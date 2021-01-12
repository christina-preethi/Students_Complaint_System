<?php
    require("dbconn.php");
    $db = new ComplaintsSystemDB();
    session_start();

    if(isset( $_SESSION["student_id"])) {
        echo"<h3>Student details</h3>";
        $student_details = $db->student_details($_SESSION["student_id"]);
        echo '<table border="2">';
        echo '<tr>';
        echo '<th>Reg_no.</th>';
        echo '<th>Name</th>';
        echo '<th>Dept.</th>';
        echo '<th>Year</th>';
        echo '<th>Section</th>';
        echo '<th>user_id</th>';
        echo '</tr>';
           
        if (mysqli_num_rows($student_details) >= 1) 
        {
            $row_count_details=mysqli_num_rows($student_details);
            for($x=0;$x<$row_count_details;$x++)
            {
                $row_details=mysqli_fetch_assoc($student_details);
                echo '<tr>';
                echo '<td>'.$row_details['reg_no'].'</td>';
                echo '<td>'.$row_details['name'].'</td>';
                echo '<td>'.$row_details['dept'].'</td>';
                echo '<td>'.$row_details['year'].'</td>';
                echo '<td>'.$row_details['section'].'</td>';
                echo '<td>'.$row_details['user_id'].'</td>';
                echo '</tr>';
                echo "</table>";
          

            }
           // $db->print_all($student_details);
           
           
        }
        echo "<br>";
        echo "<hr>";

        echo "<h4>Tickets sent</h4>";
        $tickets = $db->tickets_sent_students($_SESSION["student_id"]);
        if (mysqli_num_rows($tickets) >= 1) {
            // $db->print_all($tickets);
            $rowcount=mysqli_num_rows($tickets);
            echo "<table border='2'>";
            echo '<tr>';
           // echo '<th>Ticket no.</th>';
            echo '<th>Title</th>';
            echo '<th>Body</th>';
            echo '<th>Date</th>';
            echo '<th>Severity</th>';
            echo '<th>Status</th>';
            echo '<th>Faculty Name</th>';
            echo '</tr>';
           // echo '</table>';
            for ($y = 0; $y < $rowcount ; $y++) 
            {
                $row = mysqli_fetch_assoc($tickets);
                $ticket_no = $row['ticket_no'];
                // echo $row["ticket_no"];
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
               // echo '<table border="2">';
                 echo '<tr>';
              //  echo '<td>'.$row['ticket_no'].'</td>';
                echo '<td>'.$row['title'].'</td>';
                echo '<td>'.$row['body'].'</td>';
                echo '<td>'.$row['date'].'</td>';
                echo '<td>'.$row['severity'].'</td>';
                echo '<td>'.$row['status'].'</td>';
                echo '<td>'.$row['faculty_name'].'</td>';
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
    }    
    else {
        header("Location: dashboard_faculty.php");
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

        <div>
            <form method="POST" action="insert_ticket.php">                        
                <input type="submit" value="NEW TICKET">
            </form>
        </div>

    </body>
</html>