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
drush en event_participation -y && drush cr
```
3. Access the form page: /event-participation
4. Admin users can list and edit participants at: /admin/config/event-participation
5. End-users can view participants via the view at: /event-participation/list

## Form Fields and Validation 

---

```markdown
| Field             | Type      | Required | Validation / Description                |
|-------------------|-----------|---------|----------------------------------------|
| First Name        | Text      | Yes     | Participant's first name                |
| Last Name         | Text      | Yes     | Participant's last name                 |
| Phone Number      | Tel       | Yes     | Numeric, 11 digits                       |
| Email             | Email     | Yes     | Valid email format                        |
| Date of Birth     | Date      | Yes     | Participant's date of birth              |
| Newsletter Opt-in | Checkbox  | No      | Subscribe to newsletter                  |
| Participation Status | Select  | Yes     | Active / Inactive                        |
```

---

## Contributing

1. Fork this repository
2. Create your feature branch
3. Submit a pull request

---

