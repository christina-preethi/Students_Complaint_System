<?php
    require("dbconn.php");
    $db = new ComplaintsSystemDB();
    session_start();

?>

<!DOCTYPE html>
<html>
    <div>
        <form method="POST" action="insertion.php">
            <!-- Ticket No: <input type="text" name="ticket_id" value="" required><br> -->
            Title: <input type="text" rows="4" cols="2" name="title" value="" required><br>
            Body: <input type="text" rows="4" cols="2" name="body" value="" required><br>
            SEVERITY: <select name="severity" required>
                <option value='1'>1</option>
                <option value='2'>2</option>
                <option value='3'>3</option>
                <option value='4'>4</option>
                <option value='5'>5</option>
            </select>
            <br>
            <!-- Severity: <input type="text" name="severity" value="" required><br> -->
            <!-- Faculty Name: <input type="text" name="faculty_name" value=""><br> -->
            Faculty:
            <select name='faculty_id' required>
                <?php
                    $faculty_id_name = $db->get_faculty_id_name();
                    while($row = mysqli_fetch_assoc($faculty_id_name)) {
                        $faculty_id = $row['faculty_id'];
                        $faculty_name = $row['faculty_name'];
                        echo "<option value='$faculty_id'>$faculty_name</option>";
                    }
                ?>
            </select>
            <br>
            <!-- Status: <input type="text" name="status" value=""><br> -->
            Status:
            <select name='status' required> 
                    <option value='ASSIGNED'>ASSIGNED</option>
                    <option value='WIP'>WORK IN PROGRESS</option>
                    <option value='STUDENT_PENDING'>STUDENT PENDING</option>
                    <option value='FACULTY_PENDING'>FACULTY PENDING</option>
                    <option value='RESOLVED'>RESOLVED</option>
            </select>
            <br>
           
            <input type="submit" value="SEND">
        </form>
        
        <br> <br>
        <form action='dashboard_student.php'>
            <input type='submit' value='BACK'>
        </form>
    </div>
</html>

