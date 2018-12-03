<?php 
$message = Session::get('message');
if($message){
    echo "<p class='alert alert-success'>" . $message . "</p>";
    Session::put('message', null);
}
?>