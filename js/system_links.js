fill_links();
fill_categories();
btnAction = "Insert";
$("#addNew").on("click", function () {
  $("#linkModal").modal("show");
});

//send what inside form
$("#linkForm").on("submit", function (event) {
  event.preventDefault();

  //get data from the form
  let name = $("#name").val();
  let link = $("#link_id").val();
  let category = $("#category_id").val();
  let icon = $("#icon").val();
  let id = $("#update_id").val();

  let sendingData = {};
  if (btnAction == "Insert") {
    //data sending variable
    sendingData = {
      name: name,
      link: link,
      category: category,
      icon: icon,
      action: "register_link",
    };
  } else {
    sendingData = {
      name: name,
      link: link,
      category: category,
      icon: icon,
      id: id,
      action: "update_link",
    };
  }

  //send Data using AJAX
  $.ajax({
    method: "POST",
    dataType: "JSON",
    url: "../api/system_link.php",
    data: sendingData,
    success: function (data) {
      let status = data.status;
      let response = data.data;

      if (status) {
        swal("Great Work", response, "success");
        swal("Great Work", response, "success");
        $("#linkForm")[0].reset();
        $("#linkModal").modal("hide");
        window.location.href = "../views/system_links.php";
      } else {
        swal("An error Occured", response, "danger");
      }
    },
    error: function (data) {
      swal("An error Occured", response, "danger");
    },
  });
});

//function that responds all files in VIEWS directory with .php extension
//and then pass to the modal form
function fill_links() {
  let sendingData = {
    action: "getAllLinks",
  };
  $.ajax({
    method: "POST",
    dataType: "JSON",
    url: "../api/system_link.php",
    data: sendingData,
    success: function (data) {
      let status = data.status;
      let response = data.data;
      let html = "";
      let tr = "";
      if (status) {
        response.forEach((res) => {
          html += `<option value="${res}">${res}</option>`;
        });
        $("#link_id").append(html);
      } else {
        alert("Something Wrong");
      }
    },
    error: function (data) {},
  });
}

//function that responds all files in VIEWS directory with .php extension
//and then pass to the modal form
function fill_categories() {
  let sendingData = {
    action: "get_categories",
  };
  $.ajax({
    method: "POST",
    dataType: "JSON",
    url: "../api/category.php",
    data: sendingData,
    success: function (data) {
      let status = data.status;
      let response = data.data;
      let html = "";
      if (status) {
        response.forEach((res) => {
          html += `<option value="${res["id"]}">${res["name"]}</option>`;
        });
        $("#category_id").append(html);
      } else {
        swal("Something Wrong!", response, "danger");
      }
    },
    error: function (data) {},
  });
}

//create function that returns the link information when you Delete
function deleteInfo(id) {
  let sendingData = {
    action: "delete_link_info",
    id: id,
  };
  $.ajax({
    method: "POST",
    dataType: "JSON",
    url: "../api/system_link.php",
    data: sendingData,
    success: function (data) {
      let status = data.status;
      let response = data.data;
      let html = "";
      let tr = "";
      if (status) {
        swal("Good job!", response, "success");
        window.location.href = "../views/system_links.php";
      } else {
        swal("Good job!", response, "danger");
      }
    },
    error: function (data) {},
  });
}
//create function that returns the link information when you want to update
function fetch_update_info(id) {
  let sendingData = {
    action: "get_update_info",
    id: id,
  };
  $.ajax({
    method: "POST",
    dataType: "JSON",
    url: "../api/system_link.php",
    data: sendingData,
    success: function (data) {
      let status = data.status;
      let response = data.data;
      let html = "";
      let tr = "";
      if (status) {
        btnAction = "Update";
        $("#update_id").val(response["id"]);
        $("#name").val(response["name"]);
        $("#link_id").val(response["link"]);
        $("#category_id").val(response["category_id"]);
        $("#icon").val(response["icon"]);
        $("#linkModal").modal("show");
        swal("Good job!", response, "success");
        window.location.href = "../views/system_links.php";
      } else {
        swal("Good job!", response, "danger");
      }
    },
    error: function (data) {},
  });
}

//get the updated link and pass the fetchlink Function
$("#linkTable").on("click", "a.update_info", function () {
  let id = $(this).attr("update_id");
  fetch_update_info(id);
});
//get the delete link and pass the delete Function
$("#linkTable").on("click", "a.delete_info", function () {
  let id = $(this).attr("delete_id");
  swal({
    title: "Are you sure?",
    text: "Once You Delete, you will not be able to recover this Data!",
    icon: "warning",
    buttons: true,
    dangerMode: true,
  }).then((willDelete) => {
    if (willDelete) {
      deleteInfo(id);
    }
  });
});
