<?php

 // $_GET["BERICHT"] = "script code";
 if ( isset ( $_GET["BERICHT"] ) )
 echo $_GET["BERICHT"];

 if (isset($_POST['injection'])) {

    $query = 'SELECT * FROM Users WHERE Name =' . $_POST['injection'];

    echo $query;
 }
?>

<form action="" method="Post">
    <label for="injection"></label>
    <input type="text" name="injection" id="injection">
</form>