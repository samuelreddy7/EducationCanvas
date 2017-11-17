<?php 
include "header.php";
?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script type="text/javascript">
    $(document).ready(function (e){
        $( "#subDate" ).datepicker({
		  changeMonth: true,
		  changeYear:true,
		  showOn: "button",
		  buttonImage: "images/calendar.gif",
		  buttonImageOnly: true,
		  buttonText: "Select date",
		  dateFormat: 'yy-mm-dd',
		  minDate: 0
		});
        
        $("#assignmentForm").on('submit',(function(e){
            e.preventDefault();
            $.ajax({
            url: "saveassignment.php",
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
                    document.getElementById("assignmentForm").reset();
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
                }
            });
    	}
    }
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
  
</script>
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h4 class="page-header"><i class="fa fa-th-list" aria-hidden="true"></i> Assignment</h4>
            </div>
        </div>
        <div class="row">
            
            <div class="col-lg-12">
                 <div class="panel panel-default"> 
                        <div class="panel-heading">
                            <i class="fa fa-plus-square-o" aria-hidden="true"></i> Add Assignment
                        </div>
                        <div class="panel-body">
                            <div class="row" >                              
                                <div class="col-lg-12">
                                    <form id="assignmentForm"  name="assignmentForm" action="" method="post" enctype="multipart/form-data">
                                        <div class="col-lg-6">
    									<!--	<div class="form-group">
    											<label>Course Name</label>
    											 <select class="form-control" name="courseList" id="courseList" required onChange="getSubjects()">
                                                    <option value=''>Select</option>
                                                  </select>
                                            </div>
                                             <div class="form-group">
        											<label>Subject Name</label>
        											<select class="form-control" name="subjectList" id="subjectList" required>
                                                        <option value=''>Select</option>
        											</select>
                                               </div>-->
                                               <div class="form-group">
                                                    <label>Assignment Name</label>
                                                    <input class="form-control" type="text" name="assignName" id="assignName" required />
                                                </div>
                                                <div class="form-group">
                                                    <label>Description</label>                                            
        											<textarea name="assignDes" id="assignDes" class="form-control" rows="2" ></textarea>
                                                </div>  
                                                	<div class="form-group">
                                                <label>Instructions</label>                                            
    											<textarea name="assignIns" id="assignIns" class="form-control" rows="2" ></textarea>
                                            </div> 
                                        </div>
                                     
                                        <div class="col-lg-6">
    									 
                                            	<div class="form-group">
        											<label>File(Document)</label>
        											<input type="file" name="thmbImg" id="thmbImg" required />
        										</div>
        										<div class="form-group">
                                                    <label>Assignment Marks</label>
                                                    <input class="form-control" type="number" name="assignMrks" id="assignMrks" required />
                                                </div>
                                                <div class="form-group">
                                                    <label>Submission Date</label>
                                                    <input class="form-control" type="date" name="subDate" id="subDate" required readonly=""/>
                                                </div> 
                                        </div>
                                        <div class="col-lg-12">
                                           <center>
                                                <div id="result"></div><button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>
                                                <button type="reset" class="btn btn-danger"><i class="fa fa-refresh" aria-hidden="true"></i> Reset</button>
                                            </center>
                                        </div>
                                        
                                        
                                    </form>
                                </div>
                                <!-- /.col-lg-6 (nested) -->                                
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
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