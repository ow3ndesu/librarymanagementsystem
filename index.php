<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap 5 CSS-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="assets/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/favicon/favicon-16x16.png">
    <link rel="manifest" href="assets/favicon/site.webmanifest">
    <!-- Material Font -->
    <link rel="stylesheet" href="assets/fonts/material-icon/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" href="assets/css/auth.css">
    <title>LMS - Welcome</title>
</head>

<body class="text-center">
    <input type="hidden" name="attempts" id="attempts" value="<?php session_start(); echo ((isset($_SESSION['attempts'])) ? $_SESSION['attempts'] : 3); ?>">
    <div class="main">

        <!-- Sign up form -->
        <section class="signup hidden">
            <div class="container">
                <div class="signup-content">
                    <div class="signup-form">
                        <h2 class="form-title">Sign up</h2>
                        <form class="register-form" id="register-form">
                            <div class="form-group">
                                <label for="email"><i class="zmdi zmdi-account"></i></label>
                                <input type="text" id="email" placeholder="Username" minlength="4" />
                            </div>
                            <div class="form-group">
                                <label for="email2"><i class="zmdi zmdi-inbox"></i></label>
                                <input type="email" id="email2" placeholder="Email" minlength="4" />
                            </div>
                            <div class="form-group">
                                <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" id="pass" placeholder="Password" minlength="8" />
                            </div>
                            <div class="form-group">
                                <label for="re-pass"><i class="zmdi zmdi-lock-outline"></i></label>
                                <input type="password" id="re_pass" placeholder="Repeat your password" minlength="8" />
                            </div>
                            <div class="form-group">
                                <label for="image_proof"><i class="zmdi zmdi-image-o"></i></label>
                                <input type="file" id="image_proof" accept="image/*"/>
                            </div>
                            <small><b>Please include a photo of your School ID. Thank you.</b></small>
                            <div class="form-group">
                                <input type="checkbox" id="agree-term" class="agree-term" />
                                <label for="agree-term" class="label-agree-term"><span><span></span></span>I agree all statements in <a href="#" class="term-service">Terms of service</a></label>
                            </div>
                            <div class="form-group form-button submit-btn" role="status">
                                <input type="button" id="signupbtn" class="form-submit" value="Register" />
                            </div>
                        </form>
                    </div>
                    <div class="signup-image">
                        <figure><img src="assets/img/signup-image.jpg" alt="sing up image"></figure>
                        <a href="#" class="signup-image-link signin-link">I am already member</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Sign in  Form -->
        <section class="sign-in">
            <div class="container">
                <div class="signin-content">
                    <div class="signin-image">
                        <figure><img src="assets/img/signin-image.jpg" alt="sign up image"></figure>
                    </div>

                    <div class="signin-form">
                        <h2 class="form-title">Sign in</h2>
                        <form class="register-form" id="login-form">
                            <div class="form-group">
                                <label for="email"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" id="logemail" placeholder="Username" minlength="4" />
                            </div>
                            <div class="form-group">
                                <label for="password"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" id="logpassword" placeholder="Password" minlength="8" />
                            </div>
                            <div class="form-group">
                                <input type="checkbox" id="remember-me" class="agree-term" />
                                <label for="remember-me" class="label-agree-term"><span><span></span></span>Remember me</label>
                            </div>
                            <div class="form-group form-button submit-btn" role="status">
                                <input type="button" <?php if ($_SESSION['attempts'] > 0) { ?> id="signinbtn" class="form-submit" <?php } else { ?> class="form-submit-disabled" disabled <?php } ?> value="Log in"/>
                            </div>
                            <a href="#" class="signup-image-link signup-link">Create an account</a>
                        </form>
                    </div>
                </div>
            </div>
        </section>

    </div>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.32/dist/sweetalert2.all.min.js"></script>
    <script src="assets/js/auth.js"></script>
</body>

</html>