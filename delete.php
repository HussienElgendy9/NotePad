<?php

require 'classes/Delete.php';
echo $_POST['id'];
$deleted = new Delete(); 
$deleted = $deleted->deleteRecord($_POST['id']);
header('Location:notes.php');