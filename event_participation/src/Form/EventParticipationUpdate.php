<?php

namespace Drupal\event_participation\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class EventParticipationUpdate extends FormBase {

  public function getFormId() {
    return 'event_participation_status_form';
  }

  public function buildForm(array $form, FormStateInterface $form_state) {
    // Route üzerinden id parametresini al
    $id = \Drupal::routeMatch()->getParameter('id');

    // İlgili katılımcıyı veritabanından çek
    $participant = \Drupal::database()->select('event_participation', 'e')
      ->fields('e', ['id', 'status'])
      ->condition('id', $id)
      ->execute()
      ->fetchAssoc();

    // Eğer katılımcı bulunamazsa uyarı ver
    if (!$participant) {
      $this->messenger()->addError('Katılımcı bulunamadı.');
      return $form;
    }

    $form['id'] = [
      '#type' => 'hidden',
      '#value' => $id,
    ];

    $form['status'] = [
      '#type' => 'select',
      '#title' => 'Katılım Durumu',
      '#options' => [1 => 'Aktif', 0 => 'Pasif'],
      '#default_value' => $participant['status'],
      '#required' => TRUE,
    ];

    $form['submit'] = [
      '#type' => 'submit',
      '#value' => 'Güncelle',
    ];

    return $form;
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    \Drupal::database()->update('event_participation')
      ->fields(['status' => $form_state->getValue('status')])
      ->condition('id', $form_state->getValue('id'))
      ->execute();

    $this->messenger()->addMessage('Katılım durumu güncellendi.');
    $form_state->setRedirect('event_participation.list');
  }
}
