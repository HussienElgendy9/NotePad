<?php
session_start();
require 'classes/SaveNote.php';
include 'include/header.php';

if($_SERVER['REQUEST_METHOD']=='POST'){
    $note = new SaveNote();
    $note -> save($_SESSION['id'],$_POST['notetitle'],$_POST['description']);
}
if(!isset($_SESSION['id'])){
    header("Location:login.php");
}


?>
<h1>Notepad</h1>
<h3>Title</h3>
<?php
echo '<form action="actions/loggingOut.php" method="post">
<input type="hidden" name="id" value="' . htmlspecialchars($_SESSION['id']) . '">
<button type="submit" class="btn btn-danger">Log-Out</button>
</form>';
?>
<div class="container">
        <form method="post" action="">
            <div class="form-group">
                <label for="">Title</label>
                <input name="notetitle" type="text" value="" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="">Description</label>
                <input name="description" type="text" value="" class="form-control" aria-rowspan="5" required>
            <button class="btn btn-success my-2">Save</button>
            <a class="btn btn-success my-2" href="notes.php">Your Notes</a>
        </form>

    </div>