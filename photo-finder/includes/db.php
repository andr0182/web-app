<?php

$phfinder = getenv('DB_PHFINDER');
$pass = getenv('DB_PASS');
$data_source = getenv('DATA_SOURCE');

$db = new PDO($data_aource, $phfinder, $pass);

$db->exec('SET NAMES utf8');

