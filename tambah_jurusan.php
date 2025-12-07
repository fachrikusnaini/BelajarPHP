<!DOCTYPE html>
<?php 
include "koneksi.php";

$id = $_GET["id"];

$sql = "SELECT * FROM USERS LEFT JOIN MAHASISWA ON USERS.id_user = MAHASISWA.id_mahasiswa WHERE id_user = $id";
$result = $conn->query($sql);
//$row = mysqli_fetch_assoc($result);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id_mahasiswa = $_POST['id_mahasiswa'];
    $nim = htmlspecialchars(trim($_POST["nim"]));
    $jurusan = htmlspecialchars(trim($_POST["jurusan"]));

    if(empty($nim)) {
        echo '<script>
        window.alert("NIM Tidak boleh kosong. ");
        </script>';
    }elseif (!ctype_digit($nim)) {
        echo '<script>
        window.alert("NIM harus Angka. ");
        </script>';
    }elseif (strlen($nim) != 10) {
        echo '<script>
        window.alert("NIM harus 10digit. ");
        </script>';
    }elseif (empty($jurusan)) {
        echo '<script>
        window.alert("Jurusan tidak boleh kosong. ");
        </script>';
    }elseif (!preg_match("/^[a-zA-Z ]*$/", $jurusan)){
        echo '<script>
        window.alert("Jurusan hanya boleh terdiri dari huruf dan spasi. ");
        </script>';
    }else {
        $check = mysqli_query($conn, "SELECT * FROM MAHASISWA WHERE NIM ='$nim'");
        $checkrow = mysqli_num_rows($check);

        if ($checkrow > 0) {
            echo '<script>
            window.alert("NIM sudah ada atau terdaftar. ");
            </script>';
        } else {
            $data = "INSERT INTO MAHASISWA (id_mahasiswa, nim, jurusan) VALUES ('$id_mahasiswa', '$nim', '$jurusan')";
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

}
?>

<html lang="id">
    <head>
        <link rel="stylesheet" href="style.css">
        <title>Belajar PHP</title>
    </head>
    <body>
        <h3>Tambah Data Jurusan dan NIM</h3>
        <form method="POST" action="">
            <?php if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <input type="hidden" id="id_mahasiswa" name="id_mahasiswa" value="<?php echo $row['id_user']; ?>">
            <input type="text" id="nama" name="nama" class ="color-disable" readonly value="<?php echo $row['nama'];?>">
            <input type="text" id="umur" name="umur" class ="color-disable" readonly value="<?php echo $row['umur'], ' Tahun';?>">
            <input type="text" id="alamat" name="alamat" class ="color-disable" readonly value="<?php echo $row['alamat'];?>">
            <label for="nim">NIM:</label>
            <input type="text" id="nim" name="nim">
            <label for="jurusan">Jurusan:</label>
            <input type="text" id="jurusan" name="jurusan"> 
            <button type="submit" class='btn-submit' name="submit">Tambah Data</button>  
            <?php 
                }
            }
            ?>
        </form>
    </body>
</html>
