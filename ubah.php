<!DOCTYPE html>
<?php 
include "koneksi.php";

$id = $_GET["id"];

$sql = "SELECT * FROM USERS LEFT JOIN MAHASISWA ON USERS.id_user = MAHASISWA.id_mahasiswa WHERE id_user = $id";
$result = $conn->query($sql);
//$row = mysqli_fetch_assoc($result);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id_mahasiswa = $_POST['id_mahasiswa'];
    $nama = htmlspecialchars(trim($_POST["nama"]));
    $alamat = htmlspecialchars(trim($_POST["alamat"]));
    $umur = htmlspecialchars(trim($_POST["umur"]));
    //$nim = htmlspecialchars(trim($_POST["nim"]));
    $jurusan = htmlspecialchars(trim($_POST["jurusan"]));

    if (empty($nama)) {
        echo "Nama tidak boleh kosong. ";
    }elseif (!preg_match("/^[a-zA-Z ]*$/", $nama)) {
        echo "Nama hanya boleh terdiri dari huruf dan spasi. ";
    }elseif (strlen($nama) < 3 || strlen($nama) > 70) {
        echo "Panjang nama harus antara 3 sampai 50 karakter. ";
    }elseif (empty($alamat)) {
        echo "Alamat tidak boleh kosong. ";
    } elseif (strlen($nama) < 3 || strlen($nama) > 100) {
        echo "Panjang Alamat harus antara 3 sampai 100 karakter. ";
    }elseif (empty($umur)) {
        echo "Umur tidak boleh kosong. ";
    }elseif (!ctype_digit($umur)) {
        echo "Umur harus hanya berisi Angka. ";
    }elseif (empty($jurusan)) {
        echo "Jurusan tidak boleh kosong. ";
    }elseif (!preg_match("/^[a-zA-Z ]*$/", $jurusan)) {
        echo "Jurusan hanya boleh terdiri dari huruf dan spasi. ";
    } else {
        $data = "UPDATE USERS u 
        JOIN MAHASISWA m ON (m.id_mahasiswa = u.id_user)
        SET u.nama ='$nama',
        u.alamat='$alamat',
        u.umur='$umur',
        m.jurusan='$jurusan'
        WHERE u.id_user = '$id_mahasiswa'";
        $update_data = mysqli_query($conn, $data);

        if ($update_data > 0) {
            echo 
            '<script>
            window.alert("Data berhasil diubah");
            window.location.href = "index.php";
            </script>';  
        } else {
            echo 
            '<script>
            window.alert("Data berhasil diubah");
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
        <h3>Ubah Data</h3>
        <form method="POST" action="">
            <?php if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <input type="hidden" id="id_mahasiswa" name="id_mahasiswa" readonly value="<?php echo $row['id_user']; ?>">
            <label>NIM</label><br>
            <input type="text" id="nim" name="nim" readonly value="<?php echo $row['nim'];?>"><br>
            <label>Nama Lengkap:</label><br>
            <input type="text" id="nama" name="nama" value="<?php echo $row['nama'];?>"><br>
            <label>Umur:</label><br>
            <input type="text" id="umur" name="umur" value="<?php echo $row['umur'];?>"><br>
            <label>Alamat:</label><br>
            <textarea id="alamat" name="alamat"><?php echo $row['alamat']; ?></textarea><br>
            <label>Jurusan:</label><br>
            <input type="text" id="jurusan" name="jurusan" value="<?php echo $row['jurusan'];?>"><br><br><br>
            <button type="submit" name="submit">Tambah Data</button>
            
            <?php 
                }
            }
            ?>
        </form>
    </body>
</html>
