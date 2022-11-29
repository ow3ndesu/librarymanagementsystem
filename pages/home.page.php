<?php
session_start();

if (isset($_SESSION["authenticated"])) {

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

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
        <title>LMS - Home</title>
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
                             
                            <!-- ***** Search End ***** -->
                            <!-- ***** Menu Start ***** -->
                            <ul class="nav">
                                <li><a href="#" class="active">Home</a></li>
                                <li><a href="browse.page.php">Browse</a></li>
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

                        <!-- ***** Banner Start ***** -->
                        <div class="main-banner">
                            <div class="row">
                                <div class="col-lg-7">
                                    <div class="header-text">
                                        <h6>Welcome To LMS</h6>
                                        <h4><em>Browse</em> Our Popular Books Here</h4>
                                        <div class="main-button">
                                            <a href="browse.page.php">Browse Now</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- ***** Banner End ***** -->
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

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.32/dist/sweetalert2.all.min.js"></script>
        <script src="../assets/js/isotope.min.js"></script>
        <script src="../assets/js/owl-carousel.js"></script>
        <script src="../assets/js/tabs.js"></script>
        <script src="../assets/js/popup.js"></script>
        <script src="../assets/js/custom.js"></script>
        <script src="../assets/js/auth.js"></script>
        <?php 
            if ($_SESSION['isCompleted'] != 1) {
                echo '<script>
                    Swal.fire({
                        title: \'Let us take a moment and complete your profile.\',
                        text: "Please proceed to profile.",
                        icon: \'info\',
                        confirmButtonColor: \'#3085d6\',
                        confirmButtonText: \'Okay\',
                        allowOutsideClick: false
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = \'profile.page.php\';
                        }
                    })
                </script>';
            }
        ?>
    </body>

    </html>

<?php } else { ?>

    <?php include_once("../pages/restricted.page.php"); ?>

<?php } ?>