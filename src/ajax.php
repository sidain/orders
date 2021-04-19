<?php
 // phpcs:ignoreFile

session_start();
// header('Access-Control-Allow-Origin: *');
// header('Content-type: application/json');
// header('Content-type:application/json;charset=utf-8');


    include_once "./class-ajax.php";
    include_once "./class-files.php";
    require_once "./class-database.php";


    $ajax = new WNEO\Ajax();

    $action = @$_REQUEST['action'];
    $result = '';

    
    switch ($action) {
        case 'userLogin':
            // echo "userLogin exe \n";

            /*
            echo "<pre>";
            var_dump($_REQUEST);
            echo "</pre>";
            */
            
            $user= $_REQUEST['user'];
            $pw= $_REQUEST['pw'];

            $result = $ajax->userLogin($user, $pw);

            // var_dump($result);

            echo $result;
            
            break;

        case 'userCreate':
            //echo "userCreate exe";
            
            $user=      $_REQUEST['newusername'];
            $pw=        $_REQUEST['newuserpassword'];
            $company=   $_REQUEST['newusercompany'];
            
            $result = $ajax->userCreate($user, $pw, $company);

            $result = json_encode($result);
            
            
            header('Content-type: application/json');
            echo $result;

            break;

        case 'userCreateAdmin':
            //echo "userCreateAdmin exe";

            $result = '';

            if( isset($_SESSION['login_user']) && $_SESSION['login_user']['role'] === "admin"  ){

                // need to check if value are not empty
            
                $user=      $_REQUEST['newusername'];
                $pw=        $_REQUEST['newuserpassword'];
                $company=   $_REQUEST['newusercompany'];
            
                $result = $ajax->userCreate($user, $pw, $company);

                $result = json_encode($result);

                header('Content-type: application/json');
                echo $result;
            }

            break;

        
        case 'userLogout':
            session_destroy();
            
            break;



        /*
        case 'fileUpload':
            // echo "fileUpload exe";

            //$ajax->fileUpload();

            return;

            break;
        */


        case 'fileProcess':
            // echo "fileProcess exe";

            $ajax->fileProcess();

            break;


        case 'getOrders': 
            //echo "getOrders exe";

            if( $_SESSION['loggedin'] == true && strlen($_SESSION['login_user']['username']) > 0  ){

                $result = $ajax->getOrders();

                header('Content-type: application/json');
                $result = json_encode($result);
                echo $result;
            }

            break;


        case 'getClients':
            //echo "getClients";

            if( 
                isset($_SESSION['login_user']) && $_SESSION['login_user']['role'] === "admin" 
            ){
                $result = $ajax->getClients();

                header('Content-type: application/json');
                $result = json_encode($result);
                echo $result;
            }

            break;


        case 'getUsers':
            //echo "getClients";

            if( 
                isset($_SESSION['login_user']) && $_SESSION['login_user']['role'] === "admin" 
            ){
                $result = $ajax->getUsers();

                header('Content-type: application/json');
                $result = json_encode($result);
                echo $result;
            }

            break;


        default:
            # code...
            break;
    }

    die();