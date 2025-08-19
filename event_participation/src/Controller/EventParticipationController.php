<?php

namespace Drupal\event_participation\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Database\Connection;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Url;
use Drupal\event_participation\Enum\ParticipantsTableHeader;
//katılımcı listelemek için controller

class EventParticipationController extends ControllerBase {

  protected $database;

  public function __construct(Connection $database) {
    $this->database = $database;
  }

  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('database')
    );
  }

  public function listParticipants() {
   
    //tablo başlıkları oluşturuldu
   
    $header = ParticipantsTableHeader::headers();
  
    //sütunlar başlangıçta boş.
    
    $rows = [];
    
    //sql sorgusu
    
    $query = $this->database->select('event_participation', 'e')
      ->fields('e', ['id', 'first_name', 'last_name', 'phone', 'email', 'newsletter', 'status'])
      ->orderBy('id', 'ASC')   //SIRALAMA İLK KATILAN İLK LİSTELENİR
      ->execute();
    
    //her katılımcıyı tabloya girmek için bir foreach döngüsü
    
    foreach ($query as $record) {
      $status_label = $record->status ? 'Aktif' : 'Pasif';
      $newsletter_label = $record->status ? 'Evet' : 'Hayır';
      $edit_url = Url::fromRoute('event_participation.edit', ['id' => $record->id]);
  
      $rows[] = [
        $record->id,
        $record->first_name,
        $record->last_name,
        $record->phone,
        $record->email,
        $newsletter_label,
        $status_label,
        [
          'data' => [
            '#type' => 'link',
            '#title' => 'Düzenle',
            '#url' => $edit_url,
          ]
        ],
      ];
    }
    // ve fonksiyon header ve rows dönürüyor table türünde tabiki (boşsa katılımcı bulunamadı output eder ekrana)
    return [
      '#type' => 'table',
      '#header' => $header,
      '#rows' => $rows,
      '#empty' => 'Katılımcı bulunamadı.',
    ];
  }

}
