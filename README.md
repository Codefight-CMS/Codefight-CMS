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
base_url/admin/ (must end with slash)

- user: test@test.com 
- pass: test

If you want to use same cms for 2nd website
-------------------------------------------
just copy two root files (.htaccess and index.php) to 2nd website's folder, note, they should be on same server to share files.

####Watch demo video here

[![demo video](https://img.youtube.com/vi/Z0cBtJvFov4/0.jpg)](https://www.youtube.com/watch?v=Z0cBtJvFov4)

###### Installation

[![demo video](https://img.youtube.com/vi/aH9FCiULI5w/0.jpg)](https://www.youtube.com/watch?v=aH9FCiULI5w)


[![Flattr this git repo](http://api.flattr.com/button/flattr-badge-large.png)](https://flattr.com/submit/auto?user_id=dbashyal&url=https://github.com/dbashyal&title=Github Repos&language=&tags=github&category=software)
