<?php
session_start();
$con = mysqli_connect("localhost", "root", "", "belajar_album");


function tampilData($query)
{
    global $con;
    $data = mysqli_query($con, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($data)) {
        $rows[] = $row;
    }

    return $rows;
}



function _login($data)
{
    global $con;

    $username = $data['username'];
    $password = $data['password'];

    $query = ("SELECT * FROM tbl_user WHERE username = '$username' ");
    $hasil = mysqli_query($con, $query);
    $cek = mysqli_num_rows($hasil);

    if ($cek > 0) {
        $row = mysqli_fetch_assoc($hasil);
        $hashPassword = $row['password'];

        if (password_verify($password, $hashPassword)) {
            $_SESSION['userId'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

function _register($data)
{
    global $con;

    $username       = strtolower(stripcslashes($data['username']));
    $password       = mysqli_real_escape_string($con, $data['password']);
    $password2      = mysqli_real_escape_string($con, $data['password2']);
    $email          = htmlspecialchars($data['email']);
    $nama_lengkap   = htmlspecialchars($data['nama_lengkap']);
    $alamat         = htmlspecialchars($data['alamat']);

    $cekUsername = mysqli_query($con, "SELECT username FROM tbl_user WHERE username = '$username'");

    if (mysqli_fetch_assoc($cekUsername)) {
        echo "<script>
            alert('Username Sudah Terdaftar');
        </script>";
        return false;
    }

    if ($password !== $password2) {
        echo "<script>
            alert('Password Tidak Sesuai');
        </script>";
        return false;
    }

    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    $query = "INSERT INTO tbl_user VALUES('','$username', '$passwordHash', '$email', '$nama_lengkap', '$alamat')";
    $result = mysqli_query($con, $query);

    return mysqli_affected_rows($con);
}

function createPhoto($data, $file)
{
    global $con;

    $judulFoto = mysqli_real_escape_string($con, $data['JudulFoto']);
    $deskripsiFoto = mysqli_real_escape_string($con, $data['DeskripsiFoto']);
    $tanggalUnggah = date('Y-m-d H:i:s');
    $userID = $data['user_id'];
    $uploadedFile = uploadPhotoFile($file);

    if (!$uploadedFile) {
        return false;
    }

    $lokasiFile = mysqli_real_escape_string($con, $uploadedFile);

    $query = "INSERT INTO tbl_postingan (JudulFoto, DeskripsiFoto, TanggalUnggah, LokasiFile, user_id) 
              VALUES ('$judulFoto', '$deskripsiFoto', '$tanggalUnggah', '$lokasiFile', '$userID')";
    $result = mysqli_query($con, $query);

    return $result;
}

function uploadPhotoFile($file)
{
    $dir = "assets/";
    $uploadedFile = $dir . basename($file['name']);
    $uploadNama = basename($file['name']);

    if (move_uploaded_file($file['tmp_name'], $uploadedFile)) {
        return $uploadNama;
    } else {
        return false;
    }
}

function deletePhoto($photoID)
{
    global $con;
    
    // Hapus Gambarnya Dulu
    $getData = ("SELECT * FROM tbl_postingan WHERE id = '$photoID' ");
    $hasil = mysqli_query($con, $getData);
    $row = mysqli_fetch_assoc($hasil);
    $file = "assets/" . $row['LokasiFile'];
    unlink($file);

    // Hapus Data Di Tabel
    $query = "DELETE FROM tbl_postingan WHERE id = '$photoID'";
    $result = mysqli_query($con, $query);

    return $result;
}



// MASIH ERROR 
// Galih Pramana

function updateFoto($data, $file)
{
    global $con;

    $judulFoto = mysqli_real_escape_string($con, $data['JudulFoto']);
    $deskripsiFoto = mysqli_real_escape_string($con, $data['DeskripsiFoto']);
    $tanggalUnggah = date('Y-m-d H:i:s');
    $userID = $data['user_id'];
    $id_post = $data['id_post'];
    $uploadedFile = uploadPhotoFile($file);
    

    if (!$uploadedFile) { // Jika Tidak Ada File Baru

        $getData = ("SELECT * FROM tbl_postingan WHERE id = '$id_post' ");
        $hasil = mysqli_query($con, $getData);
        $row = mysqli_fetch_assoc($hasil);

        $uploadedFile = $row['LokasiFile'];
    } else { // Jika Ada File Baru
        // Hapus foto lama jika ada file yang diunggah baru
        $getData = ("SELECT * FROM tbl_postingan WHERE id = '$id_post' ");
        $hasil = mysqli_query($con, $getData);
        $row = mysqli_fetch_assoc($hasil);
        $fileToDelete = "assets/" . $row['LokasiFile'];
        unlink($fileToDelete);
    }

    $lokasiFile = mysqli_real_escape_string($con, $uploadedFile);

    $query1 = "UPDATE tbl_postingan SET JudulFoto = '$judulFoto', DeskripsiFoto = '$deskripsiFoto', TanggalUnggah = '$tanggalUnggah', LokasiFile='$lokasiFile', user_id='$userID' WHERE id='$id_post'";
    $result = mysqli_query($con, $query1);

    return $result;
}


function tambahKomen($data) {
    global $con;

    $idUser = $_POST['user_id'];
    $idPostingan = $_POST['postingan_id'];
    $komentar   = htmlspecialchars($data['komentar']);
    $tanggalUnggah = date('Y-m-d H:i:s');

    $query = "INSERT INTO tbl_komentar VALUES('','$komentar', '$tanggalUnggah', '$idUser', '$idPostingan')";
    mysqli_query($con, $query);
    
    // return mysqli_affected_rows($con);
}

function deleteKomen($data) {
    global $con;

    // Relasi Ke tbl_postingan harus cascade
    $id_komen = $data['komen_id'];
    $query = "DELETE FROM tbl_komentar WHERE id = '$id_komen'";
    mysqli_query($con, $query);
}

//Info
// Cascade => Parent dihapus, Child Nya Juga Akan Dihapus
// Restrict => Parent Tidak Bisa Dihapus Jika Ada Child (Kalo Di Hapus Akan Error)