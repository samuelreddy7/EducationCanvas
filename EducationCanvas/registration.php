<?php 
include "header.php";
?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script type="text/javascript">
    $(document).ready(function (e){
		$( "#dob" ).datepicker({
		  changeMonth: true,
		  changeYear:true,
		  showOn: "button",
		  buttonImage: "images/calendar.gif",
		  buttonImageOnly: true,
		  buttonText: "Select date",
		  dateFormat: 'yy-mm-dd'
		});
        getCourses();		
		$('#artpdf').on( 'change', function() {
		   var myfile= $( this ).val();
		   var ext = myfile.split('.').pop().toLowerCase();
		   if(ext != "pdf"){
			   $('#fileError').html("Upload only PDF files");
			   $('#artpdf').val('');
			   $('#artpdf').focus();		     
		   }
		   else
		   {
			   $('#fileError').html('');
		   }
		});	
        $("#studentForm").on('submit',(function(e){
            e.preventDefault();
            $.ajax({
            url: "saveStudents.php",
            type: "POST",
            data:  new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            beforeSend: function() {
			   $('#result').html("<center><img src='images/bx_loader.gif' /><br /><b>Data is saving. Please wait...</b></center>");;
			},
            success: function(data){
				//alert(data);
                 if(data == '1')
                {
                    $('#result').html("<p class='bg-success error_pgr'>Record is saved sucessfully..!!</p>");
                    document.getElementById("studentForm").reset();
                }
                else
                {
                    $('#result').html("<p class='bg-warning error_pgr'>Record is not saved.Please try again...!!</p>");
                } 
            },
            error: function(){} 	        
            });
        }));
    });
</script>
<script>
	function getCourses(){
		$.ajax({
			type: "GET",
			dataType: "html",
			url: "services.php?action=getCourse",
			cache: false,
			success: function(htmldata) {
				$('#courseList').html(htmldata);
			}
		});
	}
	function getVolumes(){
		var jrnlName=$('#jrnlName').val();
		$.ajax({
			type: "GET",
			dataType: "html",
			url: "editjrnl.php?action=getVolumes&jrnlName="+jrnlName,
			cache: false,
			success: function(htmldata) {
				$('#volmnum').html(htmldata);
				$('#volmnum').focus();
				getIssues();
			}
		});
	}
	function getIssues(){
		var volmnum=$('#volmnum').val();
		$.ajax({
			type: "GET",
			dataType: "html",
			url: "editjrnl.php?action=getIssues&volmnum="+volmnum,
			cache: false,
			success: function(htmldata) {
				$('#issnum').html(htmldata);
				$('#issnum').focus();
			}
		});
	}
	</script>
<!-- Page Content -->
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<h4 class="page-header"><i class="fa fa-th-list" aria-hidden="true"></i> Student Registration <a href="studentList.php" style="float: right;">Students List</a></h4>
			</div>
		</div>
		<div class="row">			
			<div class="col-lg-12">
				 <div class="panel panel-default"> 
						<div class="panel-heading">
                           <i class="fa fa-plus-square-o" aria-hidden="true"></i> Student Details
                        </div>
                        <div class="panel-body">
                            <div class="row" >
							<form id="studentForm"  name="studentForm" action="#" method="post" enctype="multipart/form-data">
								<div class="col-lg-4">
									<div class="form-group">
										<label>First Name </label>
										<input type="text" class="form-control" name="fname" id="fname"  required="" />
									</div>
									<div class="form-group">
										<label>Last Name </label>
										<input type="text" class="form-control" name="lname" id="lname"  required=""/>
									</div>
									<div class="form-group">
										<label>Date of Birth </label>
										<input type="text" class="form-control" name="dob" id="dob"  placeholder="YYYY-MM-DD" required=""/>
									</div>
									<div class="form-group">
										<label>Gender &nbsp;&nbsp;</label>
										<label class="radio-inline">
										  <input type="radio" name="gender" id="male" value="male" checked > Male
										</label>
										<label class="radio-inline">
										  <input type="radio" name="gender" id="female" value="female"> Female
										</label>
									</div>
								</div>
								<div class="col-lg-4">										
									<div class="form-group">
										<label>Course Name</label>
										<select class="form-control" name="courseList" id="courseList" required="">
										  <option value=''>Select</option>
										</select>
                                    </div>
									<div class="form-group">
										<label>Email</label>
										<input type="text" class="form-control" name="semail" id="semail"  required=""/>
									</div>
									<div class="form-group">
											<label>Mobile Number</label>
											<input type="text" class="form-control" name="smobile" id="smobile"  required=""/>
										</div>
										<div class="form-group">
											<label>Image</label>
											<input type="file" name="thmbImg" id="thmbImg"  />
										</div>
								</div>
								<div class="col-lg-4">
										<div class="form-group">
											<label>Address</label>
											<textarea name="address" id="address" class="form-control" rows="4" ></textarea>
										</div>
										<div class="form-group">
											<label>City</label>
											<input type="text" class="form-control" name="city" id="city"  />
										</div>
										<div class="form-group">
											<label>State</label>
											<input type="text" class="form-control" name="state" id="state"  />
										</div>
								</div>
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
					 <div class="panel panel-default"> 
						<div class="panel-heading">
                           <i class="fa fa-plus-square-o" aria-hidden="true"></i> Parent Details
                        </div>
                        <div class="panel-body">
                            <div class="row" >
								<div class="col-lg-4">
									<div class="form-group">
										<label>Parent Name </label>
										<input type="text" class="form-control" name="pname" id="pname" required="" />
									</div>									
								</div>
								<div class="col-lg-4">	
									<div class="form-group">
										<label>Email</label>
										<input type="text" class="form-control" name="pemail" id="pemail"  required=""/>
									</div>
								</div>
								<div class="col-lg-4">
										<div class="form-group">
											<label>Mobile Number</label>
											<input type="text" class="form-control" name="pmobile" id="pmobile" required="" />
										</div>										
								</div>
								<div class="col-md-12">
									 <center>
											<div id="result"></div>
											<button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>
											<button type="reset" class="btn btn-danger"><i class="fa fa-refresh" aria-hidden="true"></i> Reset</button>
										</center>
                                    
								</div>
								</form>
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
           
				
			</div>
			<!-- /.col-lg-12 -->
			
		</div>
		<!-- /.row -->
	</div>
	<!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
<?php
include "footer.php";
?>
