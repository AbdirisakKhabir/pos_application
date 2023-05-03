//create function that returns the Credit information when you Delete
function delete_returned_loan(id) {
  let sendingData = {
    action: "delete_returned_loan",
    id: id,
  };
  $.ajax({
    method: "POST",
    dataType: "JSON",
    url: "../api/returned_loans.php",
    data: sendingData,
    success: function (data) {
      let status = data.status;
      let response = data.data;
      if (status) {
        swal("Good job!", response, "success");
        window.location.href = "../views/returned_loans.php";
      } else {
        swal("Good job!", response, "danger");
      }
    },
    error: function (data) {},
  });
}
$("#customer_name").on("change", function () {
  if ($("#customer_name").val() == 0) {
    $("#phone").val("");
  }
});
$("#add_new").on("click", function () {
  $("#returned_loans_modal").modal("show");
});
$("#add_returned_loan").on("submit", function (event) {
  event.preventDefault();

  //get data from the form
  let customer_name = $("#customer_name").val();
  let phone = $("#phone").val();
  let amount = $("#amount").val();
  let description = $("#description").val();

  //data sending variable
  sendingData = {
    customer_name: customer_name,
    amount: amount,
    phone: phone,
    description: description,
    user_id: user_id,
    action: "regsiter_returned_loan",
  };

  //send Data using AJAX
  $.ajax({
    method: "POST",
    dataType: "JSON",
    url: "../api/returned_loans.php",
    data: sendingData,
    success: function (data) {
      let status = data.status;
      let response = data.data;

      if (status) {
        swal("Great Work", response, "success");
        $("#add_returned_loan")[0].reset();
        $("#returned_loans_modal").modal("hide");
        window.location.href = "../views/returned_loans.php";
      } else {
        swal("An error Occured", response, "danger");
      }
    },
    error: function (data) {},
  });
});

//get the delete Expense and pass the delete Function
$("#returnedLoansTable").on("click", "a.delete", function () {
  let id = $(this).attr("delete_id");
  if (confirm("Are you sure you want to Delete?")) {
    delete_returned_loan(id);
  }
});
