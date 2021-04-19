<?php
 // phpcs:ignoreFile

namespace WNEO;

class OrdersDB
{
    private  $_sql;
    private  $_dbServerName;
    private  $_dbUserName;
    private  $_dbPassword;
    
    public  $_dbName;

    public  $_ordersTable="wneo_ac_orders";
    public  $_usersTable="wneo_ac_users";
    public  $_settingsTable="wneo_ac_settings";
    public  $_clientsTable="wneo_ac_clients";


    public function __construct(){
        
        if (true) {
            $this->_dbName = 'artisticcoatings_1';
            $this->_dbServerName = "localhost";
            $this->_dbUserName = "artisticcoatings_ac_orders";
            $this->_dbPassword = "ac_orders3321";
        }else{
            $this->_dbName = 'wp0';
            $this->_dbServerName = "localhost";
            $this->_dbUserName = "wordpressuser";
            $this->_dbPassword = "wordpressuser3321";
        }

    }

    function initializeDB(){
        $pdo = $this->openDB();

        //test for user table, create if missing
        $sql = "select 1 from $this->_usersTable";

        try {
            $tableExists = $pdo->query($sql);
        } catch (\Throwable $th) {
            echo "<pre>";
            var_dump($th);
            echo "</pre><br /><br />";


            $sql = "
                CREATE TABLE `$this->_dbName`.`$this->_usersTable` (
                `id` INT NOT NULL AUTO_INCREMENT,
                `username` VARCHAR(45) NULL,
                `password` VARCHAR(45) NULL,
                `company` VARCHAR(45) NULL,
                `email` VARCHAR(45) NULL,
                
                `clientID` VARCHAR(45) NULL,
                `clientNameFull` VARCHAR(45) NULL,
                `clientNameAbrev` VARCHAR(45) NULL,
                
                `role` VARCHAR(45) NULL,
                `resetPassword` VARCHAR(45) NULL,

                `option1` VARCHAR(45) NULL,
                `option2` VARCHAR(45) NULL,
                `option3` VARCHAR(45) NULL,

                `created` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
                `modified` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY (`id`));";        


            try {
                $pdo->exec($sql);

            } catch (\Throwable $th) {
                echo "<pre>";
                var_dump($th);
                echo "</pre><br /><br />";
            }

            $sql= "
                insert into {$this->_dbName}.{$this->_usersTable} (
                    username, 
                    password, 
                    company, 
                    email, 
                    role
                ) values  (
                    'admin',
                    'admin3321',
                    '*',
                    'rchual@websiteneo.com',
                    'admin'
                );
            ";

            try {
                $pdo->exec($sql);

            } catch (\Throwable $th) {
                echo "<pre>";
                var_dump($th);
                echo "</pre><br /><br />";
            }
        }






        //test for orders table, create if missing
        // _ordersTable
        $sql = "select 1 from $this->_ordersTable";

        try {
            $tableExists = $pdo->query($sql);
        } catch (\Throwable $th) {
            echo "<pre>";
            var_dump($th);
            echo "</pre><br /><br />";

                
            $sql ="
                CREATE TABLE `$this->_dbName`.`$this->_ordersTable` (
                    `id` INT NOT NULL AUTO_INCREMENT,
                    `po_num` text,
                    `via` text,
                    `finish_color` text,
                    `name` text,
                    `memo` text,
                    `wood` text,
                    `qty` text,
                    `builder` text,
                    `status` text,
                    `date_received` text,
                    `ship_date` text,
                    `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
                    `modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
                    PRIMARY KEY (`id`)
                );";
            



            try {
                $pdo->exec($sql);

            } catch (\Throwable $th) {
                echo "<pre>";
                var_dump($th);
                echo "</pre><br /><br />";
            }
        }






        //test for settings table, create if missing
        // _clientsTable
        $sql = "select 1 from $this->_clientsTable";

        try {
            $tableExists = $pdo->query($sql);
        } catch (\Throwable $th) {
            echo "<pre>";
            var_dump($th);
            echo "</pre><br /><br />";


            $sql ="
                CREATE TABLE `$this->_dbName`.`$this->_settingsTable` (
                `id` INT NOT NULL AUTO_INCREMENT,
                `setting` VARCHAR(45) NULL,
                `_value` VARCHAR(45) NULL,
                PRIMARY KEY (`id`))
                COMMENT = '		';";

            try {
                $pdo->exec($sql);

            } catch (\Throwable $th) {
                echo "<pre>";
                var_dump($th);
                echo "</pre><br /><br />";
            }
        }
       
       
       
       
       
       
       
        //test for clients table, create if missing
        // _clientsTable
        $sql = "select 1 from $this->_clientsTable";

        try {
            $tableExists = $pdo->query($sql);
        } catch (\Throwable $th) {
            echo "<pre>";
            var_dump($th);
            echo "</pre><br /><br />";


            $sql ="
                CREATE TABLE `$this->_dbName`.`$this->_clientsTable` (
                `id` INT NOT NULL AUTO_INCREMENT,
                `name_full` VARCHAR(255) NULL,
                `name_abrev` VARCHAR(45) NULL,
                PRIMARY KEY (`id`))
                COMMENT = '		';";

            try {
                $pdo->exec($sql);

            } catch (\Throwable $th) {
                echo "<pre>";
                var_dump($th);
                echo "</pre><br /><br />";
            }
        }
    }


    function openDB(){
        // get pdo object with settings
        try {
            $pdo = new \PDO( "mysql:host=$this->_dbServerName;dbname=$this->_dbName", $this->_dbUserName, $this->_dbPassword);

            // set the PDO error mode to exception
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            
            // echo "Connected successfully<br />";

            return $pdo;

        } catch (\Throwable $th) {
            //throw $th;
            echo "Connection failed: " . $th->getMessage();
        }
    }

    function closeDB(){

    }
}
