<?php
include '../conn.php';
session_start();
//aksi untuk tambah
if (isset($_POST['tambah'])) {
    $judul      = $_POST['judul'];
    $deskripsi  = $_POST['deskripsi'];
    $link       = $_POST['link'];

    //$_POST: form input name=''
    //$_GET: url ?param='nilai'
    //$_FILES : ngambil nilai dari input type file

    if (!empty($_FILES['foto']['name'])) {
        $foto = $_FILES['foto']['name'];
        $fotoSize = $_FILES['foto']['size'];

        $ext = array('png', 'jpg', 'jpeg');
        $extFoto = pathinfo($foto, PATHINFO_EXTENSION);

        //Jika extensi foto tidak memenuhi syarat array extensi
        if (!in_array($extFoto, $ext)) {
            echo "Gunakan Foto Lain";
            die;
        } else {
            move_uploaded_file($_FILES['foto']['tmp_name'], 'upload/' . $foto);  //memindahkan foto ke folder upload
            $insert = mysqli_query($conn, "INSERT INTO project (judul, deskripsi, link, foto) VALUES ('$judul', '$deskripsi', '$link', '$foto')");
        }
    } else {
        // sql = structur query languages / DML = data manipulation language
        // select, insert. update, dan delete
        $insert = mysqli_query($conn, "INSERT INTO project (judul, deskripsi, link) VALUES ('$judul', '$deskripsi', '$link')");
    }

    header("location:project.php?tambah=berhasil");
}

//aksi untuk edit
$id = isset($_GET['edit']) ? $_GET['edit'] : '';
$queryEdit = mysqli_query($conn, "SELECT * FROM project WHERE id = '$id'");
$rowEdit = mysqli_fetch_assoc($queryEdit);

if (isset($_POST['edit'])) {
    $judul = $_POST['judul'];
    $deskripsi = $_POST['deskripsi'];
    $link       = $_POST['link'];

    //jika user ingin memasukkan gambar
    if (!empty($_FILES['foto']['name'])) {
        $foto = $_FILES['foto']['name'];
        $fotoSize = $_FILES['foto']['size'];

        $ext = array('png', 'jpg', 'jpeg');
        $extFoto = pathinfo($foto, PATHINFO_EXTENSION);
        if (!in_array($extFoto, $ext)) {
            echo "Gunakan Foto Lain";
            die;
        } else {
            unlink('upload/' . $rowEdit['foto']);
            move_uploaded_file($_FILES['foto']['tmp_name'], 'upload/' . $foto);  //memindahkan foto ke folder upload
            $update = mysqli_query($conn, "UPDATE project SET judul='$judul', deskripsi='$deskripsi', link='$link', foto='$foto' WHERE id='$id'");
        }
    } else {

        // kalau user tidak ingin memasukkan gambar\
        $update = mysqli_query($conn, "UPDATE project SET judul='$judul', deskripsi='$deskripsi', link='$link' WHERE id='$id'");
    }
    header("location:project.php?edit=berhasil");
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Project Data</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/vendors/feather/feather.css">
    <link rel="stylesheet" href="assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="assets/vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="assets/images/favicon.png" />
</head>

<body>
    <div class="container-scroller">
        <!-- partial:../../partials/_navbar.html -->
        <?php include 'inc/header.php'; ?>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:../../partials/_sidebar.html -->
            <?php include 'inc/sidebar.php'; ?>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title"><?php echo isset($_GET['edit']) ? 'Edit' : 'Add' ?> Project</h4>
                                    <form class="forms-sample" method="POST">
                                        <div class="input-group col-xs-6 d-flex align-items-center">
                                            <label for="">Foto</label>
                                            <input type="file" name="foto" class="form-control file-upload-info">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputName1">Judul</label>
                                            <input type="text" class="form-control" name="judul" id="exampleInputName1" placeholder="Tulis Judul" value="<?php echo isset($_GET['edit']) ? $rowEdit['judul'] : '' ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail3">Link</label>
                                            <input type="text" class="form-control" name="link" id="exampleInputEmail3" placeholder="Link Kegiatan" value="<?php echo isset($_GET['edit']) ? $rowEdit['link'] : '' ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword4">Deskripsi</label>
                                            <input type="text" class="form-control" name="deskripsi" id="exampleInputPassword4" placeholder="Deskripsi Kegiatan" value="<?php echo isset($_GET['edit']) ? $rowEdit['deskripsi'] : '' ?>">
                                        </div>
                                        <button type="submit" name="<?php echo isset($_GET['edit']) ? 'edit' : 'tambah' ?>" class="btn btn-primary me-2">Submit</button>
                                        <a href="project.php" class="btn btn-light">Back</a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/template.js"></script>
    <script src="assets/js/settings.js"></script>
    <script src="assets/js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <!-- End custom js for this page-->
</body>

</html>