<?php
$host = "db:3306";
$username = "root";
$password = "root";
$dbname = "mydatabase";

$conn = new mysqli($host, $username, $password, $dbname);
define('conn', $conn);

if (@conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function Execute($sql) {
    $result = @conn->query($sql);
    
    return $result;
}

function Query($sql) {
    $result = @conn->query($sql);

    if ($result->num_rows > 0) {
        return $result->fetch_all(MYSQLI_ASSOC);
    } else {
        return [];
    }
}

?>