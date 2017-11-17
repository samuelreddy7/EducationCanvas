<?php 
include "header.php";
?>
<link rel="stylesheet" href="css/jquery-ui.css">
<script src="js/jquery-1.12.4.js"></script>
<script src="js/jquery-ui.js"></script>
<script type="text/javascript">
    $(document).ready(function (e){
		getCourses();
        $("#stuMarksForm").on('submit',(function(e){
            e.preventDefault();          
            $.ajax({
            url: "saveAssignMarks.php",
            type: "POST",
            data:  new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            beforeSend: function() {
               $('#result').html("<img src='images/bx_loader.gif' />");
            },
            success: function(data){
                //alert(data);                
                if(data == '1')
                {
                    $('#result').html("<p class='bg-success error_pgr'>Record is saved sucessfully..!!</p>");
                    $('#sData').html('');
                    document.getElementById("stuMarksForm").reset();
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

    function getTests(){
       
       	var subId=$('#subjectList').val();
       	// alert("HI"+subId);
    	if(subId !='')
    	{
            $.ajax({
                type: "GET",
                dataType: "html",
                url: "services.php?action=getSubjectTest&subId="+subId,
                cache: false,
                success: function(htmldata) {
                    $('#testName').html(htmldata);
                }
            });
    	}
    	else
    	{
    	     $('#testName').html('<option value="">Select</option>');
    	}
    }
    function getSubjects(){
      
       	var courseList=$('#courseList').val();
    	if(courseList !='')
    	{
            $.ajax({
                type: "GET",
                dataType: "html",
                url: "services.php?action=getSubject&courseId="+courseList,
                cache: false,
                success: function(htmldata) {
                    $('#subjectList').html(htmldata);
                      getTests();
                }
            });
    	}
    	else
    	{
    	     $('#subjectList').html('<option value="">Select</option>');
    	     $('#testName').html('<option value="">Select</option>');
    	}
    }
    
    
    
    
	function getCourses(){
	$.ajax({
		type: "GET",
		dataType: "html",
		url: "services.php?action=getCourse",
		cache: false,
		success: function(htmldata) {
		     $('#result').html('');
			$('#courseList').html(htmldata);
		}
	});
	}
	function getStudents(){
	   
    	var courseList=$('#courseList').val();
    	var subId=$('#subjectList').val();
    	var testId=$('#testName').val();
    	if(courseList !='' && subId !='' && testId !='' )
    	{
        	$.ajax({
        		type: "GET",
        		dataType: "html",
        		url: "services.php?action=getStuListMarks&courseId="+courseList,
        		cache: false,
        		success: function(htmldata) {			   
        			$('#sData').html(htmldata);
        			
        		}
        	});
    	}
    	else
    	{
    	    $('#sData').html('');
    	    alert("Please select all fields");
    	}
	}
</script>

<!-- Page Content -->
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<h4 class="page-header"><i class="fa fa-th-list" aria-hidden="true"></i> Student Marks</h4>
			</div>
		</div>
		<div class="row">			
			<div class="col-lg-12">
			    	<form id="stuMarksForm"  name="stuMarksForm" action="#" method="post" enctype="multipart/form-data">
			    
				 <div class="panel panel-default"> 
						<div class="panel-heading">
                           <i class="fa fa-plus-square-o" aria-hidden="true"></i> Marks
                        </div>
                        <div class="panel-body">
                            <div class="row" >
						
								<div class="col-lg-3">
                                    <div class="form-group">
                                    	<label>Course Name</label>
                                    	 <select class="form-control" name="courseList" id="courseList" required onChange="getSubjects()">
                                            <option value=''>Select</option>
                                          </select>
                                    </div>
                                     
								</div>
								<div class="col-lg-3">
                                    <div class="form-group">
                                        <label>Subject Name</label>
                                        <select class="form-control" name="subjectList" id="subjectList" required onChange="getTests()">
                                            <option value=''>Select</option>
                                        </select>
                                    </div>
								</div>
								<div class="col-lg-3">									
									<div class="form-group">
										<label>Test Name</label>
										<select class="form-control" name="testName" id="testName" required >
										  <option value=''>Select</option>
										</select>
                                    </div>
									
								</div>
								<div class="col-lg-3">
											<button type="button" style="margin: 22px 0;" class="btn btn-primary" onClick="getStudents()"><i class="fa fa-floppy-o" aria-hidden="true"></i> Get Students</button>					
								</div>
							
							
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
				 <div class="panel panel-default"> 
						<div class="panel-heading">
                           <i class="fa fa-plus-square-o" aria-hidden="true"></i> Student Details
                        </div>
                        <div class="panel-body">
                            <div class="row" id="sData">
							
							</div>
							<div class="row">
								<div class="col-md-12">
									 <center>
											<div id="result"></div>
											<button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>
											<button type="reset" class="btn btn-danger"><i class="fa fa-refresh" aria-hidden="true"></i> Reset</button>
										</center>
                                    
								</div>
							
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
           
					</form>
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
