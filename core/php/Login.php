<?php

/**
 * Created by PhpStorm.
 * User: Andre
 * Date: 07/02/2016
 * Time: 06:29 PM
 */
include "DataBaseManager.php";
require_once("Session.php");

// Check if username and password are set in $_POST
// if (!isset($_POST["username"]) || !isset($_POST["password"])) {
//     // Handle missing form data (e.g., echo error message)
//     die("Missing username or password");
//   }

$username = $_POST["username"];
$password = $_POST["password"];


$database = DataBaseManager::getInstance();
$query = "Select * FROM  usuario WHERE nombre = '$username' AND clave = '$password'";
$result = $database->realizeQuery($query);
verifyLogin($result, $username);

function verifyLogin($result, $username) {
    $message = null;
    $session = new session();

    if (count($result) > 0) {

        $user = array();

        $user['type'] = $result[0]['tipo'];
        $user['id'] = $result[0]['id'];

        $session->set("user", $username);
        $session->set("user", $result[0]['id']);
        $usersList[] = $user;

        echo json_encode($usersList);
        // return json_encode($usersList);
    } else {
        echo json_encode($message);
        // return json_encode($message);
    }
}

