# Test for russian-english students.
Requires Yii2, mysql, PHP.
Includes Bootstrap, angularJS v1.5.8.

To make this script works:
- import the DB data from data.sql
- install Yii2 into project subfolder /backend, make DB config, replace files with the one from repository at /backend.
- if you have PHP version > 5.6 make sure that you have uncommented the string "always_populate_raw_post_data = -1" in the php.ini file 
- from project directory start PHP server "php -S localhost:8000"
- open "http://localhost:8000" in your favourite browser.
