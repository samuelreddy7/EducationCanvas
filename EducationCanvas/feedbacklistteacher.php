<?php 
include "config.php";
$tchrId = $_SESSION['ecIdslstechservice'];
 $sql="SELECT  ec_stu_register.stuId,ec_stu_register.stuFname,ec_subjects.subject,ec_parent_feedback.status,ec_parent_feedback.feedback,ec_parent_feedback.fedDate,ec_parent_feedback.stuId,ec_parent_feedback.asignSubId,ec_parent_feedback.subId FROM ec_stu_register,ec_parent_feedback,ec_subjects,ec_stu_assignments where ec_subjects.sub_id=ec_parent_feedback.subId and ec_stu_register.stuId = ec_parent_feedback.stuId and ec_parent_feedback.stuId=ec_stu_assignments.stuId and ec_stu_assignments.stuassignId = ec_parent_feedback.asignSubId and ec_stu_assignments.tchrId='$tchrId' ORDER BY  ec_parent_feedback.fedId DESC ";
$result_subject     = dbQuery($sql);
?>
<div class="dataTable_wrapper table-responsive">
        <table class="table table-striped table-bordered table-hover" id="courseGrid">
            <thead>
                <tr>			
                    <th>SNo</th>
                    <th>Student Name</th>
                    <th>Subject Name</th>
                    <th>Feedback</th>
                    <th>Date</th>				
                </tr>
            </thead>
            <tbody>
                <?php
                if (dbNumRows($result_subject) > 0)
                {
                    $i=0;
                    while($row_subject = dbFetchAssoc($result_subject))
                    {
                        extract($row_subject);
                      $i++;
                            ?>
                                <tr>	
                                <td><?php echo $i;?></td>
                                <td><?php echo $stuFname;?></td>
                                <td><?php echo $subject;?></td>
                                <?php
                                  if($status == 'p')
                                 {
                                     ?>
                                      <td><b>Parent: </b><?php echo $feedback;?> <a href="#" onclick="replyFdback('<?php echo $asignSubId;?>','<?php echo $subId;?>','<?php echo $stuId;?>')" ><i class="fa fa-reply" aria-hidden="true"></i></a></td>
                                <?php
                                 }
                                 else
                                 {
                                     ?>
                                        <td><b>Teacher: </b><?php echo $feedback;?></td>
                                     <?php
                                 }
                                 ?>
                                <td><?php echo $fedDate;?></td>
                                
                                </tr>
                            <?php
                    }
                }
                else
                {
                echo "<tr><td colspan='6'><p class='bg-warning error_pgr'>Data is not available..!</p></td></tr>";
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