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

    <title>LMS Admin - Books</title>

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
        <li class="nav-item">
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
        <li class="nav-item active">
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
            <h1 class="h3 mb-2 text-gray-800">Books</h1>

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
              <div class="card-header py-3 d-flex">
                <h6 class="m-0 font-weight-bold text-primary">
                  Available Books
                </h6>
                <button type="button" class="btn btn-primary ml-auto" id="addBookModalBtn" data-bs-toggle="modal" data-bs-target="#addBookModal">Add Book</button>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-bordered text-center" id="bookstable" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th>Book ID</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Quantity</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody id="booksTableBody">

                    </tbody>
                    <!-- <tfoot>
                      <tr>
                        <th>Book ID</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Quantity</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </tfoot> -->
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
    <div class="modal fade" id="addBookModal" tabindex="-1" role="dialog" aria-labelledby="addBookModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="addBookModalLabel">Add Book</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form id="addBookForm" action="javascript:void(0);" method="POST">
            <div class="modal-body">
              <div class="row my-2">
                <div class="col-md-4 pt-1 pl-lg-4 pr-0">
                  <label for="image">Image</label>
                  <label class="float-right">:</label>
                </div>
                <div class="col-md-8">
                  <input type="file" class="form-control" id="image" accept="image/*" required>
                </div>
              </div>
              <div class="row my-2">
                <div class="col-md-4 pt-1 pl-lg-4 pr-0">
                  <label for="copy">Soft Copy</label>
                  <label class="float-right">:</label>
                </div>
                <div class="col-md-8">
                  <input type="file" class="form-control" id="copy" accept="application/pdf" required>
                </div>
              </div>
              <div class="row my-2">
                <div class="col-md-4 pt-1 pl-lg-4 pr-0">
                  <label for="book_id">Book ID.</label>
                  <label class="float-right">:</label>
                </div>
                <div class="col-md-8">
                  <input type="text" class="form-control" id="book_id" value="Automatically Assigned" disabled>
                </div>
              </div>
              <div class="row my-2">
                <div class="col-md-4 pt-1 pl-lg-4 pr-0">
                  <label for="title">Title</label>
                  <label class="float-right">:</label>
                </div>
                <div class="col-md-8">
                  <input type="text" class="form-control" id="title" minlength="2" required>
                </div>
              </div>
              <div class="row my-2">
                <div class="col-md-4 pt-1 pl-lg-4 pr-0">
                  <label for="author">Author</label>
                  <label class="float-right">:</label>
                </div>
                <div class="col-md-8">
                  <input type="text" class="form-control" id="author" minlength="4" required>
                </div>
              </div>
              <div class="row my-2">
                <div class="col-md-4 pt-1 pl-lg-4 pr-0">
                  <label for="description">Description</label>
                  <label class="float-right">:</label>
                </div>
                <div class="col-md-8">
                  <textarea class="form-control" id="description" minlength="8" required></textarea>
                </div>
              </div>
              <div class="row my-2">
                <div class="col-md-4 pt-1 pl-lg-4 pr-0">
                  <label for="quantity">Quantity</label>
                  <label class="float-right">:</label>
                </div>
                <div class="col-md-8">
                  <input type="number" class="form-control" id="quantity" min="1" required>
                </div>
              </div>
              <div class="row my-2">
                <div class="col-md-4 pt-1 pl-lg-4 pr-0">
                  <label for="status">Status</label>
                  <label class="float-right">:</label>
                </div>
                <div class="col-md-8">
                  <!-- <input type="text" class="form-control" id="status"> -->
                  <select class="form-control" name="status" id="status" required>
                    <option value="ACTIVE">Active</option>
                    <option value="INACTIVE">Inactive</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary">Add Book</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="modal fade" id="updateBookModal" tabindex="-1" role="dialog" aria-labelledby="updateBookModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="updateBookModalLabel">Edit Book</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form id="updateBookForm" action="javascript:void(0);" method="POST">
            <div class="modal-body">
              <div class="row my-2">
                <div class="col-md-12 text-center" id="book_image">
                  <img src="../assets/uploaded/images/BOOK000NMXZ37-kjbsakjbdkabv.jpg" width="relative" height="100px" alt="book">
                </div>
              </div>
              <div class="row my-2">
                <div class="col-md-12 text-center" id="viewSoftCopyViewer">
                </div>
              </div>
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
                  <input type="text" class="form-control" id="newtitle" minlength="2" required>
                </div>
              </div>
              <div class="row my-2">
                <div class="col-md-4 pt-1 pl-lg-4 pr-0">
                  <label for="newauthor">Author</label>
                  <label class="float-right">:</label>
                </div>
                <div class="col-md-8">
                  <input type="text" class="form-control" id="newauthor" minlength="4" required>
                </div>
              </div>
              <div class="row my-2">
                <div class="col-md-4 pt-1 pl-lg-4 pr-0">
                  <label for="newdescription">Description</label>
                  <label class="float-right">:</label>
                </div>
                <div class="col-md-8">
                  <textarea class="form-control" id="newdescription" minlength="8" required></textarea>
                </div>
              </div>
              <div class="row my-2">
                <div class="col-md-4 pt-1 pl-lg-4 pr-0">
                  <label for="newquantity">Quantity</label>
                  <label class="float-right">:</label>
                </div>
                <div class="col-md-8">
                  <input type="number" class="form-control" id="newquantity" min="1" required>
                </div>
              </div>
              <div class="row my-2">
                <div class="col-md-4 pt-1 pl-lg-4 pr-0">
                  <label for="newstatus">Status</label>
                  <label class="float-right">:</label>
                </div>
                <div class="col-md-8">
                  <!-- <input type="text" class="form-control" id="status"> -->
                  <select class="form-control" name="status" id="newstatus" required>
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
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary">Save Changes</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="modal fade" id="viewBookModal" tabindex="-1" role="dialog" aria-labelledby="modalBookTitle" aria-hidden="true">
      <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalBookTitle"></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <iframe frameborder="0" width="100%" height="480px"></iframe>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
    <script src="assets/js/books.js"></script>

    <!-- All custom scripts -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.32/dist/sweetalert2.all.min.js"></script>
    <script src="assets/js/auth.js"></script>
  </body>

  </html>


<?php } else { ?>

  <?php include_once("../pages/restricted.page.php"); ?>

<?php } ?>