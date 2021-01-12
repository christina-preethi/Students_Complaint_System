<?php
    require("dbconn.php");
    $db = new ComplaintsSystemDB();
    session_start();

    $ticket = $db->ticket_correspondence($_SESSION['ticket_no']);

    if (mysqli_num_rows($ticket) >= 1) {
    // $db->print_all($ticket);
        echo "<table border='4'>";
        $rowcount_correspondence=mysqli_num_rows($ticket);
        for ($y = 0; $y < $rowcount_correspondence ; $y++) {
            $row = mysqli_fetch_assoc($ticket);
            echo '<tr>';
            echo '<td>'."<b>Title:</b>".'</td>';
            echo '<td>'.$row['title'].'</td>';
            // echo $row['title'];
            echo '</tr>';
            echo '<tr>';
            // echo "<br>";
            echo '<td>'."<b>Body:</b>".'</td>';
            echo '<td>'.$row['body'].'</td>';
            // echo "<br>";
            echo '</tr>';
            echo '<tr>';
            echo '<td>'."<b>Date:</b>".'</td>';
            echo '<td>'.$row['date'].'</td>';
            // echo "<br>";
            echo '</tr>';
            echo '<tr>';
            echo '<td>'."<b>Severity:</b>".'</td>';
            echo '<td>'.$row['severity'].'</td>';
            // echo "<br>";
            echo '</tr>';
            echo '<tr>';
            echo '<td>'."<b>Status:</b>".'</td>';
            echo '<td>'.$row['status'].'</td>';
            // echo "<br>";
            echo '</tr>';
        }
        echo "</table>";
    }

    echo "<br>";
    echo "<h4>DISCUSSION</h4>";
    $ticket_info = $db->ticket_details($_SESSION['ticket_no']);
    if (mysqli_num_rows($ticket_info) >= 1) {
        echo "<table border='2'>";
        echo "<tr>";
        echo '<th>ID No</th>';
        echo '<th>Message</th>';
        echo '<th>Date</th>';
        echo "</tr>";
        $rowcount=mysqli_num_rows($ticket_info);
        for ($y = 0; $y < $rowcount ; $y++) {
            $row = mysqli_fetch_assoc($ticket_info);
            echo '<tr>';
            echo '<td>'.$row['faculty_id'];
            echo $row['reg_no'].'</td>';
            // echo " ";
            echo '<td>'.$row['messgae'].'</td>';
            // echo " ";
            echo '<td>'.$row['date'].'</td>';
            // echo "<br>";
            echo '</tr>';
        }
        echo "</table>";
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