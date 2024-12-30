<style>
    body {
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        background-color: #ffffff;
    }

    .container {
        position: relative;
        width: 1000px;
        height: auto;
        background-image: url('http://localhost/Doan/Public/Pictures/OIP.jpeg');
        background-size: cover;
        background-position: center;
        border: 2px solid #ccc;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        padding: 40px;
        box-sizing: border-box;
        filter: brightness(1);
    }

    .info-box {
        background: rgba(255, 255, 255, 0.8);
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
    }

    .info-title {
        font-size: 24px;
        font-weight: bold;
        text-align: center;
        margin-bottom: 20px;
        color: #333;
    }

    .form-row {
        display: flex;
        justify-content: space-between;
        gap: 10px;
    }

    .form-column {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
    }

    .form-group label {
        font-size: 14px;
        font-weight: bold;
        color: #333;
        margin-bottom: 5px;
    }

    .form-group input,
    .form-group textarea,
    .form-group select {
        width: 100%;
        padding: 8px;
        font-size: 14px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
    }

    .btn {
        padding: 10px 20px;
        cursor: pointer;
        border-radius: 5px;
        text-align: center;
    }

    .btn-primary {
        background-color: #007bff;
        color: #fff;
        border: none;
    }

    .divider {
        width: 1.5px; /* Độ rộng của đường ngăn cách */
        background-color: #CED2D0;
        margin: 0 10px; /* Khoảng cách giữa các cột */
    }

    
    .column-left {
        flex: 0.5; 
        text-align: center;
    }

    .column-middle,
    .column-right {
        flex: 1; /* Chiếm phần rộng hơn */
    }

    .form-row .form-column {
        gap: 15px;
    }

    .image-container {
        margin-bottom: 15px;
    }

    .image-container img {
        width: 100%;
        max-width: 120px;
        height: auto;
        border-radius: 50%;
        margin-bottom: 10px;
    }

    .admin-label {
        font-size: 16px;
        font-weight: bold;
        text-align: center;
        color: #333;
    }
</style>

<body>
    <div class="container">
        <div class="info-box">
            <!-- Tiêu đề -->
            <h2 class="info-title">Thông Tin Người Dùng</h2>

            <form method="post" action="http://localhost/Doan/Thongtingv/updategv">
                <div class="form-row">
                    <!-- Cột bên trái -->
                    <div class="form-column column-left">
                        <div class="image-container">
                            <img src="http://localhost/Doan/Public/Pictures/user-with-shirt-and-tie_icon-icons.com_68276.png" alt="User Avatar">
                        </div>
                        <div class="admin-label">
                            Mã Giảng Viên: <?php echo $_SESSION['ID']; ?>
                        </div>
                    </div>

                    <!-- Cột ngăn cách giữa bên trái và giữa -->
                    <div class="divider"></div>

                    <!-- Cột giữa -->
                    <div class="form-column column-middle">
                        <div class="form-group">
                            <label for="Hoten">Họ và Tên:</label>
                            <input type="text" class="form-control" id="Hoten" name="txtHoten" value="<?php echo $_SESSION['Hoten']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="Ngaysinh">Ngày sinh:</label>
                            <input type="date" class="form-control" id="Ngaysinh" name="txtNgaysinh" value="<?php echo $_SESSION['Ngaysinh']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="Diachi">Địa chỉ:</label>
                            <input type="text" class="form-control" id="Diachi" name="txtDiachi" value="<?php echo $_SESSION['Diachi']; ?>" required>
                        </div>
                    </div>

                    <!-- Cột ngăn cách giữa giữa và phải -->
                    <div class="divider"></div>

                    <!-- Cột bên phải -->
                    <div class="form-column column-right">
                        <div class="form-group">
                            <label for="Email">Email:</label>
                            <input type="email" class="form-control" id="Email" name="txtEmail" value="<?php echo $_SESSION['Email']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="Sdt">Số điện thoại:</label>
                            <input type="tel" class="form-control" id="Sdt" name="txtSdt" value="<?php echo $_SESSION['Sdt']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="Gioitinh">Giới tính:</label>
                            <select class="form-control" name="txtGioitinh" required>
                                <option value="Nam" <?php echo ($_SESSION['Gioitinh'] == 'Nam') ? 'selected' : ''; ?>>Nam</option>
                                <option value="Nữ" <?php echo ($_SESSION['Gioitinh'] == 'Nữ') ? 'selected' : ''; ?>>Nữ</option>
                                <option value="Khác" <?php echo ($_SESSION['Gioitinh'] == 'Khác') ? 'selected' : ''; ?>>Khác</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group d-flex justify-content-end">
                    <button type="submit" name="btncapnhatgv" class="btn btn-primary">Lưu thay đổi</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal thông báo -->
    <div class="modal fade" id="resultModal" tabindex="-1" role="dialog" aria-labelledby="resultModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="resultModalLabel">Thông báo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php
                    if (!empty($data['result'])) {
                        switch ($data['result']) {
                            case 'success':
                                echo 'Cập nhật thông tin thành công!';
                                break;
                            case 'fail':
                                echo 'Cập nhật thông tin thất bại!';
                                break;
                        }
                    }
                    ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            <?php if (!empty($data['result'])) : ?>
                $('#resultModal').modal('show');
            <?php endif; ?>
        });
    </script>
</body>
