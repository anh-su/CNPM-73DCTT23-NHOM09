<?php
// controllers/LoginController.php

class LoginController extends controller
{
    private $loginModel;

    public function __construct()
    {
        $this->loginModel = $this->model('loginModel');
    }

    public function Get_data()
    {
        // Hiển thị trang TracNghiem nếu chưa đăng nhập
        $this->view('TracNghiem');
    }

    public function login()
    {
        $error_message = "";

        if (isset($_POST['dangnhap'])) {
            $Tendangnhap = $_POST['Tendangnhap'];
            $Matkhau = $_POST['Matkhau'];

            // Kiểm tra các trường nhập có bị bỏ trống không
            if (empty($Tendangnhap) || empty($Matkhau)) {
                $error_message = "Tên người dùng và mật khẩu không được rỗng!";
            } else {
                // Kiểm tra tài khoản và mật khẩu hợp lệ
                $userData = $this->loginModel->checkUser($Tendangnhap, $Matkhau);

                if ($userData && isset($userData['Vaitro']) ) {
                    // Lưu thông tin vào session
                    $_SESSION['Tendangnhap'] = $Tendangnhap;
                    $_SESSION['Vaitro'] = $userData['Vaitro'];
                    $_SESSION['Hoten'] = isset($userData['Hoten']) ? $userData['Hoten'] : '';
               
                   
                  
                  
                    $_SESSION['ID'] = isset($userData['ID']) ? $userData['ID'] : '';
                    $_SESSION['Ngaysinh'] = isset($userData['Ngaysinh']) ? $userData['Ngaysinh'] : '';
                    $_SESSION['Diachi'] = isset($userData['Diachi']) ? $userData['Diachi'] : '';
                    $_SESSION['Email'] = isset($userData['Email']) ? $userData['Email'] : '';
                    $_SESSION['Sdt'] = isset($userData['Sdt']) ? $userData['Sdt'] : '';
                    $_SESSION['Gioitinh'] = isset($userData['Gioitinh']) ? $userData['Gioitinh'] : '';
                   
                   
                     
                

                    // Điều hướng dựa trên vai trò
                    if ($_SESSION['Vaitro'] == 1) {
                        header("Location: http://localhost/Doan/Home/Get_data");
                        exit();
                    } else if ($_SESSION['Vaitro'] == 0) {
                        header("Location: http://localhost/Doan/Home/student");
                        exit();
                    } else if ($_SESSION['Vaitro'] == 2) {
                        header("Location: http://localhost/Doan/Home/teacher");
                        exit();
                    }
                } else {
                    $error_message = "Tài khoản hoặc mật khẩu không đúng";
                }
            }
        }

        // Nếu có lỗi, hiển thị thông báo và không chuyển hướng
        if (!empty($error_message)) {
            echo '<script>alert("' . $error_message . '");</script>';
        }

        // Chỉ điều hướng nếu không có lỗi
        echo '<script>window.location.href = "http://localhost/Doan/LoginController";</script>';
    }
}
