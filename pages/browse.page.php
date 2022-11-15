<?php
include_once("../database/connection.php");
// session_start();

if (isset($_SESSION["authenticated"])) {

?>

  <!DOCTYPE html>
  <html lang="en">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 CSS-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="../assets/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../assets/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/favicon/favicon-16x16.png">
    <link rel="manifest" href="../assets/favicon/site.webmanifest">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../assets/css/templatemo-cyborg-gaming.css">
    <link rel="stylesheet" href="../assets/css/owl.css">
    <link rel="stylesheet" href="../assets/css/animate.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
    <title>LMS - Browse</title>
  </head>

  <body>

    <!-- ***** Preloader Start ***** -->
    <div id="js-preloader" class="js-preloader">
      <div class="preloader-inner">
        <span class="dot"></span>
        <div class="dots">
          <span></span>
          <span></span>
          <span></span>
        </div>
      </div>
    </div>
    <!-- ***** Preloader End ***** -->

    <!-- ***** Header Area Start ***** -->
    <header class="header-area header-sticky">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <nav class="main-nav">
              <!-- ***** Logo Start ***** -->
              <a href="#" class="logo">
                <img src="../assets/img/logo-darker.svg" alt=""> | Library Management S. </img>
              </a>
              <!-- ***** Logo End ***** -->
              <!-- ***** Search End ***** -->
              <div class="search-input">
                <form id="search" action="#">
                  <input type="text" placeholder="Type Something" id='searchText' name="searchKeyword" onkeypress="handle" />
                  <i class="fa fa-search"></i>
                </form>
              </div>
              <!-- ***** Search End ***** -->
              <!-- ***** Menu Start ***** -->
              <ul class="nav">
                <li><a href="home.page.php" class="">Home</a></li>
                <li><a href="#" class="active">Browse</a></li>
                <li><a href="#" id="logoutbtn">Logout</a></li>
                <li><a href="profile.page.php">Profile <img src="../assets/images/profile-header.jpg" alt=""></a></li>
              </ul>
              <a class='menu-trigger'>
                <span>Menu</span>
              </a>
              <!-- ***** Menu End ***** -->
            </nav>
          </div>
        </div>
      </div>
    </header>
    <!-- ***** Header Area End ***** -->

    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="page-content">

            <!-- ***** Featured Books Start ***** -->
            <div class="row">
              <div class="col-lg-12">
                <div class="featured-games header-text">
                  <div class="heading-section">
                    <h4><em>Featured</em> Books</h4>
                  </div>
                  <div class="owl-features owl-carousel" id="featured">
                    <?php
                      $database = new Database();
                      $stmt = $database->conn->prepare("SELECT * FROM books ORDER BY quantity DESC LIMIT 4");
                      $stmt->execute();
                      $result = $stmt->get_result();
                      $stmt->close();

                      while ($row = $result->fetch_assoc()) {
                        $books[] = $row;
                      }

                      foreach ($books as $key => $value) {
                        ?>
                          <div class="item">
                            <div class="thumb">
                              <?php echo '<img src="../assets/uploaded/images/' . (($value['image'] != "") ? $value['image'] : 'no-image.svg') . '"  alt="">' ?>
                              <div class="hover-effect">
                                <h6><?php echo $value['description'] ?></h6>
                              </div>
                            </div>
                            <h4><?php echo $value['title'] ?><br><span><?php echo $value['author'] ?></span></h4>
                            <ul>
                              <li class="text-danger"><i class="fa fa-book text-danger"></i> <?php echo $value['quantity'] ?></li>
                              <li class="text-primary"><i class="fa fa-calendar"></i> <?php echo $value['inserted_at'] ?></li>
                            </ul>
                          </div>
                        <?php
                      }
                    ?>
                    <!-- <div class="item">
                      <div class="thumb">
                        <img src="../assets/images/featured-01.jpg" alt="">
                        <div class="hover-effect">
                          <h6>2.4K Streaming</h6>
                        </div>
                      </div>
                      <h4>CS-GO<br><span>249K Downloads</span></h4>
                      <ul>
                        <li><i class="fa fa-star"></i> 4.8</li>
                        <li><i class="fa fa-download"></i> 2.3M</li>
                      </ul>
                    </div>
                    <div class="item">
                      <div class="thumb">
                        <img src="../assets/images/featured-02.jpg" alt="">
                        <div class="hover-effect">
                          <h6>2.4K Streaming</h6>
                        </div>
                      </div>
                      <h4>Gamezer<br><span>249K Downloads</span></h4>
                      <ul>
                        <li><i class="fa fa-star"></i> 4.8</li>
                        <li><i class="fa fa-download"></i> 2.3M</li>
                      </ul>
                    </div>
                    <div class="item">
                      <div class="thumb">
                        <img src="../assets/images/featured-03.jpg" alt="">
                        <div class="hover-effect">
                          <h6>2.4K Streaming</h6>
                        </div>
                      </div>
                      <h4>Island Rusty<br><span>249K Downloads</span></h4>
                      <ul>
                        <li><i class="fa fa-star"></i> 4.8</li>
                        <li><i class="fa fa-download"></i> 2.3M</li>
                      </ul>
                    </div>
                    <div class="item">
                      <div class="thumb">
                        <img src="../assets/images/featured-01.jpg" alt="">
                        <div class="hover-effect">
                          <h6>2.4K Streaming</h6>
                        </div>
                      </div>
                      <h4>CS-GO<br><span>249K Downloads</span></h4>
                      <ul>
                        <li><i class="fa fa-star"></i> 4.8</li>
                        <li><i class="fa fa-download"></i> 2.3M</li>
                      </ul>
                    </div>
                    <div class="item">
                      <div class="thumb">
                        <img src="../assets/images/featured-02.jpg" alt="">
                        <div class="hover-effect">
                          <h6>2.4K Streaming</h6>
                        </div>
                      </div>
                      <h4>Gamezer<br><span>249K Downloads</span></h4>
                      <ul>
                        <li><i class="fa fa-star"></i> 4.8</li>
                        <li><i class="fa fa-download"></i> 2.3M</li>
                      </ul>
                    </div>
                    <div class="item">
                      <div class="thumb">
                        <img src="../assets/images/featured-03.jpg" alt="">
                        <div class="hover-effect">
                          <h6>2.4K Streaming</h6>
                        </div>
                      </div>
                      <h4>Island Rusty<br><span>249K Downloads</span></h4>
                      <ul>
                        <li><i class="fa fa-star"></i> 4.8</li>
                        <li><i class="fa fa-download"></i> 2.3M</li>
                      </ul>
                    </div> -->
                  </div>
                </div>
              </div>
              <!-- <div class="col-lg-4">
                <div class="top-downloaded">
                  <div class="heading-section">
                    <h4><em>Top</em> Borrowed</h4>
                  </div>
                  <ul>
                    <li>
                      <img src="../assets/images/game-01.jpg" alt="" class="templatemo-item">
                      <h4>Fortnite</h4>
                      <h6>Sandbox</h6>
                      <span><i class="fa fa-star" style="color: yellow;"></i> 4.9</span>
                      <span><i class="fa fa-download" style="color: #ec6090;"></i> 2.2M</span>
                      <div class="download">
                        <a href="#"><i class="fa fa-download"></i></a>
                      </div>
                    </li>
                    <li>
                      <img src="../assets/images/game-02.jpg" alt="" class="templatemo-item">
                      <h4>CS-GO</h4>
                      <h6>Legendary</h6>
                      <span><i class="fa fa-star" style="color: yellow;"></i> 4.9</span>
                      <span><i class="fa fa-download" style="color: #ec6090;"></i> 2.2M</span>
                      <div class="download">
                        <a href="#"><i class="fa fa-download"></i></a>
                      </div>
                    </li>
                    <li>
                      <img src="../assets/images/game-03.jpg" alt="" class="templatemo-item">
                      <h4>PugG</h4>
                      <h6>Battle Royale</h6>
                      <span><i class="fa fa-star" style="color: yellow;"></i> 4.9</span>
                      <span><i class="fa fa-download" style="color: #ec6090;"></i> 2.2M</span>
                      <div class="download">
                        <a href="#"><i class="fa fa-download"></i></a>
                      </div>
                    </li>
                  </ul>
                </div>
              </div> -->
            </div>
            <!-- ***** Featured Books End ***** -->

            <!-- ***** All Books Start ***** -->
            <div class="live-stream">
              <div class="col-lg-12">
                <div class="heading-section">
                  <h4><em>All</em> Books</h4>
                </div>
              </div>
              <div class="row" id="allbooks">
                <div class="col-lg-3 col-sm-6 text-center">
                  Nothing to show in here!
                </div>
                <!-- <div class="col-lg-3 col-sm-6">
                  <div class="item">
                    <div class="thumb">
                      <img src="../assets/images/stream-01.jpg" alt="">
                      <div class="hover-effect">
                        <div class="content">
                          <div class="live">
                            <a href="#">Live</a>
                          </div>
                          <ul>
                            <li><a href="#"><i class="fa fa-eye"></i> 1.2K</a></li>
                            <li><a href="#"><i class="fa fa-gamepad"></i> CS-GO</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                    <div class="down-content">
                      <div class="avatar">
                        <img src="../assets/images/avatar-01.jpg" alt="" style="max-width: 46px; border-radius: 50%; float: left;">
                      </div>
                      <span><i class="fa fa-check"></i> KenganC</span>
                      <h4>Just Talking With Fans</h4>
                    </div>
                  </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                  <div class="item">
                    <div class="thumb">
                      <img src="../assets/images/stream-02.jpg" alt="">
                      <div class="hover-effect">
                        <div class="content">
                          <div class="live">
                            <a href="#">Live</a>
                          </div>
                          <ul>
                            <li><a href="#"><i class="fa fa-eye"></i> 1.2K</a></li>
                            <li><a href="#"><i class="fa fa-gamepad"></i> CS-GO</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                    <div class="down-content">
                      <div class="avatar">
                        <img src="../assets/images/avatar-02.jpg" alt="" style="max-width: 46px; border-radius: 50%; float: left;">
                      </div>
                      <span><i class="fa fa-check"></i> LunaMa</span>
                      <h4>CS-GO 36 Hours Live Stream</h4>
                    </div>
                  </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                  <div class="item">
                    <div class="thumb">
                      <img src="../assets/images/stream-03.jpg" alt="">
                      <div class="hover-effect">
                        <div class="content">
                          <div class="live">
                            <a href="#">Live</a>
                          </div>
                          <ul>
                            <li><a href="#"><i class="fa fa-eye"></i> 1.2K</a></li>
                            <li><a href="#"><i class="fa fa-gamepad"></i> CS-GO</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                    <div class="down-content">
                      <div class="avatar">
                        <img src="../assets/images/avatar-03.jpg" alt="" style="max-width: 46px; border-radius: 50%; float: left;">
                      </div>
                      <span><i class="fa fa-check"></i> Areluwa</span>
                      <h4>Maybe Nathej Allnight Chillin'</h4>
                    </div>
                  </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                  <div class="item">
                    <div class="thumb">
                      <img src="../assets/images/stream-04.jpg" alt="">
                      <div class="hover-effect">
                        <div class="content">
                          <div class="live">
                            <a href="#">Live</a>
                          </div>
                          <ul>
                            <li><a href="#"><i class="fa fa-eye"></i> 1.2K</a></li>
                            <li><a href="#"><i class="fa fa-gamepad"></i> CS-GO</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                    <div class="down-content">
                      <div class="avatar">
                        <img src="../assets/images/avatar-04.jpg" alt="" style="max-width: 46px; border-radius: 50%; float: left;">
                      </div>
                      <span><i class="fa fa-check"></i> GangTm</span>
                      <h4>Live Streaming Till Morning</h4>
                    </div>
                  </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                  <div class="item">
                    <div class="thumb">
                      <img src="../assets/images/stream-04.jpg" alt="">
                      <div class="hover-effect">
                        <div class="content">
                          <div class="live">
                            <a href="#">Live</a>
                          </div>
                          <ul>
                            <li><a href="#"><i class="fa fa-eye"></i> 1.2K</a></li>
                            <li><a href="#"><i class="fa fa-gamepad"></i> CS-GO</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                    <div class="down-content">
                      <div class="avatar">
                        <img src="../assets/images/avatar-04.jpg" alt="" style="max-width: 46px; border-radius: 50%; float: left;">
                      </div>
                      <span><i class="fa fa-check"></i> GangTm</span>
                      <h4>Live Streaming Till Morning</h4>
                    </div>
                  </div>
                </div> -->
              </div>
            </div>
            <!-- ***** All Books End ***** -->

          </div>
        </div>
      </div>
    </div>

    <footer>
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <p>Copyright © <a href="#">LMS - Library Management System 2022</a>. All rights reserved.</p>
          </div>
        </div>
      </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.32/dist/sweetalert2.all.min.js"></script>
    <script src="../assets/js/isotope.min.js"></script>
    <script src="../assets/js/owl-carousel.js"></script>
    <script src="../assets/js/tabs.js"></script>
    <script src="../assets/js/popup.js"></script>
    <script src="../assets/js/custom.js"></script>
    <script src="../assets/js/auth.js"></script>

    <!-- Page level custom scripts -->
    <script src="../assets/js/browse.js"></script>

  </body>

  </html>

<?php } else { ?>

  <?php include_once("../pages/restricted.page.php"); ?>

<?php } ?>