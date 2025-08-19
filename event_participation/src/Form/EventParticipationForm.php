<?php

namespace Drupal\event_participation\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

//class açılıyor formbase temel alıyor

class EventParticipationForm extends FormBase {

  public function getFormId() {
    return 'event_participation_form';
  }
  
  //hem submit hem update işlemini aynı anda yapabilmek için id=NIL

  public function buildForm(array $form, FormStateInterface $form_state,) {
  
      // Tabloyu kontrolü yoksa yeni tablo oluşturulur
      $schema = \Drupal::database()->schema();
      if (!$schema->tableExists('event_participation')) {
        $schema->createTable('event_participation', [
          'fields' => [
            'id' => [
              'type' => 'serial',   //her yeni katılımda id artarak gider
              'not null' => TRUE,
            ],
            'first_name' => [
              'type' => 'varchar',
              'length' => 250,
              'not null' => TRUE,
            ],
            'last_name' => [
              'type' => 'varchar',
              'length' => 250,
              'not null' => TRUE,
            ],
            'phone' => [
              'type' => 'varchar',
              'length' => 20,
              'not null' => TRUE,
            ],
            'email' => [
              'type' => 'varchar',
              'length' => 255,
              'not null' => TRUE,
            ],
            'birth_date' => [
              'type' => 'varchar',
              'length' => 10,
              'not null' => TRUE,
            ],
            'newsletter' => [
              'type' => 'int',
              'size' => 'tiny',      //boolean gibi kullanılacağı için tiny seçildi
              'not null' => TRUE,
              'default' => 0,
            ],
            'status' => [
              'type' => 'int',
              'size' => 'tiny',
              'not null' => TRUE,
              'default' => 1,
            ],
          ],
          'primary key' => ['id'],
        ]);
      }
    
     //form
     
     $form['first_name'] = [
        '#type' => 'textfield',
        '#title' => 'Adınız',
        '#required' => TRUE,
      ];

      $form['last_name'] = [
        '#type' => 'textfield',
        '#title' => 'Soyadınız',
        '#required' => TRUE,
      ];

      $form['phone'] = [
        '#type' => 'textfield',
        '#title' => 'Telefon Numaranız',
        '#required' => TRUE,
      ];

      $form['email'] = [
        '#type' => 'email',
        '#title' => 'E-Posta Adresiniz',
        '#required' => TRUE,
      ];

      $form['birth_date'] = [
        '#type' => 'date',
        '#title' => 'Doğum Tarihiniz',
        '#required' => TRUE,
      ];

      $form['newsletter'] = [
        '#type' => 'checkbox',
        '#title' => 'Bültene abone olmak istiyorum',
      ];

      $form['status'] = [
        '#type' => 'select',
        '#title' => 'Katılım Durumu',
        '#options' => [
          1 => 'Aktif',
          0 => 'Pasif',
        ],
        '#default_value' => 1,
        '#required' => TRUE,
      ];
      $form['submit'] = [
        '#type' => 'submit',
        '#value' => 'Gönder',
      ];
      return $form;
    }     
  
  public function validateForm(array &$form, FormStateInterface $form_state) {

    if (!preg_match('/^[0-9]{10}$/', $form_state->getValue('phone'))) {
      $form_state->setErrorByName('phone', 'Telefon numarası 10 hane olmalı.');
    }
  
      $birthDate = $form_state->getValue('birth_date');
    if (empty($birthDate)) {
      $form_state->setErrorByName('birth_date', 'Lütfen doğum tarihinizi girin.');
    } else {
      $birthDateParts = explode('-', $birthDate);
      if (count($birthDateParts) !== 3 || !checkdate($birthDateParts[1], $birthDateParts[2], $birthDateParts[0])) {
        $form_state->setErrorByName('birth_date', 'Geçerli bir tarih giriniz.');
        }
      }
    }
  

  public function submitForm(array &$form, FormStateInterface $form_state) {
    $id = $form_state->getValue('id');

      \Drupal::database()->insert('event_participation')
        ->fields([
          'first_name' => $form_state->getValue('first_name'),
          'last_name' => $form_state->getValue('last_name'),
          'phone' => $form_state->getValue('phone'),
          'email' => $form_state->getValue('email'),
          'birth_date' => $form_state->getValue('birth_date'),
          'newsletter' => $form_state->getValue('newsletter') ? 1 : 0,
          'status' => $form_state->getValue('status'),
        ])
        ->execute();
      $this->messenger()->addMessage('Katılımınız kaydedildi.'); //kullanıcıya mesaj verilir
      $form_state->setRedirect('event_participation.list');
    }
  }
