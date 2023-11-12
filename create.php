<?php
    include("koneksi.php");
    include("layout/header.php");

    if (isset($_POST['save'])){
        $nama = $_POST['nama'];
        $jurusan = $_POST['jurusan'];

        //up gambar

        $foto = 'default.jpg';
        if($_FILES['foto']['error'] === 0){
            $extension = pathinfo($foto, PATHINFO_EXTENSION); //ambil extension dr file gambar
            $foto = time().'_'. rand(1000, 9999).'.'. $extension;

            $destination = 'uploads/'. $foto; //path file yang di upload

            move_uploaded_file($_FILES['foto']['tmp_name'], $destination);
        } 

        //simpan ke db

        $query = "INSERT INTO siswa (nama, jurusan, foto) VALUES (?, ?, ?)";
        $statement = $koneksi->prepare($query);
        $statement->bind_param("sss", $nama, $jurusan, $foto);
        $result = $statement->execute();

        if ($result){
            header("Location: index.php");;
        } else {
            echo "error" . $query . "<br>" . $koneksi->error;
        }
    }
?>

<form method="post" enctype="multipart/form-data">
    <label for="" class="form-label">Nama : </label>
    <input type="text" name="nama" class="form-control mb-3" required>
    <label for="" class="form-label">Jurusan : </label>
    <input type="text" name="jurusan" class="form-control mb-3" required>
    <label for="" class="form-label">Foto : </label>
    <input type="file" name="foto" class="form-control mb-3" accept="image/*">
    <a href="index.php" class="btn btn-secondary">Back</a>
    <input type="submit" class="btn btn-primary" name="save" value="tambah">
</form>


<?php
include("layout/footer.php");
?>
