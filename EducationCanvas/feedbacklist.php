<?php 
include "config.php";
$studentId = $_SESSION['ecIdslstechservice'];
 $sql="SELECT * FROM ec_parent_feedback,ec_subjects where ec_subjects.sub_id=ec_parent_feedback.subId and ec_parent_feedback.stuId='$studentId' ORDER BY  ec_parent_feedback.fedId DESC";
$result_subject     = dbQuery($sql);
if (dbNumRows($result_subject) > 0)
{
   while($row_subject = dbFetchAssoc($result_subject))
	{
		extract($row_subject);
		if($status == 'p')
		{
		    ?>
        <li class="left clearfix">
            <span class="chat-img pull-left">
              <b> Parent Feedback</b>-Subject:
            </span>
            <div class="chat-body clearfix">
                <div class="header">
                    <p><?php echo $subject;?></p>
                    <small class="pull-right text-muted">
                         <i class="fa fa-clock-o fa-fw"></i> <?php echo $fedDate;?>
                    </small>
                </div>
                <p>
                     <?php echo $feedback;?>
                </p>
            </div>
        </li>
		<?php
		}
		else{
		   ?>
		    <li class="left clearfix">
                <span class="chat-img pull-left">
                  <b> Teacher Replay</b>-Subject:
                </span>
                <div class="chat-body clearfix">
                    <div class="header">
                        <p><?php echo $subject;?></p>
                        <small class="pull-right text-muted">
                             <i class="fa fa-clock-o fa-fw"></i> <?php echo $fedDate;?>
                        </small>
                    </div>
                    <p>
                         <?php echo $feedback;?>
                    </p>
                    <a href="#" onclick="replyFdback('<?php echo $asignSubId;?>','<?php echo $subId;?>')" ><i class="fa fa-reply" aria-hidden="true"></i></a>
                </div>
            </li>
		   <?php
		}
	}
}

?>