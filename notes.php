<?php
session_start();
require 'classes/GetNotes.php';
require 'classes/Update.php';
include 'include/header.php';
$notes = new GetNotes();
$notes=$notes->display($_SESSION['id']);


if($_SERVER['REQUEST_METHOD']=='POST'){
    $update = new Update();
    $update -> EditUser($_POST['id'],$_POST['name'],$_POST['description']);
    header("Location:notes.php");
}

// echo '<pre>';
// var_dump($notes);
// echo'</pre>';
if(!isset($_SESSION['id'])){
    header("Location:login.php");
}
echo '<form action="actions/loggingOut.php" method="post">
            <input type="hidden" name="id" value="' . htmlspecialchars($_SESSION['id']) . '">
            <button type="submit" class="btn btn-danger">Log-Out</button>
        </form>';

foreach($notes as $note){
    echo '
    <div class="container mt-5">
        <h2>User Information</h2>
        <form action="" method="post">
            <input type="hidden" name="id" value="' . htmlspecialchars($note['id']) . '">
            <div class="form-group">
            <label for="name">Name</label>
            <input name="name" type="text" class="form-control" value="' . htmlspecialchars($note['name']) . '" required>
            </div>
            <div class="form-group">
            <label for="description">Description</label>
            <input name="description" type="text" class="form-control" id="email" value="' . htmlspecialchars($note['description']) . '" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        <form action="delete.php" method="post">
            <input type="hidden" name="id" value="' . htmlspecialchars($note['id']) . '">
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
        
    </div>';
}
    // echo $note['description'];