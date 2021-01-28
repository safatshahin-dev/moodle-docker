<?php  // Moodle configuration file

unset($CFG);
global $CFG;
$CFG = new stdClass();
//require_once('config-shared.php');

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

$CFG->wwwroot   = 'https://localhost:8443';
$CFG->dataroot = '/var/www/moodledata';
$CFG->admin     = 'admin';

$CFG->directorypermissions = 0777;

// begin ecreators additions

$CFG->debug = 0;
$CFG->debugdisplay = false;
$CFG->cronclionly = false;


//$CFG->alternative_file_system_class = '\tool_objectfs\s3_file_system';


require_once(__DIR__ . '/lib/setup.php');

// There is no php closing tag in this file,
// it is intentional because it prevents trailing whitespace problems!
