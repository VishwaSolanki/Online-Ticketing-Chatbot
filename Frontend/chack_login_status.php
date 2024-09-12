<?php
session_start();

$response = array('loggedIn' => isset($_SESSION['username']));

echo json_encode($response);
?>
