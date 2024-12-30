<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nhiệm vụ giảng viên</title>
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

        /* Điều chỉnh chiều rộng của modal */
        .modal-dialog {
            max-width: 70% !important;
            /* Chiếm 70% màn hình */
        }

        .btn.disabled,
        .btn[disabled] {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .btn-container {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
    </style>
</head>

<body>

    <div class="container">
        <h2 class="text-center mb-4">Danh Sách Nhóm Đã Được Phân Công</h2>
        <hr class="custom-hr">
        <table class="table table-striped">
            <thead>
                <tr style="background:#efeded">
                    <th>STT</th>
                    <th>ID Nhóm</th>
                    <th>Mã Đề Tài</th>
                    <th>Tên Đề Tài</th>
                    <th>Sinh Viên Đăng Ký</th>
                    <th>Khoa</th>
                    <th>Trạng Thái</th>
                    <th>Điểm</th>
                    <th>Hoạt Động</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($data['danhsachnhom'])):
                    $i = 0; ?>
                    <?php foreach ($data['danhsachnhom'] as $nhom): 
                        $gradeDetails = $this->Get_grade_details($nhom['ID_DTSV']);
                    ?>
                        <tr>
                            <td><?php echo (++$i) ?></td>
                            <td><?php echo htmlspecialchars($nhom['ID_DTSV']) ?></td>
                            <td><?php echo htmlspecialchars($nhom['Madetai']) ?></td>
                            <td><?php echo htmlspecialchars($nhom['Tendetai']) ?></td>
                            <td><?php echo htmlspecialchars($nhom['Hoten']) ?></td>
                            <td><?php echo htmlspecialchars($nhom['Tenkhoa']) ?></td>
                            <td><?php echo ($nhom['TrangthaiDT'] == 'Hoàn Thành') ? 'Hoàn Thành' : (isset($nhom['Diem']) ? 'Đã Chấm' : htmlspecialchars($nhom['TrangthaiDT'])); ?></td>
                            <td><?php echo isset($nhom['Diem']) ? htmlspecialchars($nhom['Diem']) : 'Chưa Chấm'; ?></td>
                            <td>
                            <div class="btn-container">
    <button class="btn btn-info btn-detail <?php echo ($nhom['TrangthaiDT'] == 'Từ Chối') ? 'disabled-button' : ''; ?>" 
        data-toggle="modal" data-target="#detailModal"
        data-id="<?php echo $nhom['ID_DTSV']; ?>" 
        <?php echo ($nhom['TrangthaiDT'] == 'Hoàn Thành' || isset($nhom['Diem']) || $nhom['TrangthaiDT'] == 'Từ Chối') ? 'disabled' : ''; ?>>
        Chi Tiết
    </button>
    <button class="btn btn-warning btn-update <?php echo ($nhom['TrangthaiDT'] == 'Đã Duyệt / Đã Phân Công' || $nhom['TrangthaiDT'] == 'Hoàn Thành' || $nhom['TrangthaiDT'] == 'Từ Chối') ? 'disabled-button' : ''; ?>"
        data-toggle="modal" data-target="#editModal"
        data-id="<?php echo $nhom['ID_DTSV']; ?>"
        data-score="<?php echo htmlspecialchars($gradeDetails['Diem']); ?>"
        data-comments="<?php echo htmlspecialchars($gradeDetails['Nhanxet']); ?>"
        <?php echo ($nhom['TrangthaiDT'] == 'Đã Duyệt / Đã Phân Công' || $nhom['TrangthaiDT'] == 'Hoàn Thành' || $nhom['TrangthaiDT'] == 'Từ Chối') ? 'disabled' : ''; ?>>
        Cập Nhật
    </button>
    <button class="btn btn-success btn-complete <?php echo ($nhom['TrangthaiDT'] == 'Hoàn Thành' || $nhom['TrangthaiDT'] == 'Từ Chối') ? 'disabled-button' : ''; ?>" 
        data-id="<?php echo $nhom['ID_DTSV']; ?>" 
        <?php echo ($nhom['TrangthaiDT'] == 'Hoàn Thành' || $nhom['TrangthaiDT'] == 'Từ Chối') ? 'disabled' : ''; ?>>
        Hoàn Thành
    </button>
</div>

                            </td>

                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="9" class="text-center">Không có nhóm nào được phân công</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Modal Chi Tiết -->
    <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailModalLabel">Danh Sách Thành Viên</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="groupDetails">
                        <p>Đang tải thông tin nhóm...</p>
                    </div>
                    <button type="button" class="btn btn-primary" id="viewReport">Xem Báo Cáo</button>
                    <hr>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="examinerName">Giảng viên chấm thi:</label>
                            <input type="text" class="form-control" id="examinerName" value="<?php echo $_SESSION['Hoten']; ?>" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="score">Điểm:</label>
                            <input type="number" class="form-control" id="score" name="score" min="0" max="10" step="0.1" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="comments">Nhận xét:</label>
                        <textarea class="form-control" id="comments" name="comments" rows="3" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-success" id="gradeButton">Chấm Điểm</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Cập Nhật -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Chỉnh Sửa Điểm và Nhận Xét</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="http://localhost/Doan/Nhiemvu/Update_grade_details">
                        <input type="hidden" id="editID_DTSV" name="ID_DTSV">
                        <button type="button" class="btn btn-primary" id="editViewReport">Xem Báo Cáo</button>
                        <hr>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="editExaminerName">Giảng viên chấm thi:</label>
                                <input type="text" class="form-control" id="editExaminerName" value="<?php echo $_SESSION['Hoten']; ?>" readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="editScore">Điểm:</label>
                                <input type="number" class="form-control" id="editScore" name="score" min="0" max="10" step="0.1" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="editComments">Nhận xét:</label>
                            <textarea class="form-control" id="editComments" name="comments" rows="3" required></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                            <button type="submit" class="btn btn-success">Cập Nhật</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Result Modal -->
    <div class="modal fade" id="resultModal" tabindex="-1" role="dialog" aria-labelledby="resultModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="resultModalLabel">Thông báo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="resultMessage">
                    <!-- Message will be inserted here -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal" id="closeResultModal">OK</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            // Load group details when the detail button is clicked
            $('.btn-detail').on('click', function () {
                var idDTSV = $(this).data('id');

                $('#groupDetails').empty().html('<p>Đang tải thông tin nhóm...</p>');

                // AJAX lấy thông tin nhóm
                $.ajax({
                    url: 'http://localhost/Doan/Nhiemvu/Get_group_details',
                    type: 'POST',
                    data: { ID_DTSV: idDTSV },
                    success: function (response) {
                        $('#groupDetails').html(response);
                    },
                    error: function () {
                        $('#groupDetails').html('<p>Không thể tải thông tin nhóm. Vui lòng thử lại.</p>');
                    }
                });

                // AJAX lấy thông tin điểm và nhận xét
                $.ajax({
                    url: 'http://localhost/Doan/Nhiemvu/Get_grade_details',
                    type: 'POST',
                    data: { ID_DTSV: idDTSV },
                    success: function (response) {
                        var data = JSON.parse(response);
                        if (data.Diem !== null && data.Nhanxet !== null) {
                            // Nếu đã chấm, hiển thị thông tin
                            $('#score').val(data.Diem).prop('readonly', true);
                            $('#comments').val(data.Nhanxet).prop('readonly', true);
                            $('#gradeButton').hide(); // Ẩn nút chấm điểm
                        } else {
                            // Nếu chưa chấm, cho phép nhập
                            $('#score').val('').prop('readonly', false);
                            $('#comments').val('').prop('readonly', false);
                            $('#gradeButton').show(); // Hiển thị nút chấm điểm
                        }
                    },
                    error: function () {
                        $('#score').val('');
                        $('#comments').val('');
                        $('#score').prop('readonly', false);
                        $('#comments').prop('readonly', false);
                        $('#gradeButton').show(); // Hiển thị nút chấm điểm
                    }
                });

                // Cập nhật ID cho nút xem báo cáo
                $('#viewReport').data('id', idDTSV);
            });

            // Handle view report button click
            $('#viewReport, #editViewReport').on('click', function () {
                var idDTSV = $(this).data('id');

                // AJAX request to get the file path
                $.ajax({
                    url: 'http://localhost/Doan/Nhiemvu/Get_report_file',
                    type: 'POST',
                    data: { ID_DTSV: idDTSV },
                    success: function (response) {
                        var data = JSON.parse(response);
                        if (data.file_path) {
                            window.open('http://localhost/Doan/' + data.file_path, '_blank');
                        } else {
                            alert('Không tìm thấy báo cáo.');
                        }
                    },
                    error: function () {
                        alert('Không thể tải báo cáo. Vui lòng thử lại.');
                    }
                });
            });

            // Handle grade button click
            $('#gradeButton').on('click', function () {
                var idDTSV = $('#viewReport').data('id');
                var score = $('#score').val();
                var comments = $('#comments').val();

                // Perform AJAX request to save the grade and comments
                $.ajax({
                    url: 'http://localhost/Doan/Nhiemvu/Grade_group',
                    type: 'POST',
                    data: {
                        ID_DTSV: idDTSV,
                        score: score,
                        comments: comments
                    },
                    success: function (response) {
                        if (response.status === 'success') {
                            // Update the status in the database
                            $.ajax({
                                url: 'http://localhost/Doan/Nhiemvu/Update_status',
                                type: 'POST',
                                data: { ID_DTSV: idDTSV, TrangthaiDT: 'Đã chấm' },
                                success: function () {
                                    $('#resultMessage').text('Chấm điểm thành công!');
                                    $('#resultModal').modal('show');
                                    $('#detailModal').modal('hide');
                                    $('#resultModal').on('hidden.bs.modal', function () {
    // Option 1: Tải lại toàn bộ trang
    location.reload();  // Tải lại toàn bộ trang

    // Option 2: Nếu bạn muốn làm mới form hoặc phần cụ thể của trang
    // $('#uploadForm')[0].reset();  // Reset form nếu muốn
    // $('#formContainer').load(location.href + ' #formContainer');  // Làm mới một phần cụ thể của trang
});
                                },
                                error: function () {
                                    $('#resultMessage').text('Không thể cập nhật trạng thái. Vui lòng thử lại.');
                                    $('#resultModal').modal('show');
                                }
                            });
                        } else {
                            $('#resultMessage').text('Chấm điểm thành công!');
                            $('#resultModal').modal('show');
                            $('#resultModal').on('hidden.bs.modal', function () {
    // Option 1: Tải lại toàn bộ trang
    location.reload();  // Tải lại toàn bộ trang

    // Option 2: Nếu bạn muốn làm mới form hoặc phần cụ thể của trang
    // $('#uploadForm')[0].reset();  // Reset form nếu muốn
    // $('#formContainer').load(location.href + ' #formContainer');  // Làm mới một phần cụ thể của trang
});
                        }
                    },
                    error: function () {
                        $('#resultMessage').text('Không thể chấm điểm. Vui lòng thử lại.');
                        $('#resultModal').modal('show');
                    }
                });
            });

            // Load group details when the update button is clicked
            $('.btn-update').on('click', function () {
                var idDTSV = $(this).data('id');
                var score = $(this).data('score');
                var comments = $(this).data('comments');

                $('#editID_DTSV').val(idDTSV);
                $('#editScore').val(score);
                $('#editComments').val(comments);

                // Cập nhật ID cho nút xem báo cáo
                $('#editViewReport').data('id', idDTSV);
            });

            // Handle view report button click in edit modal
            $('#editViewReport').on('click', function () {
                var idDTSV = $(this).data('id');
                var reportUrl = 'http://localhost/Doan/Nhiemvu/View_report?ID_DTSV=' + idDTSV;
                window.open(reportUrl, '_blank');
            });

            // Handle update button click
            $('#updateButton').on('click', function () {
                var idDTSV = $('#editViewReport').data('id');
                var score = $('#editScore').val();
                var comments = $('#editComments').val();

                // Perform AJAX request to update the grade and comments
                $.ajax({
                    url: 'http://localhost/Doan/Nhiemvu/Update_grade_details',
                    type: 'POST',
                    data: {
                        ID_DTSV: idDTSV,
                        score: score,
                        comments: comments
                    },
                    success: function (response) {
                        if (response.status === 'success') {
                            $('#resultMessage').text('Cập nhật điểm thành công!');
                            $('#resultModal').modal('show');
                            $('#editModal').modal('hide');
                        } else {
                            $('#resultMessage').text('Cập nhật điểm thất bại!');
                            $('#resultModal').modal('show');
                        }
                    },
                    error: function () {
                        $('#resultMessage').text('Không thể cập nhật điểm. Vui lòng thử lại.');
                        $('#resultModal').modal('show');
                    }
                });
            });

            // Handle complete button click
            $('.btn-complete').on('click', function () {
                var idDTSV = $(this).data('id');

                // Perform AJAX request to mark the task as complete
                $.ajax({
                    url: 'http://localhost/Doan/Nhiemvu/Complete_task',
                    type: 'POST',
                    data: { ID_DTSV: idDTSV },
                    success: function (response) {
                        if (response.status === 'success') {
                            $('#resultMessage').text('Nhiệm vụ đã được hoàn thành!');
                            $('#resultModal').modal('show');
                            $('#resultModal').on('hidden.bs.modal', function () {
                                location.reload();
                            });
                        } else {
                            $('#resultMessage').text('Nhiệm vụ đã được hoàn thành!');
                            $('#resultModal').modal('show');
                            $('#resultModal').on('hidden.bs.modal', function () {
                                location.reload();
                            });
                        }
                    },
                    error: function () {
                        $('#resultMessage').text('Không thể hoàn thành nhiệm vụ. Vui lòng thử lại.');
                        $('#resultModal').modal('show');
                    }
                });
            });

            // Reload the form when the result modal is closed
            $('#closeResultModal').on('click', function () {
                location.reload();
            });
        });
    </script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


</body>

</html>