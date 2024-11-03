<?php
include '../conn.php';
session_start();
//aksi untuk tambah

$querySetting = mysqli_query($conn, "SELECT * FROM about ORDER BY id DESC");
$rowSetting = mysqli_fetch_assoc($querySetting);
if (isset($_POST['simpan'])) {
    $about    = $_POST['about'];
    $id       = $_POST['id'];

    //mencari data di dalam table pengaturan, jika ada data akan di update, jika tidak ada maka akan diinsert 

    if (mysqli_num_rows($querySetting) > 0) {
        if (!empty($_FILES['foto']['name'])) {
            $foto = $_FILES['foto']['name'];
            $fotoSize = $_FILES['foto']['size'];

            $ext = array('png', 'jpg', 'jpeg');
            $extfoto = pathinfo($foto, PATHINFO_EXTENSION);

            //Jika extensi foto tidak memenuhi syarat array extensi
            if (!in_array($extfoto, $ext)) {
                echo "Gunakan Foto Lain";
                die;
            } else {
                //unlink (otomatis menghapus foto saat foto baru diupload)
                unlink('upload/' . $rowSetting['foto']);
                move_uploaded_file($_FILES['foto']['tmp_name'], 'upload/' . $foto);  //memindahkan foto ke folder upload
                $update = mysqli_query($conn, "UPDATE about SET about='$about', foto='$foto' WHERE id = '$id'");
            }
        } else {
            // sql = structur query languages / DML = data manipulation language
            // select, insert. update, dan delete
            $update = mysqli_query($conn, "UPDATE about SET about='$about' WHERE id = '$id'");
        }
    } else {
        if (!empty($_FILES['foto']['name'])) {
            $foto = $_FILES['foto']['name'];
            $fotoSize = $_FILES['foto']['size'];

            $ext = array('png', 'jpg', 'jpeg');
            $extfoto = pathinfo($foto, PATHINFO_EXTENSION);

            //Jika extensi foto tidak memenuhi syarat array extensi
            if (!in_array($extfoto, $ext)) {
                echo "Gunakan Foto Lain";
                die;
            } else {
                move_uploaded_file($_FILES['foto']['tmp_name'], 'upload/' . $foto);  //memindahkan foto ke folder upload
                $insert = mysqli_query($conn, "INSERT INTO about (about, foto) VALUES ('$about', '$foto')");
            }
        } else {
            // sql = structur query languages / DML = data manipulation language
            // select, insert. update, dan delete
            $insert = mysqli_query($conn, "INSERT INTO about (about) VALUES ('$about')");
        }
    }
    header("location:about.php?tambah=berhasil");
}


//aksi untuk edit
$id = isset($_GET['edit']) ? $_GET['edit'] : '';
$queryEdit = mysqli_query($conn, "SELECT * FROM about WHERE id = '$id'");
$rowEdit = mysqli_fetch_assoc($queryEdit);

if (isset($_POST['edit'])) {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    //jika password diisi dengan user
    if ($_POST['password']) {
        $password = $_POST['password'];
    } else {
        $password = $rowEdit['password'];
    }

    $update = mysqli_query($conn, "UPDATE user SET nama='$nama', email='$email', password='$password' WHERE id='$id'");
    header("location:about.php?edit=berhasil");
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Skydash Admin</title>
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
                                    <h4 class="card-title">About Me Setting</h4>
                                    <form class="forms-sample" method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label>Photos Upload</label>
                                            <div class="input-group col-xs-6 d-flex align-items-center">
                                                <img
                                                    src="upload/<?php echo isset($rowSetting['foto']) ? $rowSetting['foto'] : '' ?>"
                                                    alt="user-avatar"
                                                    class="d-block rounded"
                                                    height="100"
                                                    width="100"
                                                    id="uploadedAvatar" />
                                                <input type="file" name="foto" class="form-control file-upload-info">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleTextarea1">About</label>
                                            <textarea class="form-control" id="about" name="about" rows="4" value="<?php echo isset($rowSetting['about']) ? $rowSetting['about'] : '' ?>" required></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary me-2" name="<?php echo isset($_GET['edit']) ? 'edit' : 'simpan' ?>">Submit</button>
                                        <button class="btn btn-light">Cancel</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- content-wrapper ends -->
                <!-- partial:../../partials/_footer.html -->
                <?php include 'inc/footer.php'; ?>
                <!-- partial -->
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