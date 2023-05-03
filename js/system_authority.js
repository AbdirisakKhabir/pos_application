loadData();
fill_users() 

//when the user selects show the permissions of this user
$("#user_id").on("change", function () {
    let value = $(this).val();
    get_user_permission(value);
})

//when the category checkbox is checked all other checkbox inside this category should be checked
$("#authority_area").on("change", "input[name='role_authority[]']", function () {
    let value = $(this).val();
   
    if ($(this).is(":checked")) {
        $(`#authority_area input[type='checkbox'][role='${value}']`).prop('checked', true);
    } else {
        $(`#authority_area input[type='checkbox'][role='${value}']`).prop('checked', false);
    }
});
//when the link checkbox is checked all other checkboxes i inside this Link should be checked
$("#authority_area").on("change", "input[name='system_link[]']", function () {
    let value = $(this).val();
    if ($(this).is(":checked")) {
        $(`#authority_area input[type='checkbox'][link_id='${value}']`).prop('checked', true);
    } else {
        $(`#authority_area input[type='checkbox'][link_id='${value}']`).prop('checked', false);
    }
});

//create function that give the user the authorities
$("#userForm").on("submit", function (event) {
    event.preventDefault();

    //if there is no user selected and the client wants to give the user you should return alert error\
    if ($("#user_id").val() == 0) {
          swal("Please Select The User!");
        return;
    }

    let link = [];
    let user_id = $("#user_id").val();
    
    $("input[name = 'system_link[]']").each(function () {
        if ($(this).is(":checked")) {
            link.push($(this).val());
            console.log(link)
        }
    })
        //Send dta 
          sendingData = {
            "user_id": user_id,
            "link_id": link,
            "action": "authorize_user"
    }
    console.log(sendingData)
    //send Data using AJAX
    $.ajax({
        method: "POST",
        dataType: "JSON",
        url: "../api/system_authority.php",
        data: sendingData,
        success: function (data) {
            let status = data.status;
            let response = data.data;

            if (status) {
                response.forEach(r => {
                    
                swal("Great Work", r.data, "success")
                
                });
            } else {
                swal("An error Occured", response, "danger" )
            }
        },
        error: function (data) {
            // displayMessage("error", data.responseText)
        }
    })

});

//Show user permissions when the user choose
function get_user_permission(id) {
    let sendingData = {
        "action": "get_user_authorities",
        "user_id": id
    }
    $.ajax({
        method: "POST",
        dataType: "JSON",
        url: "../api/system_authority.php",
        data: sendingData,
        success: function (data) {
            let status = data.status;
            let response = data.data;
            let html = "";
            let tr = "";
            if (status) {
                if (response.length >= 1) {
                    response.forEach(users => {
                        $(`input[type='checkbox'][name='role_authority[]'][value=${users['role']}]`).prop("checked", true);

                        $(`input[type='checkbox'][name='system_link[]'][value=${users['link_id']}]`).prop("checked", true);
                    });
                 }
            } else {
                $("input[type='checkbox']").prop("checked", false);
            }
        },
        error: function (data) {
      
        }
    })
}

//Load all Data from DB to the Fieldset
function loadData() {
    //every time we make response like Registre this refress the table
    let sendingData = {
        "action": "get_authorities"
    }
    $.ajax({
        method: "POST",
        dataType: "JSON",
        url: "../api/system_authority.php",
        data: sendingData,
        success: function (data) {
            let status = data.status;
            let response = data.data;
            let html = "";
            let role = "";
            let system_link = "";
            if (status) {
                //loop all data
                //then open table row tr 
                //then open each row of data as a columns and store r
                //finally print table data each column of the data
              
                response.forEach(res => {
                    for (let r in res) {
                        if (res['role'] !== role) {
                            html += `
                            </fieldset>
                            </div></div>
                            <div class="col-sm-6">
                                <fieldset class="authority_border">
                                <legend class="auhtority_border">
                                    <input type="checkbox" name="role_authority[]" value="${res['role']}" id="" class="m-2">
                                    ${res['role']}
                                </legend>
                               
                            `;
                            role = res['role'];
                        }
                        if (res['link_name'] !== system_link) {
                            html += `
                            <div class="control-group">
                            <label class="control-label input-label">
                            <input type="checkbox" name="system_link[]" style="margin-left: 35px; margin-bottom: 10px; margin-right: 5px; !important;"
                            role="${res['role']}" id="" value="${res['link_id']}" category_id="${res['category_id']}" link_id="${res['link_id']}"
                            ">
                            ${res['link_name']}
                            </label>
                            `;
                            system_link = res['link_name'];
                        }
                             
                        }
                    
                  
                })
                $("#authority_area").append(html)
            } else {
                alert(response)
            }
        },
        error: function (data) {
      
        }
    })
}

//function that responds all files in VIEWS directory with .php extension
//and then pass to the modal form
function fill_users() {
    let sendingData = {
        "action": "get_users",
       
    }
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
                response.forEach(res => {
                    html += `<option value="${res['id']}">${res['username']}</option>`;
                });
                $("#user_id").append(html)
          
            } else {
                alert("Something Wrong");
            }
        },
        error: function (data) {
      
        }
    })
}