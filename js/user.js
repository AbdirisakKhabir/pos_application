//when click the add new Button the modal will show
$("#addNew").on("click", function () {
  $("#usersModal").modal("show");
});

$("#registerForm").on("submit", function (event) {
  event.preventDefault();
  // //get data from the form
  let username = $("#username").val();
  let password = $("#password").val();
  let name = $("#name").val();
  let phone = $("#phone").val();

  let sendingData = {};

  //data sending variable
  sendingData = {
    name: name,
    username: username,
    phone: phone,
    password: password,
    action: "register_user",
  };

  //send Data using AJAX
  $.ajax({
    method: "POST",
    dataType: "JSON",
    url: "../api/users.php",
    data: sendingData,
    success: function (data) {
      let status = data.status;
      let response = data.data;

      if (status) {
        swal("Great Work", response, "success");
        $("#registerForm")[0].reset();
        setTimeout(() => {
          window.location.href = "../views/add_users.php";
        }, "1000");
      } else {
        swal("An error Occured", response, "danger");
      }
    },
    error: function (data) {},
  });
});

$("#updateForm").on("submit", function (event) {
  event.preventDefault();
  // //get data from the form
  let username = $("#username").val();
  let password = $("#password").val();
  let name = $("#name").val();
  let phone = $("#phone").val();
  let user_status = $("#user_status").val();
  let id = $("#update_id").val();

  let sendingData = {};

  //data sending variable
  sendingData = {
    name: name,
    username: username,
    phone: phone,
    user_status: user_status,
    id: id,
    action: "update_user",
  };

  //send Data using AJAX
  $.ajax({
    method: "POST",
    dataType: "JSON",
    url: "../api/users.php",
    data: sendingData,
    success: function (data) {
      let status = data.status;
      let response = data.data;

      if (status) {
        swal("Great Work", response, "success");
        $("#usersModal").modal("hide");
        $("#updateForm")[0].reset();
        setTimeout(() => {
          window.location.href = "../views/users.php";
        }, "1000");
      } else {
        swal("An error Occured", response, "danger");
      }
    },
    error: function (data) {},
  });
});

//create function that returns the expense information when you update
function fetchUpdateInfo(id) {
  let sendingData = {
    action: "get_update_info",
    id: id,
  };
  $.ajax({
    method: "POST",
    dataType: "JSON",
    url: "../api/users.php",
    data: sendingData,
    success: function (data) {
      let status = data.status;
      let response = data.data;
      if (status) {
        //show the data to the form
        //use the hidden input to store the ID from the Database
        $("#update_id").val(response["id"]);
        $("#name").val(response["name"]);
        $("#username").val(response["username"]);
        $("#phone").val(response["phone"]);
        $("#user_status").val(response["user_status"]);

        $("#usersModal").modal("show");
      } else {
        alert(response);
      }
    },
    error: function (data) {},
  });
}

//create function that returns the expense information when you Delete
function deleteInfo(id) {
  let sendingData = {
    action: "delete_user",
    id: id,
  };
  $.ajax({
    method: "POST",
    dataType: "JSON",
    url: "../api/users.php",
    data: sendingData,
    success: function (data) {
      let status = data.status;
      let response = data.data;
      let html = "";
      let tr = "";
      if (status) {
        swal("Good job!", response, "success");
        setTimeout(() => {
          window.location.href = "../views/users.php";
        }, "1000");
      } else {
        swal("Something Wrong!", response, "danger");
        setTimeout(() => {
          window.location.href = "../views/users.php";
        }, "1000");
      }
    },
    error: function (data) {},
  });
}

//get the updated Expense and pass the fetchExpense Function
$("#usersTable").on("click", "a.update_info", function () {
  let id = $(this).attr("update_id");
  fetchUpdateInfo(id);

  console.log("Update");
});
//get the delete Expense and pass the delete Function
$("#usersTable").on("click", "a.delete_info", function () {
  let id = $(this).attr("delete_id");
  if (confirm("Are you sure you want to delete?")) {
    deleteInfo(id);
  }
});
