<?php 
include "koneksi.php";

$id = $_GET["id"];

//var_dump($id);

$row = mysqli_query($conn, "DELETE FROM users WHERE id_user = $id");

if ($row > 0) {
    echo 
    '<script>
    window.alert("Data berhasil dihapus");
    window.location.href = "index.php";
    </script>';
} else {
    echo 
    '<script>
    window.alert("Data berhasil dihapus");
    window.location.href = "index.php";
    </script>';
}


?>