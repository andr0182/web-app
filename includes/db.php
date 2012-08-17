<?php

$user = getenv('MYSQL_USERNAME');
$pass = getenv('MYSQL_PASSWORD');
$host = getenv('MYSQL_HOST');
$dbname = getenv('MYSQL_DBNAME');

$photofinder = getenv('DB_USER');
$pass = getenv('DB_PASS');
//$data_source = getenv('DATA_SOURCE');

$data_source = sprintf('mysql:host=%s;dbname=%s',$host, $dbname);

$db = new PDO($data_source, $photofinder, $pass);

$db->exec('SET NAMES utf8');

