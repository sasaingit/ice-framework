<?php
ini_set('error_log', '/tmp/iceframework_test.log');

define('TEST_BASE_PATH', dirname(__FILE__).'/');

define('APP_NAME', 'Ice Framework');
define('FB_URL', 'Ice Framework');
define('TWITTER_URL', 'Ice Framework');

define('CLIENT_NAME', 'app');
define('APP_BASE_PATH', dirname(__FILE__).'/../src/');
define('CLIENT_BASE_PATH', APP_BASE_PATH.'app/');
define('BASE_URL','http://apps.gamonoid.com/ice-framework/');
define('CLIENT_BASE_URL','http://apps.gamonoid.com/ice-framework/app/');

define('APP_DB', 'icef_sample_db_test');
define('APP_USERNAME', MYSQL_ROT_USER);
define('APP_PASSWORD', MYSQL_ROT_PASS);
define('APP_HOST', 'localhost');
define('APP_CON_STR', 'mysql://'.APP_USERNAME.':'.APP_PASSWORD.'@'.APP_HOST.'/'.APP_DB);

//file upload
define('FILE_TYPES', 'jpg,png,jpeg');
define('MAX_FILE_SIZE_KB', 10 * 1024);

//Home Links
define('HOME_LINK_ADMIN', CLIENT_BASE_URL."?g=admin&n=dashboard&m=admin_Admin");
define('HOME_LINK_OTHERS', CLIENT_BASE_URL."?g=modules&n=dashboard&m=module_My_Account");

//Version
define('VERSION', '2.0');
define('VERSION_DATE', '12/03/2015');

if(!defined('SIGN_IN_ELEMENT_MAPPING_FIELD_NAME')){define('SIGN_IN_ELEMENT_MAPPING_FIELD_NAME','profile');}