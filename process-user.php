<?php
include("connection.php");

if (isset($_POST["simpan_user"])) {
    // tampung data input anggota dari user
    // isset()) --> untuk mengecek nilai

    //$id_user = $_POST["id_user"];
    $nama_user = $_POST["nama_user"];
    $username = $_POST["username"];
    $password = sha1($_POST["password"]);
    $role = $_POST["role"];

    //membuat perintah sql untuk insert data ke table user
    $sql = "insert into user values
    ('','$nama_user','$username','$password','$role')";

    //direct ke halaman list-user
    if (mysqli_query($connect, $sql)) {
        header('Location:list-user.php');
    } else {
        printf('Gagal'.mysqli_error($connect));
        exit();
    }

# untuk update / edit

}else if(isset($_POST["edit_user"])){
        # menampung dulu data yang akan di update
        $id_user = $_POST["id_user"];
        $nama_user = $_POST["nama_user"];
        $username = $_POST["username"];
        $password = $_POST["password"];
        $role = $_POST["role"];

        //karena password bersifat optional, maka

        if (empty($_POST["password"])) {
            // password tidak ikut teredit
            $sql = "update user set
            nama_user='$nama_user',
            username='$username',
            role = '$role'
            where id_user='$id_user'";
        } else {
            // password ikut teredit
            $password = sha1($_POST["password"]);
            $sql = "update user set
            nama_user='$nama_user',
            username='$username',
            password='$password',
            role = '$role'
            where id_user= '$id_user'";
        }
        
        $edit = mysqli_query($connect, $sql);
        
        if ($edit) {
            header('Location:list-user.php');
        } else {
            printf('Gagal'.mysqli_error($connect));
            exit();
        }
        
}
?>