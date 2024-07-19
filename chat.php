<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
<script>
    window.alert("your chat in GREEN color");
    </script>
<style>
    /* Your custom styles here */
   
    div {
        border: 2px solid black;
        border-radius: 2%; 
        height: 89vh;
        overflow-y: scroll;
        background-image: url("bg.jpeg");
        padding: 20px; /* Adjust padding as needed */
    }
    div li {
        width: 200px;
        height: auto;
        border-radius: 5px;
        border: 1px solid black;
        background-color: green;
        padding: 10px;
        color: white;
        margin-bottom: 20px;
        position: relative;
        margin-left: 10px;
    }
    div li span {
        position: absolute;
        right: 10px;
        bottom: 2px;
    }
    form {
        position: relative;
        bottom: 0%;
        width: 100%;
        padding: 10px; 
        display:inline-block;
    }
    form input {
        width: 94%;
        height: 50px;
        border-radius: 20px;
        font-size: 30px;
    }
  
    .btn{
        position:sticky;
        border-radius: 50%;
        width: 50px;
        height: 50px;
        border:2px solid black;
        text-align:center;
    }
    h2 {
        width: 100%;
        height: 50px; 
        background-color: lightgray;
        border-radius: 200px;
        text-align: center;
        position: absolute;
        top: 0;
    }
</style>
</head>
<body>

<div id="result" class="container-fluid">
    <!-- Your content here -->
</div>

<form id="myForm" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
    <input type="text"  placeholder="Enter your message" name="message" required>
    <button type="submit" class="btn ">send</button>
</form>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var form = document.getElementById('myForm');
    form.addEventListener('submit', function(e) {
        e.preventDefault();

        var formData = new FormData(form);
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'process.php', true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    document.getElementById('result').innerHTML = xhr.responseText;
                    form.reset(); // Reset form after successful submission
                } else {
                    console.error('Error: ' + xhr.status);
                }
            }
        };

        var id = 1;
        formData.append('id', id);

        xhr.send(formData);
    });
});
</script>

</body>
</html>
