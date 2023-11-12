<?php 
    include("koneksi.php");

    if (isset($_GET['id'])){
        $id = $_GET['id'];

        $queryGetFoto = "SELECT foto FROM siswa WHERE id = $id";
        $resultGetFoto = $koneksi-> query($queryGetFoto);
        
        if ($resultGetFoto->num_rows > 0){
            $row = $resultGetFoto->fetch_assoc();
            $foto = $row['foto'];

            if ($foto != 'default.jpg'){
                unlink('uploads/' . $foto);
            }
        }

        $queryhapus = "DELETE FROM siswa WHERE id = $id";
        $resulthapus = $koneksi->query($queryhapus);

        if ($resulthapus) {
            header("Location: index.php");
        } else {
            echo "error" . $queryhapus . "<br>" . $koneksi->error;
        }
    }
?>