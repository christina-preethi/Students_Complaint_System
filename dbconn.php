<?php
class ComplaintsSystemDB {
    public $conn = NULL;

    function __construct() {
        $servername = "localhost";
        $username = "root";
        $password = "christina@@";
        $dbname = "complaints_system";

        $this->conn = mysqli_connect($servername, $username, $password, $dbname);

        if (!$this->conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
    }

    function print_all($result) {
        while($row = mysqli_fetch_assoc($result)){
          foreach($row as $val) {
              echo "$val ";
          }
          echo "<br>";
        }
    }

    function show_db() {
        $query = "SHOW DATABASES";
        $complaints = mysqli_query($this->conn, $query);
        return $complaints;
    }

    function student_login($user_id, $password) {
        $query = "SELECT user_id FROM student WHERE user_id = '$user_id' AND password = '$password'";
        $user = mysqli_query($this->conn, $query);
        if (mysqli_num_rows($user) == 1) {
            $row = mysqli_fetch_assoc($user);
            return $row["user_id"];
        }
        return NULL;
    }

    function faculty_login($faculty_id, $password) {
        $query = "SELECT faculty_id FROM faculty WHERE faculty_id = '$faculty_id' AND password = '$password'";
        $user = mysqli_query($this->conn, $query);
        if (mysqli_num_rows($user) == 1) {
            $row = mysqli_fetch_assoc($user);
            return $row["faculty_id"];
        }
        return NULL;
    }

    function tickets_sent_students($user_id) {
        $query = "SELECT t.ticket_no, t.title, t.body, t.date, t.severity, t.status, f.faculty_name
                    FROM tickets t, student s, faculty f
                    WHERE t.reg_no = s.reg_no
                    AND t.faculty_id = f.faculty_id
                    AND s.user_id = '$user_id'
                    ORDER BY t.severity ";
        $tickets = mysqli_query($this->conn, $query);
        return $tickets;
    }

    function tickets_sent_faculty($faculty_id) {
        $query = "SELECT  s.name, t.title, t.body, t.date, t.severity, t.status
                    FROM tickets t, student s, faculty f
                    WHERE t.reg_no = s.reg_no
                    AND t.faculty_id = f.faculty_id
                    AND f.faculty_id = '$faculty_id'";
        $tickets = mysqli_query($this->conn, $query);
        return $tickets;
    }

    function tickets_received_faculty($faculty_id) {
        $query = "SELECT t.ticket_no, t.reg_no, s.name, t.title, t.body, t.date, t.severity, t.status
                    FROM tickets t, student s
                    WHERE t.reg_no = s.reg_no
                    AND t.faculty_id = '$faculty_id'
                    order by t.severity";
        $tickets = mysqli_query($this->conn, $query);
        return $tickets;
    }

    function get_faculty_id_name() {
        $faculty_id_query = "SELECT faculty_id, faculty_name from faculty";
        $faculty_id_name = mysqli_query($this->conn, $faculty_id_query);
       
        return $faculty_id_name;
    }


    function insert_ticket($student_id, $title, $body, $severity, $faculty_id, $status) {
        $reg_no_query = "SELECT s.reg_no 
                    FROM  student s
                    WHERE s.user_id = '$student_id'";

        $result = mysqli_query($this->conn, $reg_no_query);
        $row = mysqli_fetch_assoc($result);
        $reg_no = $row['reg_no'];

        $t=time();
        $ticket_no = $t;
        $ticket_no = (string)$ticket_no;

        $sev = number_format($severity);
        $query = "INSERT into tickets(ticket_no, reg_no, title, body, date, severity, faculty_id, status)
                    values ('$ticket_no','$reg_no','$title','$body', now() , $sev, '$faculty_id', '$status')" ;
        
        $ticket_info = mysqli_query($this->conn, $query);
        return $ticket_info;
    }

    function faculty_details($faculty_id) {
        $query = "SELECT faculty_id, faculty_name, yrs_experience, designation, qualification, dept
                    from faculty
                    where faculty_id = '$faculty_id'";
        $result = mysqli_query($this->conn, $query);
       
        return $result;
    }

    function student_details($user_id) {
        $query = "SELECT reg_no, name, dept, year, section, user_id from student
                where user_id = '$user_id'";
        $result = mysqli_query($this->conn, $query);
       
        return $result;
        
    }

    function ticket_details($ticket_no) {
        $query = "SELECT * from correspondence
                    where ticket_no = '$ticket_no'";
        
        $result = mysqli_query($this->conn, $query);
       
        return $result;

    }

    function ticket_correspondence($ticket_no) {
        $query = "SELECT * from tickets where ticket_no = '$ticket_no'";
        $result = mysqli_query($this->conn, $query);

        return $result;
    }

    function correspondence($ticket_no, $message, $student_id, $faculty_id) {
        $t=time();
        $correspondence_no = $t;
        $correspondence_no = (string)$correspondence_no;

        // $reg_no = 'NULL';
        if($student_id != '') {
            $reg_no_query = "SELECT s.reg_no 
                            from student s
                            where s.user_id = '$student_id'";
            $reg_no_result = mysqli_query($this->conn, $reg_no_query);
            $row = mysqli_fetch_assoc($reg_no_result);
            $reg_no = $row['reg_no'];
            $reg_no = "'$reg_no'";
            $faculty_id = 'NULL';
        } else {
            $faculty_id = "'$faculty_id'";
            $reg_no = 'NULL';
        }
        

        $query = "INSERT into correspondence values
            ('$correspondence_no', '$ticket_no', '$message', $reg_no, $faculty_id, now())";
        echo $query;
        $correspondence_info = mysqli_query($this->conn, $query);
        // echo $correspondence_info;
        return $correspondence_info;

    }

    function update_status($status, $ticket_no) {
        $query = "UPDATE tickets
        set status = '$status'
        where ticket_no = '$ticket_no'";

        $info = mysqli_query($this->conn, $query);
        return $info;
    
    }

    function __destruct() {
        mysqli_close($this->conn);
    }
}
?> 
