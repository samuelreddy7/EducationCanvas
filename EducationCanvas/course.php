<?php 
include "header.php";
$sql="SELECT * FROM ec_courses ORDER BY course_id DESC";
$result     = dbQuery($sql);
?>
<script type="text/javascript">
    $(document).ready(function (e){
        $("#courseForm").on('submit',(function(e){
            e.preventDefault();
            $.ajax({
            url: "saveCourse.php",
            type: "POST",
            data:  new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            beforeSend: function() {
			   $('#result').html("<img src='images/bx_loader.gif' />");
			},
            success: function(data){				
                if(data == '1')
                {
                    $('#result').html("<p class='bg-success error_pgr'>Record is saved sucessfully..!!</p>");
                    document.getElementById("courseForm").reset();
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
    });
</script>
<!-- Page Content -->
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<h4 class="page-header"><i class="fa fa-th-list" aria-hidden="true"></i> Course 
<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal" style="float: right;margin: -5px 0;">
  New Course
</button>
</h4>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				 <div class="panel panel-default"> 
						<div class="panel-heading">
                            <i class="fa fa-plus-square-o" aria-hidden="true"></i> Add Course
                        </div>
                        <div class="panel-body">
					<div class="dataTable_wrapper table-responsive">
						<table class="table table-striped table-bordered table-hover" id="courseGrid">
							<thead>
								<tr>									
									<th>Name</th>									
									<th>Action</th>									
								</tr>
							</thead>
							<tbody>
							<?php 
								if (dbNumRows($result) > 0)
								{
								   while($row = dbFetchAssoc($result))
									{
										extract($row);
						       ?>
							<tr>								
								<td><?php echo $course_name;?></td>	
								<td><a href='#' title="Edit"> <i class="fa fa-pencil-square" aria-hidden="true"></i></a></td>
															
							</tr>
							<?php
								}
						   }
						   else
						   {
						       echo "<tr><td colspan='2'><p class='bg-warning error_pgr'>Data is not available..!</p></td></tr>";
						   }
						   ?>

							</tbody>
						</table>
					</div>
					<!-- /.table-responsive -->                           
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
        <h4 class="modal-title" id="myModalLabel">Add Course</h4>
      </div>
      <div class="modal-body">
		<form id="courseForm"  name="courseForm" action="" method="post" enctype="multipart/form-data">
			<div class="form-group">
				<label>Course Name</label>
				<input class="form-control" type="text" name="courseName" id="courseName" required />
			</div>									
		   <center>
				<div id="result"></div><button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>
				<button type="reset" class="btn btn-danger"><i class="fa fa-refresh" aria-hidden="true"></i> Reset</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</center>
		</form>
      </div>
    </div>
  </div>
</div>


<?php
include "footer.php";
?>