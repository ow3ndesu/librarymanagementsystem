$(document).ready(function () {
    loadEverything();
});

var student_id = null;

function loadEverything() {
    loadStudentID();
    loadProfile();
}

function loadStudentID() {
    $.ajax({
        url: "../routes/auth.route.php",
        type: "POST",
        dataType: "JSON",
        data: {
            action: "LoadProfile",
        },
        beforeSend: function () {
            console.log("loading ID...");
        },
        success: function (response) {
            console.log(response);
        },
        error: function (error) {
            console.log(error);
        },
    });
}

function loadProfile() {
    $.ajax({
        url: "../routes/profile.route.php",
        type: "POST",
        dataType: "JSON",
        data: {
            action: "LoadProfile",
        },
        beforeSend: function () {
            console.log("loading profile...");
        },
        success: function (response) {
            console.log(response);
            if (response.MESSAGE == "PROFILE_LOADED") {
                response.PROFILE.forEach((element) => {
                    student_id = element.student_id;

                    if (element.firstname == "" || element.lastname == "") {
                        $("#profileIdentity").empty().text(element.student_id);
                    } else {
                        $("#profileIdentity")
                            .empty()
                            .text(element.firstname + " " + element.lastname);
                    }

                    $("#borrowedcount").empty().text(element.borrowedcount);
                    $("#returnedcount").empty().text(element.returnedcount);

                    if (element.is_completed == 0) {
                        $("#status").empty().text("Incomplete");
                        $("#eligible").empty().text("No");

                        $("#profileActionButton").empty().append(`
                            <a href="#" onclick="openCompleteProfileModal()">Complete Profile</a>
                        `);
                        $("#profileRemarks")
                            .empty()
                            .text(
                                "You Haven't Completed Your Account yet. Go Complete It By Clicking The Buutton Below."
                            );
                        $("#student_id").val(element.student_id);
                        $("#firstname").val(element.firstname);
                        $("#middlename").val(element.middlename);
                        $("#lastname").val(element.lastname);
                        $("#address").val(element.address);
                        $("#contact_no").val(element.contact_no);

                        // loadBorrowedBooks(element.student_id);
                    } else {
                        loadBorrowedBooks();

                        $("#status").empty().text("Completed");
                        $("#eligible").empty().text("Yes");

                        $("#profileActionButton").empty().append(`
                            <a href="browse.page.php">Browse Books</a>
                        `);
                        $("#profileRemarks")
                            .empty()
                            .text(
                                "What's your pick for today? Go Browse Our Library By Clicking The Buutton Below."
                            );
                    }
                });
            } else {
                console.log("sus! how did u get in?");
            }
        },
        error: function (error) {
            console.log(error);
        },
    });
}

function loadBorrowedBooks() {
    $.ajax({
        url: "../routes/borrowals.route.php",
        type: "POST",
        dataType: "JSON",
        data: {
            action: "LoadMyBorrowals",
            student_id: student_id,
        },
        beforeSend: function () {
            console.log("loading borrowals...");
        },
        success: function (response) {
            console.log(response);
            if (response.MESSAGE == "BORROWALS_LOADED") {
                $("#libraysection").empty();
                response.BORROWALS.forEach((element) => {
                    const actionbtn =
                        element.status == "PENDING"
                            ? '<a href="#" onclick="cancelBorrowal(\'' +
                              element.borrow_id +
                              "')\">Cancel</a>"
                            : '<a href="#" onclick="returnBorrowal(\'' +
                              element.borrow_id +
                              "')\">Return</a>";
                    $("#libraysection").append(
                        `
                        <div class="item">
                            <ul>
                            <li><img src="../assets/images/game-01.jpg" alt="" class="templatemo-item"></li>
                            <li>
                                <h4>` +
                            element.title +
                            `</h4><span>Sandbox</span>
                            </li>
                            <li>
                                <h4>Date Filed</h4><span>` +
                            element.filed +
                            `</span>
                            </li>
                            <li>
                                <h4>Due Date</h4><span>` +
                            element.due +
                            `</span>
                            </li>
                            <li>
                                <h4>Currently</h4><span>` +
                            element.status +
                            `</span>
                            </li>
                            <li>
                                <div class="main-border-button border-no-active">` +
                            actionbtn +
                            `</div>
                            </li>
                            </ul>
                        </div>
                    `
                    );
                });
            } else {
                $("#libraysection")
                    .empty()
                    .append(
                        `
                    <div class="item">
                        <ul class="text-center">
                        <li>Nothing in here!</li>
                        </ul>
                    </div>
                `
                    );
            }
        },
        error: function (error) {
            console.log(error);
        },
    });
}

function updateProfile(
    student_id,
    firstname,
    middlename,
    lastname,
    address,
    contact_no
) {
    $.ajax({
        url: "../routes/profile.route.php",
        type: "POST",
        data: {
            action: "UpdateProfile",
            student_id: student_id,
            firstname: firstname,
            middlename: middlename,
            lastname: lastname,
            address: address,
            contact_no: contact_no,
        },
        beforeSend: function () {
            console.log("updating profile...");
        },
        success: function (response) {
            return response;
        },
        error: function (err) {
            console.log(err);
        },
    });
}

function EditBorrowalStatus(borrow_id, status, student_id) {
    $.ajax({
        url: "../routes/borrowals.route.php",
        type: "POST",
        data: {
            action: "EditMyBorrowalStatus",
            borrow_id: borrow_id,
            status: status,
            student_id: student_id,
        },
        beforeSend: function () {
            console.log("editing status...");
        },
        success: function (response) {
            return response;
        },
        error: function (err) {
            console.log(err);
        },
    });
}

// TRIGGERED FUNCCTIONS
function openCompleteProfileModal() {
    $("#completeProfileModal").modal("show"),
        $("#contact_no").on("input", function (e) {
            $(this).val(
                $(this)
                    .val()
                    .replace(/[^0-9]/g, "")
            );
        }),
        $("#completeProfileForm")
            .unbind("submit")
            .submit(function () {
                const student_id = $("#student_id").val();
                const firstname = $("#firstname").val();
                const middlename = $("#middlename").val();
                const lastname = $("#lastname").val();
                const address = $("#address").val();
                const contact_no = $("#contact_no").val();

                if (
                    student_id == "" ||
                    firstname == "" ||
                    middlename == "" ||
                    lastname == "" ||
                    address == "" ||
                    contact_no == ""
                ) {
                    Swal.fire("Eek!", "Please complete the form!", "error");
                } else {
                    Swal.fire({
                        title: "Update Profile?",
                        icon: "question",
                        showCancelButton: true,
                        showLoaderOnConfirm: true,
                        confirmButtonText: "Yes",
                        cancelButtonText: "No",
                        allowOutsideClick: false,
                        customClass: {
                            input: "text-center",
                        },
                        preConfirm: (e) => {
                            return updateProfile(
                                student_id,
                                firstname,
                                middlename,
                                lastname,
                                address,
                                contact_no
                            );
                        },
                    }).then((result) => {
                        if (result.isDismissed) {
                            Swal.fire(
                                "Backin' out?",
                                "Nothing Changes!",
                                "info"
                            );
                        } else {
                            if (result.value != true) {
                                Swal.fire(
                                    "Eek!",
                                    "Something went wrong?",
                                    "error"
                                );
                            } else {
                                Swal.fire(
                                    "Hooray!",
                                    "Profile Updated!",
                                    "success"
                                ).then(() => {
                                    $("#completeProfileModal").modal("hide"),
                                        loadEverything();
                                });
                            }
                        }
                    });
                }
            });
}

function cancelBorrowal(borrow_id) {
    Swal.fire({
        title: "Cancel Borrowal?",
        icon: "question",
        showCancelButton: true,
        showLoaderOnConfirm: true,
        confirmButtonText: "Yes",
        cancelButtonText: "No",
        allowOutsideClick: false,
        customClass: {
            input: "text-center",
        },
        preConfirm: (e) => {
            return EditBorrowalStatus(borrow_id, "CANCELED", student_id);
        },
    }).then((result) => {
        if (result.isDismissed) {
            Swal.fire("Backin' out?", "Nothing Changes!", "info");
        } else {
            if (result.value != true) {
                Swal.fire("Eek!", "Something went wrong?", "error");
            } else {
                Swal.fire("Hooray!", "Status Updated!", "success").then(() => {
                    loadBorrowedBooks();
                });
            }
        }
    });
}

function returnBorrowal(borrow_id) {
    Swal.fire({
        title: "Return This Book?",
        icon: "question",
        showCancelButton: true,
        showLoaderOnConfirm: true,
        confirmButtonText: "Yes",
        cancelButtonText: "No",
        allowOutsideClick: false,
        customClass: {
            input: "text-center",
        },
        preConfirm: (e) => {
            return EditBorrowalStatus(borrow_id, "RETURNING", student_id);
        },
    }).then((result) => {
        if (result.isDismissed) {
            Swal.fire("Backin' out?", "Nothing Changes!", "info");
        } else {
            if (result.value != true) {
                Swal.fire("Eek!", "Something went wrong?", "error");
            } else {
                Swal.fire("Hooray!", "Status Updated!", "success").then(() => {
                    loadBorrowedBooks();
                });
            }
        }
    });
}
