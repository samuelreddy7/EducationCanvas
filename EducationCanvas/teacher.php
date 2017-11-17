<?php 
include "header.php";
$tchrId = $_SESSION['ecIdslstechservice'];
$sql_edt="SELECT * FROM ec_teacher,ec_courses,ec_subjects where ec_teacher.courseId=ec_courses.course_id and ec_subjects.sub_id = ec_teacher.subId and ec_courses.course_id = ec_subjects.course and ec_teacher.tchrId='$tchrId'";
$deptedt_qry = dbQuery($sql_edt);
if (dbNumRows($deptedt_qry ) > 0)
{
    $row = dbFetchAssoc($deptedt_qry);
    extract($row);
}
?>
<style>
    .form-control {   
    border: none;   
    box-shadow: none;   
}
</style>
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
			&nbsp;
			<p class="text-center"><img src="images/ec.png" /></p>
			</div>
		</div>
		<br />
		<div class="row">
		    <div class="col-lg-12">
		          
			    <div class="panel panel-default"> 
                <div class="panel-heading">
                <i class="fa fa-user" aria-hidden="true"></i> Teacher Profile
                </div>
                <div class="panel-body">
                <div class="row" >                              
                <div class="col-lg-12">
                    
                   
                            
                                <form id="assignmentForm" class="form-horizontal" name="assignmentForm" action="" method="post" enctype="multipart/form-data">
                                        <div class="col-lg-6">
    										<div class="form-group">
    											<label class="col-sm-4 control-label">Teacher Name : </label>
    											<div class="col-sm-8">
    											 <p class="form-control"><?php echo $name;?></p>
    											 </div>
                                            </div>
                                             <div class="form-group">
        											<label class="col-sm-4 control-label">Course Name : </label>
        											<div class="col-sm-8">
        											<p class="form-control"><?php echo $course_name;?></p>
        											</div>
                                               </div>
                                               <div class="form-group">
        											<label class="col-sm-4 control-label">Subject Name : </label>
        											<div class="col-sm-8">
        											<p class="form-control"><?php echo $subject;?></p>
        											</div>
                                               </div>
                                                
                                            </div>
                                            <div class="col-md-6">
                                               <div class="form-group">
                                                    <label class="col-sm-4 control-label">Email : </label>
                                                    <div class="col-sm-8">
                                                    <p class="form-control"><?php echo $email;?></p>
                                                    </div>
                                                </div>
                                                 <div class="form-group">
                                                    <label class="col-sm-4 control-label">Mobile : </label>
                                                    <div class="col-sm-8">
                                                    <p class="form-control"><?php echo $mobile;?></p>
                                                    </div>
                                                </div>
                                               
                                        </div>
                                     
                                    </form>
                			 
                 </div>
                <!-- /.col-lg-6 (nested) -->                                
                </div>
                <!-- /.row (nested) -->
                </div>
                <!-- /.panel-body -->
                </div>
		
		    </div>
		   
		</div>
	
	</div>
</div>
<?php
include "footer.php";
?>