<?php

/**
 * Implements hook_views_data().
 */
function event_participation_views_data() {
  $data = [];

  // Tablo tanımı
  $data['event_participation']['table'] = [
    'group' => t('Event Participation'),
    'provider' => 'event_participation',
    'base' => [
      'field' => 'id',
      'title' => t('Event Participation'),
      'help' => t('Etkinlik katılım kayıtları'),
    ],
  ];

  // ID
  $data['event_participation']['id'] = [
    'title' => t('ID'),
    'help' => t('Primary Key'),
    'field' => ['id' => 'numeric'],
    'filter' => ['id' => 'numeric'],
    'sort' => ['id' => 'standard'],
  ];

  // Ad
  $data['event_participation']['first_name'] = [
    'title' => t('First Name'),
    'help' => t('Katılımcının adı'),
    'field' => ['id' => 'standard'],
    'filter' => ['id' => 'string'],
    'sort' => ['id' => 'standard'],
  ];

  // Soyad
  $data['event_participation']['last_name'] = [
    'title' => t('Last Name'),
    'help' => t('Katılımcının soyadı'),
    'field' => ['id' => 'standard'],
    'filter' => ['id' => 'string'],
    'sort' => ['id' => 'standard'],
  ];

  // Telefon
  $data['event_participation']['phone'] = [
    'title' => t('Phone'),
    'help' => t('Telefon numarası'),
    'field' => ['id' => 'standard'],
    'filter' => ['id' => 'string'],
    'sort' => ['id' => 'standard'],
  ];

  // Email
  $data['event_participation']['email'] = [
    'title' => t('Email'),
    'help' => t('E-posta adresi'),
    'field' => ['id' => 'standard'],
    'filter' => ['id' => 'string'],
    'sort' => ['id' => 'standard'],
  ];

  // Doğum tarihi
  $data['event_participation']['birth_date'] = [
    'title' => t('Birth Date'),
    'help' => t('Doğum tarihi'),
    'field' => ['id' => 'standard'],
    'filter' => ['id' => 'string'],
    'sort' => ['id' => 'standard'],
  ];

  // Bülten onayı
  $data['event_participation']['newsletter'] = [
    'title' => t('Newsletter'),
    'help' => t('Bültene abone mi?'),
    'field' => ['id' => 'boolean'],
    'filter' => ['id' => 'boolean'],
    'sort' => ['id' => 'standard'],
  ];

  // Katılım durumu
  $data['event_participation']['status'] = [
    'title' => t('Status'),
    'help' => t('Katılım durumu (Aktif/Pasif)'),
    'field' => [
      'id' => 'boolean',
      'click sortable' => TRUE,
    ],
    'filter' => ['id' => 'boolean'],
    'sort' => ['id' => 'standard'],
  ];

  return $data;
}
