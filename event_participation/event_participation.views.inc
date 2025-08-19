<?php

//hook_views_data
function event_participation_views_data() {
  $data = [];

  $data['event_participation']['table'] = [
    'group' => t('Event Participation'),
    'provider' => 'event_participation',
    'base' => [
      'field' => 'id',
      'title' => t('Event Participation'),
      'help' => t('Etkinlik katılım kayıtları'),
    ],
  ];

  $data['event_participation']['id'] = [
    'title' => t('ID'),
    'help' => t('Primary Key'),
    'field' => ['id' => 'numeric'],
    'filter' => ['id' => 'numeric'],
    'sort' => ['id' => 'standard'],
  ];

  $data['event_participation']['first_name'] = [
    'title' => t('First Name'),
    'help' => t('Katılımcının adı'),
    'field' => ['id' => 'standard'],
    'filter' => ['id' => 'string'],
    'sort' => ['id' => 'standard'],
  ];

  $data['event_participation']['last_name'] = [
    'title' => t('Last Name'),
    'help' => t('Katılımcının soyadı'),
    'field' => ['id' => 'standard'],
    'filter' => ['id' => 'string'],
    'sort' => ['id' => 'standard'],
  ];

  $data['event_participation']['phone'] = [
    'title' => t('Phone'),
    'help' => t('Telefon numarası'),
    'field' => ['id' => 'standard'],
    'filter' => ['id' => 'string'],
    'sort' => ['id' => 'standard'],
  ];

  $data['event_participation']['email'] = [
    'title' => t('Email'),
    'help' => t('E-posta adresi'),
    'field' => ['id' => 'standard'],
    'filter' => ['id' => 'string'],
    'sort' => ['id' => 'standard'],
  ];

  $data['event_participation']['birth_date'] = [
    'title' => t('Birth Date'),
    'help' => t('Doğum tarihi'),
    'field' => ['id' => 'standard'],
    'filter' => ['id' => 'string'],
    'sort' => ['id' => 'standard'],
  ];

  $data['event_participation']['newsletter'] = [
    'title' => t('Newsletter'),
    'help' => t('Bültene abone mi?'),
    'field' => ['id' => 'boolean'],
    'filter' => ['id' => 'boolean'],
    'sort' => ['id' => 'standard'],
  ];

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
