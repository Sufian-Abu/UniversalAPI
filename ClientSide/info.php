<?php
require 'apiconnection.php';
session_start();
$name= $_SESSION['username'];


  if (isset($_POST['ack'])&&isset($_POST['sck'])&&isset($_POST['identity'])&&isset($_POST['endpoint'])&&isset($_POST['credential']))
  {
      $accesskey=$_POST['ack'];
      $secretkey=$_POST['sck'];
      $identity=$_POST['identity'];
      $endpoint=$_POST['endpoint'];
      $credential=$_POST['credential'];

    if(!empty($accesskey)&&!empty($secretkey)&&!empty($identity)&&!empty($endpoint)&&!empty($credential))
   {
    $query ="INSERT INTO accountinfo(username, accesskey,secretkey,identity,endpoint,credential) 
             VALUES ('$name','$accesskey','$secretkey','$identity','$endpoint','$credential');"; 
    if(mysql_query($query))
    {
      header('Location:eucalyptus.php');
    }else{
      echo mysql_error();
    }
   }

  }
?>

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

<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#myPage">Universal Cloud API</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-cloud"></span>SERVICES<span class=" caret"></span></a>
        <ul class="dropdown-menu">
            <li><a href="eucalyptus.php">Eucalyptus</a></li>
            <li><a href="openstack.php">Openstack</a></li>
          </ul>
         </li>
        <li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
      </ul>
    </div>
  </div>
</nav>


<div class="container">
<center>
  <h2>Account Information</h2>
</center>
  <form class="form-horizontal" action="info.php" method="POST">
  	<h4>Eucalyptus:</h4>
    <div class="form-group">
      <label class="control-label col-sm-2" for="ack">Access Key:</label>
      <div class="col-sm-5">
        <input type="password" class="form-control" name="ack" placeholder="Access Key">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="sck">Secret Key:</label>
      <div class="col-sm-5">          
        <input type="password" class="form-control" name="sck" placeholder="Secret Key">
      </div>
    </div>
     <h4>Openstack:</h4>
    <div class="form-group">
      <label class="control-label col-sm-2" for="identity">Identity:</label>
      <div class="col-sm-5">
        <input type="text" class="form-control" name="identity" placeholder="identity">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="endpoint">End Point:</label>
      <div class="col-sm-5">          
        <input type="text" class="form-control" name="endpoint" placeholder="endpoint">
      </div>
    </div>
     <div class="form-group">
      <label class="control-label col-sm-2" for="credential">Credential:</label>
      <div class="col-sm-5">          
        <input type="text" class="form-control" name="credential" placeholder="Credential">
      </div>
    </div>
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-info">Submit</button>
      </div>
    </div>
  </form>
</div>


</body>
</html>