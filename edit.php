<?php
    include("koneksi.php");
    include("layout/header.php");


if (isset($_GET['id'])){
    $id = $_GET['id'];

    $query = "SELECT * FROM siswa WHERE id = $id";
    $result = $koneksi->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $nama = $row['nama'];
        $jurusan = $row['jurusan'];
        $foto = $row['foto'];
    } else {
        echo "data tdk ditemukan";
        exit();
    }
}
    if (isset($_POST['update'])){
        $nama = $_POST['nama'];
        $jurusan = $_POST['jurusan'];

        //up gambar

        $foto = $row['foto'];
        if($_FILES['foto']['error'] === 0){

            //hapus file lama

            if ($foto != 'default.jpg'){
                unlink('uploads/' . $foto);
            }

            //up gambar baru 

            
            $extension = pathinfo($foto, PATHINFO_EXTENSION); //ambil extension dr file gambar
            $foto = time().'_'. rand(1000, 9999).'.'. $extension;

            $destination = 'uploads/'. $foto; //path file yang di upload

            move_uploaded_file($_FILES['foto']['tmp_name'], $destination);
        } 

        //edit ke db

        $queryupdate = "UPDATE siswa SET nama = ?, jurusan = ?, foto = ? WHERE id= ?";
        $statement = $koneksi->prepare($queryupdate);
        $statement->bind_param("sssi", $nama, $jurusan, $foto, $id);
        $resultupdate = $statement->execute();

        if ($resultupdate){
            header("Location: index.php");;
        } else {
            echo "error" . $queryupdate . "<br>" . $koneksi->error;
        }
    }
?>

<form method="post" enctype="multipart/form-data">
    <label for="" class="form-label">Nama : </label>
    <input type="text" name="nama" class="form-control mb-3" value="<?php echo $nama;?>" required>
    <label for="" class="form-label">Jurusan : </label>
    <input type="text" name="jurusan" class="form-control mb-3" value="<?php echo $jurusan;?>" required>
    <label for="" class="form-label">Foto : </label>
    <input type="file" name="foto" class="form-control mb-3" accept="image/*">
    <br>
    <img src="uploads/<?php echo $foto; ?>" alt="">

    <a href="index.php" class="btn btn-secondary">Back</a>
    <input type="submit" class="btn btn-primary" name="update" value="Edit">
</form>


<?php
include("layout/footer.php");
?>
