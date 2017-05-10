<?php

$mysqli = new mysqli('localhost', 'admin_test_123', '123123123', 'eremenkov');
if (mysqli_connect_errno()) {
    printf("cant connect to MySQL Error: %s\n", mysqli_connect_error());
    exit;
}

?>