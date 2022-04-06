<?php 
require_once("functions.inc");

$course = '';
$status = '';

if(!empty($_GET['course'])){
  $course = trim($_GET['course']);
}
if(isset($_GET['status'])){
  $status = trim($_GET['status']); 
}
?>
<!doctype html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/bootstrap5.css">
<script src="scripts/bootstrap5.js"></script>
<style>
  a, a:visited{
    text-decoration: none;
  }
</style>
<title>List</title>
</head>
<body>
<header>
  <!-- Fixed navbar -->
  <nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Student Info</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="index.php">List</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="register.php">Register</a>
        </li>
      </ul>
    </div>
  </nav>
</header>

    <!-- Begin page content -->
    <main role="main" class="container mt-10">
        <h2>Students List</h2>
          <p>You may filter the table by course and vaccination status:</p>
          <div class="row">
            <div class="dropdown col-sm-1">
              <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">Course
              <span class="caret"></span></button>
              <ul class="dropdown-menu">
                  <li  class="dropdown-item <?php if($course===''){echo 'bg-primary';}?>"><a class="text-dark" href="index.php?course=&status=<?php echo $status?>">All</a></li>
                  <li  class="dropdown-item <?php if($course=='DDAT'){echo 'bg-primary';}?>"><a class="text-dark " href="index.php?course=DDAT&status=<?php echo $status?>">DDAT</a></li>
                  <li  class="dropdown-item <?php if($course=='DTOT'){echo 'bg-primary';}?>"><a class="text-dark " href="index.php?course=DTOT&status=<?php echo $status?>">DTOT</a></li>
                  <li  class="dropdown-item <?php if($course=='DSET'){echo 'bg-primary';}?>"><a class="text-dark " href="index.php?course=DSET&status=<?php echo $status?>">DSET</a></li>
              </ul>
            </div>  
            <div class="dropdown col-sm-1">
              <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">Status
              <span class="caret"></span></button>
              <ul class="dropdown-menu">
                  <li  class="dropdown-item <?php if($status===''){echo 'bg-primary';}?>"><a class="text-dark " href="index.php?course=<?php echo $course?>&status=">All</a></li> 
                  <li  class="dropdown-item <?php if($status==='1'){echo 'bg-primary';}?>"><a class="text-dark " href="index.php?course=<?php echo $course?>&status=1">Vaccinated</a></li>
                  <li  class="dropdown-item <?php if($status=='0'){echo 'bg-primary';}?>"><a class="text-dark " href="index.php?course=<?php echo $course?>&status=0">Not Vaccinated</a></li>
              </ul>
            </div>
          </div>            
          <table class="table table-hover">
            <thead>
              <tr>
                <th>Profile</th>
                <th>FirstName</th>
                <th>LastName</th>
                <th>Contact Number</th>
                <th>Course</th>
                <th>Vaccination Status</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php
                    $mysqli = new mysqli(DBHOST,DBUSER,DBPASS,DB);

                    $students = "SELECT * from students ";

                    if(!empty($course) && $status !== ''){
                      $students .= "WHERE course = '{$course}' AND isVaccinated = '{$status}'";
                    }elseif(!empty($course)){
                      $students .= "WHERE course = '{$course}'";
                    }elseif($status !== ''){
                      $students .= "WHERE isVaccinated = '{$status}'";
                    }

                    $result = $mysqli->query($students);
                    while ($row = $result->fetch_assoc()) {
                        ?>
                            <tr>
                                <td><img src="<?php echo $row['profileImg'] ?>" width="50px" height="50px"></a></td>
                                <td><?php echo $row['firstName'] ?></a></td>
                                <td><?php echo $row['lastName'] ?></td>
                                <td><?php echo $row['contactNumber'] ?></td>
                                <td><?php echo strtoupper($row['course']) ?></td>
                                <td><?php if ($row['isVaccinated'] == "1") 
                                            { 
                                                echo "Yes";
                                            }

                                          else {
                                                echo "No";
                                          } 
                                    ?></td>
                                <td>
                                  <a href="edit.php?id=<?php echo $row['studentId']?>"><button type="button" class="btn btn-outline-primary">Edit</button></a>
                                </td>
                            </tr>
                        <?php
                    }
              ?>
            </tbody>
          </table> 
    </main>

</body>
</html>