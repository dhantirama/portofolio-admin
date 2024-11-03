<?php
    session_start();
  //muncul/pilih sebuah atau semua kolom dari table user
  include '../conn.php';
  
  $queryUser = mysqli_query($conn, "SELECT * FROM user ORDER BY id DESC");

  //UPDATE
  $rowUser = mysqli_fetch_assoc($queryUser);

  //jika button simpan ditekan, POST ambil value CREATE NEW ACCOUNT
  if (isset($_POST['simpan'])) {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $id = $_POST['id'];
    $github = $_POST['github'];
    $instagram = $_POST['instagram'];
    $phone = $_POST['phone'];
    $about = $_POST['about'];

    //cari data di tbl user, jika datanya ada akan di-update,
    //jika tidak ada, akan di-insert
    if (mysqli_num_rows($queryUser) > 0) {
        if(!empty($_FILES['foto']['name'])){
            $foto = $_FILES['foto']['name'];
            $ukuran_foto = $_FILES['foto']['size'];


            //png, jpg, jpeg
            $ext = array('png', 'jpg', 'jpeg');
            $extFoto = pathinfo($foto, PATHINFO_EXTENSION);

            // jika extension foto tidak ada/ tidak sesuai dengan ext yang telah di-declare di array $ext
            if (!in_array($extFoto, $ext)) {
                echo "Ekstensi/jenis file tidak ditemukan. Ekstensi yang diizinkan: " . implode(", ", $extFoto);
                die;
            }else {
                //pindah directory gambar ke folder upload (tmp/temporary path)
                unlink('upload/' . $rowUser['foto']);
                move_uploaded_file($_FILES['foto']['tmp_name'], 'upload/' . $foto);

                $update = mysqli_query($conn, "UPDATE user SET nama='$nama', email='$email', foto='$foto', github='$github', instagram='$instagram', about='$about', phone='$phone' WHERE id='$id'");

            }
        } else {
            $update = mysqli_query($conn, "UPDATE user SET nama='$nama', email='$email', github='$github', instagram='$instagram', phone='$phone', about='$about' WHERE id='$id'");
        }
    }else {
        if(!empty($_FILES['foto']['name'])){
            $foto = $_FILES['foto']['name'];
            $ukuran_foto = $_FILES['foto']['size'];


            //png, jpg, jpeg
            $ext = array('png', 'jpg', 'jpeg');
            $extFoto = pathinfo($foto, PATHINFO_EXTENSION);

            // jika extension foto tidak ada/ tidak sesuai dengan ext yang telah di-declare di array $ext
            if (!in_array($extFoto, $ext)) {
                echo "Ekstensi/jenis file tidak ditemukan. Ekstensi yang diizinkan: " . implode(", ", $extFoto);
                die;
            }else {
                //pindah directory gambar ke folder upload (tmp/temporary path)
                move_uploaded_file($_FILES['foto']['tmp_name'], 'upload/' . $foto);

                $insert = mysqli_query($conn, "INSERT INTO user (nama, email, foto, github, instagram, phone, about) VALUES ('$nama', '$email', '$foto', '$github', '$instagram', '$phone', '$about')");

            }
        } else {
            $insert = mysqli_query($conn, "INSERT INTO user (nama, email, github, instagram, phone, about) VALUES ('$nama', '$email', '$github', '$instagram', '$phone', '$about')");
        }
    }


    //$_POST: form input name=''
    //$_GET: url ?param='nilai'
    //$_FILES: from uploaded files

    header("location:user.php?simpan=berhasil");
  }


  //UPDATE
  

  //EDIT/UPDATA ACCOUNT DATA
  $id = isset($_GET['edit']) ? $_GET['edit'] : '';
  $queryEdit = mysqli_query($conn, "SELECT * FROM user WHERE id='$id'");
  $rowEdit = mysqli_fetch_assoc($queryEdit);

  // when button edit is clicked, insert/update into db
  if (isset($_POST['edit'])) {
    $nama = $_POST['nama'];
    $email = $_POST['email'];

    //jika password diisi oleh user
    if ($_POST['password']) {
        $password = $_POST['password'];
    }else {
        $password = $rowEdit['password'];
    }

    $update = mysqli_query($conn, "UPDATE user SET nama='$nama', email='$email', password='$password' WHERE id='$id'");
    header("location:user.php?ubah=berhasil");
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>User Setting</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/vendors/feather/feather.css">
    <link rel="stylesheet" href="assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="assets/vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="assets/vendors/select2/select2.min.css">
    <link rel="stylesheet" href="assets/vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="assets/images/favicon.png" />
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_navbar.html -->
       <?php include 'inc/header.php'; ?>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
         <?php include 'inc/sidebar.php'; ?>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="row">
              <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">User Setting</h4>
                    <form class="forms-sample" method="POST" enctype="multipart/form-data">
                        <input type="hidden" class="form-control" name="id" value="<?php echo isset($rowUser['id']) ? $rowUser['id'] : '' ?>">
                    <div class="form-group">
                      <label>Photos Upload</label>
                      <div class="input-group col-xs-8 d-flex align-items-center">
                        <img src="upload/<?php echo isset($rowUser['foto']) ? $rowUser['foto'] : '' ?>" alt="user-avatar" class="d-block rounded" height="100" width="100" id="uploadedAvatar" />
                        <input type="file" name="foto" class="form-control file-upload-info">
                      </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputUsername1">Username</label>
                        <input type="text" name="name" class="form-control" id="exampleInputUsername1" placeholder="Username" value="<?php echo isset($rowUser['name']) ? $rowUser['name'] : '' ?>">
                    </div>
                    <div class="form-group">
                        <label for="exampleTextarea1">About</label>
                        <textarea type="text" class="form-control" id="about" name="about" rows="4" value="<?php echo isset($rowUser['about']) ? $rowUser['about'] : '' ?>"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Email" value="<?php echo isset($rowUser['email']) ? $rowUser['email'] : '' ?>">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Github</label>
                        <input type="text" name="github" class="form-control" id="exampleInputEmail1" placeholder="Github" value="<?php echo isset($rowUser['github']) ? $rowUser['github'] : '' ?>">
                      </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Instagram</label>
                        <input type="text" name="instagram" class="form-control" id="exampleInputEmail1" placeholder="Instagram" value="<?php echo isset($rowUser['instagram']) ? $rowUser['instagram'] : '' ?>">
                      </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Phone</label>
                        <input type="text" name="phone" class="form-control" id="exampleInputEmail1" placeholder="Phone" value="<?php echo isset($rowUser['phone']) ? $rowUser['phone'] : '' ?>">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                    </div>
                      <button type="submit" name="simpan" class="btn btn-primary me-2">Submit</button>
                      <a href="index.php" class="btn btn-light">Back</a>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
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
    <script src="assets/vendors/typeahead.js/typeahead.bundle.min.js"></script>
    <script src="assets/vendors/select2/select2.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/template.js"></script>
    <script src="assets/js/settings.js"></script>
    <script src="assets/js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="assets/js/file-upload.js"></script>
    <script src="assets/js/typeahead.js"></script>
    <script src="assets/js/select2.js"></script>
    <!-- End custom js for this page-->
  </body>
</html>