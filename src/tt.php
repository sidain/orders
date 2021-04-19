<?php
 // phpcs:ignoreFile

namespace WNEO;


include_once "../vendor/autoload.php";
include_once "class-files.php";
require_once "class-database.php";
require_once "class-ajax.php";

/*
// $fileLocation = __DIR__."../uploadedFiles/";
$fileLocation = __DIR__."/../uploadedFiles/QB open orders.xlsx";

echo $fileLocation;
echo "<br />"; 
echo "<br />"; 

$f = new file();
// $f->setup($fileLocation);
$f->parseFileToCsvData($fileLocation);
*/

/*
$ajax = new Ajax();
$ajax->fileProcess();
*/

$db= new \WNEO\OrdersDB();
$ajax = new Ajax();

$db->initializeDB();

//$pdo = $db->openDB();

/*
$sql = "select distinct name from {$db->_dbName}.{$db->_ordersTable}";

$stmt= $pdo->prepare($sql);
$stmt->execute(  );
$result= $stmt->fetchAll(\PDO::FETCH_ASSOC);

foreach( $result as $key=> $fields){
    $sql = <<<TTT
        insert ignore into {$db->_dbName}.{$db->_clientsTable} (name_full)
        select :fullname
        from dual
        where not exists(
            select 1 from {$db->_dbName}.{$db->_clientsTable}
            where name_full = :fullname
        )
        limit 1;
    TTT;    
    
    $stmt= $pdo->prepare($sql);
    $result = $stmt->execute( [':fullname' => $fields['name']  ]  );
     
}
*/


