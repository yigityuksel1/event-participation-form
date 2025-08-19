<?php

namespace Drupal\event_participation\Enum;

enum ParticipantsTableHeader: string {
  case ID = 'ID';
  case FIRST_NAME = 'Ad';
  case LAST_NAME = 'Soyad';
  case PHONE = 'Telefon';
  case EMAIL = 'Mail';
  case NEWSLETTER = 'Bültene Abonelik Onayı';
  case STATUS = 'Katılım Durumu';

  public static function headers(): array {
    return array_map(fn($case) => $case->value, self::cases());
  }
}
