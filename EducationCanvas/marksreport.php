<?php 
include "config.php";
checkUser();
$testId = $_REQUEST['testId'];  
$tchrId = $_SESSION['ecIdslstechservice'];
$sql="SELECT  ec_stu_assignments.vrfyDate,ec_stu_assignments.assignMarks,ec_stu_assignments.assignfdbck,ec_stu_assignments.stuassignId,ec_stu_assignments.stuId,ec_stu_assignments.stuDoc,ec_stu_assignments.assignRemark,ec_stu_assignments.assignDate,ec_stu_assignments.status,ec_stu_register.stuFname,ec_stu_register.stuLname FROM ec_stu_assignments,ec_stu_register where ec_stu_register.stuId=ec_stu_assignments.stuId and ec_stu_assignments.assignId='$testId' and ec_stu_assignments.tchrId='$tchrId' ORDER BY  ec_stu_register.stuFname ASC ";
$result     = dbQuery($sql);
?>
<div class="dataTable_wrapper table-responsive">
	<table class="table table-striped table-bordered table-hover" id="courseGrid">
		<thead>
			<tr>			
			    <th>SNo</th>
				<th>Student Name</th>
				<th>Marks</th>
				<th>Feedback</th>
				<th>Date</th>
			</tr>
		</thead>
		<tbody>
		<?php 
			if (dbNumRows($result) > 0)
			{
			    $i=0;
			   while($row = dbFetchAssoc($result))
				{
				    $i++;
					extract($row);
	       ?>
		<tr>	
		    <td><?php echo $i;?></td>
			<td><?php echo $stuFname." ".$stuLname;?></td>
			<td><?php echo $assignMarks;?></td>
			<td><?php echo $assignfdbck;?></td>
			<td><?php echo $vrfyDate;?></td>
		</tr>
		<?php
			}
	   }
	   else
	   {
	       echo "<tr><td colspan='5'><p class='bg-warning error_pgr'>Data is not available..!</p></td></tr>";
	   }
	   ?>

		</tbody>
	</table>
</div>

<script>
$(document).ready(function() {
    $('#courseGrid').DataTable({
            responsive: true
    });
});
</script>


