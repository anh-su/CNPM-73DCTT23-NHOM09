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
            font-size: 30px;
            font-weight: bold;
            font-family: 'Playfair Display', serif;
            z-index: 2;
            animation: slideInFromTop 1s forwards;
        }

        .main-content .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: calc(100% + 60vw);
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            z-index: 1;
            margin-left: calc(-30vw);
            
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
        .main-content img {
            width: 100vw;
            height: auto;
            margin-left: calc(-50vw + 50%);
            border-radius: 0;
            box-shadow: none;
        }

        .news-section {
            margin-top: 50px;
            padding: 20px;
            background-color: #f4f4f9;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .news-section h2 {
            font-size: 24px;
            font-family: 'Playfair Display', serif;
            color: #0a1f94;
            margin-bottom: 20px;
        }

        .news-item {
            display: flex;
            align-items: center;
            background-color: white;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 10px;
            margin-bottom: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .news-item img {
            width: 50px;
            height: 50px;
            margin-right: 15px;
            border-radius: 50%;
            object-fit: cover;
        }

        .news-item h3 {
            font-size: 18px;
            font-family: 'Montserrat', sans-serif;
            color: #333;
            margin: 0;
        }

        .news-item p {
            font-size: 14px;
            font-family: 'Montserrat', sans-serif;
            color: #666;
            margin: 5px 0 0;
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
            <div class="overlay"></div>
            <div class="text-overlay">
                <span>Thông báo</span>
            </div>
            <img src="http://localhost/Doan/Public/Pictures/BOTT0572(1)1.jpg" alt="Campus Image">
        </div>

        <div class="news-section">
            <h2>Thông báo mới nhất</h2>

            <div class="news-item">
                <img src="http://localhost/Doan/Public/Pictures/speaker_announcement_loudspeaker_promotion_loud_bullhorn_marketing_sound_megaphone_icon_229024.png" alt="Icon">
                <div>
                    <h3><a href="https://utt.edu.vn/utt/thong-bao/thong-bao-ve-viec-to-chuc-cuoc-thi-y-tuong-sang-tao-va-khoi-nghiep-trong-sinh-vien-nam-2024-a16018.html">Cuộc thi Ý tưởng sáng tạo năm 2024</a></h3>
                    <p>Thông báo về việc tổ chức cuộc thi "Ý tưởng sáng tạo và khởi nghiệp trong sinh viên năm 2024"</p>
                </div>
            </div>

            <div class="news-item">
                <img src="http://localhost/Doan/Public/Pictures/speaker_announcement_loudspeaker_promotion_loud_bullhorn_marketing_sound_megaphone_icon_229024.png" alt="Icon">
                <div>
                <h3><a href="https://utt.edu.vn/utt/thong-bao/thong-bao-ve-viec-tuyen-truyen-huan-luyen-nghiep-vu-pccc-cnch-va-dien-tap-phuong-an-chua-chay-a15997.html">Tuyên truyền phòng cháy chữa cháy</a></h3>
                    <p>Thông báo về việc tuyên truyền, huấn luyện nghiệp vụ PCCC và CNCH</p>
                </div>
            </div>

            <div class="news-item">
                <img src="http://localhost/Doan/Public/Pictures/speaker_announcement_loudspeaker_promotion_loud_bullhorn_marketing_sound_megaphone_icon_229024.png" alt="Icon">
                <div>
                <h3><a href="https://utt.edu.vn/utt/thong-bao/thong-bao-ve-viec-bo-nhiem-chuc-danh-giao-su-pho-giao-su-nam-2024-a15963.html">Kết quả xét chức danh</a></h3>
                    <p>Thông báo về việc bổ nhiệm chức danh Giáo sư, Phó Giáo sư năm 2024</p>
                </div>
            </div>

            <div class="news-item">
                <img src="http://localhost/Doan/Public/Pictures/speaker_announcement_loudspeaker_promotion_loud_bullhorn_marketing_sound_megaphone_icon_229024.png" alt="Icon">
                <div>
                <h3><a href="https://utt.edu.vn/utt/thong-bao/ke-hoach-to-chuc-hoi-nghi-vien-chuc-nguoi-lao-dong-nam-2025-a16010.html">Kế hoạch hội nghị năm 2025</a></h3>
                    <p>Kế hoạch tổ chức hội nghị viên chức, người lao động năm 2025</p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
