<?php
session_start();

spl_autoload_register(function() {
    require_once "../config/Functions.php";
});


if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $func = new Functions();
    $result = $func->login($username, $password);
    if($result["success"]) {
        $_SESSION['logged_in'] = $username;
        echo json_encode(array('success' => true));
    } else {
        echo json_encode(array('errors' => $result["fail"]));
    }
} else {
    header("Location: index.php", true, 302);
}