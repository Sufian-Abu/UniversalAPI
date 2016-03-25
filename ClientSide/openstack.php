<?php
error_reporting(E_ERROR);
    session_start();
    require 'apiconnection.php';
    $name= $_SESSION['username'];
if(isset($_POST['createname'])){
      $bucket=$_POST['createname'];
      if(!empty($bucket)){
      $query ="SELECT identity,endpoint,credential FROM accountinfo
              WHERE username='$name'";

     if($output=mysql_query($query))
     {
      while ($api= mysql_fetch_assoc($output)){
        $identity =$api['identity'];
        $endpoint =$api['endpoint'];
        $credential =$api['credential'];
        $url="http://localhost:8080/new/main/".$identity."/".$credential."/".$bucket."/create/".$endpoint;
        $response = file_get_contents($url);
        $response = new SimpleXMLElement($response);
        $output= $response->create;
       
     echo"<div class='modal fade' id='output' role='dialog'>
      <div class='modal-dialog'>
      <div class='modal-content'>
        <div class='modal-header'>
          <button type='button' class='close' data-dismiss='modal'>&times;</button>
          <h4 class='modal-title'>Server Response</h4>
        </div>
        <div class='modal-body'>
          <p>$output</p>
        </div>
        <div class='modal-footer'>
          <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
        </div>
      </div>
     </div>
      </div>";
      }
    }else{
      echo mysql_error();
    }
     }
  }

if(isset($_POST['deletename'])){
      $delbucket=$_POST['deletename'];
      if(!empty($delbucket)){
      $query ="SELECT identity,endpoint,credential FROM accountinfo
              WHERE username='$name'";

     if($output=mysql_query($query))
     {
      while ($api= mysql_fetch_assoc($output)){
        $identity =$api['identity'];
        $endpoint =$api['endpoint'];
        $credential =$api['credential'];
        $url="http://localhost:8080/new/main/".$identity."/".$credential."/".$delbucket."/delete/".$endpoint;
        $response = file_get_contents($url);
        $response = new SimpleXMLElement($response);
        $output= $response->create;
     echo"<div class='modal fade' id='output' role='dialog'>
      <div class='modal-dialog'>
      <div class='modal-content'>
        <div class='modal-header'>
          <button type='button' class='close' data-dismiss='modal'>&times;</button>
          <h4 class='modal-title'>Server Response</h4>
        </div>
        <div class='modal-body'>
          <p>$output</p>
        </div>
        <div class='modal-footer'>
          <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
        </div>
      </div>
     </div>
      </div>";
        
      }
    }else{
      echo mysql_error();
    }
  }
    }

  if(isset($_POST['uploadform'])){
      $upbucket=$_POST['uploadname'];
      if(!empty($upbucket)){
      $query ="SELECT identity,endpoint,credential FROM accountinfo
              WHERE username='$name'";

     if($output=mysql_query($query))
     {
      while ($api= mysql_fetch_assoc($output)){
        $identity =$api['identity'];
        $endpoint =$api['endpoint'];
        $credential =$api['credential'];
        $filename = basename($_FILES["fileToUpload"]["name"]);
        $target= $_FILES["fileToUpload"]["tmp_name"];
        $targetreplace= str_ireplace("\\","/",$target);
        $url="http://localhost:8080/new/main/".$identity."/".$credential."/".$upbucket."/".
                 $filename."/openstack/".$targetreplace."/".$endpoint;
        $response = file_get_contents($url);
        $response = new SimpleXMLElement($response);
        $output= $response->create;
     echo"<div class='modal fade' id='output' role='dialog'>
      <div class='modal-dialog'>
      <div class='modal-content'>
        <div class='modal-header'>
          <button type='button' class='close' data-dismiss='modal'>&times;</button>
          <h4 class='modal-title'>Server Response</h4>
        </div>
        <div class='modal-body'>
          <p>$output</p>
        </div>
        <div class='modal-footer'>
          <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
        </div>
      </div>
     </div>
      </div>";
      }
    }else{
      echo mysql_error();
    }
    }
  }

  if(isset($_POST['listform'])){
      $query ="SELECT identity,endpoint,credential FROM accountinfo
              WHERE username='$name'";

     if($output=mysql_query($query))
     {
      while ($api= mysql_fetch_assoc($output)){
        $identity =$api['identity'];
        $endpoint =$api['endpoint'];
        $credential =$api['credential'];
        $url="http://localhost:8080/new/main/".$identity."/".$credential."/".$endpoint;
        $response = file_get_contents($url);
        $response = new SimpleXMLElement($response);
        $output= $response->create;
       echo"<div class='modal fade' id='output' role='dialog'>
      <div class='modal-dialog'>
      <div class='modal-content'>
        <div class='modal-header'>
          <button type='button' class='close' data-dismiss='modal'>&times;</button>
          <h4 class='modal-title'>Server Response</h4>
        </div>
        <div class='modal-body'>
          <p>$output</p>
        </div>
        <div class='modal-footer'>
          <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
        </div>
      </div>
     </div>
      </div>";

      }
    }else{
      echo mysql_error();
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

<div class="container-fluid">
  <div class="row content">
    <div class="col-sm-3 sidenav">
      <h4>Openstack</h4>
      <ul class="nav nav-pills nav-stacked">
        <li ><a data-toggle="tab" href="#create">Create Container</a></li>
        <li ><a data-toggle="tab" href="#delete">Delete Container</a></li>
        <li ><a data-toggle="tab" href="#list">List Of Container</a></li>
        <li ><a data-toggle="tab" href="#upload">Upload Data</a></li>
      </ul><br>
    </div>

    <div class="col-sm-9 tab-content">

    <div id="create" class="tab-pane fade in active">
      <h3>Create Container</h3>
        <form role="form" action="openstack.php" method="POST"  >
       <div class="form-group">
        <label for="usr">Container Name:</label>
         <input type="text" class="form-control" name="createname" placeholder="Container Name">
        </div>
        <div class="modal-footer">
       <input type="submit" class="btn btn-info" value="Submit" id="createform">
        </div>
       </form>
    </div>

    <div id="delete" class="tab-pane fade">
      <h3>Delete Container</h3>
      <form role="form" action="openstack.php" method="POST"  >
       <div class="form-group">
        <label for="usr">Container Name:</label>
         <input type="text" class="form-control" name="deletename" placeholder="Container Name" >
        </div>
        <div class="modal-footer">
       <input type="submit" class="btn btn-info" value="Submit" id="deleteform">
        </div>
       </form>
    </div>


    <div id="list" class="tab-pane fade">
      <h3>List Of Container</h3>
        <form role="form" action="openstack.php" method="POST">
        <div class="container">
       <input type="submit" class="btn btn-info" value="See Container list" name="listform" id="listform">
        </div>
       </form>
    </div>


    <div id="upload" class="tab-pane fade">
      <h3>Upload Data</h3>
        <form role="form" action="openstack.php" method="POST" enctype="multipart/form-data" >
       <div class="form-group">
        <label for="usr">Container Name:</label>
         <input type="text" class="form-control" name="uploadname" placeholder="Container Name" >
        </div>
        <div class="form-group">
        <label for="file">Upload file</label>
        <input type="file" name="fileToUpload" id="fileToUpload">
        </div>
        <div class="modal-footer">
       <input type="submit" class="btn btn-info" value="Submit" id="uploadform" name="uploadform">
        </div>
       </form>
    </div>

    </div>

  </div>
</div>

<footer class="container-fluid text-center">
    <span class="glyphicon glyphicon-copyright-mark">UniversalCloudAPI</span>
</footer>

</body>
</html>