<?php
    
    require("dbconn.php");
    $db = new ComplaintsSystemDB();
    session_start();

    if(isset($_POST["faculty_username"]) && isset($_POST["faculty_password"])) {
        $faculty_id = $db->faculty_login($_POST["faculty_username"], $_POST["faculty_password"]);
        
        if($faculty_id) {
            $_SESSION["faculty_id"] = $faculty_id;
            header("Location: dashboard_faculty.php");
        } else {
            header("Location: index.php");
        }

    } else if(isset($_POST["student_username"]) && isset($_POST["student_password"])) {
        $student_id = $db->student_login($_POST["student_username"], $_POST["student_password"]);
       
        if($student_id) {
            $_SESSION["student_id"] = $student_id;
            header("Location: dashboard_student.php");
        } else {
            header("Location: index.php");
        }

    } else {
        header("Location: index.php");
    }

?>