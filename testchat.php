<?php
session_start();
$name="localhost";
$user="root";
$password="root";
$db="chatuser";


$conn=mysqli_connect($name,$user,$password,$db);


echo "<br>";
$nam=$_POST['name'];
$cod=$_POST['code'];
$_SESSION['gone']=$cod;

$sql="insert into userlist(name,code) values( '$nam','$cod');";
$xx=mysqli_query($conn,$sql);
if($xx){
    
    $chat="create  table $cod(id int(1) ,data varchar(40) , time varchar(10));";
    $x=mysqli_query($conn,$chat);
    if($x){
        
        header("Location: chat.php");
    }

}



?>
<br>
<br>
<style>.container{
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);

}


</style> <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
</head><body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mt-5 ml-5">
            <div class="form-group border rounded p-8 shadow-sm">
                <!-- Your form elements go here -->
<form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>  class="form-group" method="POST">
<h2 style="color:green;" >create new chat </h2>
<input type="text" placeholder="name"  name="name" required class="col-sm-4  form-control">
<br>
<br>
<input type="text" placeholder="group code"  name="code" required class="col-sm-4 form-control">
<br>
<BR>
<button class="btn" type="submit">Create Chat</button>
<a class="btn" href="index.html">cancel</a>

</form>
</div>
</div>
    </div>
</div>
</body>
</html>