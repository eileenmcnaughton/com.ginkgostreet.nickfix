This extension will keep the nickname field populated at all times. The nickname will default
to the first name, unless another value is supplied by the user. If an existing value for
the nickname is removed, the nickname will be reset to the first name.

It is recommended that after installing this extension that you run the query

UPDATE civicrm_contact
SET
  nick_name=IFNULL(nick_name, first_name)
WHERE contact_type="Individual" AND nick_name IS NULL AND first_name IS NOT NULL

to ensure that the CiviCRM contact database is in a proper state where the nickname
field is always set.

