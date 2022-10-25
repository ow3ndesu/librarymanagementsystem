$(document).ready(function () {
  $("#dataTable").DataTable();
  loadUsers();
});

function loadUsers() {
  $.ajax({
    url: "../routes/users.route.php",
    type: "POST",
    dataType: "JSON",
    data: {
      action: "LoadUsers",
    },
    beforeSend: function () {
      console.log("loading users...");
    },
    success: function (response) {
      console.log(response);
      if (response.MESSAGE == "USERS_LOADED") {
        $("#usersTableBody").empty();
        response.USERS.forEach((element) => {
          $("#usersTableBody").append(
            `
                <tr>
                    <td>` +
              element.user_id +
              `</td>
                    <td>` +
              element.email +
              `</th>
                    <td>` +
              element.user_type +
              `</td>
                    <td>` +
              element.status +
              `</td>
                    <td>` +
              element.created_at +
              `</td>
                    <td class="text-center">
                        <button type="button" class="btn btn-primary me-2" onclick="viewUser(` +
              element.user_id +
              `)"><i class="fa-solid fa-eye"></i></button>
                        <button type="button" class="btn btn-danger" onclick="deleteUser(` +
              element.user_id +
              `)"><i class="fa-solid fa-trash"></i></button>
                    </td>
                </tr>
            `
          );
        });
      }
    },
    error: function (error) {
      console.log(error);
    },
  });
}

function viewUser(user_id) {}
