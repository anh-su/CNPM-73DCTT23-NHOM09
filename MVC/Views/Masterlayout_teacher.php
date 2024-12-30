<!DOCTYPE html> 
<html lang="en"> 
<head> 
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Chủ</title> 
    <link rel="stylesheet" href="http://localhost/Doan/Public/Css/bootstrap.min.css"> 
    <link rel="stylesheet" href="http://localhost/Doan/Public/Css/dinhdang7.css?v=1">
    <link rel="stylesheet" href="http://localhost/Doan/Public/Css/MaterLO.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="http://localhost/Doan/Public/Js/jquery-3.3.1.slim.min.js"></script> 
    <script src="http://localhost/Doan/Public/Js/popper.min.js"></script> 
    <script src="http://localhost/Doan/Public/Js/bootstrap.min.js"></script> 
</head> 
<body> 
    <div class="container-fluid"> 
        <div class="header1"> 
        <img src="http://localhost/Doan/Public/Pictures/logo.png" alt="" style="width: 180px; height: auto;">

            <span style="color: black;"> <?php echo $_SESSION['Hoten']; ?>
            <img src="http://localhost/Doan/Public/Pictures/user_customer_person_13976.ico" alt="User Icon" style="width: 30px; height: 30px; margin-left: 10px; vertical-align: middle;">
            <img src="http://localhost/Doan/Public/Pictures/3844480-dot-menu-more-option_110346.png" 
     alt="User Icon" 
     style="width: 30px; height: 30px; margin-left: 10px; vertical-align: middle;" 
     id="menuIcon">
     <div id="menuDropdown" style="display: none; position: absolute; top: 40px; right: 10px; background: white; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); border-radius: 4px; width: 200px; z-index: 10;">
    <a href="http://localhost/Doan/Thongtingv" id="userInfo" style="display: block; padding: 10px; text-decoration: none; color: black; font-size: 14px; border-bottom: 1px solid #e0e0e0;">Thông tin người dùng</a>
    <a href="#" id="logoutConfirmLink" style="display: block; padding: 10px; text-decoration: none; color: black; font-size: 14px;">Đăng xuất</a>
</div>
            </span> 
        </div> 
        <div class="separator"></div> 
        <div class="row"> 
            <div class="menu_left1"> 
                <div class="list-group"> 
                    <a href="http://localhost/Doan/Home/teacher" class="list-group-item "> 
                    <img src="http://localhost/Doan/Public/Pictures/fourcircles_116453.png" alt="Menu Icon" style="width: 16px; height: 16px; margin-left: 0px;margin-right:10px; vertical-align: right;">
                    Trang Chủ 
                </a> 
                    <a href="javascript:void(0)" class="list-group-item" id="menuDetai">
                        <img src="http://localhost/Doan/Public/Pictures/tasks-list_icon-icons.com_73381.png" alt="Menu Icon" style="width: 16px; height: 16px; margin-left: 0px;margin-right:10px; vertical-align: right;">
                    Menu
                    <span id="arrow" class="fas fa-chevron-down" style="float: right; margin-left: 10px;"></span> 
                </a>
                            <div id="submenuDetai" style="display: none; padding-left: 20px;">
                                <a href="http://localhost/Doan/Nhiemvu" class="list-group-item">Nhiệm Vụ</a>
                                <a href="http://localhost/Doan/GuithongbaoHS" class="list-group-item">Gửi Thông Báo</a>
                            </div>

                    <a href="http://localhost/Doan/Xemthongbaogv" class="list-group-item"> 
                    <img src="http://localhost/Doan/Public/Pictures/ic-feedback_97633.png" alt="Menu Icon" style="width: 16px; height: 16px; margin-left: 0px;margin-right:10px; vertical-align: right;">
                    Xem Thông Báo 
                </a> 
                    <a href="http://localhost/Doan/LienHe/HS" class="list-group-item">
                    <img src="http://localhost/Doan/Public/Pictures/planning_todo_list_tasks_clipboard_icon_262700.png" alt="Menu Icon" style="width: 16px; height: 16px; margin-left: 0px;margin-right:10px; vertical-align: right;">
                    Xem đánh giá
                </a> 
                </div> 
            </div> 
            <div class="content1" style="background-color: aliceblue;"> 
                <?php include_once './MVC/Views/Pages/' . $data['page'] . '.php'; ?> 
            </div> 
        </div> 
    </div>
    <div class="modal fade" id="confirmLogoutModal" tabindex="-1" role="dialog" aria-labelledby="confirmLogoutModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmLogoutModalLabel">Xác nhận đăng xuất</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Bạn có muốn đăng xuất không?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                <button type="button" id="logoutConfirmBtn" class="btn btn-primary">Đăng xuất</button>
            </div>
        </div>
    </div>
</div>

    <script>
        document.getElementById("menuIcon").addEventListener("click", function(event) {
    const dropdown = document.getElementById("menuDropdown");
    if (dropdown.classList.contains("show")) {
        dropdown.classList.remove("show");
        setTimeout(() => dropdown.style.display = "none", 300);
    } else {
        dropdown.style.display = "block"; 
        setTimeout(() => dropdown.classList.add("show"), 0); 
    }
});


document.addEventListener("click", function(event) {
    const menuIcon = document.getElementById("menuIcon");
    const dropdown = document.getElementById("menuDropdown");
    if (!menuIcon.contains(event.target) && !dropdown.contains(event.target)) {
        dropdown.classList.remove("show");
        setTimeout(() => dropdown.style.display = "none", 300); 
    }
});
document.getElementById("logoutConfirmLink").addEventListener("click", function(event) {
    event.preventDefault();
    
    
    $('#confirmLogoutModal').modal('show');
});


document.getElementById("logoutConfirmBtn").addEventListener("click", function() {
    
    $('#confirmLogoutModal').modal('hide');
    
   
    window.location.href = "http://localhost/Doan/LoginController";
});

document.getElementById("menuDetai").addEventListener("click", function (event) {
    event.preventDefault(); 

    const submenu = document.getElementById("submenuDetai");

   
    if (submenu.classList.contains("show")) {
        submenu.classList.remove("show"); 
        setTimeout(() => (submenu.style.display = "none"), 300); 
    } else {
        submenu.style.display = "block"; 
        setTimeout(() => submenu.classList.add("show"), 10); 
    }
});
    </script>
</body>
</html>
