<?php

$test = mysqli_connect('localhost', 'root', 'root');
if (!$test) {
    die('MySQL Error: ' . mysqli_error());
}
echo 'Database connection is working properly!';
mysqli_close($testConnection);