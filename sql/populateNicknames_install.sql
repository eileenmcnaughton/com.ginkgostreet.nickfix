UPDATE civicrm_contact
SET nick_name = IFNULL(nick_name, first_name)
WHERE contact_type = "Individual"
AND nick_name IS NULL
AND first_name IS NOT NULL;