<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi Tiết Đề Tài</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .container {
            margin-top: 50px;
        }

        .custom-hr {
            border-top: 1px solid #333;
            width: 100%;
            margin-top: 10px;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .readonly-input {
            background-color: #f8f9fa;
            cursor: not-allowed;
        }

        .button-container {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .step-icon {
            font-size: 20px;
            color: gray;
        }

        .step-icon.active {
            color: green;
        }

        .progress-bar {
            background-color: #28a745;
        }

        .step p {
            margin-top: 5px;
            font-size: 12px;
            text-align: center;
        }

        /* Kiểu cho dấu tích màu xanh */
        .step-icon.checked {
            color: green;
        }

        /* Kiểu cho dấu X màu đỏ */
        .step-icon.rejected {
            color: red;
        }
    </style>
</head>

<body>
    <div class="container">
        <h4 class="text-center mb-4">Danh Sách Đề Tài Của Sinh Viên</h4>
        <hr class="custom-hr">
        <table class="table table-striped">
            <thead>
                <tr style="background:#efeded">
                    <th>STT</th>
                    <th>ID/Tên Nhóm</th>
                    <th>Mã Đề Tài</th>
                    <th>Tên Đề Tài</th>
                    <th>Giảng Viên Hướng Dẫn</th>
                    <th>Trạng Thái</th>
                    <th>Hoạt Động</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($data['danhsachdkdetai'])):
                    $i = 0; ?>
                    <?php foreach ($data['danhsachdkdetai'] as $detai): ?>
                        <tr>
                            <td><?php echo (++$i) ?></td>
                            <td><?php echo htmlspecialchars($detai['ID_DTSV']) ?></td>
                            <td><?php echo htmlspecialchars($detai['Madetai']) ?></td>
                            <td><?php echo htmlspecialchars($detai['Tendetai_Detai']) ?></td>
                            <td><?php echo htmlspecialchars($detai['Hotengv']) ?></td>
                            <td><?php echo htmlspecialchars($detai['TrangthaiDT']) ?></td>
                            <td class="button-container">
                                <button class="btn btn-info btn-detail" data-toggle="modal" data-target="#detailModal"
                                    data-id="<?php echo $detai['ID_DTSV']; ?>"
                                    data-trangthai="<?php echo $detai['TrangthaiDT']; ?>">Chi Tiết</button>
                                <button class="btn btn-warning btn-update" data-toggle="modal" data-target="#editModal"
                                    data-id="<?php echo $detai['ID_DTSV']; ?>">Bài Làm</button>

                                <button class="btn btn-success btn-status" data-toggle="modal" data-target="#statusModal"
                                    data-id="<?php echo $detai['ID_DTSV']; ?>" data-hoten="<?php echo $detai['Hoten']; ?>"
                                    data-diem="<?php echo $detai['Diem']; ?>" data-nhanxet="<?php echo $detai['Nhanxet']; ?>"
                                    data-trangthai="<?php echo $detai['TrangthaiDT']; ?>">
                                    Trạng Thái
                                </button>
                                <?php if ($detai['TrangthaiDT'] == 'Hoàn Thành'): ?>
                                    <button class="btn btn-danger btn-delete disabled" disabled
                                        data-id="<?php echo $detai['ID_DTSV']; ?>">Hủy Đề
                                        Tài</button>
                                <?php else: ?>
                                    <button class="btn btn-danger btn-reject" data-id="<?php echo $detai['ID_DTSV']; ?>">Hủy Đề Tài</button>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center">Không có kết quả nào</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Modal Chi Tiết -->
    <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel"
        aria-hidden="true">
        <div style=" max-width: 70% ;" class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailModalLabel">Danh Sách Thành Viên</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <hr class="custom-hr">
                <div class="modal-body">
                    <div id="memberDetails">
                        <p>Đang tải thông tin thành viên...</p>
                    </div>
                    <h5 class="modal-title" id="detailModalLabel">Thêm Thành Viên</h5>
                    <hr class="custom-hr">
                    <form id="memberForm">
                        <div class="form-group">
                            <label for="detailID_DTSV">ID/Tên Nhóm:</label>
                            <input type="text" class="form-control" id="detailID_DTSV" name="ID_DTSV" readonly>
                        </div>
                        <div class="form-group">
                            <label for="detailID_Sinhvien">ID Sinh Viên:</label>
                            <input type="text" class="form-control" id="detailID_Sinhvien" name="ID_Sinhvien" required>
                        </div>
                        <div class="form-group">
                            <label for="detailHoten">Họ Tên:</label>
                            <input type="text" class="form-control" id="detailHoten" name="Hoten" required>
                        </div>
                        <div class="form-group">
                            <label for="detailTenKhoa">Tên Khoa:</label>
                            <select class="form-control" id="detailTenKhoa" name="TenKhoa">
                                <?php foreach ($data['danhsachtenkhoa'] as $khoa): ?>
                                    <option value="<?php echo htmlspecialchars($khoa['Tenkhoa']); ?>">
                                        <?php echo htmlspecialchars($khoa['Tenkhoa']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">




                    <button type="button" class="btn btn-success " id="addMemberButton">Thêm Thành Viên</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                </div>

            </div>

        </div>
    </div>

    <!-- Modal Bài Làm -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
        aria-hidden="true">
        <div style=" max-width: 75% ;" class="modal-dialog modal-xl-custom" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Thông Tin Bài Làm</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="detaisinhvienDetails">
                        <!-- Thông tin chi tiết sẽ được thêm vào đây bằng JavaScript -->
                    </div>
                    <hr class="custom-hr">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="statusModal" tabindex="-1" role="dialog" aria-labelledby="statusModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="statusModalLabel">Xem Chi Tiết Đề Tài</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Progress Bar -->
                    <div class="progress" style="height: 20px;">
                        <div id="statusProgress" class="progress-bar" role="progressbar" style="width: 0%;"
                            aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>

                    <!-- Status Steps -->
                    <div class="mt-4">
                        <div class="d-flex justify-content-between">
                            <div class="step">
                                <i class="fa fa-circle step-icon" id="step1"></i>
                                <p>Chờ Duyệt</p>
                            </div>
                            <div class="step">
                                <i class="fa fa-circle step-icon" id="step2"></i>
                                <p>Đã Duyệt</p>
                            </div>
                            <div class="step">
                                <i class="fa fa-circle step-icon" id="step3"></i>
                                <p>Đã Phân Công</p>
                            </div>
                            <div class="step">
                                <i class="fa fa-circle step-icon" id="step4"></i>
                                <p>Đã Chấm</p>
                            </div>
                            <div class="step">
                                <i class="fa fa-circle step-icon" id="step5"></i>
                                <p>Đã Hoàn Thành</p>
                            </div>
                            <div class="step">
                                <i class="fa fa-circle step-icon" id="step6"></i>
                                <p>Đã Dừng</p>
                            </div>
                        </div>
                    </div>


                    <!-- Additional Details -->
                    <div class="mt-4">
                        <h5>Thông Tin Chi Tiết</h5>
                        <hr class="custom-hr">
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="ID_DTSV">ID / Tên Nhóm</label>
                                <input type="text" class="form-control" id="id_tennhom" readonly>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="Hoten">Giảng viên chấm thi:</label>
                                <input type="text" class="form-control" id="hoten" readonly>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="Diem">Điểm:</label>
                                <input type="number" class="form-control" id="diem" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Nhanxet">Nhận xét:</label>
                            <textarea class="form-control" id="nhanxet" rows="3" readonly></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>




    <!-- Modal -->
    <div id="notificationModal" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Thông báo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p id="modalMessage"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Xác nhận hủy đề tài -->
     <!-- Modal xác nhận từ chối -->
     <div class="modal fade" id="confirmRejectModal" tabindex="-1" role="dialog"
            aria-labelledby="confirmRejectModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmRejectModalLabel">Xác nhận từ chối</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Bạn có chắc chắn muốn hủy đề tài này không?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                        <button type="button" class="btn btn-danger" id="confirmRejectButton">Kết Thúc Đề Tài</button>
                    </div>
                </div>
            </div>
        </div>


    <script>

        $(document).ready(function () {




            $('.btn-status').on('click', function () {
                var idDTSV = $(this).data('id');
                var hoTen = $(this).data('hoten');
                var diem = $(this).data('diem');
                var nhanXet = $(this).data('nhanxet');
                var trangThaiLichSu = $(this).data('trangthai').split(','); // Chuyển chuỗi thành mảng

                $('#id_tennhom').val(idDTSV);
                $('#hoten').val(hoTen);
                $('#diem').val(diem);
                $('#nhanxet').val(nhanXet);

                // Hàm cập nhật trạng thái
                function updateStatus(trangThaiLichSu) {
                    // Tắt tất cả trạng thái trước
                    for (var i = 1; i <= 6; i++) {
                        var step = document.getElementById('step' + i);
                        step.classList.remove('checked', 'rejected');
                    }

                    // Mảng định nghĩa thứ tự trạng thái
                    const allStates = ['Chờ Duyệt', 'Đã Duyệt', 'Đã Duyệt / Đã Phân Công', 'Đã Chấm', 'Hoàn Thành', 'Từ Chối'];

                    // Biến lưu trạng thái cao nhất đã đạt
                    let maxStateIndex = -1;

                    // Xác định trạng thái cao nhất đã đạt được trong lịch sử
                    trangThaiLichSu.forEach(function (trangThai) {
                        const stateIndex = allStates.indexOf(trangThai);
                        if (stateIndex > maxStateIndex) {
                            maxStateIndex = stateIndex;
                        }
                    });

                    // Kiểm tra nếu trạng thái "Đã Dừng" xuất hiện
                    if (trangThaiLichSu.includes('Từ Chối')) {
                        // Nếu có trạng thái "Đã Dừng", đánh dấu tất cả là "rejected"
                        for (var i = 1; i <= 6; i++) {
                            var step = document.getElementById('step' + i);
                            step.classList.add('rejected');
                        }
                    } else {
                        // Đánh dấu các trạng thái từ 0 đến maxStateIndex là "checked"
                        for (let i = 0; i <= maxStateIndex; i++) {
                            document.getElementById('step' + (i + 1)).classList.add('checked');
                        }
                    }
                }

                // Gọi hàm để cập nhật trạng thái
                updateStatus(trangThaiLichSu);

                $.ajax({
                    url: 'http://localhost/Doan/ChitietDT/Get_grade_details',
                    type: 'POST',
                    data: { ID_DTSV: idDTSV },
                    success: function (response) {
                        var data = JSON.parse(response);
                        if (data) {
                            $('#id_tennhom').val(data.ID_DTSV).prop('readonly', true);
                            $('#hoten').val(data.Hoten).prop('readonly', true);
                            $('#diem').val(data.Diem).prop('readonly', true);
                            $('#nhanxet').val(data.Nhanxet).prop('readonly', true);

                            // Fetch and update status steps
                            fetchStatusSteps(idDTSV);
                        } else {
                            console.log("Không có dữ liệu trả về");
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error('Error: ' + error);
                    }
                });
            });



            // Load member details when the detail button is clicked
            $('.btn-detail').on('click', function () {
                var idDTSV = $(this).data('id');
                var ID_Khoa = $(this).data('idkhoa');
                var trangThai = $(this).data('trangthai');

                $('#detailID_DTSV').val(idDTSV);
                $('#editIDKhoa').val(ID_Khoa);  // Tương tự với trường ID_Khoa

                $('#memberDetails').empty().html('<p>Đang tải thông tin thành viên...</p>');
                if (trangThai === 'Hoàn Thành') {
                    $('#addMemberButton').prop('disabled', true);
                } else {
                    $('#addMemberButton').prop('disabled', false);
                }
                // AJAX lấy thông tin thành viên
                $.ajax({
                    url: 'http://localhost/Doan/DSdetai/Get_member_details',
                    type: 'POST',
                    data: { ID_DTSV: idDTSV },
                    success: function (response) {
                        $('#memberDetails').html(response);
                    },
                    error: function () {
                        $('#memberDetails').html('<p>Không thể tải thông tin thành viên. Vui lòng thử lại.</p>');
                    }
                });

                // Load additional details into the form
                $.ajax({
                    url: 'http://localhost/Doan/ChitietDT/Get_detail',
                    type: 'POST',
                    data: { ID_DTSV: idDTSV },
                    success: function (response) {
                        var data = JSON.parse(response);
                        $('#detailID_DTSV').val(data.ID_DTSV);
                        $('#detailID_Sinhvien').val(data.ID_Sinhvien);
                        $('#detailHoten').val(data.Hoten);
                        $('#detailTenKhoa').val(data.TenKhoa);
                    },
                    error: function () {
                        alert('Không thể tải thông tin. Vui lòng thử lại.');
                    }
                });
            });

            // Load data into the update form when the update button is clicked
            $('#editModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var idDTSV = button.data('id'); // Lấy ID của đề tài sinh viên từ thuộc tính data-id

                // Gửi yêu cầu AJAX để lấy thông tin từ bảng detaisinhvien
                $.ajax({
                    url: 'http://localhost/Doan/ChitietDT/Get_detaisinhvien_details',
                    type: 'POST',
                    data: { ID_DTSV: idDTSV },
                    success: function (response) {
                        $('#detaisinhvienDetails').html(response);
                    },
                    error: function () {
                        alert('Không thể tải thông tin chi tiết. Vui lòng thử lại.');
                    }
                });
            });

            // Load status history when the status button is clicked


            // Handle delete button click
            $('.btn-reject').on('click', function () {
                var idDTSV = $(this).data('id'); // Lấy ID_DTSV từ data-id của nút
                // Mở modal xác nhận
                $('#confirmRejectModal').modal('show');

                // Khi người dùng xác nhận
                $('#confirmRejectButton').on('click', function () {
                    $.ajax({
                        url: 'http://localhost/Doan/ChitietDT/rejectDetai',  // URL xử lý cập nhật
                        type: 'POST',
                        data: {
                            ID_DTSV: idDTSV,
                            TrangthaiDT: 'Từ Chối'  // Cập nhật trạng thái thành 'Từ Chối'
                        },
                        success: function (response) {
                            if (response.status === 'success') {
                                location.reload();  // Làm mới trang sau khi cập nhật
                            }
                        },
                        error: function () {
                            alert('Có lỗi xảy ra. Vui lòng thử lại.');
                        }
                    });

                    // Đóng modal sau khi xác nhận
                    $('#confirmRejectModal').modal('hide');
                       // Load lại trang sau khi đóng modal
                       $('#confirmRejectModal').on('hidden.bs.modal', function () {
                                    location.reload(); // Tải lại trang
                                });
                });
            });


            // Handle add member button click
            $('#addMemberButton').on('click', function () {
                var formData = $('#memberForm').serialize();
                $.ajax({
                    url: 'http://localhost/Doan/ChitietDT/addMember',
                    type: 'POST',
                    data: formData,
                    success: function (response) {
                        if (response.status === 'success') {
                            alert('Thêm thành viên thành công!');
                            location.reload();

                        } else {
                            alert('Thêm thành viên thành công!');
                            location.reload();

                        }
                    },
                    error: function () {
                        alert('Không thể thêm thành viên. Vui lòng thử lại.');
                    }
                });
            });
            $('#uploadForm').submit(function (event) {
                event.preventDefault(); // Ngừng việc submit form mặc định

                var formData = new FormData(this);

                $.ajax({
                    url: 'http://localhost/Doan/ChitietDT/UploadFileBaoCao',  // Đường dẫn đến hàm UploadFileBaoCao()
                    type: 'POST',
                    data: formData,
                    processData: false,  // Không xử lý dữ liệu
                    contentType: false,  // Không đặt content-type
                    success: function (response) {
                        var jsonResponse = JSON.parse(response);

                        // Hiển thị thông báo trong modal
                        $('#modalMessage').text(jsonResponse.message);

                        // Mở modal
                        $('#notificationModal').modal('show');

                        // Nếu tệp được tải lên thành công, hiển thị tên tệp đã tải lên
                        if (jsonResponse.status === 'success') {
                            $('#fileNameDisplay').text('Tệp đã tải lên: ' + jsonResponse.file_name);
                        } else {
                            $('#fileNameDisplay').text('Lỗi: ' + jsonResponse.message);
                        }
                    },
                    error: function () {
                        $('#modalMessage').text('Đã có lỗi xảy ra khi tải file.');
                        $('#notificationModal').modal('show');
                    }
                });
            });


        });

        document.addEventListener('DOMContentLoaded', function () {
            // Lấy tất cả các nút "Nộp Báo Cáo"
            const submitButtons = document.querySelectorAll('.btn-submit-report');

            submitButtons.forEach(button => {
                const form = button.closest('form');
                const fileInput = form.querySelector('input[type="file"]');

                // Disable the button initially if no file is selected
                if (!fileInput.value) {
                    button.disabled = true;
                }

                // Enable the button when a file is selected
                fileInput.addEventListener('change', function () {
                    if (fileInput.files.length > 0) {
                        button.disabled = false;
                    } else {
                        button.disabled = true;
                    }
                });

                button.addEventListener('click', function (event) {
                    event.preventDefault();
                    const formData = new FormData(form);
                    const ID_DTSV = this.getAttribute('data-id');

                    // Gửi file qua AJAX
                    fetch(form.action, {
                        method: 'POST',
                        body: formData
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.status === 'success') {
                                // Hiển thị modal thành công
                                $('#successModal .modal-body').text(data.message);
                                $('#successModal').modal('show');
                            } else {
                                // Hiển thị modal lỗi
                                $('#errorModal .modal-body').text(data.message);
                                $('#errorModal').modal('show');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            // Hiển thị modal lỗi
                            $('#errorModal .modal-body').text('Có lỗi xảy ra khi nộp báo cáo. Vui lòng thử lại.');
                            $('#errorModal').modal('show');
                        });
                });
            });

            // Handle add member button click


        });



    </script>
</body>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


</html>