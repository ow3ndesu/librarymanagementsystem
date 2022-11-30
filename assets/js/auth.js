$(document).ready(function () {
  const attempts = $("#attempts").val();
  if (attempts <= 0) {
    let interval = 30;
    setInterval(function () {
      interval--;
      $('.form-submit-disabled').val(interval);
    }, 1000);

    setTimeout(function() {
      $.ajax({
        url: "routes/auth.route.php",
        type: "POST",
        data: {
          action: "Logout",
        },
        success: function () {
          window.location.reload();
        }
      });
    }, 30000);
  }
});

$("#signinbtn").click(function () {
  const attempts = $("#attempts").val();
  const email = $("#logemail").val();
  const password = $("#logpassword").val();

  if (email === "" || password === "") {
    Swal.fire("Where you goin?", "Please fill all fields!", "error");
  } else if (password.length < 8) {
    Swal.fire(
      "Where you goin?",
      "Passwords must be at least 8 characters!",
      "error"
    );
  } else {
    let formdata = new FormData();
    formdata.append("action", "Login");
    formdata.append("email", email);
    formdata.append("password", password);
    $.ajax({
      url: "routes/auth.route.php",
      type: "POST",
      dataType: "JSON",
      processData: false,
      contentType: false,
      data: formdata,
      beforeSend: function () {
        $(".submit-btn").addClass("spinner-border");
      },
      success: function (res) {
        $("#logpassword").val("");
        if (res.MESSAGE === "LOGIN_SUCCESS") {
          Swal.fire({
            title: "Welcome to LMS!",
            text: "Login Success",
            icon: "success",
            preConfirm: function () {
              $("#login-form")[0].reset();
              $(".submit-btn").removeClass("spinner-border");

              window.location = res.URL;
            },
          });
        } else if (res.MESSAGE === "ACCOUNT_INACTIVE") {
          Swal.fire({
            title: "Oopps!",
            text: "Account is still inactive.",
            icon: "error",
            preConfirm: function () {
              $("#login-form")[0].reset();
              $(".submit-btn").removeClass("spinner-border");
            },
          });
        } else if (res.MESSAGE === "INCORRECT_COMBINATION") {
          $("#attempts").val(res.ATTEMPTS);
          Swal.fire({
            title: "Authentication Error!",
            text: "Username or password do not match! " + res.ATTEMPTS + " attempt/s left.",
            icon: "error",
            preConfirm: function () {
              $("#login-form")[0].reset();
              $(".submit-btn").removeClass("spinner-border");
            },
          }).then(() => {
            if (res.ATTEMPTS == 0) {
              window.location.reload();
            }
          });
        } else if (res.MESSAGE === "NO_USER_FOUND") {
          Swal.fire({
            title: "This account do not exist.",
            text: "Create account first.",
            icon: "error",
            preConfirm: function () {
              $("#login-form")[0].reset();
              $(".submit-btn").removeClass("spinner-border");
            },
          });
        } else if (res.MESSAGE === "ACCOUNT_DEACTIVATED") {
          Swal.fire({
            title: "Oopps!",
            text: "Account is deactivated!",
            icon: "error",
            preConfirm: function () {
              $("#login-form")[0].reset();
              $(".submit-btn").removeClass("spinner-border");
            },
          });
        } else {
          Swal.fire({
            title: "Hey?",
            text: "Something went really wrong.",
            icon: "error",
            preConfirm: function () {
              $("#login-form")[0].reset();
              $(".submit-btn").removeClass("spinner-border");
            },
          });
        }
      },
      error: function (err) {
        console.log(err);
        Swal.fire({
          title: "Hey?",
          text: "Something went really wrong.",
          icon: "error",
          preConfirm: function () {
            $("#login-form")[0].reset();
            $(".submit-btn").removeClass("spinner-border");
          },
        });
      },
    });
  }
});

$("#signupbtn").click(function () {
  const email = $("#email").val();
  const email2 = $("#email2").val();
  const password = $("#pass").val();
  const re_password = $("#re_pass").val();
  const proof = $("#image_proof")[0].files;
  console.log(proof)
  if (email === "" || email2 === "" || password === "" || re_password === "" || proof.length === 0) {
    Swal.fire("Where you goin?", "Please fill all fields!", "error");
  } else if (password !== re_password) {
    Swal.fire(
      "Could you check that again?",
      "Password is not the same!",
      "error"
    );
  } else if (password.length < 8) {
    Swal.fire(
      "Where you goin?",
      "Passwords must be at least 8 characters!",
      "error"
    );
  } else {
    let formdata = new FormData();
    formdata.append("action", "Register");
    formdata.append("email", email);
    formdata.append("email2", email2);
    formdata.append("password", password);
    formdata.append("proof", proof[0]);

    $.ajax({
      url: "routes/auth.route.php",
      type: "POST",
      processData: false,
      contentType: false,
      data: formdata,
      beforeSend: function () {
        $(".submit-btn").addClass("spinner-border");
      },
      success: function (res) {
        if (res === "REGISTER_SUCCESS") {
          Swal.fire({
            title: "Registered Successfully!",
            text: "Please wait for account approval.",
            icon: "success",
            preConfirm: function () {
              $("#register-form")[0].reset();
              $(".submit-btn").removeClass("spinner-border");
              showSignIn();
            },
          });
        } else if (res === "EMAIL_ALREADY_IN_USE") {
          Swal.fire({
            title: "Oopps!",
            text: "Sounds like this email is already associated on an account.",
            icon: "error",
            preConfirm: function () {
              $("#register-form")[0].reset();
              $(".submit-btn").removeClass("spinner-border");
            },
          });
        } else {
          Swal.fire("Hey?", "Something went really wrong.", "error");
        }
      },
      error: function (err) {
        console.log(err);
        Swal.fire("Hey?", "Something went really wrong.", "error");
      },
    });
  }
});

$("#logoutbtn").click(function () {
  Swal.fire({
    title: "Are you sure you want to logout ?",
    showCancelButton: true,
    showLoaderOnConfirm: true,
    confirmButtonText: "Yes",
    cancelButtonText: "No",
    allowOutsideClick: false,
    customClass: {
      input: "text-center",
    },
    preConfirm: (e) => {
      return $.ajax({
        url: "../routes/auth.route.php",
        type: "POST",
        data: {
          action: "Logout",
        },
        success: function (response) {
          if (response != "LOGOUT_SUCCESS") {
            Swal.showValidationMessage(`SOMETHING WENT WRONG.`);
          }
        },
      });
    },
  }).then((result) => {
    if (result.value == "LOGOUT_SUCCESS") {
      window.location.href = "../index.php";
    }
  });
});

function showSignIn() {
  $(".sign-in").show(500);
  $(".signup").hide(500);
}

function showSignUp() {
  $(".signup").show(500);
  $(".sign-in").hide(500);
}

$(".signin-link").on("click", function () {
  showSignIn();
});

$(".signup-link").on("click", function () {
  showSignUp();
});
