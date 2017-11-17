<?php 
include "config.php";
$action= $_REQUEST['action'];
    
    if(isset($_REQUEST['action']) && $action == 'getCourse')
    {
    	$sql="select * from ec_courses";
    	$art_qry = dbQuery($sql);
    	if (dbNumRows($art_qry) > 0)
    	{
    		while($row = dbFetchAssoc($art_qry))
    		{	  
    		   $art[] = array('id' =>$row['course_id'], 'name' =>$row['course_name']); 
    		}
    		$artOptions = '<option value="">Select</option>';
    		foreach ($art as $key => $value)
    		{
    			$id=$value['id'];
    			$name=$value['name'];
    			$artOptions .= "<option value=\"$id\"";
    			$artOptions .= ">$name</option>\r\n";
    		}
    	}
    	else
    	{
    		$artOptions = '<option value="">Select</option>';
    	}
    	echo $artOptions;	
    }
    else if(isset($_REQUEST['action']) && $action == 'getSubjectTest')
    {
        
        $subId    = $_SESSION['ec_subject'];
        $courseId = $_SESSION['ec_course'];
        $tchrId   = $_SESSION['ecIdslstechservice'];
        
    	$sql="select * from ec_assignment where subId='$subId' and courseId='$courseId' and tchrId='$tchrId'";
    	$art_qry = dbQuery($sql);
    	if (dbNumRows($art_qry) > 0)
    	{
    		while($row = dbFetchAssoc($art_qry))
    		{	  
    		   $art[] = array('id' =>$row['assId'], 'name' =>$row['asignName']); 
    		}
    		$artOptions = '<option value="">Select</option>';
    		foreach ($art as $key => $value)
    		{
    			$id=$value['id'];
    			$name=$value['name'];
    			$artOptions .= "<option value=\"$id\"";
    			$artOptions .= ">$name</option>\r\n";
    		}
    	}
    	else
    	{
    		$artOptions = '<option value="">Select</option>';
    	}
    	echo $artOptions;	
    }
    else if(isset($_REQUEST['action']) && $action == 'getStuList'){
    	$courseId=$_REQUEST['courseId'];
        $sql_edt="select * from ec_stu_register where stuCourse='$courseId'";
        $deptedt_qry = dbQuery($sql_edt);
        if (dbNumRows($deptedt_qry ) > 0)
        {
        	while($row = dbFetchAssoc($deptedt_qry ))
        	{	  
        	   $editors[] = array('id' =>$row['stuId'], 'name' =>$row['stuFname']); 
        	}
        	$edtOptions = '';
        	foreach ($editors as $key => $value)
        	{
        		$id=$value['id'];
        		$name=$value['name'];			
        		$edtOptions .= " <div class='col-md-3'><div class='checkbox'><label><input type='checkbox' name='check_list[]' value=\"$id\"";
        		$edtOptions .= ">$name</input></label></div></div>";
        	}
        }
        else
        {
        	$edtOptions = '';
        }
        echo $edtOptions ;
	}
	else if(isset($_REQUEST['action']) && $action == 'getSubject')
    {
        $courseId=$_REQUEST['courseId'];
    	$sql="select * from ec_subjects where course='$courseId'";
    	$art_qry = dbQuery($sql);
    	if (dbNumRows($art_qry) > 0)
    	{
    		while($row = dbFetchAssoc($art_qry))
    		{	  
    		   $art[] = array('id' =>$row['sub_id'], 'name' =>$row['subject']); 
    		}
    		$artOptions = '<option value="">Select</option>';
    		foreach ($art as $key => $value)
    		{
    			$id=$value['id'];
    			$name=$value['name'];
    			$artOptions .= "<option value=\"$id\"";
    			$artOptions .= ">$name</option>\r\n";
    		}
    	}
    	else
    	{
    		$artOptions = '<option value="">Select</option>';
    	}
    	echo $artOptions;	
    }
    else if(isset($_REQUEST['action']) && $action == 'getStuListMarks'){
    	$courseId=$_REQUEST['courseId'];
        $sql_edt="select * from ec_stu_register where stuCourse='$courseId'";
        $deptedt_qry = dbQuery($sql_edt);
        if (dbNumRows($deptedt_qry ) > 0)
        {
        	while($row = dbFetchAssoc($deptedt_qry ))
        	{	  
        	   $editors[] = array('id' =>$row['stuId'], 'name' =>$row['stuFname']); 
        	}
        	$edtOptions = '';
        	foreach ($editors as $key => $value)
        	{
        		$id=$value['id'];
        		$name=$value['name'];			
        	//	$edtOptions .= " <div class='col-md-3'><div class='checkbox'><label><input type='text' name='check_list[]' value=\"$id\"";
        	//	$edtOptions .= ">$name</input></label></div></div>";
        		
        		$edtOptions .="<div class='col-lg-12' >
                	<div class='col-lg-4'>
                		<div class='form-group'>
                			<label>Student Name </label>
                			<input type='hidden' class='form-control' name='stuId_list[]' value=\"$id\"/>
                			<input type='text' class='form-control' name='stuId_names[]' value=\"$name\" disabled />
                		</div>									
                	</div>
                	<div class='col-lg-4'>	
                		<div class='form-group'>
                			<label>Marks</label>
                			<input type='number' class='form-control' name='stuMarks_list[]' />
                		</div>
                	</div>
                	<div class='col-lg-4'>
                			<div class='form-group'>
                				<label>Feedback</label>
                				<input type='text' class='form-control' name='stuFeedBack_list[]'/>
                			</div>										
                	</div>
                </div>";
        		
        		
        	}
        }
        else
        {
        	$edtOptions = '';
        }
        echo $edtOptions ;
	}
	 else if(isset($_REQUEST['action']) && $action == 'deleteTeacher'){
	     $tchrId=$_REQUEST['tchrId'];
	     $sql="delete from ec_teacher where tchrId='$tchrId'";
            if(dbQuery($sql))
        	{ 
            	echo "1";
        	}
        	else
        	{
            	echo "0";
        	}
	 }
	 else if(isset($_REQUEST['action']) && $action == 'deleteStudent'){
	     $stuId=$_REQUEST['stuId'];
	     $sql="delete from ec_stu_register where stuId='$stuId'";
            if(dbQuery($sql))
        	{ 
            	echo "1";
        	}
        	else
        	{
            	echo "0";
        	}
	 }
?>
