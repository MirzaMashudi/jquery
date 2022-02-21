<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

require 'functions.php';

// Ambil data dari URL
$id = $_GET["id"];

// Query mahasiswa berdasarkan ID
$mhs = query("SELECT * FROM mahasiswa WHERE id=$id")[0];

// cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])) {
    // cek apakah data berhasil ditambahkan atau tidak
    if (update($_POST) > 0) {
        echo "
        <script>
            alert('Data Berhasil diubah!'),
            document.location.href= 'index.php';
        </script>
        ";
    } else {
        echo "
        <script>
            alert('Data Gagal diubah!'),
            document.location.href= 'index.php';
        </script>
        ";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Data</title>
</head>

<body>
    <h1>Update Data</h1>

    <form action="" method="post">
        <input type="hidden" name="id" value="<?= $mhs["id"] ?>"></input>
        <ul>
            <li>
                <label for="nama">Nama : </label>
                <input type="text" name="nama" id="nama" required value="<?= $mhs["nama"]; ?>">
            </li>
            <li>
                <label for="usia">Usia : </label>
                <input type="text" name="usia" id="usia" required value="<?= $mhs["usia"]; ?>">
            </li>
            <li>
                <label for="jurusan">Jurusan : </label>
                <input type="text" name="jurusan" id="jurusan" required value="<?= $mhs["jurusan"]; ?>">
            </li>
            <li>
                <label for="gambar">Gambar : </label>
                <input type="text" name="gambar" id="gambar" required value="<?= $mhs["gambar"]; ?>"></input>
            </li>
            <button type="submit" name="submit">Update Data</button>
        </ul>

    </form>
</body>

</html>