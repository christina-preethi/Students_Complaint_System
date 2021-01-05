<?php
    require("dbconn.php");
    $db = new ComplaintsSystemDB();
    session_start();

    if (isset($_SESSION["student_id"])) {
        $student_id = $_SESSION["student_id"];
        $faculty_id = '';
    } else {
        $student_id = '';
        $faculty_id = $_SESSION["faculty_id"];
    }
    $ticket_details = $db->correspondence($_SESSION['ticket_no'], $_POST['message'], $student_id, $faculty_id);
    
    $status_info = $db->update_status($_POST['status'], $_SESSION['ticket_no']);
    header("Location: ticket_details.php");
    
?>