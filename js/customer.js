//send what inside form
$("#registerForm").on("submit", function (event) {
  event.preventDefault();

  //get data from the form
  let customer_name = $("#customer_name").val();
  let city = $("#city").val();
  let phone = $("#phone").val();

  let sendingData = {};

  //data sending variable
  sendingData = {
    customer_name: customer_name,
    city: city,
    phone: phone,
    user_id: user_id,
    action: "register_customer",
  };

  //send Data using AJAX
  $.ajax({
    method: "POST",
    dataType: "JSON",
    url: "../api/customers.php",
    data: sendingData,
    success: function (data) {
      let status = data.status;
      let response = data.data;

      if (status) {
        swal("Great Work", response, "success");
        $("#registerForm")[0].reset();
      } else {
        swal("An error Occured", response, "danger");
      }
    },
    error: function (data) {},
  });
});

// Update Customer from Modal
//send what inside form
$("#updateForm").on("submit", function (event) {
  event.preventDefault();

  //get data from the form
  let customer_name = $("#customer_name").val();
  let city = $("#city").val();
  let phone = $("#phone").val();
  let id = $("#update_id").val();

  let sendingData = {};

  //data sending variable
  sendingData = {
    customer_name: customer_name,
    city: city,
    phone: phone,
    user_id: user_id,
    id: id,
    action: "update_customer",
  };

  //send Data using AJAX
  $.ajax({
    method: "POST",
    dataType: "JSON",
    url: "../api/customers.php",
    data: sendingData,
    success: function (data) {
      let status = data.status;
      let response = data.data;

      if (status) {
        swal("Great Work", response, "success");
        $("#customersModal")[0].reset();
        $("#customersModal").modal("hide");
        window.location.href = "../views/customers.php";
      } else {
        swal("An error Occured", response, "danger");
      }
    },
    error: function (data) {
      displayMessage("error", data.responseText);
    },
  });
});

//create function that returns the category information when you update
function fetchcategoryInfo(id) {
  let sendingData = {
    action: "get_update_info",
    id: id,
  };
  $.ajax({
    method: "POST",
    dataType: "JSON",
    url: "../api/customers.php",
    data: sendingData,
    success: function (data) {
      let status = data.status;
      let response = data.data;
      let html = "";
      let tr = "";
      if (status) {
        //show the data to the form
        //use the hidden input to store the ID from the Database

        $("#update_id").val(response["id"]);
        $("#customer_name").val(response["customer_name"]);
        $("#city").val(response["city"]);
        $("#phone").val(response["phone"]);
        $("#customersModal").modal("show");
      } else {
        alert(response);
      }
    },
    error: function (data) {},
  });
}

//create function that returns the category information when you Delete
function deleteInfo(id) {
  let sendingData = {
    action: "delete_customer",
    id: id,
  };
  $.ajax({
    method: "POST",
    dataType: "JSON",
    url: "../api/customers.php",
    data: sendingData,
    success: function (data) {
      let status = data.status;
      let response = data.data;
      let html = "";
      let tr = "";
      if (status) {
        swal("Good job!", response, "success");
      } else {
        swal("Good job!", response, "danger");
      }
    },
    error: function (data) {},
  });
}

//get the updated category and pass the fetchcategory Function
$("#customersTable").on("click", "a.update_info", function () {
  let id = $(this).attr("update_id");
  fetchcategoryInfo(id);
});
//get the delete category and pass the delete Function
$("#customersTable").on("click", "a.delete_info", function () {
  let id = $(this).attr("delete_id");
  swal({
    title: "Are you sure?",
    text: "Once Approved, you will not be able to recover this Credit Data!",
    icon: "warning",
    buttons: true,
    dangerMode: true,
  }).then((willDelete) => {
    if (willDelete) {
      deleteInfo(id);
    }
  });
});
