$("#signinbtn").click(function () {
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
            title: "Welcome to SFA!",
            text: "Login Success",
            icon: "success",
            preConfirm: function () {
              $("#login-form")[0].reset();
              $(".submit-btn").removeClass("spinner-border");

              window.location = res.URL;
            },
          });
        } else if (res.MESSAGE === "ACCOUNT_PENDING") {
          Swal.fire({
            title: "Oopps!",
            text: "Account is still pending.",
            icon: "error",
            preConfirm: function () {
              $("#login-form")[0].reset();
              $(".submit-btn").removeClass("spinner-border");
            },
          });
        } else if (res.MESSAGE === "INCORRECT_PASSWORD") {
          Swal.fire({
            title: "Oopps!",
            text: "Authentication Failed!",
            icon: "error",
            preConfirm: function () {
              $("#login-form")[0].reset();
              $(".submit-btn").removeClass("spinner-border");
            },
          });
        } else if (res.MESSAGE === "NO_USER_FOUND") {
          Swal.fire({
            title: "Oopps! Create an account first!",
            text: "Authentication Failed!",
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
  const password = $("#pass").val();
  const re_password = $("#re_pass").val();

  if (email === "" || password === "" || re_password === "") {
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
    formdata.append("password", password);

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
