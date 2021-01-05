<?php
    require("dbconn.php");
    $db = new ComplaintsSystemDB();
    session_start();
    
    if (isset($_SESSION["faculty_id"])) {
        echo "<h3>Faculty details</h3>";
        $faculty_details = $db->faculty_details($_SESSION["faculty_id"]);
        echo '<table border="2">';
           echo '<tr>';
           echo '<th>faculty_id</th>';
           echo '<th>faculty_name</th>';
           echo '<th>yrs_experience</th>';
           echo '<th>designation</th>';
           echo '<th>qualification</th>';
           echo '<th>dept</th>';
           echo '</tr>';
    }
        
        if (mysqli_num_rows($faculty_details) >= 1) 
        {
            //$db->print_all($faculty_details);
            $row_count_details=mysqli_num_rows($faculty_details);
            for($x=0;$x<$row_count_details;$x++)
            {
                $row_details=mysqli_fetch_assoc($faculty_details);
                echo '<tr>';
                echo '<td>'.$row_details['faculty_id'].'</td>';
           echo '<td>'.$row_details['faculty_name'].'</td>';
           echo '<td>'.$row_details['yrs_experience'].'</td>';
           echo '<td>'.$row_details['designation'].'</td>';
           echo '<td>'.$row_details['qualification'].'</td>';
           echo '<td>'.$row_details['dept'].'</td>';
           echo '</tr>';
           echo "</table>";
          

        }
        echo "<br>";
        echo "<hr>";

        echo "<h4>Tickets received</h4>";
        $tickets = $db->tickets_received_faculty($_SESSION["faculty_id"]);
        if (mysqli_num_rows($tickets) >= 1) {
            // $db->print_all($tickets);
            $rowcount=mysqli_num_rows($tickets);
            echo "<table border='2'>";
            echo '<tr>';
            echo '<th>Reg no.</th>';
            echo '<th>Name</th>';
            echo '<th>Title</th>';
            echo '<th>Body</th>';
            echo '<th>Date</th>';
            echo '<th>Severity</th>';
            echo '<th>Status</th>';
            echo '</tr>';
            
            for ($y = 0; $y < $rowcount ; $y++) {
                $row = mysqli_fetch_assoc($tickets);
                $ticket_no = $row['ticket_no'];
                // echo $row["ticket_no"];
                // echo " "; 
                // echo $row['reg_no'];
                // echo " ";  
                // echo $row['name'];
                // echo " ";
                // echo $row['title'];
                // echo " ";
                // echo $row['body'];
                // echo " ";
                // echo $row['date'];
                // echo " ";
                // echo $row['severity'];
                // echo " ";
                // echo $row['status'];
                echo '<tr>';
                //echo '<td>'.$row['ticket_no'].'</td>';
                echo '<td>'.$row['reg_no'].'</td>';
                echo '<td>'.$row['name'].'</td>';
                echo '<td>'.$row['title'].'</td>';
                echo '<td>'.$row['body'].'</td>';
                echo '<td>'.$row['date'].'</td>';
                echo '<td>'.$row['severity'].'</td>';
                echo '<td>'.$row['status'].'</td>';
                
                
                echo '<td>'.
                    "<form method='POST' action='ticket_no.php'>
                        <input type='hidden' name='selected_ticket' value='$ticket_no'>
                        <input type='submit' value='more...'>
                    </form>".'</td>';
                echo "<br>";
                echo '</tr>';
                
            }
            echo '</table>';
            

        } else {
            echo "<p>No tickets</p>";
        }
    } else {
        header("Location: dashboard_student.php");
    }

?>

<!DOCTYPE html>
<html>
    <body>
        <div>
            <form method="POST" action="logout.php">                        
                <input type="submit" value="LOGOUT">
            </form>
        </div>

        <!-- <div>
            <form method="POST" action="ticket_details.php">                        
                <input type="submit" value="TICKET INFO">
            </form>
        </div> -->

    </body>
</html>