<?php

require '../functions.php';

$keyword = $_GET["keyword"];

$query = "SELECT * FROM mahasiswa
            WHERE 
            nama LIKE '%$keyword%' OR
            usia LIKE '%$keyword%' OR
            jurusan LIKE '%$keyword%'
            ";
$mahasiswa = query($query);
?>

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