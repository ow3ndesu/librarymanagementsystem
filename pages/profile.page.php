<?php
session_start();

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
    <title>LMS - Profile</title>
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
                <li><a href="home.page.php">Home</a></li>
                <li><a href="browse.page.php">Browse</a></li>
                <li><a href="#" id="logoutbtn">Logout</a></li>
                <li><a href="#" class="active">Profile <img src="../assets/images/profile-header.jpg" alt=""></a></li>
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

            <!-- ***** Banner Start ***** -->
            <div class="row">
              <div class="col-lg-12">
                <div class="main-profile ">
                  <div class="row">
                    <div class="col-lg-4">
                      <img src="../assets/images/profile.jpg" alt="" style="border-radius: 23px;">
                    </div>
                    <div class="col-lg-4 align-self-center">
                      <div class="main-info header-text">
                        <span>Online</span>
                        <h4 id="profileIdentity">Loading...</h4>
                        <p id="profileRemarks">You Haven't Completed Your Account yet. Go Complete It By Clicking The Button Below.</p>
                        <div class="main-border-button" id="profileActionButton">
                          <a href="#" onclick="openCompleteProfileModal()">Complete Profile</a>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-4 align-self-center">
                      <ul>
                        <li>Books Borrowed <span id="borrowedcount">3</span></li>
                        <li>Books Returned <span id="returnedcount">16</span></li>
                        <li>Profile Status <span id="status">Incomplete</span></li>
                        <li>Can Borrow <span id="eligible">No</span></li>
                      </ul>
                    </div>
                  </div>

                </div>
              </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="completeProfileModal" tabindex="-1" aria-labelledby="completeProfileModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="completeProfileModalLabel">Complete Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <form id="completeProfileForm" action="javascript:void(0)" method="post">
                    <div class="modal-body">
                      <div class="row my-2">
                        <div class="col-md-4 pt-1 pl-lg-4 pr-0">
                          <label for="student_id">Student ID.</label>
                          <label class="float-right">:</label>
                        </div>
                        <div class="col-md-8">
                          <input type="text" class="form-control" id="student_id" readonly>
                        </div>
                      </div>
                      <div class="row my-2">
                        <div class="col-md-4 pt-1 pl-lg-4 pr-0">
                          <label for="firstname">Firstname</label>
                          <label class="float-right">:</label>
                        </div>
                        <div class="col-md-8">
                          <input type="text" class="form-control" id="firstname" minlength="2" required>
                        </div>
                      </div>
                      <div class="row my-2">
                        <div class="col-md-4 pt-1 pl-lg-4 pr-0">
                          <label for="middlename">Middlename</label>
                          <label class="float-right">:</label>
                        </div>
                        <div class="col-md-8">
                          <input type="text" class="form-control" id="middlename" minlength="4" required>
                        </div>
                      </div>
                      <div class="row my-2">
                        <div class="col-md-4 pt-1 pl-lg-4 pr-0">
                          <label for="lastname">Lastname</label>
                          <label class="float-right">:</label>
                        </div>
                        <div class="col-md-8">
                          <input type="text" class="form-control" id="lastname" minlength="4" required>
                        </div>
                      </div>
                      <div class="row my-2">
                        <div class="col-md-4 pt-1 pl-lg-4 pr-0">
                          <label for="address">Address</label>
                          <label class="float-right">:</label>
                        </div>
                        <div class="col-md-8">
                          <input type="text" class="form-control" id="address" minlength="4" required>
                        </div>
                      </div>
                      <div class="row my-2">
                        <div class="col-md-4 pt-1 pl-lg-4 pr-0">
                          <label for="contact_no">Contact No</label>
                          <label class="float-right">:</label>
                        </div>
                        <div class="col-md-8">
                          <input type="tel" class="form-control" id="contact_no" placeholder="09xxxxxxxxx" pattern="[0]{1}[9]{1}[0-9]{2}[0-9]{3}[0-9]{4}" minlength="11" required>
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <!-- ***** Banner End ***** -->

            <!-- ***** Gaming Library Start ***** -->
            <div class="gaming-library profile-library">
              <div class="col-lg-12">
                <div class="heading-section">
                  <h4>Library</h4>
                </div>
                <div id="libraysection">
                  <div class="item">
                    <ul class="text-center">
                      <li>Nothing in here!</li>
                    </ul>
                  </div>
                  <!-- <div class="item">
                    <ul>
                      <li><img src="../assets/images/game-01.jpg" alt="" class="templatemo-item"></li>
                      <li>
                        <h4>Dota 2</h4><span>Sandbox</span>
                      </li>
                      <li>
                        <h4>Date Filed</h4><span>24/08/2036</span>
                      </li>
                      <li>
                        <h4>Due Date</h4><span>05/29/2087</span>
                      </li>
                      <li>
                        <h4>Currently</h4><span>Borrowed</span>
                      </li>
                      <li>
                        <div class="main-border-button border-no-active"><a href="#">Return</a></div>
                      </li>
                    </ul>
                  </div>
                  <div class="item">
                    <ul>
                      <li><img src="../assets/images/game-02.jpg" alt="" class="templatemo-item"></li>
                      <li>
                        <h4>Fortnite</h4><span>Sandbox</span>
                      </li>
                      <li>
                        <h4>Date Filed</h4><span>22/06/2036</span>
                      </li>
                      <li>
                        <h4>Due Date</h4><span>05/29/2087</span>
                      </li>
                      <li>
                        <h4>Currently</h4><span>Borrowed</span>
                      </li>
                      <li>
                        <div class="main-border-button border-no-active"><a href="#">Return</a></div>
                      </li>
                    </ul>
                  </div>
                  <div class="item last-item">
                    <ul>
                      <li><img src="../assets/images/game-03.jpg" alt="" class="templatemo-item"></li>
                      <li>
                        <h4>CS-GO</h4><span>Sandbox</span>
                      </li>
                      <li>
                        <h4>Date Filed</h4><span>21/04/2022</span>
                      </li>
                      <li>
                        <h4>Due Date</h4><span>05/29/2087</span>
                      </li>
                      <li>
                        <h4>Currently</h4><span>Borrowed</span>
                      </li>
                      <li>
                        <div class="main-border-button border-no-active"><a href="#">Return</a></div>
                      </li>
                    </ul>
                  </div> -->
                </div>
              </div>
            </div>
            <!-- ***** Gaming Library End ***** -->
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.js" integrity="sha512-CX7sDOp7UTAq+i1FYIlf9Uo27x4os+kGeoT7rgwvY+4dmjqV0IuE/Bl5hVsjnQPQiTOhAX1O2r2j5bjsFBvv/A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.32/dist/sweetalert2.all.min.js"></script>
    <script src="../assets/js/isotope.min.js"></script>
    <script src="../assets/js/owl-carousel.js"></script>
    <script src="../assets/js/tabs.js"></script>
    <script src="../assets/js/popup.js"></script>
    <script src="../assets/js/custom.js"></script>
    <script src="../assets/js/auth.js"></script>

    <!-- Page level custom scripts -->
    <script src="../assets/js/profile.js"></script>
  </body>

  </html>

<?php } else { ?>

  <?php include_once("../pages/restricted.page.php"); ?>

<?php } ?>