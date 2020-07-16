<!-- <script type="text/javascript" src="validation/jquery.minv.js"></script> --!>

  <div class="col-md-12 col-sm-12 col-xs-12">
  <?php  $depart = $_GET['Schd'];
$session=$_GET['sec'];
$coursecodes= $_GET['scos'];
  $serial=1;
   ?>
                <div class="x_panel">
                  <div class="x_title">
                  
                    <h2> List of Student(s) that Registered for <?php echo $coursecodes." (".getcourse($coursecodes).")";?> .</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <p class="text-muted font-13 m-b-30">
                  <?php check_message(); ?>
                    </p>
                  <div class="alert alert-info alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span>
                    </button>
        Click On The Checkbox to select the approprate student(s) to approve Course Registration . 
                  </div>
                	<form  action="approve_course.php" name="formSubmit" class='form' id="formSubmit" method="post">
                    
                    <input type="hidden" name="type" value="<?php //echo $EmpID == '' ? 'Add' : 'Update'; ?>">
	     <input type="hidden" name="teacher" value="<?php echo $session_id; ?>">
	      <input type="hidden" name="sessionNow" value="<?php echo $default_session; ?>">
	    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" >
                    <!--	<a data-placement="top" title="Click to Delete check item"   data-toggle="modal" href="#student_delete" id="delete22"  class="btn btn-danger" name=""  ><i class="fa fa-trash icon-large"> Delete</i></a>
                    	&nbsp;&nbsp;&nbsp;
								<a href="new_apply.php?view=imp_a" class="btn btn-info"  id="delete21" data-placement="right" title="Click to import Student UTME Exam Result" ><i class="fa fa-file icon-large"></i> Import Data</a>
								onclick="setData()" &nbsp;&nbsp;&nbsp;
	<input style="margin: 20px;cursor: pointer;" type="button" class="btn btn-info" id="save" name="save"  title="Click on left Checkbox to Approve Registered Courses" value="Approve" >
		<button name="addmemt" class="btn btn-info"  id="add2" data-placement="right" title="Click to add class Member"><i class="fa-plus icon-large"> Add Selected Student(s)</i></button>--!>
	    	<a data-placement="top" title="Click to approve Selected Student Course Registration"    data-toggle="modal" href="#approve_c" id="delete2"  class="btn btn-info" name=""  ><i class="fa fa-check icon-large"> Approve Registered Courses</i></a>
	    	<a data-placement="top" title="Click Here to Go Back"    href="javascript:void(0);" onClick="window.location.href='Result_am.php?view=apcs';" id="delete1"  class="btn btn-primary" name="divButton2"  ><i class="fa fa-arrow-left icon-large"> Go Back</i></a>
									<script type="text/javascript">
									 $(document).ready(function(){
									 $('#delete').tooltip('show'); $('#delete1').tooltip('show'); $('#delete2').tooltip('show');
									 $('#delete').tooltip('hide'); 	 $('#delete1').tooltip('hide'); $('#delete2').tooltip('hide');
									 });
									</script>
										<?php include('modal_delete.php'); ?>
                      <thead>
                        <tr>
                     <th><input type="checkbox" name="chkall3" id="chkall3" onclick="return checkall3('selector3[]');"> </th>
                         <th>S/N</th>
                         <th>Registration No</th>
                         <th>Student Name</th>
                         <!-- <th>Course Title</th>
                          <th>Course Code</th>--!>
                          <th>Session</th>
                          <th>Semester</th>
                          <th>Level</th>
                          
                         <th>Action</th>
                        </tr>
                      </thead>
                      
                      
 <tbody>
                 <?php
$viewcourseallot1=mysqli_query($condb,"select * from coursereg_tb where c_code ='". safee($condb,$coursecodes) ."' and session ='". safee($condb,$session) ."'  and dept='". safee($condb,$depart) ."' ");
		while($row_allot = mysqli_fetch_array($viewcourseallot1)){
		$id = $row_allot['creg_id'];
		$course_id = $row_allot['course_id'];
		$course_approve = $row_allot['lect_approve'];
		$course_reg = $row_allot['sregno'];
?>     
<tr><td> <?php if($course_approve > 0){ ?><input type='checkbox' name="selector3[]" id="optionsCheckbox2" class="selector3" checked="checked" value="<?php echo $row_allot['creg_id']; ?>" /> <?php }else{ ?><input type='checkbox' name="selector3[]" id="optionsCheckbox2" class="selector3"  value="<?php echo $row_allot['creg_id']; ?>" /> <?php } ?></td>
     <input type="hidden" name="deptcp[]" value="<?php echo $depart; ?>">
	      <input type="hidden" name="sessions[]" value="<?php echo $session; ?>">
	     <input type="hidden" name="cosd[]" value="<?php echo $course_id; ?>">
                        	<td width="30"><?php echo $serial++; ?></td>
						  <td><?php 
						  echo $row_allot['sregno'];?></td>
					 <td><?php  echo getname($row_allot['sregno']); ?></td>
                         <!-- <td><?php echo getcourse($row_allot['c_code']); ?></td>
                          <td><?php echo $row_allot['c_code']; ?></td>--!>
                          <td><?php echo $row_allot['session']; ?></td>
                          <td><?php echo $row_allot['semester']; ?></td>
                          <td><?php echo getlevel($row_allot['level'],$class_ID); ?></td>
                          <input type="hidden" name="term" value="<?php echo $row_allot['semester']; ?>">
                          <td width="90">
	
	<a rel="tooltip"  title="Check Course Approval Status <?php echo $row_allot['course']; ?>" id="delete1" href="javascript:changeUserStatus60('<?php echo $id; ?>','<?php echo $course_id; ?>','<?php echo $depart; ?>','<?php echo $session; ?>','<?php echo $course_approve; ?>');" class="btn btn-info" ><i class="fa fa-check  <?php echo $course_approve == '0'? 'fa fa-check' : 'fa fa-remove'; ?>"></i>&nbsp;<?php echo $course_approve == '0'? 'Approve' : 'Decline'; ?></a>
												</td></tr>
                        <?php } ?>
                      </tbody>
                      
                       </table>
                      	</form>
                   
                  </div>
                </div>
              </div>