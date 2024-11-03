<?php
session_start();
include '../conn.php';
//munculkan satu atau semua kolom dari tabel user
$query = mysqli_query($conn, "SELECT * FROM project");
//mysqli_fetch_assoc = untuk menjadikan hasil query menjadi sebuah data (object, atau array)

//jika parameternya ada ?delete=nilai param
if (isset($_GET['delete'])) {
    $id = $_GET['delete']; //mengambil nilai parameter

    //query perintah hapus
    $delete = mysqli_query($conn, "DELETE FROM project WHERE id = '$id'");
    header("location:project.php?hapus=berhasil");
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
                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Project Data</h4>
                                    <div class="table-responsive">
                                        <a href="project_add.php" class="btn btn-primary me-2">Add</a>
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Foto</th>
                                                    <th>Judul</th>
                                                    <th>Link</th>
                                                    <th>Deskripsi</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $no = 1;
                                                while ($rowProject = mysqli_fetch_assoc($query)) : ?>
                                                    <tr>
                                                        <td><?php echo $no++ ?></td>
                                                        <td>
                                                            <img src="upload/<?php echo $rowProject['foto'] ?>" alt="">
                                                        </td>
                                                        <td><?php echo $rowProject['judul'] ?></td>
                                                        <td><?php echo $rowProject['link'] ?></td>
                                                        <td><?php echo $rowProject['deskripsi'] ?></td>
                                                        <td>| <a href="project_add.php?edit=<?php echo $rowProject['id'] ?>"><i class="mdi mdi-auto-fix"></i></a> | | <a onclick="return confirm('Apakah anda yakin akan menghapus data ini??')" href="project.php?delete=<?php echo $rowProject['id'] ?>"><i class="mdi mdi-eraser"></i> |</a></td>
                                                    </tr>
                                                <?php endwhile ?>
                                            </tbody>
                                        </table>
                                    </div>
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