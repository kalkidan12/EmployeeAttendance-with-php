<!DOCTYPE html>
<html lang = "eng">
	<head>
		<title>RV Employee Attendance Record System</title>
		<?php include('./admin/headerout.php') ?>
	</head>

	<style media = "all">
         body {
			 height: 100vh;
			background-image: linear-gradient(to bottom, grey, lightblue);
		 	background-position: center;
			background-repeat: no-repeat;
			background-size: cover;
		}
		.card{
			background-color:#f5ebf3;
		}
         
      </style>
	<body>
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
			<div class="container-fluid">
			 
			<a class="navbar-brand" href="#"> <img class="mx-2" src="./assets/images/logo.png" width="30" height="35" alt="">RV Employee Attendance System</a>
			</div>
  		</nav>
		<div id="main" class="my-5">
		<div class = "container-fluid admin2">
			
			<div class="attendance_log_field">

				<div id="company-logo-field" class="mb-4 ">
					<!-- <img src="./assets/images/logo.png" width="100" height="110" alt=""> -->
				</div>
				<div class="col-md-4 offset-md-4">
					<div class="card">
						<div class="card-title text-center my-2">
						<img src="./assets/images/logo.png" width="100" height="110" alt="">


						</div>
						<div class="card-body">
							<div class="text-center">
								<h4><?php echo date('F d,Y') ?> <span id="now"></span></h4>
							</div>
							<div class="col-md-12">
								<div class="text-center mb-4" id="log_display"></div>
									<form action="" id="att-log-frm" >
										<div class="form-group">
											<label for="eno" class="control-label">Enter your Employee Number</label>
											<input type="text" id="eno" name="eno" class="form-control col-sm-12">
										</div>
										<center class="button-popup hidden-xs" >
										<!-- style="display: none;" -->
											<button type="button" class='btn btn-sm btn-success log_now col-sm-2 my-1' data-id="1">IN AM</button>
											<button type="button" class='btn btn-sm btn-info log_now col-sm-2' data-id="2">OUT AM</button>
											<button type="button" class='btn btn-sm btn-success log_now col-sm-2 my-1' data-id="3">IN PM</button>
											<button type="button" class='btn btn-sm btn-info log_now col-sm-2' data-id="4">OUT PM</button>
										</center>
										<div class="loading" style="display: none"><center>Please wait...</center></div>
										
									</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		</div>


	</body>
	<script>
		$(document).ready(function(){
			setInterval(function(){
				var time = new Date();
				var now = time.toLocaleString('en-US', { hour: 'numeric', minute: 'numeric', second: 'numeric', hour12: false })
				$('#now').html(now)
			},500)
			console.log()

			$('.log_now').each(function(){
				$(this).click(function(){
					var _this = $(this)
					var eno = $('[name="eno"]').val()
					if(eno == ''){
						alert("Please enter your employee number");
					}else{
						$('.log_now').hide()		
						$('.loading').show()
						$.ajax({
							url:'./admin/time_log.php',
							method:'POST',
							data:{type:_this.attr('data-id'),eno:$('[name="eno"]').val()},
							error:err=>console.log(err),
							success:function(resp){
								if(typeof resp != undefined){
									resp = JSON.parse(resp)

									if(resp.status == 1){
										$('[name="eno"]').val('')
										$('#log_display').html(resp.msg)
										$('.log_now').show()		
										$('.loading').hide()
										setTimeout(function(){
										$('#log_display').html('')
										},5000)
									}else{
										alert(resp.msg)
										$('.log_now').show()		
										$('.loading').hide()
									}
								}
							}
						})		
					}
				})
			})
		})
	</script>



<script>
    function isOpen() {
        var days = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
        var months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun,", "Jul",
            "Aug", "Sep", "Oct", "Nov", "Dec"];

        var date = new Date();

        var current_week_day = days[date.getDay()];
        
        var hour = date.getHours();
        var minute = date.getMinutes();
        var day = date.getDate();
        var month = months[date.getMonth()];
        var year = date.getFullYear();

        var opening_hours = Array();
        opening_hours["Sun"] = [0000, 0000];
        opening_hours["Mon"] = [0800, 0830];
        opening_hours["Mon"] = [1700, 1730];
        opening_hours["Tue"] = [0800, 0830];
        opening_hours["Tue"] = [1700, 1730];
        opening_hours["Wed"] = [0800, 0830];
        opening_hours["Wed"] = [1700, 1730];
        opening_hours["Thu"] = [0800, 0830];
        opening_hours["Thu"] = [1700, 1730];
        opening_hours["Fri"] = [0800, 0830];
        opening_hours["Fri"] = [1700, 1730];
     
        opening_hours["Sat"] = [0000, 0000];
        
        var days_closed = [
            {"day": 25, "month": "Dec"},
            {"day": 26, "month": "Dec"}
        ];

        if(current_week_day == "Sun") {
            return false;
        }

        if(current_week_day == "Sat") {
            return false;
        }

        var should_be_closed = days_closed.every(function(value) {

            if(day == value["day"] && month == value["month"]) {
                return false;
            }
            
            return true;
        });
        
        if(!should_be_closed) {
            return false;
        }

        var today_hours = opening_hours[current_week_day];
        var current_time = hour.toString() + minute.toString();

        if(today_hours[0] <= current_time && today_hours[1] > current_time) {
            return true;
        }
    }

    jQuery(document).ready(function () {            
        // jQuery('.need-help-header').click(function () {
        //     jQuery('.need-help-content').slideToggle();
        // });

        if(isOpen()) {
            jQuery(".button-popup").show();
        }
    });
</script>


</html>