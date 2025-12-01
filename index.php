<!DOCTYPE html>
<?php 
include "koneksi.php";

$num = 1;

$sql = "SELECT * FROM USERS LEFT JOIN MAHASISWA ON USERS.id_user = MAHASISWA.id_mahasiswa";
$result = $conn->query($sql);
?>

<html lang="id">
    <head>
        <link rel="stylesheet" href="style.css">
        <title>Belajar PHP</title>
    </head>
    <body>
        <h1>Halaman Utama</h1>
        <a href="tambah.php" class="button btn_tambah font_tambah">Tambah Data Mahasiswa</a>
        <table>
            <tr>
                <th>NO</th>
                <th>NIM</th>
                <th>Nama Mahasiswa</th>
                <th>Alamat</th>
                <th>Jurusan</th>
                <th>Umur</th>
                <th>Aksi</th>
            </tr>
            <?php if (mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_assoc($result)) {
            ?>
            <tr>
                <td><?php echo $num++?></td>
                <td><?php echo $row['nim']?></td>
                <td><?php echo $row['nama'] ?></td>
                <td><?php echo $row['alamat'] ?></td>
                <td><?php echo $row['jurusan']?></td>
                <td><?php echo $row['umur']?> Tahun</td>
                <td>
                    <a href="tambah_jurusan.php?id=<?php echo $row["id_user"] ?>" class="button btn_ubah">TAMBAH JURUSAN</a>
                    <a href="ubah.php?id=<?php echo $row["id_user"] ?>" class="button btn_ubah">UBAH DATA</a>
                    <a href="hapus.php?id=<?php echo $row["id_user"]?>" onclick="return confirm ('Apakah anda ingin menghapus data ini?')" class="button btn_hapus">HAPUS</a>
                </td>
            </tr>
            <?php 
             }
        }?>
        </table>
    </body>
</html>