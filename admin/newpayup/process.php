<?php 
//require_once
include('./lib/dbcon.php'); 
dbcon(); 
include('session.php');

$action = isset($_GET['action']) ? $_GET['action'] : '';

switch ($action) {
			
	case 'status' :
		statusUser();
		break;
		case 'status2' :
	   statusUser2();
		break;
		case 'status20' :
	   statusUser20();
	   break;
		case 'status21' :
	   statusUser21();
		break;
    case 'status3' :
	   statusUser3();
		break;
		case 'status4' :
	   statusUser4();
		break;
		case 'status5' :
	   statusUser5();
		break;
	case 'status6' :
	statuscapp2();
	break;
		case 'status60' :
	statuscapp20();
		break;
			case 'status10' :
	statuspay();
		break;
	case 'status7' :
	statusUser7();
		break;
		case 'status8' :
	statusUser8();
		break;
		case 'status9' :
	statusUser9();
		break;
	default :
	 redirect("../admin/");
		//redi('Location: index.php');
}
function statusUser()
{ $userId = $_GET['userId'];	
	$nst 	= $_GET['nst'];
	$status = $nst == 'Cancel Aproval' ? 'FALSE' : 'TRUE';
$sql   = mysqli_query(Database ::$conn,"UPDATE new_apply1 SET verify_apply = '".safee($condb,$status)."' WHERE stud_id = '".safee($condb,$userId)."' ");
redirect("new_apply.php?details&userId=".$userId);
}
function statusUser2()
{$userId = $_GET['userId'];	
$nst 	= $_GET['nst'];
$status = $nst == 'Cancel Verification' ? 'FALSE' : 'TRUE';
$getsup=mysqli_query(Database ::$conn,"SELECT * FROM student_tb WHERE  stud_id ='".safee($condb,$userId)."' AND reg_status = '1'");
$stfound = mysqli_fetch_array($getsup); $regNo1 = $stfound['RegNo']; $pass_word = substr(md5($regNo1.SUDO_M),14); $yearofgrag = $stfound['yoe']+ $stfound['prog_dura'];
	$sql   = mysqli_query(Database ::$conn,"UPDATE student_tb SET verify_Data = '".safee($condb,$status)."',password = '".safee($condb,$pass_word)."',yog = '".safee($condb,$yearofgrag)."' WHERE stud_id = '".safee($condb,$userId)."'"); //redirect("Student_Record.php?details&userId=");
redirect("Student_Record.php?details&userId=".$userId);
	}
	
	function statusUser20()
{$userId = $_GET['userId'];
$nst 	= $_GET['nst']; $dep1 = $_GET['dep']; $sec1 = $_GET['sec']; $los 	= $_GET['los'];
$status = $nst == 'Cancel' ? 'FALSE' : 'TRUE';
$getsup=mysqli_query(Database ::$conn,"SELECT * FROM student_tb WHERE  stud_id ='".safee($condb,$userId)."' AND reg_status = '1'");
$stfound = mysqli_fetch_array($getsup); $regNo1 = $stfound['RegNo']; $pass_word = substr(md5($regNo1.SUDO_M),14); $yearofgrag = $stfound['yoe']+ $stfound['prog_dura'];
	$sql   = mysqli_query(Database ::$conn,"UPDATE student_tb SET verify_Data = '".safee($condb,$status)."',password = '".safee($condb,$pass_word)."',yog = '".safee($condb,$yearofgrag)."' WHERE stud_id = '".safee($condb,$userId)."'"); //redirect("Student_Record.php?details&userId=");
if(empty($dep1)){redirect("Student_Record.php");}else{ redirect("Student_Record.php?dept1_find=".$dep1."&session2=".$sec1."&los=".$los);}
	}
	  function statusUser21()
{ $userId = $_GET['userId'];	
	$nst 	= $_GET['nst']; $status = $nst == 'Block user' ? '0' : '1';
	$sql   = mysqli_query(Database ::$conn,"UPDATE admin SET validate = '".safee($condb,$status)."' WHERE admin_id = '".safee($condb,$userId)."'");
redirect("add_Users.php");
}
	  function statusUser3()
{ $userId = $_GET['userId'];	
	$nst 	= $_GET['nst'];
	$status = $nst == 'Show' ? 'TRUE' : 'FALSE';
	$sql   = mysqli_query(Database ::$conn,"UPDATE news SET status = '".safee($condb,$status)."' WHERE news_id = '".safee($condb,$userId)."'");
redirect("News_events.php");
}
	  function statusUser4()
{$userId = $_GET['userId'];	
	$nst 	= $_GET['nst'];
	$status = $nst == 'Approve' ? '1' : '0';
	$hinfoo=mysqli_query(Database ::$conn,"SELECT * FROM hostelallot_tb WHERE  allot_id ='".safee($condb,$userId)."' AND paystatus = '1'");
	$hinfoo1 = mysqli_fetch_array($hinfoo); $roomid = $hinfoo1['roomno']; $startdatec = $hinfoo1['allotdate']; $duration = $hinfoo1['duration'];

	//$startdate2= DateTime::createFromFormat('d/m/Y', $startdatec)->format('Y-m-d');
		//production
//$startdate = endCycle($startdatec, $duration);
$sql   = mysqli_query(Database ::$conn,"UPDATE  hostelallot_tb SET validity = '".safee($condb,$status)."',allotdate = '".safee($condb,$startdatec)."',allotexpire = '".safee($condb,$startdate)."', allotstatus ='".safee($condb,$status)."',approve_by = '".$_SESSION['id']."' WHERE allot_id = '".safee($condb,$userId)."'");
$sql2   = mysqli_query(Database ::$conn,"UPDATE  roomdb SET room_status = '0' WHERE room_id = '".safee($condb,$roomid)."'");
redirect("add_Hostel.php?view=roomR");
}

function statusUser5()
{$userId = $_GET['id2'];	
	$nst 	= $_GET['nst'];
	$status = $nst == 'Show' ? 'TRUE' : 'FALSE';
	$sql   = "UPDATE staff_details SET u_display = '$status' WHERE staff_id = '$userId' ";
mysqli_query(Database ::$conn,$sql);
redirect("add_Staff.php");
	//header('Location: add_staff.php');	

}
function statuscapp2()
{$userId = $_GET['userId'];	
	$nst 	= $_GET['nst'];
	$cosn 	= getccode2($_GET['cos']);
		//$status = $nst == 'Verified' ? 'TRUE' : 'FALSE';
	$status = $nst == 'Approve' ? '1' : '0';
	$sql   = "UPDATE coursereg_tb SET lect_approve = '$status' WHERE sregno = '$userId'";
mysqli_query(Database::$conn,$sql); redirect("Course_m.php?view=clist&userId=".$cosn);
//redirect("Course_m.php?view=v_allot");
}
function statuscapp20()
{$userId = $_GET['userId'];	//$cosn 	= getccode2($_GET['slos']);
	$nst 	= $_GET['nst']; $cosn 	= $_GET['slos'];$sess = ($_GET['sec']);$sdp = ($_GET['Schd']); $matno = getrno($_GET['userId']);
	$status = $nst == 'Approve' ? '1' : '0';
	$sql   = "UPDATE coursereg_tb SET lect_approve = '$status' WHERE creg_id = '$userId'";
mysqli_query(Database::$conn,$sql); redirect("Result_am.php?view=caprove&dlist&userId=".($matno)."&Schd=".$sdp."&sec=".$sess."&slos=".$cosn);


}
function statusUser7()
{$userId = $_GET['userId'];	
	$nst 	= $_GET['nst'];
	$status = $nst == 'Approve' ? '1' : '0';
	$sql   = "UPDATE candidate_tb SET approve = '$status' WHERE candid = '$userId'";
mysqli_query(Database::$conn,$sql);
redirect("election.php?view=candidates");
}
function statusUser8()
{$userId = $_GET['userId'];	
	$nst 	= $_GET['nst'];
	$status = $nst == 'Approve' ? '1' : '0';
	$sql   = "UPDATE candidate_tb SET approve_result = '$status' WHERE candid = '$userId'";
mysqli_query(Database::$conn,$sql);
redirect("election.php?view=candidates");
}
function statusUser9()
{$userId = $_GET['userId'];	
	$nst 	= $_GET['nst'];
	$status = $nst == 'Start' ? '0' : '1';
	$sql   = "UPDATE electiontb SET estatus = '$status' WHERE id = '$userId'";
mysqli_query(Database::$conn,$sql);
redirect("election.php?view=velection");
}
function statuspay(){
$userId = $_GET['userId'];	
$nst 	= $_GET['nst']; $dop 	= $_GET['dop']; $sess = ($_GET['ses']);$sdp = ($_GET['dep']);
$status = $nst == 'Approve' ? '1' : '0';
$getsup=mysqli_query(Database ::$conn,"SELECT * FROM payment_tb WHERE  pay_id ='".safee($condb,$userId)."' AND paid_amount > 0 ");
$stfound = mysqli_fetch_array($getsup); $feetype = $stfound['fee_type']; 
$sql   = mysqli_query(Database ::$conn,"UPDATE payment_tb SET pay_status = '".safee($condb,$status)."' WHERE pay_id ='".safee($condb,$userId)."'");
$sql2 = mysqli_query(Database ::$conn,"UPDATE feecomp_tb SET pstatus ='".safee($condb,$status)."' WHERE Batchno ='".safee($condb,$feetype)."' ")or die(mysqli_error($condb));
redirect("View_Payment.php?dept1_find=".$sess."&session2=".$sdp."&dop=".$dop);
	}
?>