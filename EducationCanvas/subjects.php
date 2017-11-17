<?php 
include "header.php";
$sql="SELECT * FROM ec_subjects,ec_courses where ec_subjects.course=ec_courses.course_id ORDER BY ec_subjects.sub_id DESC";
$result     = dbQuery($sql);
?>
<script type="text/javascript">
    $(document).ready(function (e){
       $("#subjectForm").on('submit',(function(e){
            e.preventDefault();
            $.ajax({
            url: "saveSubjects.php",
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
                    document.getElementById("subjectForm").reset();
                     location.reload();
                }
                else
                {
                    $('#result').html("<p class='bg-warning error_pgr'>Record is not saved.Please try again...!!</p>");
                } 
            },
            error: function(){}             
            });
        }));
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
				<h4 class="page-header"><i class="fa fa-th-list" aria-hidden="true"></i> Subjects 
				<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal" style="float: right;margin: -5px 0;">
  New Subject
</button>
				</h4>
			</div>
		</div>
		<div class="row">
		
			<div class="col-lg-12">
				 <div class="panel panel-default"> 
						<div class="panel-heading">
                            <i class="fa fa-plus-square-o" aria-hidden="true"></i> Add Subject
                        </div>
                        <div class="panel-body">
                            <div class="col-lg-12" >								
                                <div class="dataTable_wrapper table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="courseGrid">
                                <thead>
                                <tr>									
                                	<th>SNo</th>
                                	<th>Subject Name</th>
                                	<th>Course Name</th>
                                	<th>Action</th>									
                                </tr>
                                </thead>
                                <tbody>
                                <?php 
                                if (dbNumRows($result) > 0)
                                {
                                    $i=0;
                                   while($row = dbFetchAssoc($result))
                                	{
                                		extract($row);
                                		$i++;
                                ?>
                                <tr>								
                                <td><?php echo $i;?></td>	
                                <td><?php echo $subject;?></td>	
                                <td><?php echo $course_name;?></td>	
                                <td><a href='#' title="Edit"> <i class="fa fa-pencil-square" aria-hidden="true"></i></a></td>
                                							
                                </tr>
                                <?php
                                }
                                }
                                else
                                {
                                echo "<tr><td colspan='4'><p class='bg-warning error_pgr'>Data is not available..!</p></td></tr>";
                                }
                                ?>
                                
                                </tbody>
                                </table>
                                </div>
                                <!-- /.table-responsive -->     								
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


<script>
$(document).ready(function() {
    $('#courseGrid').DataTable({
            responsive: true
    });
});
</script>


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add Subject</h4>
      </div>
      <div class="modal-body" style="height: 265px;">
        <div class="col-lg-12">
            <div class="col-lg-3"></div>
            <div class="col-lg-6">
            <form id="subjectForm"  name="subjectForm" action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                <label>Course Name</label>
                <select class="form-control" name="courseList" id="courseList" required>
                  <option value=''>Select</option>
                </select>
            </div>
        		<div class="form-group">
                    <label>Subject Name</label>
                    <input class="form-control" type="text" name="subject" id="subject" required />
                </div>									
               <center>
        			<div id="result"></div><button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>
        			<button type="reset" class="btn btn-danger"><i class="fa fa-refresh" aria-hidden="true"></i> Reset</button>
        		</center>
            </form>
            </div>
            <div class="col-lg-3"></div>
            
        </div>
      </div>
    </div>
  </div>
</div>



<?php
include "footer.php";
?>