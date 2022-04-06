<?php require_once("functions.inc"); ?>
<doctype html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/bootstrap5.css">
<title>Register</title>
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

		<form id="studentForm" method="POST" action="register-process.php" enctype="multipart/form-data">
		<div class="container">
		<div>
				<legend>Registration Information</legend>
		</div>
		<div>
				<div class="mb-3 col-sm-3">
					<label for="profile" class="form-label">Profile</label>
					<input type="file" class="form-control" name="profile" id="profile" required>
				</div>
				<div class="mb-3 col-sm-3">
					<label for="firstName" class="form-label">First Name:</label>
					<input type="text" class="form-control" id="firstName" name="firstName" placeholder="Shackelford" required>
				</div>
				<div class="mb-3 col-sm-3">
					<label for="lastName" class="form-label">Last Name:</label>
					<input type="text" class="form-control" id="lastName" name="lastName" placeholder="Requina" required>
				</div>
				<div class="mb-3 col-sm-3">
					<label for="contactNum" class="form-label">Contact Number:</label>
					<input type="tel" class="form-control" id="contactNum" name="contactNum" placeholder="09123456789" pattern="[0-9]{11}" required>
				</div>
				<div class="mb-3 col-sm-3" form-check>
					<p>Are you vaccinated?:</p>
					<input type="radio" id="yes" name="vaccinated" value="yes" required>
					<label for="yes">Yes</label><br>
					<input type="radio" id="no" name="vaccinated" value="no" required>
					<label for="no">No</label><br>
				</div>
				<div class="mb-3 col-sm-3" form-check>
					<p>Course:</p>
					<input type="radio" id="DDAT" name="course" value="ddat" required>
					<label for="ddat">DDAT</label><br>
					<input type="radio" id="DSET" name="course" value="dset" required>
					<label for="no">DSET</label><br>
					<input type="radio" id="dtot" name="course" value="dtot" required>
					<label for="no">DTOT</label><br>
				</div>
				<button type="submit" class="btn btn-primary" type="submit" id="submit" name="submit">Submit</button>
		</div>
		</form>
		</div>
</div>		
<script src="scripts/form.js"></script>
</body>
</html>
			