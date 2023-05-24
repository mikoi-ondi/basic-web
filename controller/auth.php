<?php
require_once "../User.php";

$user = new User();
if($_POST['action'] == 'login'){
    $user->loginUser($conn);
} elseif ($_POST['action'] == 'registration') {
    $user->regUser($conn);
}

?>