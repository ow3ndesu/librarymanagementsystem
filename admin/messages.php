<?php
session_start();

if (isset($_SESSION["admin-auth"])) {

?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>LMS Admin - Messages</title>

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="../assets/favicon/apple-touch-icon.png" />
    <link rel="icon" type="image/png" sizes="32x32" href="../assets/favicon/favicon-32x32.png" />
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/favicon/favicon-16x16.png" />
    <link rel="manifest" href="../assets/favicon/site.webmanifest" />

    <!-- Custom fonts for this template-->
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />

    <!-- Custom styles for this template-->
    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet" />

    <!-- Fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  </head>

  <body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
      <!-- Sidebar -->
      <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
          <div class="sidebar-brand-icon rotate-n-15">
            <img src="../assets/img/logo-darker.svg" alt="" width="40" height="40" />
          </div>
          <div class="sidebar-brand-text mx-3">LMS Admin</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0" />

        <!-- Nav Item - Dashboard -->
        <li class="nav-item">
          <a class="nav-link" href="index.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider" />

        <!-- Heading -->
        <div class="sidebar-heading">Major</div>

        <!-- Nav Item - Borrowals -->
        <li class="nav-item">
          <a class="nav-link" href="borrowals.php">
            <i class="fas fa-fw fa-book-bookmark"></i>
            <span>Borrowals</span></a>
        </li>

        <!-- Nav Item - Returns -->
        <li class="nav-item">
          <a class="nav-link" href="returns.php">
            <i class="fas fa-fw fa-file-invoice"></i>
            <span>Returns</span></a>
        </li>

        <!-- Nav Item - Messages -->
        <li class="nav-item active">
          <a class="nav-link" href="messages.php">
            <i class="fas fa-fw fa-message"></i>
            <span>Messages</span></a>
        </li>

        <!-- Heading -->
        <div class="sidebar-heading">Minor</div>

        <!-- Nav Item - Tables -->
        <li class="nav-item">
          <a class="nav-link" href="books.php">
            <i class="fas fa-fw fa-book"></i>
            <span>Books</span></a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="students.php">
            <i class="fas fa-fw fa-graduation-cap"></i>
            <span>Students</span></a>
        </li>

        <!-- Nav Item - Users -->
        <li class="nav-item">
          <a class="nav-link" href="users.php">
            <i class="fas fa-fw fa-user"></i>
            <span>Users</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block" />

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
          <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>
      </ul>
      <!-- End of Sidebar -->

      <!-- Content Wrapper -->
      <div id="content-wrapper" class="d-flex flex-column">
        <!-- Main Content -->
        <div id="content">
          <!-- Topbar -->
          <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
            <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
              <i class="fa fa-bars"></i>
            </button>

            <!-- Topbar Search -->
            <!-- <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
              <div class="input-group">
                <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" />
                <div class="input-group-append">
                  <button class="btn btn-primary" type="button">
                    <i class="fas fa-search fa-sm"></i>
                  </button>
                </div>
              </div>
            </form> -->

            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">
              <!-- Nav Item - Search Dropdown (Visible Only XS) -->
              <li class="nav-item dropdown no-arrow d-sm-none">
                <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fas fa-search fa-fw"></i>
                </a>

              <div class="topbar-divider d-none d-sm-block"></div>

              <!-- Nav Item - User Information -->
              <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <span class="mr-2 d-none d-lg-inline text-gray-600 small"> <?php echo (isset($_SESSION['fullname']) == true) ? $_SESSION['fullname'] : 'Admin'; ?></span>
                  <img class="img-profile rounded-circle" src="assets/img/undraw_profile.svg" />
                </a>
                <!-- Dropdown - User Information -->
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                  <a class="dropdown-item" href="#">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Profile
                  </a>

                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item logoutbtn">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                  </a>
                </div>
              </li>
            </ul>
          </nav>
          <!-- End of Topbar -->

          <!-- Begin Page Content -->
          <div class="container-fluid">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
              <h1 class="h3 mb-0 text-gray-800">Messages</h1>
              <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate
                Report</a> -->
            </div>

            <div class="card shadow mb-4">
              <div class="card-header py-3 d-flex">
                <h6 class="m-0 font-weight-bold text-primary">
                  Inbox
                </h6>
              </div>
              <div class="card-body">
                <div class="container-fluid" id="inboxcontainer">
                  
                </div>
              </div>
            </div>

            <div class="modal fade" id="messagesModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
              <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId">You've got a chat! Check it out.</h5>
                  </div>
                  <div class="modal-body">
                    <div class="container message-box">
                      <div class="row recieved">
                        <div class="col">
                          <span style=" display: flex; border: 1px solid rgb(219 226 239); border-radius: 10px; width: fit-content; padding: .2rem 1rem .2rem 1rem; flex-wrap: wrap; background-color: rgb(219 226 239);">Reach us out? Type down below.</span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <textarea name="message-input" id="message-input" cols="30" rows="1" class="form-control message-input"></textarea>
                    <input type="hidden" name="reply_to" id="reply_to">
                    <input type="hidden" name="student_id" id="student_id">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="closeMessageModalBtn">Close</button>
                    <button type="button" class="btn btn-primary" id="sendMessageBtn" disabled>Send</button>
                  </div>
                </div>
              </div>
            </div>

          </div>
          <!-- /.container-fluid -->
        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
          <div class="container my-auto">
            <div class="copyright text-center my-auto">
              <span>Copyright &copy; LMS - Library Management System 2022</span>
            </div>
          </div>
        </footer>
        <!-- End of Footer -->
      </div>
      <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="assets/js/sb-admin-2.min.js"></script>

    <!-- All custom scripts -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.32/dist/sweetalert2.all.min.js"></script>
    <script src="assets/js/auth.js"></script>
    <script src="assets/js/inbox.js"></script>
  </body>

  </html>

<?php } else { ?>

  <?php include_once("../pages/restricted.page.php"); ?>

<?php } ?>