<?php
error_reporting(E_ALL);
require 'vendor/autoload.php';
$GLOBALS['config'] = require 'config.php';
use Base\Query;
use Base\Orm;

use Orm\CEPersona;
$a = new CEPersona(1);
var_dump($a);
// $a = new Orm();
// $a->run();
//require 'genClasses.php';

// $a = new \DateTime();
// var_dump($a);
