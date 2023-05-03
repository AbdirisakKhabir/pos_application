loadData();
btnAction = "Insert";
$("#addNew").on("click", function () {
    $("#categoryModal").modal("show");
});

//send what inside form
$("#categoryForm").on("submit", function (event) {
    event.preventDefault();

    //get data from the form
    let name = $("#name").val();
    let role = $("#role").val();
    let icon = $("#icon").val();
    let id = $("#update_id").val();

    let sendingData = {};
    if (btnAction == "Insert") {
        //data sending variable
       sendingData = {
            "name": name,
            "role": role,
            "icon": icon,
            "action": "register_category"
        }
        
    } else {
          sendingData = {
            "name": name,
            "role": role,
            "icon": icon,
            "id": id,
            "action": "update_category"
        }
    }
    
    //send Data using AJAX
    $.ajax({
        method: "POST",
        dataType: "JSON",
        url: "../api/category.php",
        data: sendingData,
        success: function (data) {
            let status = data.status;
            let response = data.data;

            if (status) {
                swal("Great Work", response, "success" )
                btnAction = "Insert";
                loadData();
                $("#categoryForm")[0].reset();
                $("#categoryModal").modal("hide");
                
            } else {
                swal("An error Occured", response, "danger" )
            }
        },
        error: function (data) {
            displayMessage("error", data.responseText)
        }
    })

});

//Load data to the Table
function loadData() {
    $("#categoryTable tbody").html("");
    let sendingData = {
        "action": "get_categories"
    }
    $.ajax({
        method: "POST",
        dataType: "JSON",
        url: "../api/category.php",
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
                    tr += `<td> <a class="btn btn-info update_info text-white"  update_id=${res["id"]}><i class="fas fa-edit" style="color:#fff;"></i>Edit</a>&nbsp; &nbsp; 
                    <a class="btn btn-danger delete_info text-white" delete_id=${res["id"]}><i class="fas fa-trash" style="color:#fff;"></i>Delete</a></td>`;
                    tr += "</tr>"
                })
                $("#categoryTable tbody").append(tr)
            } else {
                alert(response)
            }
        },
        error: function (data) {
      
        }
    })
}

//create function that returns the category information when you update
function fetchcategoryInfo(id) {
    let sendingData = {
        "action": "get_update_info",
        "id": id
    }
    $.ajax({
        method: "POST",
        dataType: "JSON",
        url: "../api/category.php",
        data: sendingData,
        success: function (data) {
            let status = data.status;
            let response = data.data;
            let html = "";
            let tr = "";
            if (status) {
                //show the data to the form
                //use the hidden input to store the ID from the Database
                  btnAction = "Update";
                    $("#update_id").val(response['id']);
                    $("#name").val(response['name']);
                    $("#role").val(response['role']);
                    $("#icon").val(response['icon']);
                    $("#categoryModal").modal("show")
            } else {
                alert(response)
            }
        },
        error: function (data) {
      
        }
    })
}

//create function that returns the category information when you Delete
function deleteInfo(id) {
    let sendingData = {
        "action": "delete_category_info",
        "id": id
    }
    $.ajax({
        method: "POST",
        dataType: "JSON",
        url: "../api/category.php",
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

//get the updated category and pass the fetchcategory Function
$("#categoryTable").on("click", "a.update_info", function () {
    let id = $(this).attr("update_id");
    fetchcategoryInfo(id);
  
});
//get the delete category and pass the delete Function
$("#categoryTable").on("click", "a.delete_info", function () {
    let id = $(this).attr("delete_id");
      
   swal({
        title: "Are you sure?",
        text: "Once Approved, you will not be able to recover this Credit Data!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                 deleteInfo(id);   
            }
        })
  
})