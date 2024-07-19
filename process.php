<?php
session_start();

$name = "localhost";
$user = "root";
$password = "root";
$db = "chatuser";

$conn = mysqli_connect($name, $user, $password, $db);


if (isset($_SESSION['gone'])) {
    $hlo = $_SESSION['gone'];


    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['message'])&& isset($_POST['id'])) {
        $data = $_POST['message'];
        $time = date('i:s');
        $id=$_POST['id'];

      
        $sql = "INSERT INTO $hlo (id,data, time) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'sss',$id, $data, $time);

        if (mysqli_stmt_execute($stmt)) {
            $sql_delete = "SELECT * FROM $hlo ORDER BY time DESC LIMIT 8";
            $sqlime=mysqli_query($conn, $sql_delete);
            if ( $sqlime && mysqli_num_rows($sqlime)>0) {
               
                while(  $row = mysqli_fetch_assoc($sqlime)){
                    $rows[] = $row;}
                    for ($i = count($rows) - 1; $i >= 0; $i--) {
                        $row = $rows[$i];

            $data = $row['data']; 
            $time=$row['time'];
            $id=$row["id"];
            if($id!=1){
                $color = "white"; 
                $colortime="yellow";
                $bgcolor='	#002600';
               echo "<li  type='none' style='color: $color; font-size: 16px; background-color:$bgcolor'>$data";
                   echo "<span  style='color: $colortime; font-size: 12px;'>$time</span></li>";
                        
                         }
            else{
                $color = "white"; 
                         $colortime="black";
                        echo "<li  type='none' style='color: $color; font-size: 16px;'>$data";
                            echo "<span  style='color: $colortime; font-size: 12px;'>$time</span></li>";
            }

            }
            } else {
                echo "Error deleting row: " . mysqli_error($conn);
            }
        } else {
            echo "Error: No message received.";
        }
    } else {
        echo "Error: Session variable 'gone' not set.";
    }
        } else {
            echo "Error inserting message: " . mysqli_error($conn);
        }

        mysqli_stmt_close($stmt);



mysqli_close($conn);
?>
