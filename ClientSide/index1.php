<html lang="en">
<head>
  <title>Universal API</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <link rel="stylesheet" href="style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <script src="api.js"></script>

</head>

<?php
require 'apiconnection.php';
require 'session.php';
  if (isset($_POST['sfname'])&&isset($_POST['suname'])&&isset($_POST['semail'])&&isset($_POST['spassword']))
  {
      $fullname=$_POST['sfname'];
      $username=$_POST['suname'];
      $email=$_POST['semail'];
      $password=$_POST['spassword'];

    if(!empty($username)&&!empty($password)&&!empty($email)&&!empty($fullname))
   {
    $query ="INSERT INTO userinfo(fullname, username,email,password) VALUES ('$fullname','$username','$email','$password');"; 
    if(mysql_query($query))
    {
      
    }else{
      echo mysql_error();
    }
   }

  }


    if (isset($_POST['luname'])&&isset($_POST['lpassword']))
  {

      $username=$_POST['luname'];
      $password=$_POST['lpassword'];
  
   if(!empty($username)&&!empty($password))
   {
    
     $query ="SELECT password,username FROM userinfo
              WHERE username='$username'";

     if($output=mysql_query($query))
     {
      while ($api= mysql_fetch_assoc($output)){
        $User_password =$api['password'];
        $User_name =$api['username'];
      
           $_SESSION['username']=$User_name;
           if($User_password==$password)
           {
            $query ="SELECT username FROM accountinfo
              WHERE username='$username'";
            if($output=mysql_query($query))
            {
                while ($api= mysql_fetch_assoc($output)){
                $User =$api['username'];
                if($User_name==$User){
                   header('Location:eucalyptus.php');
                }else{
                header('Location:info.php');
                }
              }
            }
           }else{
            header('Location:index1.php');;
           }
      }
     }

   }else{
     echo"<script>alert('Invalid username and password');</script>";
   }



  }


?>

<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#myPage">Universal Cloud API</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#about">ABOUT</a></li>
        <li><a href="#services"><span class="glyphicon glyphicon-cloud"></span>SERVICES</a></li>
        <li><a data-toggle="modal" data-target="#signup"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
        <li><a data-toggle="modal" data-target="#login"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="jumbotron">
  <div class="container text-center">
    <h1>Universal Cloud API Services</h1>      
  </div>
</div>



<div class="container-fluid bg-1 text-center">
  <div class="row">
  <div class="col-sm-4">
   <h3>Eucalyptus</h3>
      <img src="eucalyptus.jpg" alt="Random Name" width="200px" height="200px">    
    </div>
    <div class="col-sm-4">
      <h4>Openstack</h4>
      <img src="openstack.jpg" alt="Random Name" width="200px" height="200px">  
    </div>
  </div>
</div>

<div class="container-fluid bg-2 text-center" id="about">
  <h3>About</h3>
  <p>The purpose of this research is to develop a ‘Universal API’ so that user
communicate with one API interface and can manage multiple cloud platform like
Eucalyptus, OpenStack, OpenNebula and much more.  Initially, we will be
working with Eucalyptus and Openstack and in future we will be setting up all the
existing platforms.  This research will provide a valuable API (Application
Program Interface) from where the user gets the privilege to access all the features
of any platform of cloud computing from this one API.</p>
</div>

<div class="container">
      <div class="modal fade" id="signup" role="dialog">
      <div class="modal-dialog">
      
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Sign UP</h4>
          </div>
<!--signup form//////////////////////////////////////////////////////////// -->
        <div class="modal-body">

        <form role="form" action="index1.php" method="POST"  >
        <div class="form-group">
        <label for="usr">Full Name:</label>
        <input type="text" class="form-control" name="sfname" >
        </div>
       <div class="form-group">
        <label for="usr">User Name:</label>
         <input type="text" class="form-control" name="suname" >
        </div>
         <div class="form-group">
        <label for="usr">Email Address:</label>
         <input type="text" class="form-control" name="semail">
        </div>
        <div class="form-group">
        <label for="usr">Password:</label>
         <input type="password" class="form-control" name="spassword">
        </div>
        <div class="modal-footer">
       <input type="submit" class="btn btn-info" value="Submit" id="signupform">
        </div>
       </form> 

       </div>
 <!--signup form//////////////////////////////////////////////////////////// -->    
      </div>
    </div>
    
  </div>
  </div>

<div class="container">
      <div class="modal fade" id="login" role="dialog">
      <div class="modal-dialog">
      
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Log in</h4>
          </div>
<!--signup form//////////////////////////////////////////////////////////// -->
        <div class="modal-body">

        <form role="form" action="index1.php" method="POST"  >
       <div class="form-group">
        <label for="usr">User Name:</label>
         <input type="text" class="form-control" name="luname" >
        </div>
        <div class="form-group">
        <label for="usr">Password:</label>
         <input type="password" class="form-control" name="lpassword">
        </div>
        <div class="modal-footer">
       <input type="submit" class="btn btn-info" value="Submit" id="loginform">
        </div>
       </form> 

       </div>
 <!--signup form//////////////////////////////////////////////////////////// -->    
      </div>
    </div>
    
  </div>
  </div>

<footer class="container-fluid text-center">
    <span class="glyphicon glyphicon-copyright-mark">UniversalCloudAPI</span>
</footer>

</body>
</html>
