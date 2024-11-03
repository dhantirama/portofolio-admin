<?php 
$host = '127.0.0.1';
$username = 'root';
$password = '';
$db_name = 'admin_db';

$conn = mysqli_connect($host, $username, $password, $db_name);

if (!$conn) {
    echo "Koneksi Gagal";
}

?>