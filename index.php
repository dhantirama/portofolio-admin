<?php
include 'conn.php';
session_start();
$queryUser     = mysqli_query($conn, "SELECT * FROM user ORDER BY id DESC");
$rowUser       = mysqli_fetch_assoc($queryUser);
$queryTime      = mysqli_query($conn, "SELECT * FROM timeline ORDER BY id DESC");
$queryProject   = mysqli_query($conn, "SELECT * FROM project ORDER BY id DESC");

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <title>Hi, Dhanti's Here</title>
  <link href="images/ki.png" rel="shortcut icon" type="image/x-icon" />

  <!-- load CSS -->
  <link
    rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Open+Sans:300" />
  <link rel="stylesheet" href="css/bootstrap.min.css" />
  <link rel="stylesheet" href="fontawesome/css/fontawesome-all.min.css" />
  <link rel="stylesheet" type="text/css" href="slick/slick.css" />
  <link rel="stylesheet" type="text/css" href="slick/slick-theme.css" />
  <link rel="stylesheet" href="css/style.css" />

  <!-- Icon Font Stylesheet -->
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" />
</head>

<body>
  <div id="tm-bg"></div>
  <div id="tm-wrap">
    <div class="tm-main-content">
      <div class="container tm-site-header-container">
        <div class="row">
          <div
            class="col-sm-12 col-md-6 col-lg-6 col-md-col-xl-6 mb-md-0 mb-sm-4 mb-4 tm-site-header-col">
            <div class="tm-site-header">
              <h1 class="mb-4">
                <span id="container"></span><span class="typed-cursor">|</span>
              </h1>
              <img src="img/underline.png" class="img-fluid mb-4" />
              <h3>Ramadhanti's Portofolio</h3>
              <p>Junior Web Developer</p>
            </div>
          </div>
          <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
            <div class="content">
              <div class="grid">
                <!-- About Us Start -->
                <div class="grid__item" id="home-link">
                  <div class="product">
                    <div class="tm-nav-link">
                      <i class="fas fa-users fa-3x tm-nav-icon"></i>
                      <span class="tm-nav-text">About Me</span>
                      <div class="product__bg"></div>
                    </div>
                    <div class="product__description">
                      <div class="row mb-3">
                        <div class="col-12">
                          <h2 class="tm-page-title">Hello, call me Dhanti</h2>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                          <img src="admin/upload/<?php echo $rowUser['foto'] ?>" class="img-fluid mb-3" />
                          <p style="font-weight: bold"><?php echo $rowUser['about'] ?>
                          </p>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                          <div class="timeline">
                              <?php while ($rowTime = mysqli_fetch_assoc($queryTime)) : ?>
                              <ul>
                                <li>
                                  <span><?php echo $rowTime['kegiatan'] ?></span>
                                  <div class="content">
                                    <h3><?php echo $rowTime['tahun'] ?></h3>
                                    <p><?php echo $rowTime['pelaksana'] ?></p>
                                  </div>
                                </li>
                              </ul>
                              <?php endwhile ?>
                            </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- About Us End -->

                <!-- Skills Start -->
                <div class="grid__item" id="team-link">
                  <div class="product">
                    <div class="tm-nav-link">
                      <i
                        class="fas fa-magic-wand-sparkles fa-3x tm-nav-icon"></i>
                      <span class="tm-nav-text">Skills</span>
                      <div class="product__bg"></div>
                    </div>
                    <div class="product__description">
                      <div class="p-sm-4 p-2">
                        <div class="row mb-3">
                          <div class="col-12">
                            <h2 class="tm-page-title">My Skills</h2>
                          </div>
                        </div>
                        <div class="row g-6 service-blok">
                          <div class="col-lg-4">
                            <div
                              class="service-item d-flex flex-column flex-sm-row rounded h-100 p-4 p-lg-4">
                              <div class="ms-sm-5">
                                <h4 class="mb-3">Frontend</h4>
                                <h6 class="mb-2">
                                  <h6 class="mb-2">
                                    <i
                                      class="fa-brands fa-html5 fa-2x text-white tm-nav-icon"></i><i
                                      class="fa-brands fa-css3 fa-2x text-white tm-nav-icon"></i><i
                                      class="fa-brands fa-js fa-2x text-white tm-nav-icon"></i>
                                  </h6>
                                </h6>
                                <span>
                                  Have a good understanding in HTML, CSS, and
                                  JavaScript. Experienced in responsive web
                                  design and building user-friendly interfaces
                                </span>
                              </div>
                            </div>
                          </div>
                          <div class="col-lg-4 service-blok">
                            <div
                              class="service-item d-flex flex-column flex-sm-row rounded h-100 p-4 p-lg-4">
                              <div class="ms-sm-5">
                                <h4 class="mb-3">Backend</h4>
                                <h6 class="mb-2">
                                  <i
                                    class="fa-brands fa-php fa-2x text-white tm-nav-icon"></i><i
                                    class="fa-brands fa-laravel fa-2x text-white tm-nav-icon"></i><i
                                    class="fa-brands fa-js fa-2x text-white tm-nav-icon"></i>
                                </h6>
                                <span>Entry-level backend developer adept at PHP
                                  and Laravel, eager to contribute to the
                                  development of dynamic and efficient web
                                  applications.</span>
                              </div>
                            </div>
                          </div>
                          <div class="col-lg-4 service-blok">
                            <div
                              class="service-item d-flex flex-column flex-sm-row rounded h-100 p-4 p-lg-4">
                              <div class="ms-sm-5">
                                <h4 class="mb-3">WordPress</h4>
                                <h6 class="mb-2">
                                  <i
                                    class="fa-brands fa-elementor fa-2x text-white tm-nav-icon"></i>
                                </h6>
                                <span>Experienced in creating WordPress websites
                                  for shops and education. Customizes sites
                                  with themes and plugins for specific
                                  needs.</span>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Skills End -->

                <!-- Project Start -->
                <div class="grid__item">
                  <div class="product">
                    <div class="tm-nav-link">
                      <i class="fas fa-file fa-3x tm-nav-icon"></i>
                      <span class="tm-nav-text">My Project</span>
                      <div class="product__bg"></div>
                    </div>
                    <div class="product__description">
                      <div class="p-sm-4 p-2">
                        <div class="row mb-3">
                          <div class="col-12">
                            <h2 class="tm-page-title">
                              A collection of projects I've worked on.
                            </h2>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-12">
                            <div class="p-sm-4 p-2 tm-img-container">
                              <div class="tm-img-slider" id="tmImgSlider">
                                <div class="project">
                                  <div class="content">
                                  <?php while ($rowProject= mysqli_fetch_assoc($queryProject)) : ?>
                                    <a
                                      href="<?php echo $rowProject['link'] ?>"
                                      class="tm-slider-img-link">
                                      <div class="content-overlay"></div>
                                      <img
                                        src="admin/upload/<?php echo $rowProject['foto'] ?>"
                                        alt="Image 2"
                                        class="content-image" />
                                    </a>
                                    <div
                                      class="content-details fadeIn-bottom">
                                      <h3 class="content-title">
                                        <a
                                          href="<?php echo $rowProject['link'] ?>"
                                          target="_blank"
                                          style="color: white">
                                          <?php echo $rowProject['judul'] ?></a>
                                      </h3>
                                      <p class="content-text">
                                        <?php echo $rowProject['deskripsi'] ?>
                                      </p>
                                    </div>
                                  <?php endwhile ?>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Project End -->

                <!-- Contact Us Start -->
                <div class="grid__item">
                  <div class="product">
                    <div class="tm-nav-link">
                      <i class="fas fa-comments fa-3x tm-nav-icon"></i>
                      <span class="tm-nav-text">Contact Me</span>
                      <div class="product__bg"></div>
                    </div>
                    <div class="product__description">
                      <div
                        class="pt-sm-4 pb-sm-4 pl-sm-5 pr-sm-5 pt-2 pb-2 pl-3 pr-3">
                        <div class="row mb-3">
                          <div class="col-12">
                            <h2 class="tm-page-title">Let's work together</h2>
                          </div>
                        </div>
                        <div class="row d-flex contact-section mb-5">
                          <div class="col-md-6 col-lg-3 d-flex ftco-animate">
                            <div
                              class="align-self-stretch box p-4 text-center">
                              <div
                                class="icon d-flex align-items-center justify-content-center">
                                <a
                                  href="https://wa.me/62895635929627"
                                  target="_blank">
                                  <i
                                    class="fa-solid fa-mobile-screen-button fa-2x"></i></a>
                              </div>
                              <h3 class="mb-4">Contact Number</h3>
                              <p><?php echo $rowUser['phone'] ?></p>
                            </div>
                          </div>
                          <div class="col-md-6 col-lg-3 d-flex ftco-animate">
                            <div
                              class="align-self-stretch box p-4 text-center">
                              <div
                                class="icon d-flex align-items-center justify-content-center">
                                <a
                                  href="mailto:info@yoursite.com"
                                  target="_blank"><i
                                    class="fa-solid fa-paper-plane fa-2x"></i></a>
                              </div>
                              <h3 class="mb-4">Email Address</h3>
                              <p><?php echo $rowUser['email'] ?></p>
                            </div>
                          </div>
                          <div class="col-md-6 col-lg-3 d-flex ftco-animate">
                            <div
                              class="align-self-stretch box p-4 text-center">
                              <div
                                class="icon d-flex align-items-center justify-content-center">
                                <a
                                  href="https://www.instagram.com/_dhanram/
                                                            "
                                  target="_blank"><i class="fa-brands fa-instagram fa-2x"></i></a>
                              </div>
                              <h3 class="mb-4">Instagram Account</h3>
                              <p><?php echo $rowUser['instagram'] ?></p>
                            </div>
                          </div>
                          <div class="col-md-6 col-lg-3 d-flex ftco-animate">
                            <div
                              class="align-self-stretch box p-4 text-center">
                              <div
                                class="icon d-flex align-items-center justify-content-center">
                                <a
                                  href="https://github.com/dhantirama"
                                  target="_blank"><i class="fa-brands fa-github fa-2x"></i></a>
                              </div>
                              <h3 class="mb-4">Github Account</h3>
                              <p>dhantirama</p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Contact Us End -->
              </div>
            </div>
          </div>
        </div>
      </div>
      <footer>
        <p class="small tm-copyright-text">
          Copyright &copy;
          <span class="tm-current-year">2024</span> dhanram.my.id
        </p>
      </footer>
    </div>
    <!-- .tm-main-content -->
  </div>
  <!-- load JS -->
  <script src="js/jquery-3.2.1.slim.min.js"></script>
  <!-- https://jquery.com/ -->
  <script src="slick/slick.min.js"></script>
  <!-- http://kenwheeler.github.io/slick/ -->
  <script src="js/anime.min.js"></script>
  <!-- http://animejs.com/ -->
  <script src="js/main.js"></script>
  <script src="lib/wow/wow.js"></script>
  <script src="js/timeline.js"></script>
  <script>
    function setupFooter() {
      var pageHeight =
        $(".tm-site-header-container").height() + $("footer").height() + 100;

      var main = $(".tm-main-content");

      if ($(window).height() < pageHeight) {
        main.addClass("tm-footer-relative");
      } else {
        main.removeClass("tm-footer-relative");
      }
    }

    /* DOM is ready
      ------------------------------------------------*/
    $(function() {
      setupFooter();

      $(window).resize(function() {
        setupFooter();
      });

      $(".tm-current-year").text(new Date().getFullYear()); // Update year in copyright
    });
  </script>
</body>

</html>