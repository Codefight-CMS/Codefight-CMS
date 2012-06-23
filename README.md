Codefight CMS - a codeigniter open source php cms
==================================================

Steps to install:
-----------------
1. Create a database.
2. Import SQL from old-install/files/codefight_latest.sql
3. Update app/config/database.php
4. Update app/config/config.php
5. Modify .htaccess as required.

optional
--------
1. Update define('CFWEBSITEID', 1); (if required) on index.php | no change required during installation.
you can add more websites on same admin just use different website id on index file.

admin:
------
base_url/admin

user: test@test.com 
pass: test

If you want to use same cms for 2nd website
-------------------------------------------
just copy two root files (.htaccess and index.php) to 2nd website's folder, note, they should be on same server to share files.