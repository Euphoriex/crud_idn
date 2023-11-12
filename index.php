<?php
include("koneksi.php");
include("layout/header.php");

$query = "SELECT * FROM siswa";
$result = $koneksi->query($query);
?>

<a href="create.php" class="btn btn-primary">Tambah</a>
<table class="table table-stripped">
    <tr>
        <th>ID</th>
        <th>Nama</th>
        <th>Jurusan</th>
        <th>Foto</th>
        <th>Actions</th>
    </tr>

    <?php
    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
    ?>
        <tr>
            <td><?php echo "{$row['id']}" ?></td>
            <td><?php echo "{$row['nama']}" ?></td>
            <td><?php echo "{$row['jurusan']}" ?></td>
            <td>
                <img src="uploads/<?php echo "{$row['foto']}" ?>" width="100">
            </td>
        <td>
            <a href="edit.php?id=<?php echo "{$row['id']}" ?>" class="btn btn-warning">Edit</a>
            <a href="delete.php?id=<?php echo "{$row['id']}" ?>" class="btn btn-danger">Delete</a>
        </td>
    </tr>
    <?php
        }
        } else{
            echo "<tr><td colspan='5'>Tidak ada data</td></tr>";
        }
    ?>

<?php
include("layout/footer.php");
?>
