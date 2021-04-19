<?php

namespace WNEO;


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


include_once "../vendor/autoload.php";
include_once "class-files.php";
require_once "class-database.php";
require_once "class-ajax.php";

$db= new OrdersDB();
$pdo = $db->openDB();
$db->initializeDB();



$ajax = new Ajax();
$fileLocation = __DIR__."/../uploads/orders.xlsx";
$parser = new \SimpleXLSX($fileLocation);

echo $fileLocation;
echo "<br />"; 
echo "<br />"; 

// var_dump($parser);

foreach($parser->rows() as $key=>$fields ){
    $output= "$key::=>  ";

    for ($i=0; $i < count($fields) ; $i++) { 
        $output.= "($i)==> $fields[$i],";
    }

    $output.= "<br /> \n";
    
    echo $output;
}



// $_file = new file();
// $result = $f->parseFileToCsvData($fileLocation);

/*
// $fileLocation = __DIR__."../uploadedFiles/";


$f = new file();
// $f->setup($fileLocation);
*/

/*
$ajax = new Ajax();
$ajax->fileProcess();
*/






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