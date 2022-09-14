<?php

ini_set('display_errors', 0);

/** MySQL settings */
define('DBNAME', 'nordeuropa1');
define('DBUSER', 'root');
define('DBPASS', '');
define('DBHOST', 'localhost');

$file = 'data.xml';
file_exists($file) or die('Такого файла не существует');

require_once 'libs/ORM.php';
ORM::configure('mysql:host='.DBHOST.';dbname='.DBNAME);
ORM::configure([
    'username' => DBUSER,
    'password' => DBPASS
]);

$file = simplexml_load_file($file);
$data = $file->offers->offer;
$values = [];
$delete = [];

foreach ($data as $row) 
{
    $row = (array) $row;
    $delete[] = $row['id'];
    $values[] = '("'.join('", "', array_values($row)).'")';
}

try {
    $db = ORM::getDb();
    $db->query('REPLACE INTO `products` VALUES '.join(', ', $values).';');
    $db->query('DELETE FROM `products` WHERE `id` NOT IN ('.join(', ', $delete).');');
} catch(\Exception $e) {
    echo $e->getMessage();
}
