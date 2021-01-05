<?php

    require("dbconn.php");
    $db = new ComplaintsSystemDB();
    session_start();

    // $all_db = $db->show_db();
    // $db->print_all($all_db);

    // $user_id = $db->student_login('christina_ncp', 'efgh');
    // echo $user_id;

    // 
    if(isset($_SESSION["faculty_id"])) {
        header("Location: dashboard_faculty.php");
    } else if (isset($_SESSION["student_id"])) {
        header("Location: dashboard_student.php");
    } else {
        // header("Location: index.php");
    }


?>

<!DOCTYPE html>
<html>
    <body>
        <div>
            <h2>Faculty Login</h2>
            <form method="POST" action="validate_login.php">
                Username: <input type="text" name="faculty_username" value=""><br>
                Password : <input type="password" name="faculty_password" value=""><br>            
                <input type="submit" value="LOGIN">
            
            </form> 
        </div>

        <div>
            <h2>Student Login</h2>
            <form method="POST" action="validate_login.php">
                Username: <input type="text" name="student_username" value=""><br>
                Password : <input type="password" name="student_password" value=""><br>            
                <input type="submit" value="LOGIN">
            
            </form> 
        </div>

    
    </body>
</html>