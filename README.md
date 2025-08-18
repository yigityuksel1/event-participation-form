# Event Participation Form (Drupal Module)

A custom Drupal 10 module that provides a single-event participation form with validation, database storage, and both admin and public participant listings.

## Features
- 📋 **Event Participation Form**
  - Collects participant details: first name, last name, phone number, email address, date of birth, newsletter subscription consent, and active/inactive status.
  - Validates input (e.g., phone number must be numeric and exactly 11 digits).
  - Stores submissions in a custom database table.

- 🔒 **Admin Interface**
  - Accessible only to users with **admin permissions** under the **Configuration** menu.
  - Lists all participants in a table.
  - Provides an edit page to update participant active/inactive status.

- 🌍 **Public View**
  - Displays the list of participants through a **Drupal View**.
  - Accessible without requiring any user permissions.

## Tech Stack
- [Drupal 10](https://www.drupal.org/)
- PHP
- MySQL/MariaDB

## Installation
1. Clone the repository into your Drupal `/modules/custom/` directory:
   ```bash
   git clone https://github.com/your-username/event_participation.git web/modules/custom/event_participation
