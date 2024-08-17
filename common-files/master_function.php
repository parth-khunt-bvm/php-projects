<?php 
session_start();
/**
 * Sanitize input data to prevent common security vulnerabilities.
 *
 * This function takes a string input, removes unnecessary characters, 
 * and converts special characters to HTML entities to prevent 
 * code injection attacks.
 *
 * @param string $data The input data to be sanitized.
 * @return string The sanitized input data.
 */
function cleartext($data) {
    // Remove whitespace from both ends of the string
    $data = trim($data);

    // Remove backslashes from the string
    $data = stripslashes($data);

    // Convert special characters to HTML entities
    $data = htmlspecialchars($data);

    // Return the sanitized string
    return $data;
}

function checklogin(){
    if(!isset($_SESSION["userid"]) || !isset($_SESSION["email"]) || $_SESSION["sessionid"] != 'phpproject'){
        return false;
    } else {
        return true;
    } 
}

?>