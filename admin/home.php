<!DOCTYPE html>
<?php
	include 'auth.php';
	include 'db_connect.php'
?>
<html lang = "eng">
	<head>
		<title>RV Employee Attendance Record System</title>
		<?php include 'header.php'; ?>
	</head>
	<style>
		.container{
			margin-left: 300px;
		}
		.card-counter{
			cursor: pointer;
    box-shadow: 2px 2px 10px #DADADA;
    margin: 5px;
    padding: 20px 10px;
    background-color: #fff;
    height: 100px;
    border-radius: 5px;
    transition: .3s linear all;
  }

  .card-counter:hover{
    box-shadow: 4px 4px 20px #DADADA;
    transition: .3s linear all;
  }

  .card-counter.primary{
    background-color: #007bff;
    color: #FFF;
  }

  .card-counter.danger{
    background-color: #ef5350;
    color: #FFF;
  }  

  .card-counter.success{
    background-color: #66bb6a;
    color: #FFF;
  }  

  .card-counter.info{
    background-color: #26c6da;
    color: #FFF;
  }  

  .card-counter i{
    font-size: 5em;
    opacity: 0.2;
  }

  .card-counter .count-numbers{
    position: absolute;
    right: 35px;
    top: 20px;
    font-size: 32px;
    display: block;
  }

  .card-counter .count-name{
    position: absolute;
    right: 35px;
    top: 65px;
    font-style: italic;
    text-transform: capitalize;
    opacity: 0.5;
    display: block;
    font-size: 18px;
  }
	</style>
	<body>
		<?php include 'nav_bar.php' ?>
		<div class = "container-fluid admin" >
			
			<div class = "alert alert-primary"><h5>Welcome <?php echo ucwords($user_name) ?> !</h5></div>
			
			</div>
			
			<!--  -->
			<div class="container">
				<div class="row">

				<div class="col-md-3">
				<div class="card-counter info">
					<i class="fa fa-users"></i>
					<?php 
			
						$employee = "SELECT * from users";
						$employee_run = mysqli_query($conn, $employee);
						if ($employee_total = mysqli_num_rows($employee_run)) {
						
							// Return the number of rows in result set
							echo '<span class="count-numbers">'.$employee_total.'</span>';
							// echo '<h1>'.$employee_total.'</h1>';
							
							
						}
					?>
				
					<span class="count-name">Users</span>
				</div>
				</div>

				<div class="col-md-3">
				<div class="card-counter primary">
					<i class="fa fa-code-fork"></i>
					<?php 
			
						$employee = "SELECT * from employee";
						$employee_run = mysqli_query($conn, $employee);
						if ($employee_total = mysqli_num_rows($employee_run)) {
						
							// Return the number of rows in result set
							echo '<span class="count-numbers">'.$employee_total.'</span>';
							// echo '<h1>'.$employee_total.'</h1>';
							
							
						}
					?>
					<span class="count-name">Employee</span>
				</div>
				</div>
				

				<div class="col-md-3">
				 <a href='attendance.php'>
					<div class="card-counter success">
					<i class="fa fa-database"></i>
					<span class="count-numbers">5+</span>
					<span class="count-name">Attendance</span>
					</div>
				 </a>
				</div>

				
				
				<div class="col-md-3">
					<div class="card-counter danger">
						<i class="fa fa-ticket"></i>
						<span class="count-numbers">1+</span>
						<span class="count-name">Annual Report</span>
					</div>
				</div>

				

				
			</div>
			</div>
			<!--  -->
		</div>
	</body>
	
	
</html>