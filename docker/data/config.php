<?php
// Moodle configuration file

unset($CFG);
global $CFG;
$CFG = new stdClass();

$CFG->dbtype    = 'mysqli';
$CFG->dblibrary = 'native';
$CFG->dbhost = 'moodle_db';
$CFG->dbname = 'moodle_db';
$CFG->dbuser = 'moodle_db';
$CFG->dbpass = 'testmoodlepass';
$CFG->prefix    = 'mdl_';
$CFG->dboptions = array (
  'dbpersist' => 0,
  'dbport' => '',
  'dbsocket' => '',
);

$CFG->phpunit_dbtype = 'mysqli';
$CFG->phpunit_dblibrary = 'native';
$CFG->phpunit_dbhost    = 'test_db';
$CFG->phpunit_dbname    = 'test_db';
$CFG->phpunit_dbuser    = 'test_db';
$CFG->phpunit_dbpass    = 'testmoodlepass';
$CFG->phpunit_prefix    = 'phpu_';
$CFG->phpunit_dboptions = array (
    'dbpersist' => 0,
    'dbport' => '',
    'dbsocket' => '',
);
$CFG->phpunit_dataroot = '/var/www/testmoodledata';

$CFG->wwwroot   = 'http://localhost:8082';
$CFG->dataroot = '/var/www/moodledata';
$CFG->admin     = 'admin';

$CFG->directorypermissions = 0777;
$CFG->debug = 0;
$CFG->debugdisplay = false;
$CFG->cronclionly = false;
//use this for development if no emails required, cron runs every minute, please comment this line for no emails
$CFG->noemailever = true;

require_once(__DIR__ . '/lib/setup.php');

