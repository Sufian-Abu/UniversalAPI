<html lang="en">
<head>
  <title>Universal API</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <script src="api.js"></script>
  <style>
    /* Remove the navbar's default rounded borders and increase the bottom margin */ 
    .navbar {
      margin-bottom: 50px;
      border-radius: 0;
    }
    
    /* Remove the jumbotron's default bottom margin */ 
     .jumbotron {
      margin-bottom: 0;
    }
    /* Add a gray background color and some padding to the footer */
    footer {
    background-color: #f2f2f2;
      padding: 25px;
    }
  </style>
</head>

<?php
      if (isset($_POST['ack'])&&isset($_POST['sck'])&&isset($_POST['eucabucket']))
      {
       $accesskey=$_POST['ack'];
        $secretkey=$_POST['sck'];
       $bucket=$_POST['eucabucket'];
       $url="http://localhost:8080/API/main/".$accesskey."/".$secretkey."/".$bucket;
      $response = file_get_contents($url);
      $response = new SimpleXMLElement($response);
      $output=$response->create;
      // echo $output;
      // print_r($response);

     echo"<div class='modal fade' id='output' role='dialog'>
      <div class='modal-dialog'>
      <div class='modal-content'>
        <div class='modal-header'>
          <button type='button' class='close' data-dismiss='modal'>&times;</button>
          <h4 class='modal-title'>Eucalyptus Output</h4>
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

      if (isset($_POST['identity'])&&isset($_POST['credential'])&&isset($_POST['openbucket']))
      {
       $identity=$_POST['identity'];
       $credential=$_POST['credential'];
       $bucket=$_POST['openbucket'];
       $url="http://localhost:8080/API/main/openstack/".$identity."/".$credential."/".$bucket;
      $response = file_get_contents($url);
      $response = new SimpleXMLElement($response);
      $output=$response->create;
      // echo $output;
      // print_r($response);

     echo"<div class='modal fade' id='output' role='dialog'>
      <div class='modal-dialog'>
      <div class='modal-content'>
        <div class='modal-header'>
          <button type='button' class='close' data-dismiss='modal'>&times;</button>
          <h4 class='modal-title'>Openstack Output</h4>
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
?>

<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="index.html">Universal Cloud API</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
        <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="jumbotron">
  <div class="container text-center">
    <h1>Universal Cloud API Services</h1>      
  </div>
</div>



<div class="container">    
  <div class="row">
    <div class="col-sm-4">
      <div class="panel panel-primary">
        <div class="panel-body"><img src="Storage.jpg" class="img-responsive" style="width:50%" alt="Image" data-toggle="modal" data-target="#myModal"></div>
        <div class="panel-footer">Object Storage</div>
      </div>
    </div>
    <div class="col-sm-4"> 
      <div class="panel panel-danger">
        <div class="panel-body"><img src="service.jpg" class="img-responsive" style="width:50%" alt="Image"></div>
        <div class="panel-footer">upcoming</div>
      </div>
    </div>
    <div class="col-sm-4"> 
      <div class="panel panel-success">
        <div class="panel-body"><img src="service.jpg" class="img-responsive" style="width:50%" alt="Image"></div>
        <div class="panel-footer">upcoming</div>
      </div>
    </div>
  </div>
</div><br>

<div class="container">    
  <div class="row">
    <div class="col-sm-4">
      <div class="panel panel-primary">
        <div class="panel-body"><img src="service.jpg" class="img-responsive" style="width:50%" alt="Image"></div>
        <div class="panel-footer">upcoming</div>
      </div>
    </div>
    <div class="col-sm-4"> 
      <div class="panel panel-primary">
        <div class="panel-body"><img src="service.jpg" class="img-responsive" style="width:50%" alt="Image"></div>
        <div class="panel-footer">upcoming</div>
      </div>
    </div>
    <div class="col-sm-4"> 
      <div class="panel panel-primary">
        <div class="panel-body"><img src="service.jpg" class="img-responsive" style="width:50%" alt="Image"></div>
        <div class="panel-footer">upcoming</div>
      </div>
    </div>
  </div>
</div><br><br>


    <div class="modal fade" id="myModal" role="dialog">
      <div class="modal-dialog">
      
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Storage Service</h4>
          </div>
          <div class="modal-body">
            <center>
         <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal1" data-dismiss="modal">Eucalyptus</button>
          <br><br>
         <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal2" data-dismiss="modal">Openstack</button>
        </center>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-info" data-dismiss="modal" >cancel</button>
          </div>     
      </div>
    </div>
    
  </div>


<div class="container" id="api2">
      <div class="modal fade" id="myModal1" role="dialog">
      <div class="modal-dialog">
      
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Eucalyptus Storage Service</h4>
          </div>
<!--eucalyptus form//////////////////////////////////////////////////////////// -->
        <div class="modal-body">

        <form role="form" action="index.php" method="POST"  >
        <div class="form-group">
        <label for="usr">Access Key:</label>
        <input type="password" class="form-control" name="ack" >
        </div>
       <div class="form-group">
        <label for="pwd">Secret Key:</label>
         <input type="password" class="form-control" name="sck" >
        </div>
         <div class="form-group">
        <label for="pwd">Bucket Name:</label>
         <input type="text" class="form-control" name="eucabucket">
        </div>
        <div class="modal-footer">
       <input type="submit" class="btn btn-info" value="Submit" id="eucaform">
        </div>
       </form> 

       </div>
 <!--eucalyptus form//////////////////////////////////////////////////////////// -->    
      </div>
    </div>
    
  </div>
  </div>

  <div class="container" id="api2">
      <div class="modal fade" id="myModal2" role="dialog">
      <div class="modal-dialog">
      
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Openstack Storage Service</h4>
          </div>

  <!--openstack form//////////////////////////////////////////////////////////// -->
          <div class="modal-body">
        <form role="form" action="index.php" method="POST">
        <div class="form-group">
        <label for="usr">Identity:</label>
        <input type="text" class="form-control" name="identity">
        </div>
       <div class="form-group">
        <label for="pwd">Credential:</label>
         <input type="password" class="form-control" name="credential">
        </div>
        <div class="form-group">
        <label for="pwd">Bucket Name:</label>
         <input type="text" class="form-control" name="openbucket">
        </div>
         <div class="modal-footer">
        <input type="submit" class="btn btn-info" value="Submit" id="openstackform">
          </div> 
          </form>
        </div>
  <!--openstack form//////////////////////////////////////////////////////////// -->    
      </div>
    </div>
    
  </div>
  </div>

<footer class="container-fluid text-center">
    <span class="glyphicon glyphicon-copyright-mark">Euclidian</span>
</footer>

</body>
</html>
