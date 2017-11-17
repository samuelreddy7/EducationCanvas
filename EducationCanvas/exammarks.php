<?php 
include "header.php";
?>
<script type="text/javascript">
    $(document).ready(function (e){
        $("#journalForm").on('submit',(function(e){
            e.preventDefault();
            tinyMCE.triggerSave();
            $.ajax({
            url: "saveJournal.php",
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
                    document.getElementById("journalForm").reset();
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
                <h4 class="page-header"><i class="fa fa-th-list" aria-hidden="true"></i> Exam Marks</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
            </div>
            <div class="col-lg-6">
                 <div class="panel panel-default"> 
                        <div class="panel-heading">
                            <i class="fa fa-plus-square-o" aria-hidden="true"></i> Add Exam Marks
                        </div>
                        <div class="panel-body">
                            <div class="row" >                              
                                <div class="col-lg-12">
                                    <form id="journalForm"  name="journalForm" action="" method="post" enctype="multipart/form-data">
                                        <div class="col-lg-6">
                                            <label>Select Class</label>
                                            <select class="form-control" name="jrnlName" id="jrnlName" required onchange="getVolumes()">
                                          <option value=''>Select</option>
                                        </select>
                                        </div>
                                        <div class="col-lg-6">
                                            <label>Select Exam</label>
                                            <select class="form-control" name="jrnlName" id="jrnlName" required onchange="getVolumes()">
                                          <option value=''>Select</option>
                                        </select>
                                        </div>  <br><br><br><br>                               
                                       <center>
                                            <div id="result"></div><button type="submit" class="btn btn-primary"><i aria-hidden="true"></i>Marks</button>
                                            <button type="reset" class="btn btn-danger"><i class="fa fa-refresh" aria-hidden="true"></i> Reset</button>
                                        </center>
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
            <div class="col-lg-3">
            </div>
        </div>
        <!-- /.row -->
        <div class="row">
            <div>
                 <div class="panel panel-default"> 
                        <div class="panel-heading">
                            <i class="fa fa-plus-square-o" aria-hidden="true"></i> Manage Marks
                        </div>
                        <div class="panel-body">
                            <div class="row" >                              
                                <div class="col-lg-12">
                                    <form id="journalForm"  name="journalForm" action="" method="post" enctype="multipart/form-data">
                                    <table>
                                    <tr><td class="col-lg-4">
                                        <div>
                                            <label>Select student</label>
                                            <select class="form-control" name="jrnlName" id="jrnlName" required onchange="getVolumes()">
                                          <option value=''>Select</option>
                                        </select>
                                        </div></td>
                                        <td class="col-lg-4">
                                        <div>
                                            <label>Select Subject</label>
                                            <select class="form-control" name="jrnlName" id="jrnlName" required onchange="getVolumes()">
                                          <option value=''>Select</option>
                                        </select>
                                        </div></td>
                                        <td class="col-lg-4">
                                        <div">
                                            <label>Enter Marks</label>
                                            <input type="text">
                                        </div></td>
                                        <td align="center">
                                        <div id="result"></div><button type="submit" class="btn btn-primary"><i aria-hidden="true"></i>Save Marks</button></center></td>
                                        </tr>
                                    </table>
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
            <div class="col-lg-3">
            </div>
             <table class='table table-responsive'>
                                    <tr><th class="col-lg-6">
                                        <div>
                                            <label>Student Name</label>
                                        </div></th>
                                        <th class="col-lg-6">
                                        <div>
                                            <label>Marks Obtained</label>
                                        </div></th>
                                        <th class="col-lg-6">
                                        <div>
                                            <label>FeedBack</label>
                                        </div></th>
                                        </tr>
                                    </table>
        </div>
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
<?php
include "footer.php";
?>
<script>
  tinymce.init({
    selector: '#classificationList'
  });
  </script>