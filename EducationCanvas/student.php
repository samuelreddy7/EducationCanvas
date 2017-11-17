<?php 
include "header.php";
$studentId = $_SESSION['ecIdslstechservice'];
$sql_subject="SELECT ec_subjects.sub_id,ec_subjects.subject FROM ec_stu_register,ec_subjects where ec_stu_register.stuCourse=ec_subjects.course and ec_stu_register.stuId='$studentId' ORDER BY  ec_subjects.subject ASC";
$result_subject     = dbQuery($sql_subject);
?>
<style>
hr {
    margin-top: 5px;
    margin-bottom: 5px;
    border: 0;
    border-top: 1px solid #eee;
}
</style>
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row brde_line">
			<div class="col-lg-12">
			&nbsp;
			<p class="text-center"><img src="images/ec.png" /></p>
			</div>
		</div>
		<br />
		<div class="row">
			<div class="col-lg-8">
			    
            <?php 
            if (dbNumRows($result_subject) > 0)
            {
                
               while($row_subject = dbFetchAssoc($result_subject))
            	{
            	  
            		extract($row_subject);
                ?>
                 <div class="col-lg-4 col-md-6">
        				<div class="panel panel-primary">
        					<div class="panel-heading">
        						<div class="row">
        							<div class="col-xs-2">
        								<i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i>
        							</div>
        							<div class="col-xs-10 text-left">
        								<div class="huge"></div>
        								<div class="dash-hd"><?php echo $subject;?></div>
        							</div>
        						</div>
        					</div>
        					<a href="stuassignmenst.php?subId=<?php echo $sub_id;?>">
        						<div class="panel-footer">
        							<span class="pull-left">Assignments</span>
        							<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
        							<div class="clearfix"></div>
        						</div>
        					</a>
        					<a href="stumarks.php?subId=<?php echo $sub_id;?>">
        						<div class="panel-footer">
        							<span class="pull-left">Marks</span>
        							<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
        							<div class="clearfix"></div>
        						</div>
        					</a>
        				</div>
        			</div>
    			    
    			   <?php
                	}
                }
            ?>

			    
			    
			    
			    
			   
			    
			</div>
			<div class="col-lg-4">
                 <?php
                 include "leftcontainer.php";
                 ?>
             </div>
		</div>
	
	</div>
</div>
<?php
include "footer.php";
?>