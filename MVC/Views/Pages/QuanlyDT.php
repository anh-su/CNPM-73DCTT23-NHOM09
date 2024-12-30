<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký đề tài</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .container {
            margin-top: 50px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .readonly-input {
            background-color: #f8f9fa;
            cursor: not-allowed;
        }

        .btn-add-member {
            background-color: #28a745;
            color: white;
            border: none;
        }

        .btn-add-member:hover {
            background-color: #218838;
        }

        .file-input {
            margin-top: 10px;
        }

        .member-list {
            margin-top: 20px;
        }

        .member-row {
            margin-bottom: 10px;
        }

        .btn-remove-member {
            background-color: #dc3545;
            color: white;
            border: none;
        }

        .btn-remove-member:hover {
            background-color: #c82333;
        }

        .custom-hr {
            border-top: 1px solid #333;
            width: 100%;
            margin-top: 10px;
            margin-bottom: 20px;
        }

        .status-created {
            background-color: #28a745;
            color: white;
            padding: 5px;
            border-radius: 4px;
        }

        .status-ended {
            background-color: #dc3545;
            color: white;
            padding: 5px;
            border-radius: 4px;
        }
    </style>
</head>

<body>

    <div class="container">
        <h2 class="text-center mb-4">TẠO ĐỀ TÀI NGHIÊN CỨU KHOA HỌC</h2>
        <a href="http://localhost/Doan/DSdetai" class="edit-link">
            <==Quản Lý Đề Tài</a>
                <hr class="custom-hr">
                <form id="registrationForm" method="post" action="http://localhost/Doan/QuanlyDT/themmoi"
                    enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="Madetai">Mã Đề Tài:</label>
                        <input type="text" class="form-control" id="Madetai" name="txtMadetai"
                            placeholder="Nhập Mã Đề Tài" required>
                    </div>
                    <div class="form-group">
                        <label for="Tendetai">Tên Đề Tài:</label>
                        <input type="text" class="form-control" id="Tendetai" name="txtTendetai"
                            placeholder="Nhập Tên Đề Tài" required>
                    </div>
                    <div class="form-group">
                        <label for="Tieude">Tiêu đề:</label>
                        <input type="text" class="form-control" id="Tieude" name="txtTieude" placeholder="Nhập Tiêu Đề"
                            required>
                    </div>

                    <div class="form-group">
                        <label for="Ngaybatdau">Ngày Bắt Đầu</label>
                        <input type="date" class="form-control" id="Ngaybatdau" name="txtNgaybatdau" required>
                    </div>

                    <div class="form-group">
                        <label for="Ngayketthuc">Ngày Kết Thúc:</label>
                        <input type="date" class="form-control" id="Ngayketthuc" name="txtNgayketthuc" required>
                    </div>

                    <div class="form-group">
                        <label for="notes">Mô Tả:</label>
                        <textarea class="form-control" id="Mota" name="txtMota" rows="4" placeholder="Mô tả"></textarea>
                    </div>

                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-primary" name='btnthemdt'>Đăng ký đề tài</button>
                    </div>
                </form>

                <hr class="custom-hr">
                <h4 class="text-center mb-4">Danh Sách Đề Tài Đã Tạo</h4>
                <table class="table table-striped">
                    <thead>
                        <tr style="background:#efeded">
                            <th>STT</th>
                            <th>Mã Đề Tài</th>
                            <th>Tên Đề Tài</th>
                            <th>Tiêu Đề</th>
                            <th>Trạng Thái</th>
                            <th>Ngày Bắt Đầu</th>
                            <th>Ngày Kết Thúc</th>
                            <th>Mô Tả</th>
                            <th>Cài Đặt</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($data['danhsachdetai'])):
                            $i = 0; ?>
                            <?php foreach ($data['danhsachdetai'] as $detai): ?>
                                <tr>
                                    <td><?php echo (++$i) ?></td>
                                    <td><?php echo htmlspecialchars($detai['Madetai']) ?></td>
                                    <td><?php echo htmlspecialchars($detai['Tendetai']) ?></td>
                                    <td><?php echo htmlspecialchars($detai['Tieude']) ?></td>
                                    <td>
                                        <?php
                                        $ngayKetThuc = new DateTime($detai['Ngayketthuc']);
                                        $today = new DateTime();
                                        if ($today > $ngayKetThuc) {
                                            echo '<span class="status-ended">Đã kết thúc</span>';
                                        } else {
                                            echo '<span class="status-created">Đã tạo</span>';
                                        }
                                        ?>
                                    </td>
                                    <td><?php echo htmlspecialchars($detai['Ngaybatdau']) ?></td>
                                    <td><?php echo htmlspecialchars($detai['Ngayketthuc']) ?></td>
                                    <td><?php echo htmlspecialchars($detai['Mota']) ?></td>
                                    <td>
                                        <!-- Add your action buttons here -->
                                        <button class="btn btn-info btn-edit" data-toggle="modal" data-target="#editModal"
                                            data-id="<?php echo $detai['Madetai']; ?>"
                                            data-tendetai="<?php echo $detai['Tendetai']; ?>"
                                            data-tieude="<?php echo $detai['Tieude']; ?>"
                                            data-ngaybatdau="<?php echo $detai['Ngaybatdau']; ?>"
                                            data-ngayketthuc="<?php echo $detai['Ngayketthuc']; ?>"
                                            data-mota="<?php echo $detai['Mota']; ?>"
                                            data-trangthai="<?php echo ($today > $ngayKetThuc) ? 'Đã kết thúc' : 'Đã tạo'; ?>">Sửa</button>
                                        <button class="btn btn-danger btn-delete"
                                            data-id="<?php echo $detai['Madetai']; ?>">Xóa</button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="9" class="text-center">Không có kết quả nào</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="resultModal" tabindex="-1" role="dialog" aria-labelledby="resultModalLabel"
        aria-hidden="true">
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
                            case 'duplicate':
                                echo 'Trùng mã Đề Tài!';
                                break;
                            case 'invalid_start_date':
                                echo 'Ngày bắt đầu phải là ngày trong tương lai!';
                                break;
                            case 'invalid_end_date':
                                echo 'Ngày kết thúc phải sau ngày bắt đầu!';
                                break;
                            case 'fail':
                                echo 'Tạo đề tài thất bại!';
                                break;
                            case 'success':
                                echo 'Tạo đề tài thành công!';
                                break;
                            case 'update_success':
                                echo 'Sửa đề tài thành công!';
                                break;
                            case 'update_fail':
                                echo 'Sửa đề tài thất bại!';
                                break;
                            case 'delete_success':
                                echo 'Xóa đề tài thành công!';
                                break;
                            case 'delete_fail':
                                echo 'Xóa đề tài thất bại!';
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

    <!-- Modal chỉnh sửa -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Chỉnh Sửa Đề Tài</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editForm" method="post" action="http://localhost/Doan/QuanlyDT/sua">
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="editMadetai">Mã Đề Tài:</label>
                                <input type="text" class="form-control" id="editMadetai" name="Madetai" readonly>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="editTendetai">Tên Đề Tài:</label>
                                <input type="text" class="form-control" id="editTendetai" name="Tendetai" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="editTieude">Tiêu Đề:</label>
                                <input type="text" class="form-control" id="editTieude" name="Tieude" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="editNgaybatdau">Ngày Bắt Đầu:</label>
                                <input type="date" class="form-control" id="editNgaybatdau" name="Ngaybatdau" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="editNgayketthuc">Ngày Kết Thúc:</label>
                                <input type="date" class="form-control" id="editNgayketthuc" name="Ngayketthuc"
                                    required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="editMota">Mô Tả:</label>
                            <textarea class="form-control" id="editMota" name="Mota" rows="4" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="editTrangthai">Trạng Thái:</label>
                            <input type="text" class="form-control" id="editTrangthai" name="Trangthai" readonly>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                            <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal Xác Nhận Xóa -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Xác Nhận Xóa Đề Tài</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Bạn chắc chắn muốn xóa đề tài này không?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                    <a href="#" id="deleteConfirmBtn" class="btn btn-danger">Xóa</a>
                </div>
            </div>
        </div>
    </div>

    <form id="deleteForm" method="post" action="http://localhost/Doan/QuanlyDT/xoa">
        <input type="hidden" name="Madetai" id="deleteMadetai">
    </form>

    <script>
        $(document).ready(function () {
            <?php if (!empty($data['result'])): ?>
                $('#resultModal').modal('show');
            <?php endif; ?>

            document.getElementById("registrationForm").addEventListener("submit", function (e) {
                const ngayBatDau = new Date(document.getElementById("Ngaybatdau").value);
                const ngayKetThuc = new Date(document.getElementById("Ngayketthuc").value);
                const today = new Date();
                today.setHours(0, 0, 0, 0); // Đặt thời gian về đầu ngày để so sánh chính xác
                ngayBatDau.setCustomValidity("");
                ngayKetThuc.setCustomValidity("");
                // Kiểm tra Ngày Bắt Đầu phải là tương lai
                if (ngayBatDau <= today) {
                    e.preventDefault(); // Ngăn form gửi đi
                    ngayBatDau.setCustomValidity("Ngày bắt đầu phải là ngày trong tương lai!");
                    ngayBatDau.reportValidity(); // Hiển thị thông báo lỗi
                    return;
                }

                // Kiểm tra Ngày Kết Thúc không được trước Ngày Bắt Đầu
                if (ngayKetThuc < ngayBatDau) {
                    e.preventDefault(); // Ngăn form gửi đi
                    ngayKetThuc.setCustomValidity("Ngày kết thúc không được trước ngày bắt đầu!");
                    ngayKetThuc.reportValidity(); // Hiển thị thông báo lỗi
                    return;
                }
            });
            // Fill the edit modal with the current data
            $('.btn-edit').on('click', function () {
                var madetai = $(this).data('id');
                var tendetai = $(this).data('tendetai');
                var tieude = $(this).data('tieude');
                var ngaybatdau = $(this).data('ngaybatdau');
                var ngayketthuc = $(this).data('ngayketthuc');
                var mota = $(this).data('mota');
                var trangthai = $(this).data('trangthai');

                $('#editMadetai').val(madetai);
                $('#editTendetai').val(tendetai);
                $('#editTieude').val(tieude);
                $('#editNgaybatdau').val(ngaybatdau);
                $('#editNgayketthuc').val(ngayketthuc);
                $('#editMota').val(mota);
                $('#editTrangthai').val(trangthai);
            });
            $('.btn-delete').on('click', function () {
                var madetai = $(this).data('id');
                $('#deleteMadetai').val(madetai);
                $('#deleteModal').modal('show');
            });

            $('#deleteConfirmBtn').on('click', function () {
                $('#deleteForm').submit();
            });
        });
    </script>

</body>

</html>