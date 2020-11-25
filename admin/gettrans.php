<?php
include('lib/dbcon.php'); 
dbcon();
// get student transcript search details
 $tmatno = $_POST['matno'];
    $sql = "SELECT * FROM student_tb WHERE RegNo='".safee($condb,$tmatno)."'";
    $result = mysqli_query($condb,$sql); 
    $users_arr2 = array();
    while( $row = mysqli_fetch_array($result) ){
        $id = $row['RegNo'];
        $fullname = ucwords($row['FirstName']." ".$row['SecondName']." ".$row['Othername']);
        $fact = $row['Faculty'];
        $gdept = $row['Department'];
        $yoe = $row['yoe'];
        $acads = getAcastatus($row['acads']);
        $users_arr2[] = array("RegNo" => $id,"fullname" =>$fullname ,"facn" => $fact,"dept" => $gdept,"yoe" => $yoe,"acad" => $acads);
    }
// encoding array to json format
    echo json_encode($users_arr2);
    exit;
?>