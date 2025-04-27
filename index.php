<?php
error_reporting(E_ALL);
require 'vendor/autoload.php';
$GLOBALS['config'] = require 'config.php';
use Base\Query;
use Base\Orm;
use Orm\CESoggetto;
use Utility\CodiceFiscale;
// use Orm\CEPersona;
//$query = new Query();
//$fields = $query->query("SELECT * FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = 'test' /* AND TABLE_NAME='$row[TABLE_NAME]'  */ ORDER BY ORDINAL_POSITION");
//var_dump($fields);

$a = new CodiceFiscale("attilio", "monti", new DateTime("1984/01/03"), "Roma", "M");
echo $a->getCodice();
// $a = new CESoggetto(1);
// var_dump($a);
//var_dump($a->getNome());
// echo $a->save();
// $a = new Orm();
// $a->run();
// require 'genClasses.php';

// $a = new \DateTime();
// var_dump($a);
