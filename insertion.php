<?php
    require("dbconn.php");
    $db = new ComplaintsSystemDB();
    session_start();

    $ticket_info = $db->insert_ticket($_SESSION["student_id"], $_POST["title"], $_POST["body"], $_POST["severity"], $_POST["faculty_id"], $_POST["status"]);
    // $row = mysqli_fetch_assoc($ticket_info);
    // $_SESSION["ticket_no"] = $row["ticket_id"];
    header("Location: dashboard_student.php");
         
?>