<?php
$host = 'db'; // JANGAN localhost!
$user = 'root';
$pass = 'root';
$dbname = 'smartfarm';

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
