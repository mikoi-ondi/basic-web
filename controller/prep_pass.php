<?php
function prep_pass($value) {
    $value = trim($value); 
    $value = stripslashes($value); 
    $value = htmlspecialchars($value); 
    return $value;
}