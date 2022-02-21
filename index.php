<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

require 'functions.php';
$mahasiswa = query("SELECT * FROM mahasiswa");

// Cek apakah tombol cari ditekan atau belum
if (isset($_POST["cari"])) {
    $mahasiswa = cari($_POST["keyword"]);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman admin</title>
    <style>
        .loader {
            width: 100px;
            position: absolute;
            top: 103px;
            left: 200px;
            z-index: -1;
        }
    </style>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/script.js"></script>
</head>

<body>

    <a href="logout.php">Logout</a>

    <h1>Daftar Mahasiswa</h1>

    <a href="create.php">Tambah Data</a>
    <br><br>
    <form action="" method="post">
        <input type="text" name="keyword" sizeof="30" autofocus placeholder="Masukkan Keyword Pencarian.." autocomplete="off" id="keyword">
        <button type="submit" name="cari" id="tombol-cari">Cari</button>
        <img src="img/loader.gif" class="loader">
    </form>
    <br>
    <div id="container">
        <table border="1" cellpadding="10" cellspacing="0">
            <tr>
                <th>No.</th>
                <th>Aksi</th>
                <th>Nama</th>
                <th>Usia</th>
                <th>Jurusan</th>
                <th>Gambar</th>
            </tr>

            <?php $i = 1; ?>
            <?php foreach ($mahasiswa as $row) : ?>
                <tr>
                    <td><?= $i; ?></td>
                    <td>
                        <a href="update.php?id=<?= $row["id"]; ?>">Ubah</a> |
                        <a href="delete.php?id=<?= $row["id"]; ?>" onclick="return confirm('yakin?');">Hapus</a>
                    </td>
                    <td><?= $row["nama"]; ?></td>
                    <td><?= $row["usia"]; ?></td>
                    <td><?= $row["jurusan"]; ?></td>
                    <td>
                        <img src="img/<?= $row["gambar"]; ?>" width="50px">
                    </td>
                </tr>
                <?php $i++; ?>
            <?php endforeach; ?>
        </table>
    </div>
</body>

</html>