 <?php 
$resi = "";
if(isset($_POST['SendMessage'])){
$username = $_POST['username'];
$subject = $_POST['subject'];
$message = $_POST['msg'];
 $date=date("U");
 $vartime=date("D M d, Y H:i:s");
$usercategory = $_POST['r_type'];
$ourPath =  host()	;
$webaddress=$_SERVER['HTTP_HOST'];	
$query_adminrecord = mysqli_query($condb,"SELECT * FROM admin WHERE username='$username' OR email='$username'  AND validate='1'")or die(mysqli_error($condb));$row_adminrecord = mysqli_fetch_array($query_adminrecord); $num_checkadmin = mysqli_num_rows($query_adminrecord); $email20 = $row_adminrecord['email']; $adminid = $row_adminrecord['admin_id']; $adminuser = $row_adminrecord['username'];

$query_student = mysqli_query($condb,"SELECT * FROM student_tb WHERE RegNo ='$username' OR e_address='$username' AND verify_Data ='TRUE'")or die(mysqli_error($condb)); $num_row_student = mysqli_num_rows($query_student);
		$row_student = mysqli_fetch_array($query_student); $email21 = $row_student['e_address'];
		$studentid = $row_student['stud_id']; $regnopass = $row_student['RegNo'];
		
		$query_staff = mysqli_query($condb,"SELECT * FROM staff_details WHERE usern_id='$username' OR email='$username' AND  r_status='2'")or die(mysqli_error($condb));$num_row_staff = mysqli_num_rows($query_staff);
		$row_staff = mysqli_fetch_array($query_staff); $email22 = $row_staff['email'];
		$staffid = md5($row_staff['staff_id']); $usern_id = $row_staff['usern_id'];
		
	if($usercategory == "Admin"){
if ($num_checkadmin < 1){
message("ERROR:  The Recipiant UserID $username is Incorrect please Comfirm and try Again.", "error");
 redirect('message_m.php'); 
//$res="<font color='Red'><strong>ERROR:  The Recipiant UserID $username is Incorrect please Comfirm and try Again.</strong></font><br>";
				//$resi=1;
}else{
$sendmessage=mysqli_query($condb,"INSERT into b_pms (sender, receiver,subject,message,therealtime,vartime) values('$session_id','$adminid','$subject','$message','$date','$vartime')") or die("Could not send message");
message("Your Message was Successfully Sent", "success");
 redirect('message_m.php');
	//	$res="<font color='green'><strong>Your Message was Successfully Sent.</strong></font><br>";
		//$resi = 1;				
		}}
		
			if($usercategory == "Student"){
if ($num_row_student < 1){ 
message("ERROR:  The Recipiant $username is Incorrect please Comfirm and try Again", "error");
 redirect('message_m.php');
//$res="<font color='Red'><strong>ERROR:  The Recipiant $username is Incorrect please Comfirm and try Again.</strong></font><br>";
				//$resi=1;
}else{
$sendmessage=mysqli_query($condb,"INSERT into b_pms (sender, receiver,subject,message,therealtime,vartime,s_status,r_status) values('$session_id','$regnopass','$subject','$message','$date','$vartime','1','$sender_count')") or die("Could not send message");
message("Your Message was Successfully Sent", "success");
 redirect('message_m.php');
//	$res="<font color='green'><strong>Your Message was Successfully Sent.</strong></font><br>";
		//$resi = 1;			
		}}
		
		if($usercategory == "Staff"){
if ($num_row_staff < 1){
 message("ERROR:  The Recipiant $username is Incorrect please Comfirm and try Again.", "error");
 redirect('message_m.php');
//$res="<font color='Red'><strong>ERROR:  The Recipiant $username is Incorrect please Comfirm and try Again.</strong></font><br>";
			//	$resi=1;
}else{
$sendmessage=mysqli_query($condb,"INSERT into b_pms (sender, receiver,subject,message,therealtime,vartime,s_status,r_status) values('$session_id','$usern_id','$subject','$message','$date','$vartime','2','$sender_count')") or die("Could not send message");
message("Your Message was Successfully Sent.", "success");
 redirect('message_m.php');
	//$res="<font color='green'><strong>Your Message was Successfully Sent.</strong></font><br>";
		//$resi = 1;
		}}

}
?>
 
 <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                 
                    <h2>Compose New Message</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                   <div class="x_content">

                    		<form name="addFee1" method="post" enctype="multipart/form-data" id="addFee1">
<input type="hidden" name="insidmsg" value="<?php echo $_SESSION['insidmsg'];?> " />
                      <input type="hidden" name="MAX_FILE_SIZE" value="500000" />
                      <span class="section"> <?php if($resi == 1){	echo " 
		<center><label class=\"control-label\" for=\"inputEmail\"><font color=\"red\">$res</font></label></center>";}
?> </span>

   <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
						  	  <label for="heard">Recipient Type </label>
                            	  <select name='r_type' id="r_type" class="form-control" required="required" >
                            <option value="">-- Select --</option>
                             <option value="Staff">Staff</option>
                              <option value="Student">Student</option>
                              <option value="Admin">Admin</option>
                            </select>
                      </div>
                      
<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
					  <label for="heard" id="c_title">Username of Recipient :</label>
                     <input type="text" class="form-control " name='username' id="username" placeholder="Username / Reg No / Email" value=""  required="required"> </div>
                         
						 <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
					  <label for="heard" id="c_title">Subject :</label>
                    <input type="text" class="form-control " name='subject' id="subject"  value=""  required="required"> </div>
                         
                      <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
					  <label for="heard">Message :</label>
        <textarea name="msg" id='msg' rows='6' cols = '45' class="form-control "  required="required"></textarea>
   
                           </div>
                          <!--
                           <div class="col-md-6 col-sm-6  form-group has-feedback">
					  <label for="heard" id="im_d">Attach File:</label>
                      <input name="image_name" class="form-control" id="fileInput" type="file" accept="image/*" onchange="preview_image(event)" style="width:200px;">
						  </div> --!>
                   
               
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                        
                        </div>
                      </div>
                      <div class="form-group">
                      <div class="col-md-6 col-md-offset-3">
                                        
                                        </div>  </div>
                      <div  class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <div class="col-md-6 col-md-offset-3">
                         <button  name="SendMessage"  id="addpro"  class="btn btn-primary col-md-12" title="Click Here to Send Message" ><i class="fa fa-sign-in"></i> Send Message </button>
                      
                        	<script type="text/javascript">
	                                            $(document).ready(function(){
	                                            $('#addpro').tooltip('show');
	                                            $('#addpro').tooltip('hide');
	                                            });
	                                            </script>
                        </div>
                        
                        	
									
                        </form>
                       </div>
                  
                </div>
              </div>
              