Auto Installation Not available in this beta version.
=====================================================

Steps:
======
1. Create a database.
2. Import SQL from in-stall/files/codefight_latest.sql
3. Update app/config/database.php
4. Update app/config/config.php
5. Modify .htaccess as required.

optional
========
1. Update define('CFWEBSITEID', 1); (if required) on index.php | no change required during installation.

admin:
======
base_url/admin

user: test@test.com
pass: test

If you want to use same cms for 2nd website
===========================================
just copy two root files to 2nd website's folder, note, they should be on same server to share files.
.htaccess and index.php

samples attached.