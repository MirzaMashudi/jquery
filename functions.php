<?php
// koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "phpdasar");
function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}
function tambah($data)
{
    global $conn;
    $nama = htmlspecialchars($data["nama"]);
    $usia = htmlspecialchars($data["usia"]);
    $jurusan = htmlspecialchars($data["jurusan"]);

    // Upload gambar terlebih dahulu
    $gambar = upload();
    if (!$gambar) {
        return false;
    }


    $query = "INSERT INTO mahasiswa
                VALUE
                ('', '$nama', '$usia', '$jurusan', '$gambar')";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}
function delete($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM mahasiswa WHERE id=$id");
    return mysqli_affected_rows($conn);
}

function update($data)
{
    global $conn;
    $id = $data["id"];
    $nama = htmlspecialchars($data["nama"]);
    $usia = htmlspecialchars($data["usia"]);
    $jurusan = htmlspecialchars($data["jurusan"]);
    $gambar = htmlspecialchars($data["gambar"]);

    $query = "UPDATE mahasiswa SET
    nama = '$nama',
    usia = '$usia',
    jurusan = '$jurusan',
    gambar = '$gambar'
    WHERE id = $id
    ";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function cari($keyword)
{
    $query = "SELECT * FROM mahasiswa
            WHERE 
            nama LIKE '%$keyword%' OR
            usia LIKE '%$keyword%' OR
            jurusan LIKE '%$keyword%'
            ";
    return query($query);
}

function upload()
{
    return false;
}

function registrasi($data)
{
    global $conn;

    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);

    // cek apakah username sudah terdaftar
    $result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");

    if (mysqli_fetch_assoc($result)) {
        echo "<script>
        alert('Username sudah terdaftar')
        </script>";
        return false;
    }

    // cek konfirmasi password
    if ($password !== $password2) {
        echo "<script>
         alert('Konfirmasi password salah')
        </script>";
        return false;
    }

    // enskripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // tambahkan user ke database
    mysqli_query($conn, "INSERT INTO user VALUES('', '$username', '$password')");

    return mysqli_affected_rows($conn);
}
