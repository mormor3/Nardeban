<?php
$to = "m.ranjbar3@rayana.ir";
$subject = "My subject";
$txt = "Hello world!";
$headers = "From: mostafa.ranjbar3@gmail.com" . "\r\n";

mail($to,$subject,$txt,$headers);
echo 'OK';
?>