fill_customer();

//send what inside form
$("#add_credit").on("submit", function (event) {
  event.preventDefault();

  //get data from the form
  let customer_name = $("#customer_name").val();
  let city = $("#city").val();
  let phone = $("#phone").val();
  let amount = $("#amount").val();
  let deadline = $("#deadline").val();
  let description = $("#description").val();

  let sendingData = {};

  //data sending variable
  sendingData = {
    customer_name: customer_name,
    amount: amount,
    deadline: deadline,
    city: city,
    phone: phone,
    description: description,
    user_id: user_id,
    action: "register_credit",
  };

  //send Data using AJAX
  $.ajax({
    method: "POST",
    dataType: "JSON",
    url: "../api/credits.php",
    data: sendingData,
    success: function (data) {
      let status = data.status;
      let response = data.data;

      if (status) {
        swal("Great Work", response, "success");
        $("#add_credit")[0].reset();
      } else {
        swal("An error Occured", response, "danger");
      }
    },
    error: function (data) {},
  });
});

//send what inside form
$("#update_credit").on("submit", function (event) {
  event.preventDefault();

  //get data from the form
  let customer_name = $("#customer_name").val();
  let city = $("#city").val();
  let phone = $("#phone").val();
  let amount = $("#amount").val();
  let deadline = $("#deadline").val();
  let description = $("#description").val();
  let id = $("#update_id").val();

  //data sending variable
  sendingData = {
    customer_name: customer_name,
    amount: amount,
    deadline: deadline,
    city: city,
    phone: phone,
    description: description,
    user_id: user_id,
    id: id,
    action: "update_credit",
  };

  //send Data using AJAX
  $.ajax({
    method: "POST",
    dataType: "JSON",
    url: "../api/credits.php",
    data: sendingData,
    success: function (data) {
      let status = data.status;
      let response = data.data;

      if (status) {
        swal("Great Work", response, "success");
        $("#creditsModal").modal("hide");
        window.location.href = "../views/credits.php";
      } else {
        swal("An error Occured", response, "danger");
      }
    },
    error: function (data) {},
  });
});

//create function that returns the category information when you update
function fetch_update_info(id) {
  let sendingData = {
    action: "get_credit",
    id: id,
  };
  $.ajax({
    method: "POST",
    dataType: "JSON",
    url: "../api/credits.php",
    data: sendingData,
    success: function (data) {
      let status = data.status;
      let response = data.data;
      let html = "";
      let tr = "";
      if (status) {
        //show the data to the form
        //use the hidden input to store the ID from the DatabaseSS
        response.forEach((res) => {
          console.log(res);
          $("#update_id").val(res["id"]);
          $("#customer_name").val(res["customer_name"]);
          $("#amount").val(res["amount"]);
          $("#deadline").val(res["deadline"]);
          $("#city").val(res["city"]);
          $("#phone").val(res["phone"]);
          $("#description").val(res["description"]);
          $("#creditsModal").modal("show");
        });
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
    action: "delete_credit",
    id: id,
  };
  $.ajax({
    method: "POST",
    dataType: "JSON",
    url: "../api/credits.php",
    data: sendingData,
    success: function (data) {
      let status = data.status;
      let response = data.data;
      let html = "";
      let tr = "";
      if (status) {
        swal("Good job!", response, "success");
        window.location.href = "../views/credits.php";
      } else {
        swal("Good job!", response, "danger");
      }
    },
    error: function (data) {},
  });
}

function fill_customer() {
  let sendingData = {
    action: "get_customers",
    user_id: user_id,
  };
  $.ajax({
    method: "POST",
    dataType: "JSON",
    url: "../api/customers.php",
    data: sendingData,
    success: function (data) {
      let status = data.status;
      let response = data.data;
      let name = "";

      if (status) {
        response.forEach((res) => {
          name += `<option value="${res["customer_name"]}">${res["customer_name"]}</option>`;
        });
        $("#customer_name").append(name);
      } else {
        alert("Something Wrong");
      }
    },
    error: function (data) {},
  });
}

function fill_phone(customer_name) {
  let sendingData = {
    action: "get_customer",
    customer_name: customer_name,
  };
  $.ajax({
    method: "POST",
    dataType: "JSON",
    url: "../api/customers.php",
    data: sendingData,
    success: function (data) {
      let status = data.status;
      let response = data.data;
      let name = "";
      let phone = "";
      let city = "";

      if (status) {
        response.forEach((res) => {
          $("#city").val(res["city"]);
          $("#phone").val(res["phone"]);
        });
        // $("#phone").append(name)
      } else {
        alert("Something Wrong");
      }
    },
    error: function (data) {},
  });
}
//create function that returns the category information when you Delete
function approve_credit(id) {
  let sendingData = {
    action: "approve_credit",
    id: id,
  };
  $.ajax({
    method: "POST",
    dataType: "JSON",
    url: "../api/credits.php",
    data: sendingData,
    success: function (data) {
      let status = data.status;
      let response = data.data;
      let html = "";
      let tr = "";
      if (status) {
        swal("Good job!", response, "success");
        window.location.href = "../views/credits.php";
      } else {
        swal("Good job!", response, "danger");
      }
    },
    error: function (data) {},
  });
}
// Fill Customer Phone Function
$("#customer_name").on("change", function () {
  let value = $(this).val();
  fill_phone(value);
});

//get the updated category and pass the fetchcategory Function
$("#creditsTable").on("click", "a.update_info", function () {
  let id = $(this).attr("update_id");
  fetch_update_info(id);
});
//get the delete category and pass the delete Function
$("#creditsTable").on("click", "a.delete_info", function () {
  let id = $(this).attr("delete_id");
  swal({
    title: "Are you sure?",
    text: "Once deleted, you will not be able to recover this imaginary file!",
    icon: "warning",
    buttons: true,
    dangerMode: true,
  }).then((willDelete) => {
    if (willDelete) {
      deleteInfo(id);
    }
  });
});
// When the User Clicks Approve Button
$("#creditsTable").on("click", "a.approve", function () {
  let id = $(this).attr("approve");
  swal({
    title: "Are you sure?",
    text: "Once Approved, you will not be able to recover this Credit Data!",
    icon: "warning",
    buttons: true,
    dangerMode: true,
  }).then((willDelete) => {
    if (willDelete) {
      approve_credit(id);
    }
  });
});
