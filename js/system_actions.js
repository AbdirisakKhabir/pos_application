loadData();
fill_links();
btnAction = "Insert";
$("#addNew").on("click", function () {
    $("#actionModal").modal("show");
});

//send what inside form
$("#actionForm").on("submit", function (event) {
    event.preventDefault();

    //get data from the form
    let name = $("#name").val();
    let link_id = $("#link_id").val();
    let system_action = $("#system_action").val();
    let id = $("#update_id").val();

    let sendingData = {};
    if (btnAction == "Insert") {
        //data sending variable
       sendingData = {
            "name": name,
            "link_id": link_id,
            "system_action": system_action,
            "action": "register_action"
        }
        
    } else {
          sendingData = {
              "name": name,
            "link_id": link_id,
            "system_action": system_action,
            "id": id,
            "action": "update_action"
        }
    }
    
    //send Data using AJAX
    $.ajax({
        method: "POST",
        dataType: "JSON",
        url: "../api/system_actions.php",
        data: sendingData,
        success: function (data) {
            let status = data.status;
            let response = data.data;

            if (status) {
                swal("Great Work", response, "success" )
                btnAction = "Insert";
                loadData();
                $("#actionForm")[0].reset();
                $("#actionModal").modal("hide");
                
            } else {
                swal("An error Occured", response, "danger" )
            }
        },
        error: function (data) {
            displayMessage("error", data.responseText)
        }
    })

});

function displayMessage(type, message) {
    let success = document.querySelector(".alert-success")
    let error = document.querySelector(".alert-danger")
    if (type == "success") {
        error.classList = "alert alert-danger d-none"
        success.classList = "alert alert-success";
        success.innerHTML = message;
    } else {
        error.classList = "alert alert-danger";
        error.innerHTML = message;
    }
}



//Load data to the Table
function loadData() {
    $("#actionTable tbody").html("");
    let sendingData = {
        "action": "get_actions"
    }
    $.ajax({
        method: "POST",
        dataType: "JSON",
        url: "../api/system_actions.php",
        data: sendingData,
        success: function (data) {
            let status = data.status;
            let response = data.data;
            let html = "";
            let tr = "";
            if (status) {
                //loop all data
                //then open table row tr 
                //then open each row of data as a columns and store r
                //finally print table data each column of the data
                response.forEach(res => {
                    tr += "<tr>";
                    for (let r in res) {
                        
                             tr += `<td>${res[r]}</td>`                      
                    }
                    tr += `<td> <a class="btn btn-success update_info "  update_id=${res["id"]}><i class="fas fa-edit" style="color:#fff;"></i></a>&nbsp; &nbsp; <a class="btn btn-danger delete_info" delete_id=${res["id"]}><i class="fas fa-trash" style="color:#fff;"></i></a></td>`;
                    tr += "</tr>"
                })
                $("#actionTable tbody").append(tr)
            } else {
                alert(response)
            }
        },
        error: function (data) {
      
        }
    })
}

//function that responds all links DB data specially the link Id
//and then pass to the modal form
function fill_links() {
    let sendingData = {
        "action": "get_links",
       
    }
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
                response.forEach(res => {
                    html += `<option value="${res['id']}">${res['name']}</option>`;
                });
                $("#link_id").append(html)
          
            } else {
                alert("Something Wrong");
            }
        },
        error: function (data) {
      
        }
    })
}


//create function that returns the link information when you Delete
function deleteInfo(id) {
    let sendingData = {
        "action": "get_delete_action",
        "id": id
    }
    $.ajax({
        method: "POST",
        dataType: "JSON",
        url: "../api/system_actions.php",
        data: sendingData,
        success: function (data) {
            let status = data.status;
            let response = data.data;
            let html = "";
            let tr = "";
            if (status) {
                swal("Good job!", response, "success");
                loadData()
            } else {
                 swal("Good job!", response, "danger");
            }
        },
        error: function (data) {
      
        }
    })
}
//create function that returns the link information when you want to update
function fetch_update_info(id) {
    let sendingData = {
        "action": "get_update_action",
        "id": id
    }
    $.ajax({
        method: "POST",
        dataType: "JSON",
        url: "../api/system_actions.php",
        data: sendingData,
        success: function (data) {
            let status = data.status;
            let response = data.data;
            let html = "";
            let tr = "";
            if (status) {
                  btnAction = "Update";
                    $("#update_id").val(response['id']);
                    $("#name").val(response['name']);
                    $("#link_id").val(response['link_id']);
                    $("#system_action").val(response['action']);
                    $("#actionModal").modal("show")
                swal("Good job!", response, "success");
                loadData();
            } else {
                 swal("Good job!", response, "danger");
            }
        },
        error: function (data) {
      
        }
    })
}

//get the updated link and pass the fetchlink Function
$("#actionTable").on("click", "a.update_info", function () {
    let id = $(this).attr("update_id");
    fetch_update_info(id);
    
  
});
//get the delete link and pass the delete Function
$("#actionTable").on("click", "a.delete_info", function () {
    let id = $(this).attr("delete_id");
    if (confirm("Are you sure you want to delete?")) {
        deleteInfo(id);    
    }
  
})