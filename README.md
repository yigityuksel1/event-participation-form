# Event Participation Form - Drupal 10 Module

This module provides a **single event participation form** for Drupal 10 and stores participant data in the database. The module includes administration and viewing functionalities.

---

## Features

- Single event participation form  
- Form fields: First Name, Last Name, Phone Number, Email, Date of Birth  
- Newsletter subscription option  
- Participation status (Active/Inactive)  
- Validation on form submission:  
  - Phone number must be numeric and 11 digits  
  - Valid email format  
  - Required fields check  
- Admin users can access a configuration page under the Configuration menu to list and edit participants  
- End-users can view participants without any special permissions via a view  

---

## Installation and Usage

1. Copy the module to the Drupal `modules/custom` directory.  
2. Enable the module and clear the cache:
```bash
```bash
drush en event_participation -y && drush cr



