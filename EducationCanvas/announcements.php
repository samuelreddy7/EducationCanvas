<?php 
include "header.php";
?>
<script type="text/javascript">
    $(document).ready(function (e){     
        getAnnouseList();
        $("#AnnouncementForm").on('submit',(function(e){
            e.preventDefault();
            $.ajax({
            url: "saveAnuncmnt.php",
            type: "POST",
            data:  new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            beforeSend: function() {
				console.log(new FormData(this));
               $('#result').html("<center><img src='images/bx_loader.gif' /><br /><b>Data is saving. Please wait...</b></center>");;
            },
            success: function(data){
                //alert(data);
                 if(data == '1')
                {
                    $('#result').html("<p class='bg-success error_pgr'>Record is saved sucessfully..!!</p>");
                    document.getElementById("AnnouncementForm").reset();
                     getAnnouseList();
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
     function getAnnouseList(){
        $.ajax({
            type: "GET",
            dataType: "html",
            url: "announcementsList.php",
            cache: false,
            success: function(htmldata) {
                $('#ansList').html(htmldata);
            }
        });
    }
</script>
<!-- Page Content -->
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<h4 class="page-header"><i class="fa fa-th-list" aria-hidden="true"></i> Announcements 
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal" style="float: right;margin: -5px 0;">
                      New Announcement
                    </button>
                </h4>
			</div>
		</div>
		<div class="row" id="ansList">
		
		</div>
		<!-- /.row -->
	</div>
	<!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add Course</h4>
      </div>
      <div class="modal-body">
            <form id="AnnouncementForm"  name="AnnouncementForm" action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Announcement</label>                                            
            		<textarea name="abstract" id="abstract" class="form-control" rows="4"  required=""></textarea>
                </div>                                                                       
               <center>
                    <div id="result"></div><button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>
                    <button type="reset" class="btn btn-danger"><i class="fa fa-refresh" aria-hidden="true"></i> Reset</button>
                </center>
            </form>
      </div>
    </div>
  </div>
</div>

<?php
include "footer.php";
?>
