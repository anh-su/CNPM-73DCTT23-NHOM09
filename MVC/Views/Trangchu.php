<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Chủ</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* CSS cho header */
        .header {
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f8f9fa;
            padding: 10px 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            gap: 50px;
        }

        .nav-menu {
            display: flex;
            list-style: none;
            padding: 0;
            margin: 0;
            gap: 50px;
            font-weight: bold;
            font-family: 'Playfair Display', serif;
        }

        .nav-menu a {
            text-decoration: none;
            color: #333;
            font-size: 16px;
            font-weight: 500;
            
        }

        .nav-menu a:hover {
            color: #007bff;
        }

        .logo {
            position: relative;
            width: 100px;
            height: 100px;
            clip-path: polygon(50% 0%, 100% 38%, 82% 100%, 18% 100%, 0% 38%);
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .logo img {
            width: 100%;
            height: auto;
            object-fit: cover;
        }

        /* CSS cho phần nội dung chính */
        .main-content {
            position: relative;
            text-align: center;
            margin-top: 30px;
        }

        .main-content .text-overlay {
            position: absolute;
            bottom: 400px; /* Đặt chữ ở gần phía dưới ảnh */
            left: 50%;
            transform: translateX(-50%);
            text-align: center;
            
        }

        .main-content .text-overlay span:first-child {
            display: block;
            color: #0a1f94; /* Màu xanh nước biển */
            font-size: 36px; /* Tăng cỡ chữ */
            font-weight: bold;
            font-family: 'Playfair Display', serif; /* Font chữ nghệ thuật */
            margin-bottom: 10px; /* Khoảng cách giữa hai dòng chữ */
            animation: slideInFromTop 1s forwards;
        }

        .main-content .text-overlay span:last-child {
            display: block;
            background-color: rgba(0, 123, 255, 0.8); /* Nền xanh cho dòng dưới */
            color: white;
            font-size: 36px; /* Tăng cỡ chữ */
            font-weight: bold;
            font-family: 'Playfair Display', serif; /* Font chữ nghệ thuật */
            padding: 10px 20px;
            border-radius: 5px;
            animation: slideInFromTop 1s forwards;
        }

        .main-content img {
            width: 100%; /* Phóng to ảnh */
            height: auto;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        @keyframes slideInFromTop {
            from {
                transform: translateY(-100%);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }
    </style>
</head>

<body>

    <div class="header">

    <ul class="nav-menu">
    <li><a href="http://localhost/Doan/Home/Get_data">Trang chủ</a></li>
    <li><a href="http://localhost/Doan/Home/Gioithieu">Giới thiệu</a></li>
    <li><a href="http://localhost/Doan/Home/Tintuc">Tin tức</a></li>
</ul>


        <div class="logo">
            <img src="http://localhost/Doan/Public/Pictures/tải xuống.png" alt="Logo">
        </div>

        <ul class="nav-menu">
        <li><a href="http://localhost/Doan/Home/Thongbao">Thông báo</a></li>
            <li><a href="http://localhost/Doan/Home/Lienhe">Liên hệ</a></li>
            <li><a href="http://localhost/Doan/LoginController/login">Đăng Nhập</a></li>
        </ul>
    </div>

    <div class="container mt-4">
        <div class="main-content">
            <!-- Chữ nằm chồng trên ảnh -->
            <div class="text-overlay">
                <span>Cùng Khám Phá Đại Học</span>
                <span>Công Nghệ Giao Thông Vận Tải</span>
            </div>
            <img src="http://localhost/Doan/Public/Pictures/BOTT0572(1).jpg" alt="Campus Image">
        </div>
    </div>
</body>

</html>
