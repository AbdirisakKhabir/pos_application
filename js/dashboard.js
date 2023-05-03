let totalCustomers = 0;
let totalCredits = 0;
let totalReturnedLoans = 0;

show_customers();
show_credits();
show_returned_loans();

function show_customers() {
  let sendingData = {
    action: "get_number_customers",
    user_id: user_id,
  };
  $.ajax({
    method: "POST",
    dataType: "JSON",
    url: "../api/totals.php",
    data: sendingData,
    async: false,
    success: function (data) {
      let status = data.status;
      let response = data.data;
      if (status) {
        console.log("customers", response);
        document.querySelector("#total_customers").innerText =
          +response[0].total;
        totalCustomers = response[0].COUNT;
        console.log(totalCustomers);
      } else {
      }
    },
    error: function (data) {},
  });
}

function show_returned_loans() {
  let sendingData = {
    action: "get_total_return_credits",
    user_id: user_id,
  };
  $.ajax({
    method: "POST",
    dataType: "JSON",
    url: "../api/totals.php",
    data: sendingData,
    async: false,
    success: function (data) {
      let status = data.status;
      let response = data.data;
      if (status) {
        const totalReturnedLoans = document.querySelector(
          "#total_returned_loans"
        );
        const total = response[0].total !== null ? response[0].total : 0;
        totalReturnedLoans.innerText = "$" + total;
      } else {
      }
    },
    error: function (data) {},
  });
}
function show_credits() {
  let sendingData = {
    action: "get_total_credits",
    user_id: user_id,
  };
  $.ajax({
    method: "POST",
    dataType: "JSON",
    url: "../api/totals.php",
    data: sendingData,
    async: false,
    success: function (data) {
      let status = data.status;
      let response = data.data;
      if (status) {
        const totalCredits = document.querySelector("#total_credits");
        const total = response[0].total !== null ? response[0].total : 0;
        totalCredits.innerText = "$" + total;
      } else {
      }
    },
    error: function (data) {},
  });
}
