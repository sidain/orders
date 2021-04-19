<?php
 // phpcs:ignoreFile

namespace WNEO;

// use SimpleXLSX;

require_once "../vendor/shuchkin/simplexlsx/src/SimpleXLSX.php";
require_once "class-database.php";

class file
{
    var $directory;
    var $file; 
    var $parser;

    var $input;
    var $output;

    function __construct(){  
        return;      
    }

    function setup(String $location){
        echo __CLASS__;
        return;
    }

    function parseFileToCsvFile(String $location){

        try {
            $parser = new \SimpleXLSX($location);
        
            $fp = fopen('file.csv', 'w');
            foreach ($parser->rows() as $fields ) {
                fputcsv( $fp, $fields);
            }
            fclose($fp);
            
        } catch (\Throwable $th) {
            var_dump($th);
        }

        return;
    }

    function parseFileToCsvData(String $location){
                
        try {

            $db= new \WNEO\OrdersDB();

            $pdo= $db->openDB();

            $sql= "truncate table {$db->_dbName}.{$db->_ordersTable}";
            // $sql= "drop ?table {$db->_dbName}.{$db->_ordersTable}";
            $pdo->exec($sql);
            $db->initializeDB();
            

            $parser = new \SimpleXLSX($location);

        
            foreach($parser->rows() as $key=>$fields ) {

                /**
                 * 2.   P. O. #
                 * 4.   Via
                 * 6.   Finish Color
                 * 8.   Name
                 * 10.  Memo
                 * 12.  Wood
                 * 14.  Qty
                 * 16.  Builder
                 * 18.  Status
                 * 20.  Date Recieved
                 * 22.  Ship Date
                 */

                 if( $key > 0 && $fields[8] != "" ){

                    $output= "$key:: ".
                        $fields[2].", ".
                        $fields[4].", ".
                        $fields[6].", ".
                        $fields[8].", ".
                        $fields[10].", ".
                        $fields[12].", ".
                        $fields[14].", ".
                        $fields[16].", ".
                        $fields[18].", ".
                        $fields[20].", ".
                        $fields[22].", ".
                        "<br />";

                    echo $output;

                    $sql="insert into {$db->_dbName}.{$db->_ordersTable} (po_num, via, finish_color, name, memo, wood, qty, builder, status, date_received,ship_date) values (?,?,?,?,?,?,?,?,?,?,?)";

                    try {
                        $stmt = $pdo->prepare($sql);
                        $result = $stmt->execute(
                            [
                                $fields[2],
                                $fields[4],
                                $fields[6],                            
                                $fields[8],                            
                                $fields[10],                            
                                $fields[12],                            
                                $fields[14],                            
                                $fields[16],                            
                                $fields[18],                            
                                $fields[20],                            
                                $fields[22]                            
                            ]
                        );

                    } catch (\Throwable $th) {
                        var_dump($th);
                    }
                 };
            }

            // grab unique clients from orders and insert into clients table

            $sql = "select distinct name from {$db->_dbName}.{$db->_ordersTable} where name != '' ";

            $stmt= $pdo->prepare($sql);
            $stmt->execute(  );
            $result= $stmt->fetchAll(\PDO::FETCH_ASSOC);

            foreach( $result as $key=> $fields){
                $sql = "
                    insert ignore into {$db->_dbName}.{$db->_clientsTable} (name_full)
                    select :fullname
                    from dual
                    where not exists(
                        select 1 from {$db->_dbName}.{$db->_clientsTable}
                        where name_full = :fullname
                    )
                    limit 1;";
                
                $stmt= $pdo->prepare($sql);
                $result = $stmt->execute( [':fullname' => $fields['name']  ]  );
                
            }

            
            
        } catch (\Throwable $th) {
            var_dump($th);
        }

        // unlink to delete file

        return $location;
    }
}
