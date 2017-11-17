<?php 
include "header.php";
if(isset($_SESSION['ec_course']))
{
   $ec_course= $_SESSION['ec_course'];
}
?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script type="text/javascript">
    $(document).ready(function (e){
	    $( "#doa" ).datepicker({
		  changeMonth: true,
		  changeYear:true,
		  showOn: "button",
		  buttonImage: "images/calendar.gif",
		  buttonImageOnly: true,
		  buttonText: "Select date",
		  dateFormat: 'yy-mm-dd'
		});
    });
</script>
<script>

     function getStudents(){
        var doa=$('#doa').val();
        if(doa !='')
        {
            $.ajax({
                type: "GET",
                dataType: "html",
                url: "attenHis.php?doa="+doa,
                cache: false,
                success: function(htmldata) {			   
                	$('#sData').html(htmldata);
                }
            });
        }
        else
        {
            alert("Please select date..!");
        }
 
    	
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
                
                
                   <div class="panel panel-default"> 
                        <div class="panel-heading">
                            <i class="fa fa-plus-square-o" aria-hidden="true"></i> Selet Date
                        </div>
                        <div class="panel-body">
                            <div class="row" >                              
                                
                                    <div class="col-lg-4">
                                        <div class="form-group">
    										<input type="text" class="form-control" name="doa" id="doa"  placeholder="YYYY-MM-DD" required=""/>
								    	</div>
                                    </div>
                                    <div class="col-lg-4">
                                        <button type="button"  class="btn btn-primary" onClick="getStudents()"><i class="fa fa-floppy-o" aria-hidden="true"></i> Get Students</button>
                                    </div>
                                    <div class="col-lg-4"> </div>
                                   
                                                        
                            </div>
                           
                        </div>
                       
                    </div>
                 
                  <div class="panel panel-default"> 
                        <div class="panel-heading">
                            <i class="fa fa-plus-square-o" aria-hidden="true"></i> Student Details
                        </div>
                        <div class="panel-body">
                            <div class="row" >                              
                                <div class="col-lg-12" id="sData">  
                                
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
