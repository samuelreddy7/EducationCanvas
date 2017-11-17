<?php 
include "header.php";
if(isset($_SESSION['ec_course']))
{
   $ec_course= $_SESSION['ec_course'];
}
?>
<script type="text/javascript">
    $(document).ready(function (e){
		getStudents();
        $("#attendeceForm").on('submit',(function(e){
            e.preventDefault();          
            $.ajax({
            url: "saveAttendance.php",
            type: "POST",
            data:  new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            beforeSend: function() {
               $('#result').html("<img src='images/bx_loader.gif' />");
            },
            success: function(data){
    // alert(data);                
                if(data == '1')
                {
                    $('#result').html("<p class='bg-success error_pgr'>Record is saved sucessfully..!!</p>");
                    $('#sData').html('');
                    document.getElementById("attendeceForm").reset();
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
		     $('#result').html('');
			$('#courseList').html(htmldata);
		}
	});
	}
    function getStudents(){
        $.ajax({
            type: "GET",
            dataType: "html",
            url: "services.php?action=getStuList&courseId="+<?php echo $ec_course;?>,
            cache: false,
            success: function(htmldata) {			   
            	$('#sData').html(htmldata);
            }
        });
 
    	
	}
</script>
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h4 class="page-header"><i class="fa fa-th-list" aria-hidden="true"></i> Attendance</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <form id="attendeceForm"  name="attendeceForm" action="" method="post" enctype="multipart/form-data">
                
                
<!--                <div class="panel panel-default"> 
                        <div class="panel-heading">
                            <i class="fa fa-plus-square-o" aria-hidden="true"></i> Add Attendance
                        </div>
                        <div class="panel-body">
                            <div class="row" >                              
                                
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Course Name</label>
                                            <select class="form-control" name="courseList" id="courseList" required>
                                            <option value=''>Select</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <button type="button" style="margin: 22px 0;" class="btn btn-primary" onClick="getStudents()"><i class="fa fa-floppy-o" aria-hidden="true"></i> Get Students</button>
                                    </div>
                                    <div class="col-lg-4"> </div>
                                   
                                                        
                            </div>
                           
                        </div>
                       
                    </div>-->
                 
                  <div class="panel panel-default"> 
                        <div class="panel-heading">
                            <i class="fa fa-plus-square-o" aria-hidden="true"></i> Student Details-Attendence Date : <?php echo date("Y-m-d");?>
                        </div>
                        <div class="panel-body">
                            <div class="row" >                              
                                    <div class="col-lg-12" id="sData">  
                                    
                                    </div>
                                    <div class="col-lg-12">  
                                        <center>
                                            <div id="result"></div><button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save Attendance</button>
                                            <button type="reset" class="btn btn-danger"><i class="fa fa-refresh" aria-hidden="true"></i> Reset</button>
                                        </center>
                                    </div>
                                                        
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    
                    
                    
                    
                    </form>    
                    
                    
                    <!-- /.panel -->
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
