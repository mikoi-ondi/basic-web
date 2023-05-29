<?php
require_once "/controller/User.php";


$user = new User();
if($_POST['action'] == 'login'){
    $user->loginUser($conn);
} elseif ($_POST['action'] == 'registration') {
    $user->regUser($conn);
} elseif ($_POST['action'] == 'feedback') {
    $user->feedback($conn);
}

?>