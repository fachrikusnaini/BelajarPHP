<?php 
$servername = "localhost";
$username = "root";
$password = "";
$database = "belajar_php";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}


function query ($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $row[s] = $row;
    }
    return $rows;
}
?>
