<?php

namespace Drupal\event_participation\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

//class açılıyor formbase temel alıyor

class EventParticipationForm extends FormBase {

  public function getFormId() {
    return 'event_participation_form';
  }
  
  //hem submit hem update işlemini aynı anda yapabilmek için id=>NIL

  public function buildForm(array $form, FormStateInterface $form_state, $id = NULL) {

    if ($id) {
      // Admin yetkisi update sadece status attribute için
      $participant = \Drupal::database()->select('event_participation', 'e')
        ->fields('e', ['id', 'status'])
        ->condition('id', $id)
        ->execute()
        ->fetchAssoc();

      $form['id'] = [
        '#type' => 'hidden',
        '#value' => $id,
      ];

      $form['status'] = [
        '#type' => 'select',
        '#title' => 'Katılım Durumu',
        '#options' => [
          1 => 'Aktif',
          0 => 'Pasif',
        ],
        '#default_value' => $participant['status'],
        '#required' => TRUE,
      ];

    } else {
      // yeni katılımcı formu
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
    }
    //id kontrolü yaparak submit butonu ayarlandı
    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $id ? 'Güncelle' : 'Gönder',
    ];

    return $form;
  }

  public function validateForm(array &$form, FormStateInterface $form_state) {
    //validation sadece yeni katılımda (id=>NIL) yapılır
    if (!$form_state->getValue('id')) {
      if (!preg_match('/^[0-9]{10}$/', $form_state->getValue('phone'))) {
        $form_state->setErrorByName('phone', 'Telefon numarası 10 hane olmalı.');
      }

      $birth_date = $form_state->getValue('birth_date');
      if (empty($birth_date)) {
        $form_state->setErrorByName('birth_date', 'Lütfen doğum tarihinizi girin.');
      } else {
        $parts = explode('-', $birth_date);
        if (count($parts) !== 3 || !checkdate($parts[1], $parts[2], $parts[0])) {
          $form_state->setErrorByName('birth_date', 'Geçerli bir tarih giriniz.');
        }
      }
    }
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    $id = $form_state->getValue('id');

    if ($id) {
      // id != NIL => update yapılır
      \Drupal::database()->update('event_participation')
        ->fields(['status' => $form_state->getValue('status')])
        ->condition('id', $id)
        ->execute();
      $this->messenger()->addMessage('Katılım durumu güncellendi.'); //admine mesaj verilir
    } else {
      // id == NIL => insert yapılır
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
    }

    $form_state->setRedirect('event_participation.list');
  }
}

