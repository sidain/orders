<?php
 // phpcs:ignoreFile

namespace WNEO;

require_once 'class-database.php';
require_once 'class-files.php';

class Ajax
{
    private $db;

    function __construct()
    {        
        $this->db= new \WNEO\OrdersDB();
    }



    function userLogin(string $username, string $pw ){
        // echo 'userLogin <br /> ';

        /**
         * 1. try to get user and password
         * 2. store in session
         */
        $retVar = -1;

        /*
        echo "<pre>";
        var_dump($username);
        var_dump($pw);
        echo "</pre>";
        */

        $pdo = $this->db->openDB();

        $sql = "select * from {$this->db->_dbName}.{$this->db->_usersTable} where username=?";    

        /*
        $stmt= $pdo->prepare($sql);
        $stmt->execute( [$username, $pw] );
        $result= $stmt->fetchAll(\PDO::FETCH_ASSOC);
        */

        try {

            $stmt= $pdo->prepare($sql);
            $stmt->execute( [$username] );
            $result= $stmt->fetchAll(\PDO::FETCH_ASSOC);

        } catch (\Throwable $th) {
            //throw $th;
            $retVar = [
                "retVar"=> 0,
                "result"=> $result,
                'u'=> $username,
                'p'=> $pw,
                'th' => $th
            ];

            $retVar = json_encode($retVar);

            $_SESSION['loggedin'] = false;
            $_SESSION['login_user'] = NULL;
        }

        /*
        echo "<pre>";
        var_dump($result);
        echo "</pre>";
        */

        /*
        var_dump($_SESSION['login']);
        var_dump($_SESSION['login_user']);
        */

        $checkPW = ($result[0]['password'] == $pw);


        if( count($result) > 0 &&  ($result[0]['password'] == $pw)){
        
            // session_start();
            // $retVar = true;

            $_SESSION['loggedin'] = true;
            $_SESSION['login_user'] = $result[0];

            $retVar = [
                'retVar' => true,
                'username'=> $result[0]['username'],
                'password'=> $result[0]['password'],
                'company'=> $result[0]['clientNameFull'],
                'role'=> $result[0]['role'],
            ];

            $retVar = json_encode($retVar);

        } else{
            $retVar = [
                "retVar"=> 0,
                "result"=> $result,
                'checkPW' => $checkPW,
                'u'=> $username,
                'p'=> $pw
            ];

            $retVar = json_encode($retVar);

            $_SESSION['loggedin'] = false;
            $_SESSION['login_user'] = NULL;
        }

        // var_dump($retVar);

        return $retVar;
    }

    function userCreate(string $username, string $password, string $company){
        /**
         * 1. check if exists already
         * 2. check if exists in client list
         * 3. create in users table
         * 
         * _dbName
         * _usersTable
         * _clientsTable
         * 
         */
        $retVar = -1;

        $pdo = $this->db->openDB();

        // check for username created already
        $sql = "select * from {$this->db->_dbName}.{$this->db->_usersTable} where username=?";    

        $stmt= $pdo->prepare($sql);
        $stmt->execute( [$username] );
        $result= $stmt->fetchAll(\PDO::FETCH_ASSOC);

        /* 
        var_dump($username);
        var_dump($sql);
        var_dump($result);
        var_dump(count($result));
        var_dump(count($result) <= 0 );
        */

        if( count($result) <= 0 ){
            /**
             * 1?. check if user exists in clients
             * 2. create iin user table
             * 3. login user
             * 4. returnn user created msg
             * 
             */


            //get client info
            $sql = "select * from  {$this->db->_dbName}.{$this->db->_clientsTable} where name_full like ?";

            $stmt = $pdo->prepare($sql);

            $stmt->execute( ["%$company%"] );
            $result= $stmt->fetchAll(\PDO::FETCH_ASSOC);

            // var_dump($result);

            if( count($result) > 1 ){
                //more then 1 result, send back for feedback
                $errorValue = [];

                foreach( $result as $key => $fields ){
                    array_push($errorValue, $fields['name_full']);
                }

                $retVar = [ 
                    'retVar' => -2, 
                    'errorMsg' => 'More then one similar  Company found, click on the intended one and try again', 
                    'errorType' => '', 
                    'errorValue' => $errorValue 
                ];


            }
            else if( count($result) == 1 ){

                $sql = "insert into {$this->db->_dbName}.{$this->db->_usersTable} (username, password, company, clientID, clientNameFull, clientNameAbrev, role) value (?,?,?,?,?,?,?)";

                $stmt= $pdo->prepare($sql);
                $result = $stmt->execute( [$username, $password, $result[0]['name_full'], $result[0]['id'], $result[0]['name_full'], $result[0]['name_abrev'], 'user' ] );

                if( $result ){
                    $retVar = $result;

                    $sql = "select * from {$this->db->_dbName}.{$this->db->_usersTable} where username=? and password=?";  

                    $stmt= $pdo->prepare($sql);
                    $stmt->execute( [$username, $password] );
                    $result= $stmt->fetchAll(\PDO::FETCH_ASSOC);

                    // @session_start();

                    if( isset($_SESSION['login_user']) && $_SESSION['login_user']['role'] === "admin"  ){

                    }else{
                        $_SESSION['loggedin'] = true;
                        $_SESSION['login_user'] = $result[0];
                    }

                    $retVar = [
                        'retVar' => true,
                        'username'=> $result[0]['username'],
                        'company'=> $result[0]['clientNameFull'],
                    ];

                    // $retVar = json_encode($retVar);
                }
                else{
                    $retVar = 0;
                }
            }

            
        }
        else{
            // return user exists message            

            $retVar = [ 
                'retVar' => 2, 
                'errorMsg' => 'User already exists', 
                'errorType' => '', 
                'errorValue' => [] 
            ];

            $retVar = json_encode($retVar);
        }

        return $retVar;
    }

    function userForgotPassword(string $username){
        return;
    }
    
    function userDelete(string $username){
        return;
    }



    function fileProcess(){
        /**
         * 0. check for table, drop table, create table 
         * 1. initialize parser
         * 2. open file
         * 3. parse file into memory, csv?
         * 4. add data to 
         * 
         * _dbName
         * _ordersTable
         * 
         */

        /**
         * file is uploaded by microsoft flow
         * from shared google drive folder
         * every 6 hours
         * 
         * https://us.flow.microsoft.com/
         * 
         * ac-orders@outlook.com
         * acorders3321
         * 
         * orders/src/ajax.php?action=fileProcess
         * /home/artisticcoatings/public_html/ac-orders/orders/src
         * 
         * https://artisticcoatingsin.com/ac-orders/orders/src/ajax.php?action=fileProcess
         * 
         */

        $fileLocation = __DIR__."/../uploads/orders.xlsx";
        $f = new file();
        // $f->setup($fileLocation);
        $f->parseFileToCsvData($fileLocation);

        return;
    }


    function fileUpload(string $filename, string $fileData){
        /**
         * 0. check for table, drop table, create table 
         * 1. upload file
         * 2. open file
         * 3. convert to data
         * 4. truncate orders table
         * 5. import data  into orders table
         */

        return;
    }



    
    function getOrders(){
        /**
         * 1.get user value
         * 2.get orders
         * 3.return json
         * 
         * _dbName
         * _ordersTable
         * 
         */

        $result = '';

        if( $_SESSION['loggedin'] == true && strlen($_SESSION['login_user']['username']) > 0  ){

            $company = $_SESSION['login_user']['company'];

            if( $_SESSION['login_user']['role'] === "admin" ){
                $sql= "select * from {$this->db->_dbName}.{$this->db->_ordersTable}";
            }
            else{
                $sql= "select * from {$this->db->_dbName}.{$this->db->_ordersTable} where name like ?";
            }
            
            
            $pdo = $this->db->openDB();
            $stmt= $pdo->prepare($sql);
            $stmt->execute( ["%$company%"] );
            $result= $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }

        return $result;
    }    

    
    function getClients(){
        /**
         * 0. check admin
         * 1. get user value
         * 2. get orders
         * 3. return json
         * 
         * _dbName
         * _ordersTable
         * 
         */

        $result = '';

        if( isset($_SESSION['login_user']) && $_SESSION['login_user']['role'] === "admin"  ){

            $sql= "select * from {$this->db->_dbName}.{$this->db->_clientsTable} order by name_full";

            $pdo = $this->db->openDB();
            $stmt= $pdo->prepare($sql);
            $stmt->execute( );
            $result= $stmt->fetchAll(\PDO::FETCH_ASSOC);            
        }

        return $result;
    }    

    function getUsers(){
        /**
         * 1. check admin
         * 2. get users
         * 3. return json
         */

         $result = '';

        if( isset($_SESSION['login_user']) && $_SESSION['login_user']['role'] === "admin"  ){

            $sql= "select * from {$this->db->_dbName}.{$this->db->_usersTable} order by company";

            $pdo = $this->db->openDB();
            $stmt= $pdo->prepare($sql);
            $stmt->execute( );
            $result= $stmt->fetchAll(\PDO::FETCH_ASSOC); 

        }

        return $result;        
    }
}
