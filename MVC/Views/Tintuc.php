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
            top: 20%;
            left: 5%;
            text-align: left;
            color: white;
            font-size: 30px; /* Giảm kích thước chữ */
            font-weight: bold;
            font-family: 'Playfair Display', serif;
            z-index: 2;
            opacity: 0;
            animation: slideInFromTop 1s forwards; /* Thêm hiệu ứng slide-in từ trên xuống */
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

        .main-content .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: calc(100% + 60vw); /* Chiều rộng bằng chiều rộng của toàn bộ phần tử cộng thêm */
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7); /* Overlay màu đen với độ mờ 70% */
            z-index: 1;
            margin-left: calc(-30vw); /* Kéo overlay rộng ra hai phía */
        }

        .main-content img {
            width: 100vw; /* Chiếm hết chiều rộng màn hình (viewport) */
            height: auto;
            margin-left: calc(-50vw + 50%); /* Kéo hình ảnh rộng ra hai phía */
            border-radius: 0; /* Loại bỏ bo góc để ảnh chiếm hết chiều rộng */
            box-shadow: none; /* Tùy chỉnh nếu không muốn ảnh có bóng đổ */
        }

        .info-boxes {
            display: flex;
            justify-content: space-around;
            margin-top: 30px;
            gap: 20px;
        }

        .info-box {
            flex: 1;
            background-color: #e0f7fa; /* Màu xanh nước biển nhạt */
            border: 1px solid #0a1f94;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .info-box h3 {
            font-size: 20px; /* Cỡ chữ nhỏ đi */
            font-family: 'Playfair Display', serif;
            color: black; /* Tiêu đề màu đen */
            margin-bottom: 10px;
        }

        .info-box p {
            font-size: 14px; /* Cỡ chữ nhỏ đi */
            font-family: 'Montserrat', sans-serif;
            color: gray; /* Màu xám */
        }

        .news-section {
            margin-top: 50px;
            text-align: center;
        }

        .news-section h2 {
            font-size: 24px;
            font-family: 'Playfair Display', serif;
            color: #0a1f94;
        }

        .news-box {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
            gap: 20px;
        }

        .news-item {
            flex: 1;
            display: flex;
            background-color: #f8f9fa;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .news-item img {
            width: 150px;
            height: 100px;
            margin-right: 20px;
            border-radius: 5px;
            object-fit: cover;
        }

        .news-item h3 {
            font-size: 20px;
            font-family: 'Playfair Display', serif;
            color: black;
            margin-bottom: 10px;
        }

        .news-item p {
            font-size: 14px;
            font-family: 'Montserrat', sans-serif;
            color: gray;
        }

        .news-item a {
            text-decoration: none;
            color: #007bff;
        }

        .news-item a:hover {
            text-decoration: underline;
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
            <div class="overlay"></div>
            <div class="text-overlay">
                <span>Tin tức</span>
            </div>
            <img src="http://localhost/Doan/Public/Pictures/BOTT0572(1)1.jpg" alt="Campus Image">
        </div>

        <div class="news-section">
    <h2>Tin tức gần nhất</h2>
    <!-- Hàng đầu tiên -->
    <div class="news-box">
        <div class="news-item">
            <img src="http://localhost/Doan/Public/Pictures/dai-hoi-doantn-2025-15.jpg" alt="Campus Image">
            <div>
                <h3><a href="https://utt.edu.vn/utt/tin-tuc-su-kien/dai-hoi-dai-bieu-doan-tncs-ho-chi-minh-truong-dai-hoc-cong-nghe-gtvt-khoa-xi-nhiem-ky-2024-2027-a16034.html">Đại hội đại biểu Đoàn TNCS Hồ Chí Minh Trường Đại học Công nghệ GTVT khóa XI, nhiệm kỳ 2024-2027</a></h3>
                <p>Ngày 27/12, Đoàn TNCS Hồ Chí Minh Trường Đại học Công nghệ GTVT đã long trọng tổ chức Đại hội đại biểu lần thứ XI, nhiệm kỳ 2024 – 2027 với...</p>
            </div>
        </div>
        <div class="news-item">
            <img src="http://localhost/Doan/Public/Pictures/695644.jpg" alt="Campus Image">
            <div>
                <h3><a href="https://utt.edu.vn/utt/tin-tuc-su-kien/hoi-nghi-tong-ket-cong-tac-tuyen-sinh-2024-a16032.html">Hội nghị tổng kết công tác tuyển sinh 2024</a></h3>
                <p>Hội nghị nhằm tổng kết, đánh giá kết quả đã đạt được và tìm ra những hạn chế, nguyên nhân và bài học kinh nghiệm của công tác tuyển sinh năm 2024, từ...</p>
            </div>
        </div>
    </div>
    <!-- Hàng thứ hai -->
    <div class="news-box">
        <div class="news-item">
            <img src="http://localhost/Doan/Public/Pictures/z6152906845138_7d37eb7b5497a7f3facd1510ca29d660.jpg" alt="Campus Image">
            <div>
                <h3><a href="https://utt.edu.vn/utt/tin-tuc-su-kien/truong-dh-cong-nghe-gtvt-tham-gia-cac-hoat-dong-ve-nguon-tai-tinh-dien-bien-a16025.html">Trường ĐH Công nghệ GTVT tham gia các hoạt động về nguồn tại tỉnh Điện Biên</a></h3>
                <p>Trong 03 ngày (20,21,22/12/2024), nhân dịp kỷ niệm 80 năm ngày thành lập Quân đội Nhân dân Việt Nam (22/12/1944 - 22/12/2024), Đoàn công tác của Nhà xuất bản Chính...</p>
            </div>
        </div>
        <div class="news-item">
            <img src="http://localhost/Doan/Public/Pictures/z6149703449223_857d48c2aec371d5f06565f7ccce3edc.jpg" alt="Campus Image">
            <div>
                <h3><a href="https://utt.edu.vn/utt/tin-tuc-su-kien/utt-tham-du-ngay-hoi-khoi-nghiep-doi-moi-sang-tao-tinh-vinh-phuc-lan-thu-2-a16019.html">UTT tham dự Ngày hội Khởi nghiệp đổi mới sáng tạo tỉnh Vĩnh Phúc lần thứ 2</a></h3>
                <p>Sáng 20/12, tại Vĩnh Phúc, UBND tỉnh Vĩnh Phúc phối hợp với Bộ Khoa học và Công nghệ, Bộ Kế hoạch và Đầu tư tổ chức sự kiện Ngày hội khởi nghiệp đổi...</p>
            </div>
        </div>
    </div>
</div>

    </div>

    </body>
    </html>