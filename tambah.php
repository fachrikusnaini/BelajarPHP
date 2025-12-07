<!DOCTYPE html>
<?php 
include "koneksi.php";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = htmlspecialchars(trim($_POST["nama"]));
    $umur = htmlspecialchars(trim($_POST["umur"]));
    $alamat = htmlspecialchars(trim($_POST["alamat"]));

    if (empty($nama)){
        echo "Nama tidak boleh kosong. ";
    } elseif (!preg_match("/^[a-zA-Z ]*$/", $nama)) {
        echo "Nama hanya boleh terdiri dari huruf dan spasi. ";
    } elseif (strlen($nama) < 3 || strlen ($nama) > 70) {
        echo "Panjang nama harus antara 3 dan 70 karakter. ";
    } elseif (empty($umur)) {
        echo "Umur tidak boleh kosong. ";
    } elseif (!ctype_digit($umur) || $umur < 17 || $umur > 60) {
        echo "Umur hanya boleh angka dan minimal 17 - 60 tahun. ";
    }elseif (empty($alamat)) {
        echo "Alamat tidak boleh kosong. ";
    } elseif (strlen($alamat < 3 || strlen($alamat) > 100)) {
        echo "Panjang karakter alamat hanya 3 - 100. ";
    } else {
        $data = "INSERT INTO users (nama, umur, alamat) VALUES ('$nama','$umur','$alamat')";
        $result = mysqli_query($conn, $data);

        if ($result > 0) {
            echo 
            '<script>
            window.alert("Data user berhasil ditambahkan");
            window.location.href = "index.php";
            </script>';       
            } else {
            echo 
            '<script>
            window.alert("Data user gagal ditambahkan");
            window.location.href = "index.php";
            </script>';
        }
    }
}  
?>

<html lang="id">
    <head>
        <link rel="stylesheet" href="style.css">
        <title>Belajar PHP</title>
    </head>
    <body>
        <h3>Tambah Data Mahasiswa</h3>
        <form method="POST" action="">
            <label for="nama">Nama Lengkap:</label>
            <input type="text" id="nama" name="nama">
            <label for="umur">Umur:</label>
            <input type="text" id="umur" name="umur">
            <label for="alamat">Alamat:</label>
            <textarea name="alamat" id="alamat"></textarea>
            <button type="submit" class='btn-submit' name="submit">Tambah Data</button>
        </form>
    </body>
</html>
