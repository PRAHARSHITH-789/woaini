<?php
session_start();
$name = "localhost";
$user = "root";
$password = "root";
$db = "chatuser";

$conn = mysqli_connect($name, $user, $password, $db);


// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input
    $nam = isset($_POST['name']) ? mysqli_real_escape_string($conn, $_POST['name']) : '';
    $cod = isset($_POST['code']) ? mysqli_real_escape_string($conn, $_POST['code']) : '';

    // Perform query only if $nam and $cod are not empty
    if (!empty($nam) && !empty($cod)) {
        $sql = "SELECT code FROM userlist WHERE code = '$cod'";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $code = $row['code'];

                // Check if codes match
                if ($code == $cod) {
                    // Redirect to chat.php if code matches
                    header("Location: chat1.php");
                    exit; // Make sure to stop further execution after redirection
                } else {
                    echo "Sorry, incorrect group code.";
                }
            } else {
                echo "No data found for the entered group code.";
            }
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } 
}
?>

<!-- Form HTML -->
<br><br>
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<style>
 
 
.container{
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);

}
    
    </style>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 mt-5">
            <div class="form-group border rounded p-8 shadow-sm">
                <!-- Your form elements go here -->
            
            <form  class="form-group " action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                
              <h2 style="color:red"> * if the chat is created </h2>
             <input type="text" placeholder="name"  name="name" required class="col-sm-4  form-control"><br><br>
              <input type="text" placeholder="group code" name="code" required  class="col-sm-4  form-control"><br><br>
             <button class='btn' type="submit" > join chat</button>
               <a class="btn" href="index.html">cancel</a>
             </form>
         </div>
      
    </div>
</div>
</body>
</html>