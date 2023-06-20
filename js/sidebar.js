loadUserMenu();

function logoutFunction() {
  window.location.href = "../views/logout.php";
}
//show user menu to the sidebar

function loadUserMenu() {
  let sendingData = {
    action: "get_user_menus",
    user_id: user_id,
  };

  $.ajax({
    method: "POST",
    dataType: "JSON",
    url: "../api/system_authority.php",
    data: sendingData,
    success: function (data) {
      let status = data.status;
      let response = data.data;
      let html = ` 
                     
                           <button type="button" onclick="logoutFunction()" class="btn btn-primary align-items-end mt-5 mx-2">Logout</button>
                          
                       `;
      let category = "";
      let menuElement = "";
      if (status) {
        //loop all data
        response.forEach((menu) => {
          if (menu["category_name"] !== category) {
            if (category !== "") {
              menuElement += "</ul></li>";
            }
            menuElement += `
                      
                     


                        `;
            category = menu["category_name"];
          }
          menuElement += `
          <li  class="nav-item">
          <a href="${menu["link"]}" current_link="${menu["link"]}"  class="nav-link "><span class="pcoded-micon"><i class="${menu["icon"]}"></i></span><span class="pcoded-mtext">${menu["link_name"]}</span></a>
         
      </li>
                   
                    `;
        });
        $("#userMenu").append(menuElement);
        $("#userMenu").append(html);

        //in here we want to get the current link that user have
        //first get split th url
        //then get url that user wants and Pass Classes
        let href = window.location.href.split("/");
        let url = href[href.length - 1];
        let currentPage = document.querySelector(`[current_link="${url}"]`);
        currentPage.parentElement.classList.toggle("active");
        currentPage.classList = "active";
      } else {
        alert(response);
      }
    },
    error: function (data) {},
  });
}
