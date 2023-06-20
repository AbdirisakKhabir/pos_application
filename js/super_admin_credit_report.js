fill_users();

$(document).ready(function () {
  $("#creditForm").submit(function (event) {
    event.preventDefault();
    if ($("#user_id").val() == 0) {
      swal("Please Select The User You Want to Get the Report");
    } else {
      // Perform other actions if the form is valid
      $("#creditTable tr").html("");
      //get data from the form
      let phone = $("#phone").val();
      let from = $("#from").val();
      let to = $("#to").val();
      let user_id = $("#user_id").val();

      let sendingData = {
        phone: phone,
        from: from,
        to: to,
        user_id: user_id,
        action: "get_credit_report",
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

          let tr = "";
          let th = "";
          if (status) {
            //loop all data
            response.forEach((res) => {
              //Print all Headers
              th = "<tr>";
              for (let r in res) {
                th += `<th>${r}</th>`;
              }
              th += "</tr>";

              //Print all Rows
              tr += "<tr>";
              for (let r in res) {
                tr += `<td>${res[r]}</td>`;
              }
              tr += "</tr>";
            });
            $("#creditTable thead").append(th);
            $("#creditTable tbody").append(tr);
          }
        },
        error: function (data) {
          alert(data);
        },
      });
    }
  });
});

function fill_users() {
  let sendingData = {
    action: "get_users",
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
        html += ` <option value="0">Select User</option>`;
        response.forEach((res) => {
          html += `<option value="${res["id"]}">${res["name"]}</option>`;
        });
        $("#user_id").append(html);
      } else {
        alert("Something Wrong");
      }
    },
    error: function (data) {},
  });
}

//Report Print Function
$("#printButton").on("click", function () {
  printStatement();
});

//Print Report funtion
function printStatement() {
  let printArea = document.querySelector("#printArea");
  let newWindow = window.open("");
  newWindow.document.write(
    `<html><head><title>Loan Cloud Loans Report</title>`
  );
  newWindow.document.write(`<style media="print"> 
      @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100&display=swap');
  
      body {
          font-family: 'Poppins', sans-serif;
      }
      table {
          width: 100%;
      }
      th {
          background-color: #04AA6D !important;
          color: white 1important;
  
      }
      th, td {
          padding: 15px !important;
          text-align: left !important;
  
      }
      th, td{
          border-bottom: 1px, solid, #ddd !important
      }
      
      </style>`);

  newWindow.document.write(`</head><body>`);
  newWindow.document.write(printArea.innerHTML);
  newWindow.document.write(`</body></html>`);
  newWindow.print();
  newWindow.close();
}

//export To Excel when we cick the export Button
$("#exportButton").on("click", function (e) {
  let file = new Blob([$("#printArea").html()], {
    type: "application/vnd.ms-excel",
  });
  let url = URL.createObjectURL(file);
  let a = $("<a />", {
    href: url,
    download: "printArea.xls",
  })
    .appendTo("body")
    .get(0)
    .click();
  e.preventDefault();
});
