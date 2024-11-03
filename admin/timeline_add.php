<?php
include '../conn.php';
if (isset($_POST['tambah'])) {
    $kegiatan = $_POST['kegiatan'];
    $tahun = $_POST['tahun'];
    $pelaksana = $_POST['pelaksana'];


    // sql = structur query languages / DML = data manipulation language
    // select, insert. update, dan delete
    $insert = mysqli_query($conn, "INSERT INTO timeline (kegiatan, tahun, pelaksana) VALUES ('$kegiatan', '$tahun', '$pelaksana')");
    header("location:timeline.php?tambah=berhasil");
}

$id = isset($_GET['edit']) ? $_GET['edit'] : '';
$editUser = mysqli_query($conn, "SELECT * FROM timeline WHERE id= '$id'");

$rowEdit = mysqli_fetch_assoc($editUser);

if (isset($_POST['edit'])) {
    $kegiatan = $_POST['kegiatan'];
    $pelaksana = $_POST['pelaksana'];
    $tahun = $_POST['tahun'];

    //ubah user kolom apa yang mau diubah (SET), yang mau diubah di id berapa
    $update = mysqli_query($conn, "UPDATE timeline SET kegiatan='$kegiatan', pelaksana='$pelaksana' WHERE id= '$id'");
    header("location: timeline.php?tambah=berhasil");
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $delete = mysqli_query($conn, "DELETE FROM timeline WHERE id='$id'");
    header("location: timeline.php?hapus=berhasill");
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
                                    <h4 class="card-title">Timeline Setting</h4>
                                    <form class="forms-sample" method="POST">
                                        <div class="form-group">
                                            <label for="exampleInputName1">Kegiatan</label>
                                            <input type="text" class="form-control" name="kegiatan" id="exampleInputName1" placeholder="Tulis Kegiatan" value="<?php echo isset($_GET['edit']) ? $rowEdit['kegiatan'] : '' ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail3">Tahun</label>
                                            <input type="text" class="form-control" name="tahun" id="exampleInputEmail3" placeholder="Tahun Kegiatan" value="<?php echo isset($_GET['edit']) ? $rowEdit['tahun'] : '' ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword4">Pelaksana</label>
                                            <input type="text" class="form-control" name="pelaksana" id="exampleInputPassword4" placeholder="Pelaksana Kegiatan" value="<?php echo isset($_GET['edit']) ? $rowEdit['pelaksana'] : '' ?>">
                                        </div>
                                        <button type="submit" name="<?php echo isset($_GET['edit']) ? 'edit' : 'tambah' ?>" class="btn btn-primary me-2">Submit</button>
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