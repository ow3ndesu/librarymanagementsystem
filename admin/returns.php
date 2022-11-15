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

    <title>LMS Admin - Returns</title>

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="../assets/favicon/apple-touch-icon.png" />
    <link rel="icon" type="image/png" sizes="32x32" href="../assets/favicon/favicon-32x32.png" />
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/favicon/favicon-16x16.png" />
    <link rel="manifest" href="../assets/favicon/site.webmanifest" />

    <!-- Custom fonts for this template -->
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet" />

    <!-- Custom styles for this page -->
    <link href="assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" />

    <!-- Fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  </head>

  <body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
      <!-- Sidebar -->
      <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.PHP">
          <div class="sidebar-brand-icon rotate-n-15">
            <img src="../assets/img/logo-darker.svg" alt="" width="40" height="40" />
          </div>
          <div class="sidebar-brand-text mx-3">LMS Admin</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0" />

        <!-- Nav Item - Dashboard -->
        <li class="nav-item">
          <a class="nav-link" href="index.PHP">
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
        <li class="nav-item active">
          <a class="nav-link" href="returns.php">
            <i class="fas fa-fw fa-file-invoice"></i>
            <span>Returns</span></a>
        </li>

        <!-- Nav Item - Messages -->
        <li class="nav-item">
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
            <form class="form-inline">
              <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
              </button>
            </form>

            <!-- Topbar Search -->
            <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
              <div class="input-group">
                <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" />
                <div class="input-group-append">
                  <button class="btn btn-primary" type="button">
                    <i class="fas fa-search fa-sm"></i>
                  </button>
                </div>
              </div>
            </form>

            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">
              <!-- Nav Item - Search Dropdown (Visible Only XS) -->
              <li class="nav-item dropdown no-arrow d-sm-none">
                <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fas fa-search fa-fw"></i>
                </a>
                <!-- Dropdown - Messages
                <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                  <form class="form-inline mr-auto w-100 navbar-search">
                    <div class="input-group">
                      <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" />
                      <div class="input-group-append">
                        <button class="btn btn-primary" type="button">
                          <i class="fas fa-search fa-sm"></i>
                        </button>
                      </div>
                    </div>
                  </form>
                </div>
              </li>



              <!-- Nav Item - Messages
              <li class="nav-item dropdown no-arrow mx-1">
                <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fas fa-envelope fa-fw"></i>
                  <!-- Counter - Messages
                  <span class="badge badge-danger badge-counter">7</span>
                </a>
                <!-- Dropdown - Messages
                <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                  <h6 class="dropdown-header">Message Center</h6>
                  <a class="dropdown-item d-flex align-items-center" href="#">
                    <div class="dropdown-list-image mr-3">
                      <img class="rounded-circle" src="img/undraw_profile_1.svg" alt="..." />
                      <div class="quantity-indicator bg-success"></div>
                    </div>
                    <div class="font-weight-bold">
                      <div class="text-truncate">
                        Hi there! I am wondering if you can help me with a
                        problem I've been having.
                      </div>
                      <div class="small text-gray-500">Emily Fowler · 58m</div>
                    </div>
                  </a>
                  <a class="dropdown-item d-flex align-items-center" href="#">
                    <div class="dropdown-list-image mr-3">
                      <img class="rounded-circle" src="img/undraw_profile_2.svg" alt="..." />
                      <div class="quantity-indicator"></div>
                    </div>
                    <div>
                      <div class="text-truncate">
                        I have the photos that you ordered last month, how would
                        you like them sent to you?
                      </div>
                      <div class="small text-gray-500">Jae Chun · 1d</div>
                    </div>
                  </a>
                  <a class="dropdown-item d-flex align-items-center" href="#">
                    <div class="dropdown-list-image mr-3">
                      <img class="rounded-circle" src="img/undraw_profile_3.svg" alt="..." />
                      <div class="quantity-indicator bg-warning"></div>
                    </div>
                    <div>
                      <div class="text-truncate">
                        Last month's report looks great, I am very happy with
                        the progress so far, keep up the good work!
                      </div>
                      <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                    </div>
                  </a>
                  <a class="dropdown-item d-flex align-items-center" href="#">
                    <div class="dropdown-list-image mr-3">
                      <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60" alt="..." />
                      <div class="quantity-indicator bg-success"></div>
                    </div>
                    <div>
                      <div class="text-truncate">
                        Am I a good boy? The reason I ask is because someone
                        told me that people say this to all dogs, even if they
                        aren't good...
                      </div>
                      <div class="small text-gray-500">
                        Chicken the Dog · 2w
                      </div>
                    </div>
                  </a>
                  <a class="dropdown-item text-center small text-gray-500" href="messages.php">Read More Messages</a>
                </div>
              </li>

              <div class="topbar-divider d-none d-sm-block"></div>

              <!-- Nav Item - User Information -->
              <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <span class="mr-2 d-none d-lg-inline text-gray-600 small"> <?php echo $_SESSION['fullname']; ?></span>
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
            <h1 class="h3 mb-2 text-gray-800">Returns</h1>

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
              <div class="card-header py-3 d-flex">
                <h6 class="m-0 font-weight-bold text-primary">
                  Successful and Incoming Returns
                </h6>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-bordered text-center" id="returnstable" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th>Borrow ID</th>
                        <th>Book</th>
                        <th>Student</th>
                        <th>Filed</th>
                        <th>Due</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody id="returnsTableBody">

                    </tbody>
                    <tfoot>
                      <tr>
                        <th>Borrow ID</th>
                        <th>Book</th>
                        <th>Student</th>
                        <th>Filed</th>
                        <th>Due</th>
                        <th>Action</th>
                      </tr>
                    </tfoot>
                    <tbody></tbody>
                  </table>
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

    <!-- Modal -->
    <div class="modal fade bd-example-modal-lg" id="updateReturnModal" tabindex="-1" role="dialog" aria-labelledby="updateReturnModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="updateReturnModalLabel">View Return</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-12">
                <h5 class="text-center">Borrow Details</h5>
                <div class="row my-2">
                  <div class="col-md-4 pt-1 pl-lg-4 pr-0">
                    <label for="borrow_id">Borrow ID.</label>
                    <label class="float-right">:</label>
                  </div>
                  <div class="col-md-8">
                    <input type="text" class="form-control" id="borrow_id" readonly>
                  </div>
                </div>
                <div class="row my-2">
                  <div class="col-md-4 pt-1 pl-lg-4 pr-0">
                    <label for="filed">Filed</label>
                    <label class="float-right">:</label>
                  </div>
                  <div class="col-md-8">
                    <input type="text" class="form-control" id="filed" readonly>
                  </div>
                </div>
                <div class="row my-2">
                  <div class="col-md-4 pt-1 pl-lg-4 pr-0">
                    <label for="due">Due</label>
                    <label class="float-right">:</label>
                  </div>
                  <div class="col-md-8">
                    <input type="text" class="form-control" id="due" readonly>
                  </div>
                </div>
                <div class="row my-2">
                  <div class="col-md-4 pt-1 pl-lg-4 pr-0">
                    <label for="status">Status</label>
                    <label class="float-right">:</label>
                  </div>
                  <div class="col-md-8">
                    <input type="text" class="form-control" id="status" readonly>
                  </div>
                </div>
                <div class="row my-2">
                  <div class="col-md-4 pt-1 pl-lg-4 pr-0">
                    <label for="modify_by">Modify by</label>
                    <label class="float-right">:</label>
                  </div>
                  <div class="col-md-8">
                    <input type="text" class="form-control" id="modify_by" readonly>
                  </div>
                </div>
                <div class="row my-2">
                  <div class="col-md-4 pt-1 pl-lg-4 pr-0">
                    <label for="modify_at">Modify at</label>
                    <label class="float-right">:</label>
                  </div>
                  <div class="col-md-8">
                    <input type="text" class="form-control" id="modify_at" readonly>
                  </div>
                </div>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-6">
                <h5 class="text-center">Student Details</h5>
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
                    <label for="user_id">User ID</label>
                    <label class="float-right">:</label>
                  </div>
                  <div class="col-md-8">
                    <input type="text" class="form-control" id="user_id" readonly>
                  </div>
                </div>
                <div class="row my-2">
                  <div class="col-md-4 pt-1 pl-lg-4 pr-0">
                    <label for="fullname">Fullname</label>
                    <label class="float-right">:</label>
                  </div>
                  <div class="col-md-8">
                    <input type="text" class="form-control" id="fullname" readonly>
                  </div>
                </div>
                <div class="row my-2">
                  <div class="col-md-4 pt-1 pl-lg-4 pr-0">
                    <label for="email">Email</label>
                    <label class="float-right">:</label>
                  </div>
                  <div class="col-md-8">
                    <input type="text" class="form-control" id="email" readonly>
                  </div>
                </div>
                <div class="row my-2">
                  <div class="col-md-4 pt-1 pl-lg-4 pr-0">
                    <label for="address">Address</label>
                    <label class="float-right">:</label>
                  </div>
                  <div class="col-md-8">
                    <input type="text" class="form-control" id="address" readonly>
                  </div>
                </div>
                <div class="row my-2">
                  <div class="col-md-4 pt-1 pl-lg-4 pr-0">
                    <label for="contact_no">Contact No</label>
                    <label class="float-right">:</label>
                  </div>
                  <div class="col-md-8">
                    <input type="text" class="form-control" id="contact_no" readonly>
                  </div>
                </div>
                <div class="row my-2">
                  <div class="col-md-4 pt-1 pl-lg-4 pr-0">
                    <label for="registration_date">Date</label>
                    <label class="float-right">:</label>
                  </div>
                  <div class="col-md-8">
                    <input type="text" class="form-control" id="registration_date" readonly>
                  </div>
                </div>
              </div>
              <div class="col-6">
                <h5 class="text-center">Book Details</h5>
                <div class="row my-2">
                  <div class="col-md-4 pt-1 pl-lg-4 pr-0">
                    <label for="newbook_id">Book ID.</label>
                    <label class="float-right">:</label>
                  </div>
                  <div class="col-md-8">
                    <input type="text" class="form-control" id="newbook_id" readonly>
                  </div>
                </div>
                <div class="row my-2">
                  <div class="col-md-4 pt-1 pl-lg-4 pr-0">
                    <label for="newtitle">Title</label>
                    <label class="float-right">:</label>
                  </div>
                  <div class="col-md-8">
                    <input type="text" class="form-control" id="newtitle" readonly>
                  </div>
                </div>
                <div class="row my-2">
                  <div class="col-md-4 pt-1 pl-lg-4 pr-0">
                    <label for="newauthor">Author</label>
                    <label class="float-right">:</label>
                  </div>
                  <div class="col-md-8">
                    <input type="text" class="form-control" id="newauthor" readonly>
                  </div>
                </div>
                <div class="row my-2">
                  <div class="col-md-4 pt-1 pl-lg-4 pr-0">
                    <label for="newdescription">Description</label>
                    <label class="float-right">:</label>
                  </div>
                  <div class="col-md-8">
                    <textarea class="form-control" id="newdescription" readonly></textarea>
                  </div>
                </div>
                <div class="row my-2">
                  <div class="col-md-4 pt-1 pl-lg-4 pr-0">
                    <label for="newquantity">Quantity</label>
                    <label class="float-right">:</label>
                  </div>
                  <div class="col-md-8">
                    <input type="number" class="form-control" id="newquantity" readonly>
                  </div>
                </div>
                <div class="row my-2">
                  <div class="col-md-4 pt-1 pl-lg-4 pr-0">
                    <label for="newstatus">Status</label>
                    <label class="float-right">:</label>
                  </div>
                  <div class="col-md-8">
                    <!-- <input type="text" class="form-control" id="status"> -->
                    <select class="form-control" name="status" id="newstatus" disabled>
                      <option value="ACTIVE">Active</option>
                      <option value="INACTIVE">Inactive</option>
                    </select>
                  </div>
                </div>
                <div class="row my-2">
                  <div class="col-md-4 pt-1 pl-lg-4 pr-0">
                    <label for="date">Date</label>
                    <label class="float-right">:</label>
                  </div>
                  <div class="col-md-8">
                    <input type="text" class="form-control" id="date" readonly>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary btn-block my-auto" id="approveReturnBtn">Approve Return</button>
            <button type="button" class="btn btn-secondary btn-block" id="disapproveReturnBtn">Disapprove Return</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="assets/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="assets/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="assets/js/returns.js"></script>

    <!-- All custom scripts -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.32/dist/sweetalert2.all.min.js"></script>
    <script src="assets/js/auth.js"></script>
  </body>

  </html>


<?php } else { ?>

  <?php include_once("../pages/restricted.page.php"); ?>

<?php } ?>