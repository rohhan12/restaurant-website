<?php

define('DBHOST', 'localhost');
define('DBUSER', 'your_username');
define('DBPASS', 'your_password');
define('DBNAME', 'your_database_name');

try {
    $string = "mysql:host=" . DBHOST . ";dbname=" . DBNAME;
    $user = DBUSER;
    $pass = DBPASS;

    $pdo = new PDO($string, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e) {

    die("Connection failed: " . $e->getMessage());

}

session_start();

function is_admin() {
    return isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;
}

?>