<?php
    require("dbconn.php");
    $db = new ComplaintsSystemDB();
    session_start();

    // echo $_POST['selected_ticket'];
    $_SESSION['ticket_no'] = $_POST['selected_ticket'];

    header("Location: ticket_details.php");

?>