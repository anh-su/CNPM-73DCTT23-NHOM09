<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Ký Tài Khoản Sinh Viên</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        h4 {
            text-align: center;
            margin-top: 1cm;
        }

        h3 {
            text-align: center;
            margin-top: 1cm;
        }

        .custom-hr {
            border-top: 1px solid #333;
            width: 100%;
            margin-top: 10px;
            margin-bottom: 20px;
        }

        .form-container {
            width: 50%;
            margin: auto;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 15px;
        }

        .btn {
            width: 100%;
        }
    </style>
</head>

<body>
    <h4 class="mb-2">QUẢN LÝ KHOA</h4>
    <hr class="custom-hr">

    <!-- Form Đăng Ký -->
    <div class="form-container">
        <form method="post" action="http://localhost/Doan/Quanlykhoa/themmoi">
            <div class="form-row">
                <div class="form-group col-sm-12">
                    <label for="myID_Khoa">ID Khoa</label>
                    <input type="text" class="form-control" id="myID_Khoa" name="txtID_Khoa" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-sm-12">
                    <label for="myTenkhoa">Tên Khoa</label>
                    <input type="text" class="form-control" id="myTenkhoa" name="txtTenkhoa" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-sm-12">
                    <label for="myEmail">Email</label>
                    <input type="text" class="form-control" id="myEmail" name="txtEmail" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-sm-12">
                    <label for="mySdt">Liên Hệ</label>
                    <input type="tel" class="form-control" id="mySdt" name="txtSdt" required pattern="[0-9]+"
                        title="Chỉ được nhập số">

                </div>
            </div>

            <div class="form-group">
                <button style="background-color: #26a69a;" type="submit" class="btn btn-primary"
                    name="btnThemkhoa">Thêm</button>
            </div>
        </form>
    </div>


    <!-- Danh sách tài khoanr học sinh  -->


    <form method="post" action="http://localhost/Doan/Quanlykhoa/timkiem">
        <br>
        <hr class="custom-hr">

        <h3>Danh Sách Khoa</h3>
        <br>
        <div class="form-inline d-flex align-items-center">
            <div class="form-group">
                <label for="myID_Khoa">ID Khoa: </label>
                <input type="text" class="form-control1" id="myID_Khoa" name="keyword" 
    value="<?php echo isset($data['keyword']) ? htmlspecialchars($data['keyword']) : ''; ?>">



            </div>


            <div class="form-group">
                <button style="margin-left: 1cm; background-color: #26a69a;" type="submit" class="btn btn-primary"
                    name="btnTimkiem">Tìm Kiếm</button>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success" name="btnXuatExcel" style="margin-left: 1cm;">
                    Xuất Excel
                </button>
            </div>
        </div>

        <br>
        <table class="table table-striped">
            <thead>
                <tr style="background:#efeded">
                    <th>STT</th>
                    <th>ID Khoa</th>
                    <th>Tên Khoa</th>
                    <th>Email</th>
                    <th>Liên Hệ</th>
                    <th>Cài Đặt</th>




                </tr>
            </thead>
            <tbody>

                <?php if (!empty($data['danhsachkhoa'])):
                    $i = 0; ?>
                    <?php foreach ($data['danhsachkhoa'] as $Quanlykhoa): ?>
                        <tr>

                            <td><?php echo (++$i) ?></td>
                            <td><?php echo $Quanlykhoa['ID_Khoa'] ?></td>
                            <td><?php echo $Quanlykhoa['Tenkhoa'] ?></td>
                            <td><?php echo $Quanlykhoa['Email'] ?></td>
                            <td><?php echo $Quanlykhoa['Sdt'] ?></td>

                            <td>
                                <a href="#" class="edit-link" data-ID_Khoa="<?php echo $Quanlykhoa['ID_Khoa']; ?>"
                                    data-Tenkhoa="<?php echo $Quanlykhoa['Tenkhoa']; ?>"
                                    data-Email="<?php echo $Quanlykhoa['Email']; ?>"
                                    data-Sdt="<?php echo $Quanlykhoa['Sdt']; ?>">
                                    <img src="http://localhost/Doan/Public/Pictures/edit.gif" alt="Edit">
                                </a>
                                <a href="http://localhost/Doan/Quanlykhoa/xoakhoa/<?php echo $Quanlykhoa['ID_Khoa'] ?>">
                                    <img src="http://localhost/Doan/Public/Pictures/13.png" alt="Delete">
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center">Không có kết quả nào</td>
                    </tr>
                <?php endif; ?>
            </tbody>

        </table>
    </form>

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
                                echo 'Trùng mã Tài Khoản!';
                                break;

                            case 'upload_error':
                                echo 'Lỗi khi tải file lên!';
                                break;
                            case 'fail':
                                echo 'Thêm thất bại!';
                                break;
                            case 'success':
                                echo 'Thâm thành công!';
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
                    <h5 class="modal-title" id="editModalLabel">Chỉnh sửa thông tin khoa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Nội dung form chỉnh sửa -->
                    <form method="post" action="http://localhost/Doan/Quanlykhoa/capnhatkhoa">
                        <div class="container-fluid mt-3">
                            <div class="form-row">
                                <div class="form-group col-sm-6">
                                    <label for="modalID_Khoa">ID Khoa: </label>
                                    <input type="text" class="form-control" id="modalID_Khoa" name="txtID_Khoa"
                                        readonly>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="modalTenkhoa">Tên Khoa:</label>
                                    <input type="text" class="form-control" id="modalTenkhoa" name="txtTenkhoa">
                                </div>

                            </div>
                            <div class="form-row">
                                <div class="form-group col-sm-6">
                                    <label for="modalEmail">Email:</label>
                                    <input type="text" class="form-control" id="modalEmail" name="txtEmail">

                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="modalSdt">Liên Hệ:</label>
                                    <input type="tel" class="form-control" id="modalSdt" name="txtSdt" required
                                        pattern="[0-9]+" title="Chỉ được nhập số">

                                </div>

                            </div>

                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    <!-- Modal thông báo kết quả sửa -->
    <div class="modal fade" id="editResultModal" tabindex="-1" role="dialog" aria-labelledby="editResultModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editResultModalLabel">Kết Quả Sửa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php if (isset($data['editResult'])): ?>
                        <?php if ($data['editResult'] == 'success'): ?>
                            <p>Sửa thành công!</p>
                        <?php else: ?>
                            <p>Sửa thất bại!</p>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal thông báo kết quả xóa -->
    <div class="modal fade" id="deleteResultModal" tabindex="-1" role="dialog" aria-labelledby="deleteResultModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div style="background-color: #78dd78;" class="modal-header">
                    <h5 class="modal-title" id="deleteResultModalLabel">Kết Quả Xóa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php if (isset($data['resultdl'])): ?>
                        <?php if ($data['resultdl'] == 'success'): ?>
                            <p>Xóa thành công!</p>
                        <?php else: ?>
                            <p>Xóa thất bại!</p>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>




    <!-- Bootstrap & jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> <!-- Thay thế bằng bản đầy đủ -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function () {
            <?php if (!empty($data['result'])): ?>
                $('#resultModal').modal('show');
            <?php endif; ?>

            <?php if (isset($data['resultdl'])): ?>
                $('#deleteResultModal').modal('show');
            <?php endif; ?>

            <?php if (isset($data['editResult'])): ?>
                $('#editResultModal').modal('show');
            <?php endif; ?>
            $('.edit-link').click(function () {
                var ID_Khoa = $(this).data('id_khoa'); // Lấy đúng thuộc tính data-id_khoa
                var Tenkhoa = $(this).data('tenkhoa'); // Lấy đúng thuộc tính data-tenkhoa
                var Email = $(this).data('email');
                var Sdt = $(this).data('sdt');

                // In ra console để kiểm tra dữ liệu
                console.log(ID_Khoa, Tenkhoa, Email, Sdt);

                // Gán dữ liệu vào các trường trong modal
                $('#modalID_Khoa').val(ID_Khoa);
                $('#modalTenkhoa').val(Tenkhoa);
                $('#modalEmail').val(Email);
                $('#modalSdt').val(Sdt);

                // Hiển thị modal
                $('#editModal').modal('show');
            });

        });

        document.getElementById("mySdt").addEventListener("input", function (event) {
            this.value = this.value.replace(/[^0-9]/g, ''); // Loại bỏ tất cả ký tự không phải số
        });
        document.getElementById("modalSdt").addEventListener("input", function (event) {
            this.value = this.value.replace(/[^0-9]/g, ''); // Loại bỏ tất cả ký tự không phải số
        });



    </script>
</body>

</html>