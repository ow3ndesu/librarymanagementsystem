<html lang="en">

<head>
    <title>Oops..</title>
    <link href="../assets/img/logo.svg" rel="icon">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.32/dist/sweetalert2.all.min.js"></script>
    <script>
        Swal.fire({
            title: 'Are you sure you are in the right place?',
            text: "You are trying to access a page not for you, please log-in.",
            icon: 'warning',
            showLoaderOnConfirm: true,
            confirmButtonText: 'Okay',
            allowOutsideClick: false,
            preConfirm: (e) => {
                window.location.href = "../index.php"
            },
        })
    </script>

</body>

</html>