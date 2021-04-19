<?php
    // phpcs:ignoreFile
    
    // header("Access-Control-Allow-Origin: *");

    //start session
    session_start();
    // session_destroy();

    // include_once "./class-database.php";
    // $db= new WNEO\DB();

    

    if( isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true ){
        // var_dump($_SESSION);

        $loggedin = $_SESSION['loggedin'];
        $username = $_SESSION['login_user']['username'];
        $pw = $_SESSION['login_user']['password'];    
        $role = $_SESSION['login_user']['role'];
    }
    else{
        $loggedin = false;
    }    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">





    <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> -->

    <script
        src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
        crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>    

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://unpkg.com/bootstrap-show-password@1.2.1/dist/bootstrap-show-password.min.js"></script>

    <!-- <script src="https://cdn.rawgit.com/h2non/jsHashes/master/hashes.js"></script> -->






    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.js"></script>


    <!-- <script src="https://cdn.jsdelivr.net/npm/vue-axios@2.1.5/src/index.js"></script> -->

    <!-- <script src="https://cdn.jsdelivr.net/npm/vee-validate@latest/dist/vee-validate.js"></script> -->

    <!-- iframe resizer -->
    <script src="https://artisticcoatingsin.com/ac-orders/orders/assets/js/iframeResizer.contentWindow.min.js"></script>

    <style>   

        div.vue-div>div.navigation{
            margin-bottom: 100px;
        }   

        div.vue-div>div.row>div.information{
            margin-bottom: 20px;
        }

        div.vue-div>div.row>div.orders{
            margin-top: 20px;
        }

        span.nav-link, span.error-company{
            cursor: pointer;
        }

        table.orders-table th:hover{
            color: #007bff;
        }

        table.orders-table th{
            cursor: pointer;
            text-align: center;
            vertical-align: middle;
        }

        .card {
            border: 0;
        }

        .bg-light {
            background-color: #fff !important;
        }       

    </style>

    <script>
    </script>
</head>
<body>

        <!-- 
        container-fluid
        -->
        <div id='vue-div' class="vue-div container-fluid">


            <!-- <div class="row"> -->
                
                <div class="row navigation">
                    <!-- 
                        justify-content-center
                        
                    -->
                    <nav class="navbar  bg-light navbar-expand-sm navbar-light fixed-top">


                            
                            <!--                             
                            <a href="#" class="navbar-brand  ">
                                <img src="https://artisticcoatingsin.com/wp-content/uploads/elementor/thumbs/artistic-coatings-logo-oo2lul4m0of7z1tqih7y3nknatwlf7i6dz4q6aee5u.png" alt="" height="30">
                            
                            </a> 
                            -->

                            <a v-show="loggedIn != true" href="#" class="navbar-brand  ">
                                <span>WELCOME</span>
                            
                            </a> 

                                    
                                <!--  
                                <ul v-show="loginUserRole==='admin'"  class="navbar-nav  ">
                                    <li v-show="loggedIn != true" class="nav-item">
                                        <span v-on:click="createLoginClick1" class="nav-link">Create Login</span>
                                    </li>
                                    

                                    
                                    <li class="nav-item">
                                        <span v-on:click="fileUploadClick1" class="nav-link">Upload</span>
                                    </li>
                                    

                                    
                                    
                                    <li class="nav-item">
                                        <span v-on:click="adminClick" class="nav-link">Admin</span>
                                    </li>
                                    
                                    
                                    
                                    <li  v-show="loggedIn == true" class="nav-item">
                                        <span v-on:click="getOrdersClick" class="nav-link">Orders</span>
                                    </li>   
                                    
                                    
                                    <li  v-show="loggedIn == true" class="nav-item ml-4">
                                        <form class='fileUpload form-inline ' v-on:submit.prevent="function(){ ; }">    
                                            
                                            <button v-on:click="fileProcessClick" class='btn btn-sm btn-primary '>Process Upload File</button>
                                        </form>
                                    </li>

                                </ul>
                                -->
                            
                                

                                
                            <form id="login-form" name="login-form" v-show="loggedIn == false" action="" class="form-inline ml-auto login-form" v-on:submit.prevent="function(){ ; }">

                                <div class="form-group form-row justify-content-end">
                                    <input 
                                        v-on:focus="hidePopoverFocus" 
                                        id="loginUsername" 
                                        name="loginUsername" 
                                        class='loginUsername form-control-sm col-4 mr-1' 
                                        type="text" 
                                        v-model="loginUsername" 
                                        placeholder="Usernname">
                                    
                                    <div class="col form-row mr-0">
                                        <!--  
                                        <input 
                                            v-on:focus="hidePopoverFocus" 
                                            type="password" 
                                            id="loginUsernamePassword" 
                                            name="loginUsernamePassword" 
                                            v-model="loginUsernamePassword" 
                                            class='loginUsernamePassword form-control-sm col-7' 
                                            data-toggle="password" 
                                            data-size='sm' 
                                            placeholder="Password">
                                        -->

                                        <input 
                                            v-on:focus="hidePopoverFocus" 
                                            type="text" 
                                            id="loginUsernamePassword" 
                                            name="loginUsernamePassword" 
                                            class='loginUsernamePassword form-control-sm col-9' 
                                            data-toggle="password" 
                                            data-size='sm' 
                                            placeholder="Password">
                                    </div>    

                                            

                                    <button v-on:click="userLoginClick" class="btn btn-sm btn-primary col-2 ml-n5">Login</button>

                                    
                                    
                                    <!-- 
                                    <button class="btn btn-sm btn-primary col-2 mr-1">Logout</button> 
                                    -->
                                </div>
                            </form>   

                            <form v-show="loggedIn == true" action="" class="form-inline ml-auto" v-on:submit.prevent="function(){ ; }">

                                <div class="form-group form-row justify-content-end">
                                   <span class="col-3 mr-4">Welcome </span>
                                    
                                    <label class="col-3 mr-2">{{loginUsername}}</label>

                                    <button v-on:click="userLogoutClick" class="btn btn-sm btn-primary col-4 mr-1">Logout</button>

                                </div>
                            </form>         
                            
                    </nav>
                </div>
            <!-- </div>  -->

            <div class="row">
                <!-- 
                    w-auto                    
                 -->
                <div class="information card col w-auto p-0">
                    <div class="card-header">
                        ORDER TRACKING
                    </div> 
                    
                    
                    <div class="card-body" v-show="state === ''">
                        <h5 class="card-title"></h5>

                        <div class="card-body">
                            Please login to view orders
                        </div>
                    </div>
                    
                    <div class="card-body" v-show="state === 'create'">
                        <h5 class="card-title"></h5>

                        <div class="card-body">
                            Please fill out the short form below and press Submit
                        </div>
                    </div>
                    
                    <div class="card-body" v-show="state === 'upload'">
                        <h5 class="card-title"></h5>

                        <div class="card-body">
                            Upload files here
                        </div>
                    </div>
                    
                    <div class="card-body" v-show="state === 'admin'">
                        <h5 class="card-title">Admin</h5>

                        <div class="card-body">
                            
                        </div>
                    </div>

                    
                    
                    <div class="card-body" v-show="state === 'orders'">
                        <h5 class="card-title">{{loginUserCompany}}</h5>

                        <div class="card-text">        
                            Currently <span class="badge badge-primary">{{orders.length}}</span> Orders open
                        </div>          
                    </div>
                    

                    

                    <div class="card-body" v-show="errorMsg.length > 0">
                        <h5 class="card-title">Error</h5>

                        <div class="card-text">
                            There has been and error, {{errorMsg}}
                        </div>
                    </div>

                </div>
            </div>
          

            
            <!--  
            <div class="row justify-content-center">
                <div v-show="state === 'upload'" class="uploads card col-8 p-4">
                    <h5 class="card-title">Uploads</h5>

                    <form class='fileUpload ' v-on:submit.prevent="function(){ ; }">

                        <div class="form-group form-row">

                            <label class='col-sm-4 col-form-label' for="fileUserName">Username:</label>
                            
                            <input id='fileUserName' name='fileUserName' v-model="fileUserName" type="text" class="fileUserName form-control col" placeholder="Username">

                        </div>
                        

                        <div class="form-group form-row">

                            <label class="col-sm-4 col-form-label" for="fileUserPw">Password:</label>

                            <input id='fileUserPw' name='fileUserPw'  v-model='fileUserPw' class='fileUserPw form-control col' type="text" placeholder="Password">

                        </div>
                                

                        <div class="form-group form-row">

                            <label class="col-sm-4 col-form-label" for="fileInput">File:</label>
                            
                            <input type="file" class="inputFile form-input col" id="fileInput" name="fileInput" >

                        </div>

                        
                        
                        <div class="row">
                            <label class="col-sm-2" for="fileName">File:</label>

                            <input id='fileName' name='fileName' v-model='fileName' class='inputFile form-control col-sm-4' type="text" value="./uploadedFiles/QB open orders.xlsx">
                        </div>
                        

                        <div class="float-right">
                            <button v-on:click="fileUploadClick2" class='btn btn-primary  '>Submit</button>                        

                            <button v-on:click="fileProcessClick" class='btn btn-primary '>Process</button>
                        </div>

                    </form>
                </div>
            </div>
            -->
            
          

            
            <div class="row">
                <div v-show="loginUserRole === 'admin'" class="uploads card border col p-4">
                    <h5 class="card-title">Admin</h5>

                    <div class="card-body">
                        <form class='createClientLogins' v-on:submit.prevent="function(){ ; }">

                            <div class="">
                                <div class="form-group form-row">
                                    <button v-on:click="getClientsClick" class='btn btn-primary mr-2 '>Create New Users</button>

                                    <button v-on:click="getUsersClick" class='btn btn-primary mr-2'>Get Users</button>

                                    <button v-on:click="fileProcessClick" class='btn btn-sm btn-primary '>Process Upload File</button>
                                </div>
                            </div>

                            <div class="row">
                                <table v-show="users.length > 0" class="table table-bordered table-striped table-hover table-responsive table-sm orders-table col">
                                    <tr>
                                        <th>Company Name</th>
                                        <th>Username</th>
                                        <th>Password</th>
                                        <th></th>
                                        <th></th>
                                    </tr>    
                                
                                    <tr class="user" v-for=" u in users ">
                                        <td>{{u.company}}</td>
                                        <td>{{u.username}}</td>
                                        <td>{{u.password}}</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </table>
                            </div>




                            <div class="row">
                                <table  v-show="clients.length > 0"  class="table table-bordered table-striped table-hover table-responsive table-sm orders-table col">
                                    <tr>
                                        <th>Company Name</th>
                                        <th>Username</th>
                                        <th>Password</th>
                                        <th></th>
                                        <th></th>
                                    </tr>

                                    <tr v-for="(client, index) in clients" v-bind:class="'cu'+index">

                                        <td>
                                            <input 
                                                type="text" 
                                                class="newClientName form-control cuCompany" 
                                                v-bind:value="client.name_full" 
                                                v-bind:id="'cu'+index+'Company'" 
                                                v-bind:class="'cu'+index">
                                        </td>
                                        
                                        <td>
                                            <input 
                                                type="text" 
                                                class="newClientUsername form-control cuUsername" 
                                                v-bind:id="'cu'+index+'Username'"
                                                v-bind:class="'cu'+index">
                                        </td>

                                        <td>                                        
                                            <input 
                                                type="text" 
                                                class="newClientPassword form-control cuPassword" 
                                                v-bind:id="'cu'+index+'Password'"
                                                v-bind:class="'cu'+index">
                                        </td>
                                            
                                        <td>
                                            <button v-on:click="createLoginClick3('cu'+index);" class='btn btn-primary '>Create User</button>
                                        </td>

                                        <td>
                                            <!-- info -->
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            


                            



                        </form>
                    </div>

                    

                    <!--  
                    <form class='fileUpload ' v-on:submit.prevent="function(){ ; }">

                        <div class="form-group form-row">

                            <label class='col-sm-4 col-form-label' for="fileUserName">Username:</label>
                            
                            <input id='fileUserName' name='fileUserName' v-model="fileUserName" type="text" class="fileUserName form-control col" placeholder="Username">

                        </div>
                        

                        <div class="form-group form-row">

                            <label class="col-sm-4 col-form-label" for="fileUserPw">Password:</label>

                            <input id='fileUserPw' name='fileUserPw'  v-model='fileUserPw' class='fileUserPw form-control col' type="text" placeholder="Password">

                        </div>
                                

                        <div class="form-group form-row">

                            <label class="col-sm-4 col-form-label" for="fileInput">File:</label>
                            
                            <input type="file" class="inputFile form-input col" id="fileInput" name="fileInput" >

                        </div>

                        <div class="float-right">
                            <button v-on:click="fileUploadClick2" class='btn btn-primary  '>Submit</button>                        

                            <button v-on:click="fileProcessClick" class='btn btn-primary '>Process</button>
                        </div>

                    </form>
                    -->
                </div>
            </div>
            
            <!--  
            <div class="row justify-content-center">
                <div v-show="state === 'create'" class="users create card col-8 p-4">
                    <h5 class="card-title">Users &gt; Create New User</h5>

                    <form class='fileUpload ' v-on:submit.prevent="function(){ ; }">

                        <div class="form-group form-row">

                            <label class='col-sm-4' for="newUserName">Username:</label>
                            
                            <input id='newUserName' name='newUserName' v-model="newUserName" type="text" class="newUserName form-control col" placeholder="Username">

                        </div>
                        

                        <div class="form-group form-row">

                            <label class="col-sm-4" for="newUserPassword">Password:</label>

                            <div class="col px-0">
                                <input 
                                    type="password" 
                                    id='newUserPassword' 
                                    name='newUserPassword'  
                                    v-model='newUserPassword' 
                                    data-toggle="password"  
                                    class='newUserPassword form-control' 
                                    placeholder="Password">
                            </div>

                        </div>
                        

                        <div class="form-group form-row">

                            <label class="col-sm-4" for="newUserCompany">Company:</label>

                            <input id='newUserCompany' name='newUserCompany'  v-model='newUserCompany' class='newUserCompany form-control col' type="text" placeholder="Company">

                        </div>

                        <div v-show='errorsCreateForm.length > 0' class="form-group form-row">
                            <label class='col-sm-4'></label>

                            <div class="errors col ">
                                <div v-for="e in errorsCreateForm" class='alert alert-danger'>

                                    <p>{{e.errorMsg}}</p>

                                    <ul v-if="e.retVar === -2" >
                                        <li v-for="company in e.errorValue">
                                            <span v-on:click="newUserCompany = company; errorsCreateForm = ''; " class='error-company alert-link'>
                                                {{company}}
                                            </span>
                                        </li>
                                    </ul>
                                    


                                </div>
                            </div>
                        </div>


                        <button v-on:click="createLoginClick2" class='btn btn-primary float-right'>Submit</button>
                    </form>
                </div>
            </div>
            -->

            <!--  
            <div class="row">
                <div v-show="state === 'login'" class="users login card col-6 p-4">
                    <h5 class="card-title">Users &gt; User Login</h5>

                    <form class='fileUpload ' v-on:submit.prevent="function(){ ; }">

                        <div class="form-group form-row">

                            <label class='col-sm-4' for="fileUserName">Username:</label>
                            
                            <input id='fileUserName' name='fileUserName' v-model="fileUserName" type="text" class="fileUserName form-control col" placeholder="Username">

                        </div>
                        

                        <div class="form-group form-row">

                            <label class="col-sm-4" for="fileUserPw">Password:</label>

                            <input id='fileUserPw' name='fileUserPw'  v-model='fileUserPw' class='fileUserPw form-control col' type="text" placeholder="Password">

                        </div>


                        <button v-on:click="userLogin" class='btn btn-primary float-right'>Submit</button>
                    </form>
                </div>
            </div>
            -->

            <!-- 
            <div class="row">
                <div v-show="state === 'forgot'" class="users forgot card col-6 p-4">
                    <h5 class="card-title">Users &gt; User Forgot Password</h5>

                    <form class='fileUpload ' v-on:submit.prevent="function(){ ; }">

                        <div class="form-group form-row">

                            <label class='col-sm-4' for="fileUserName">Username:</label>
                            
                            <input id='fileUserName' name='fileUserName' v-model="fileUserName" type="text" class="fileUserName form-control col" placeholder="Username">

                        </div>
                        

                        <div class="form-group form-row">

                            <label class="col-sm-4" for="fileUserPw">Password:</label>

                            <input id='fileUserPw' name='fileUserPw'  v-model='fileUserPw' class='fileUserPw form-control col' type="text" placeholder="Password">

                        </div>


                        <button v-on:click="userLogin" class='btn btn-primary float-right'>Submit</button>
                    </form>
                </div>
            </div>
            -->
            

            <div class="row justify-content-center">
                <div class="orders card" v-show="orders.length > 0">
                    <h5 class="card-title">
                        Orders

                        <span class="badge badge-pill badge-primary float-right">
                            Click on column titles to sort
                        </span>
                    </h5>

                    <table class="table table-bordered table-striped table-hover table-responsive table-sm orders-table">
                        <thead class="thead-dark">
                            <tr>
                                <th v-on:click="sort('name')">Name</th>
                                <th v-on:click="sort('po_num')" >P.O #</th>
                                <th v-on:click="sort('qty')" >Qty</th>
                                <th v-on:click="sort('memo')" >Product</th>
                                <th v-on:click="sort('wood')" >Wood</th>
                                <th v-on:click="sort('finish_color')" >Finish Color</th>
                                <th v-on:click="sort('builder')" >Builder</th>
                                <th v-on:click="sort('date_received')" >Date Recieved</th>
                                <th v-on:click="sort('ship_date')" >Ship Date</th>
                                <th v-on:click="sort('status')" >Status</th>
                            </tr>
                        </thead>

                        <tbody class="">
                            <tr v-for="order in sortedOrders">
                                <td>{{order['name']}}</td>
                                <td>{{order['po_num']}}</td>
                                <td>{{order['qty']}}x</td>
                                <td>{{order['memo']}}</td>
                                <td>{{order['wood']}}</td>
                                <td>{{order['finish_color']}}</td>
                                <td>{{order['builder']}}</td>
                                <td>{{order['date_received']}}</td>
                                <td>{{order['ship_date']}}</td>
                                <td>{{order['status']}}</td>
                            </tr>
                        </tbody>

                    </table>
                </div>
            </div>
            
        </div>
            
        


    <script>
        // const axios = require('axios');

        var app = new Vue({
            el: '#vue-div',

            data:{
                ajaxFile: "./src/ajax.php",

                fileInput: [],
                fileName: '',
                fileUserName: '',
                fileUserPw: '',

                newUserName: '',
                newUserPassword: '',
                newUserCompany: '',

                loginUsername: '',
                loginUsernamePassword: '',
                loginUserCompany: '',
                loginUserRole: '',
                loggedIn: false,

                errorMsg: '',
                errorsCreateForm: [],
                errorsLoginForm: [],

                orders: [],
                users:  [],
                files:  [],
                clients: [],

                state: '',

                currentSort: 'po_num',
                currentSortDir: 'asc',
            },

            computed:{
                sortedOrders: function(){
                    return this.orders.sort( (a,b) => {
                            let modifier =  1;

                            if( this.currentSortDir === 'desc' )
                                modifier = -1;

                            if(a[this.currentSort] < b[this.currentSort]) 
                                return -1 * modifier;

                            if(a[this.currentSort] > b[this.currentSort]) 
                                return 1 * modifier;
                            
                            return 0;
                        }
                    );
                }
            },

            mounted: function(){
                <?php
                    if( $loggedin )
                    {
                        echo "this.loggedIn = true; ";

                        echo "this.loginUsername = '{$_SESSION['login_user']['username']}'; ";

                        echo "this.loginUserCompany = '{$_SESSION['login_user']['clientNameFull']}'; ";


                        if( isset($role) && $role == "admin"){
                            echo "this.loginUserRole = '{$_SESSION['login_user']['role']}'; ";
                        }
                        

                        echo "this.getOrdersClick(); \n";
                    }
                ?>

            },

            methods:{
                sort: function(s){
                    //if s == current sort, reverse
                    if(s === this.currentSort) {
                        this.currentSortDir = this.currentSortDir==='asc'?'desc':'asc';
                    }

                    this.currentSort = s;
                },
                
                adminClick: function(event){
                    app.state = 'admin';
                },
                

                fileUploadClick1: function(event){
                    this.state = 'upload';
                },

                fileUploadClick2: function(event){
                    //upload file and process on server

                    axios({
                        method: 'post',
                        url: this.ajaxFile,
                        params:{
                            action: 'fileUpload',
                            filename: this.fileName,
                            user: this.fileUserName,
                            pw: this.fileUserPassword
                        }
                    })
                    .then((response) => {
                        console.log(response);
                    }, (error) =>{
                        console.log(error);
                    });
                },

                fileProcessClick: function(event){
                    axios({
                        method: 'post',
                        url: this.ajaxFile,
                        params:{
                            action: 'fileProcess',
                            filename: this.fileName,
                            user: this.fileUserName,
                            pw: this.fileUserPassword
                        }
                    })
                },

                userLoginClick : function(event){
                    //login user
                    submit = true;

                    this.errorsLoginForm =[];

                    

                    if(this.loginUsername.length < 1 ){
                        //username empty
                        this.errorsLoginForm.push(
                            {
                                retVar: -3,
                                errorMsg: 'Username cannot be empty',
                            }
                        );

                        // $('.loginUsername').focus();
                        /*
                        $('.loginUsername').popover(
                            {
                                content: "Username cannot be empty",
                                placement: 'bottom',
                                title: 'Error',
                                template: '<div class="popover alert alert-danger" role="tooltip"><div class="arrow"></div><h3 class="popover-header"></h3><div class="popover-body text-danger"></div></div>',
                            }
                        );
                        */

                        $('.login-form').popover(
                            {
                                content: "Username cannot be empty",
                                placement: 'bottom',
                                title: 'Error',
                                trigger: 'manual',
                                template: '<div class="popover alert alert-danger" role="tooltip"><div class="arrow"></div><h3 class="popover-header"></h3><div class="popover-body text-danger"></div></div>',
                            }
                        );

                        $('.login-form').popover('show');


                        submit = false;
                    }



                    pw = document.getElementById('loginUsernamePassword').value;

                    // if(this.loginUsernamePassword.length < 1 ){
                    if(pw.length < 1 ){
                        //username empty
                        this.errorsLoginForm.push(
                            {
                                retVar: -3,
                                errorMsg: 'Password cannot be empty',
                            }
                        );

                        $('.login-form').popover(
                            {
                                content: "Password cannot be empty",
                                placement: 'bottom',
                                title: 'Error',
                                trigger: 'manual',
                                template: '<div class="popover alert alert-danger" role="tooltip"><div class="arrow"></div><h3 class="popover-header"></h3><div class="popover-body text-danger"></div></div>',
                            }
                        );

                        $('.login-form').popover('show');

                        submit = false;
                    }

                    if( submit ){
                        pw = document.getElementById('loginUsernamePassword').value;

                        // var pwMD5 = new Hashes.MD5().hex(pw);
                        // var pwMD5 = new Hashes.MD5().hex(this.loginUsernamePassword);
                                                
                        axios({
                            method: 'post',
                            url: this.ajaxFile,
                            params:{
                                action: 'userLogin',
                                pw: pw,
                                // pw: this.loginUsernamePassword,
                                // pw: pwMD5,
                                user: this.loginUsername
                            }
                        })
                        .then((response) => {
                            d = response.data;

                            if(response.data.retVar){
                                //got user and logging in
                                this.loggedIn = true;
                                this.loginUsername = d.username;
                                this.loginUserCompany = d.company;
                                this.loginUserRole = d.role;
                                this.state= 'orders';

                                $('.login-form').popover('dispose');

                                this.getOrdersClick();
                            }
                            else{
                                //failed to get user

                                $('.login-form').popover(
                                    {
                                        content: "Incorrect Username or password, please try again",
                                        placement: 'bottom',
                                        title: 'Error',
                                        trigger: 'manual',
                                        template: '<div class="popover alert alert-danger" role="tooltip"><div class="arrow"></div><h3 class="popover-header"></h3><div class="popover-body text-danger"></div></div>',
                                    }                              
                                );
    
                                $('.login-form').popover('show');
                            }


                            console.log(response);
                        }, (error) =>{
                            console.log(error);
                        });
                        




                    }

                },

                userLogoutClick: function(event){
                    if( this.loggedIn == true){
                        axios({
                            method: 'post',
                            url: this.ajaxFile,
                            params:{
                                action: 'userLogout',
                            }
                        })
                        .then((response) => {
                            this.loggedIn = false;
                            this.loginUserRole = '',
                            this.loginUsername = '',
                            this.loginUsernamePassword = '',
                            this.loginUserCompany = '',
                            document.getElementById('loginUsernamePassword').value = '';

                            this.state ='';
                            this.orders = [];
                            this.users = [],
                            this.clients = [],

                            console.log(response);
                        }, (error) =>{
                            console.log(error);
                        });
                    }

                },

                /*
                createLoginClick1: function(event){
                    this.state = 'create';                        
                },
                */

                /*
                createLoginClick2: function(event){
                    submit = true;

                    this.errorsCreateForm =[];



                    if(this.newUserName.length < 1 ){
                        //username empty
                        this.errorsCreateForm.push(
                            {
                                retVar: -3,
                                errorMsg: 'Username cannot be empty',
                            }
                        );

                        $('.newUserName').focus();

                        submit = false;
                    }

                    if(this.newUserPassword.length < 1 ){
                        //username empty
                        this.errorsCreateForm.push(
                            {
                                retVar: -3,
                                errorMsg: 'Password cannot be empty',
                            }
                        );

                        $('.newUserPassword').focus();

                        submit = false;
                    }

                    if(this.newUserCompany.length < 1 ){
                        //username empty
                        this.errorsCreateForm.push(
                            {
                                retVar: -3,
                                errorMsg: 'Company cannot be empty',
                            }
                        );

                        $('.newUserCompany').focus();

                        submit = false;
                    }



                    if( submit ){

                        axios({
                            method: 'post',
                            url: this.ajaxFile,
                            params:{
                                action: 'userCreate',
                                newusername: this.newUserName,
                                newuserpassword: this.newUserPassword,
                                newusercompany: this.newUserCompany,
                            }
                        })
                        .then((response) => {
                            console.log(response);

                            d = response.data;

                            if( d.retVar == true ){
                                this.state = 'orders';
                                this.loggedIn = true;
                                this.loginUsername = d.username;
                                this.loginUserCompany = d.company;
                                this.getOrdersClick();
                            }

                            if( d.retVar == 2 ){
                                // this.errorsCreateForm = [];
                                this.errorsCreateForm.push( d );
                            }

                            if (d.retVar == -2) {
                                // this.errorsCreateForm = [];
                                this.errorsCreateForm.push( d );
                            }

                        }, (error) =>{
                            console.log(error);
                        });
                    }
                },
                */

                createLoginClick3: function( cu ){
                    // cu= "#"+cu;

                    // c= $(cu+'Company');
                    // u= $(cu+'Username');
                    // p= $(cu+'Password');

                    c= document.getElementById(cu+'Company').value.trim();
                    u= document.getElementById(cu+'Username').value.trim();
                    p= document.getElementById(cu+'Password').value.trim();

                    // pwMD5 = new Hashes.MD5().hex(p);

                    
                    axios({
                            method: 'post',
                            url: this.ajaxFile,
                            params:{
                                action: 'userCreateAdmin',
                                newusername:  u,
                                // newuserpassword:  pwMD5,
                                newuserpassword:  p,
                                newusercompany:  c,
                            }
                        })
                        .then((response) => {
                            console.log(response);

                            d = response.data;

                            if( d.retVar == true ){
                                // $("tr."+cu).hide();

                                $("tr."+cu).addClass("border border-success");
                            }


                            /*

                                if( d.retVar == true ){
                                    this.state = 'orders';
                                    this.loggedIn = true;
                                    this.loginUsername = d.username;
                                    this.loginUserCompany = d.company;
                                    this.getOrdersClick();
                                }

                                if( d.retVar == 2 ){
                                    // this.errorsCreateForm = [];
                                    this.errorsCreateForm.push( d );
                                }

                                if (d.retVar == -2) {
                                    // this.errorsCreateForm = [];
                                    this.errorsCreateForm.push( d );
                                }
                            */

                        }, (error) =>{
                            console.log(error);
                        });
                },

                getOrdersClick : function(event){
                    this.state = 'orders';
                    

                    axios({
                        method: 'post',
                        url: this.ajaxFile,
                        params:{
                            action: 'getOrders',
                        }
                    })
                    .then((response) => {

                        console.log(response);
                        console.log(response.data[0]);
                        this.orders= response.data;

                    }, (error) =>{
                        console.log(error);
                    });

                },

                getClientsClick: function(event){

                    axios({
                        method: 'post',
                        url: this.ajaxFile,
                        params:{
                            action: 'getClients',
                        }
                    })
                    .then((response) => {

                        console.log(response);
                        console.log(response.data[0]);
                        this.clients='';
                        this.clients = response.data;

                    }, (error) =>{
                        console.log(error);
                    });
                },

                getUsersClick: function(event){

                    axios({
                        method: 'post',
                        url: this.ajaxFile,
                        params:{
                            action: 'getUsers',
                        }
                    })
                    .then((response) => {

                        console.log(response);
                        console.log(response.data[0]);
                        this.users = response.data;

                    }, (error) =>{
                        console.log(error);
                    });
                },

                hidePopoverFocus: function(event){
                    console.log(event);

                    //$('.login-form').popover('hide');
                    $('.login-form').popover('dispose');

                },


            }
        });

        
    </script>

    
</body>
</html>

<?php

?>

