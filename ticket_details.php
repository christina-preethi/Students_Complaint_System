<?php
    require("dbconn.php");
    $db = new ComplaintsSystemDB();
    session_start();

    $ticket = $db->ticket_correspondence($_SESSION['ticket_no']);

    if (mysqli_num_rows($ticket) >= 1) {
    // $db->print_all($ticket);
        $rowcount_correspondence=mysqli_num_rows($ticket);
        for ($y = 0; $y < $rowcount_correspondence ; $y++) {
            $row = mysqli_fetch_assoc($ticket);
            echo "Title: ";
            echo $row['title'];
            echo "<br>";
            echo "Body: ";
            echo $row['body'];
            echo "<br>";
            echo "Date: ";
            echo $row['date'];
            echo "<br>";
            echo "Severity: ";
            echo $row['severity'];
            echo "<br>";
            echo "Status: ";
            echo $row['status'];
            echo "<br>";
        }
    }

    echo "<br>";
    $ticket_info = $db->ticket_details($_SESSION['ticket_no']);
    if (mysqli_num_rows($ticket_info) >= 1) {
        $rowcount=mysqli_num_rows($ticket_info);
            for ($y = 0; $y < $rowcount ; $y++) {
                $row = mysqli_fetch_assoc($ticket_info);
                echo $row['faculty_id'];
                echo " ";
                echo $row['reg_no'];
                echo " ";
                echo $row['messgae'];
                echo " ";
                echo $row['date'];
                echo "<br>";
            }
    }



?>

<!DOCTYPE html>
<html>
    <body>
    <form method="POST" action="correspondence.php">
    <h4>Message<h4> 
    <textarea rows="5" cols="50" name="message" value="" required></textarea>
    <br>
    <br>

    Status:
            <select name='status' required> 
                    <option value='ASSIGNED'>ASSIGNED</option>
                    <option value='WIP'>WORK IN PROGRESS</option>
                    <option value='STUDENT_PENDING'>STUDENT PENDING</option>
                    <option value='FACULTY_PENDING'>FACULTY PENDING</option>
                    <option value='RESOLVED'>RESOLVED</option>
            </select>
            <br>
            <br>
    <input type="submit" value="SEND">

    <br>
    <br>
    <br>

    
    </form>
    <?php
        if(isset($_SESSION["faculty_id"])) {
            echo "<form action='dashboard_faculty.php'>
            <input type='submit' value='BACK'>
           </form>";
        } else {
            echo "<form action='dashboard_student.php'>
            <input type='submit' value='BACK'>
            </form>";
        }

        
    ?>
    
    </body>
</html>