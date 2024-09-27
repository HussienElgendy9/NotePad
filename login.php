<?php
    session_start();
    if(isset($_SESSION['error_message'])){
        echo '<p style="color: red";>'.$_SESSION['error_message'].'</p>';
        unset($_SESSION['error_message']);
    }
    if(isset($_SESSION['success_message'])){
        echo '<p style="color: green";>'.$_SESSION['success_message'].'</p>';
        unset($_SESSION['success_message']);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <form action="actions/logging.php" method="post">
            <div class="form-group">
                <label for="">Email</label>
                <input name="email" type="email" value="" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="">Password</label>
                <input name="password" type="password" value="" class="form-control" required>
            </div>
            <button class="btn btn-success my-2">Log-In</button>
            <a class="btn btn-success my-2" href="notes.php">Sign Up</a>
        </form>
    </div>
</body>
</html>