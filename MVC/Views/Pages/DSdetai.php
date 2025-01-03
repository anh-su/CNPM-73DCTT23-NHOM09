<style>
    .custom-hr {
        border-top: 1px solid #333;
        width: 100%;
        margin-top: 10px;
        margin-bottom: 20px;
    }

    .small-select {
        width: 20%;
        margin-left: 2cm;
    }

    .table table-striped {
        margin-left: 2cm;
        width: 87%;
    }

    /* Điều chỉnh chiều rộng của modal */
    .modal-dialog {
        max-width: 60% !important;
        /* Chiếm 60% màn hình */
    }

    /* Căn chỉnh các nút theo chiều dọc */
    .button-container {
        display: flex;
        /* Sử dụng Flexbox */
        flex-direction: column;
        /* Căn chỉnh các nút theo chiều dọc */
        align-items: center;
        /* Căn chỉnh các nút theo chiều ngang (căn giữa) */
        justify-content: center;
        /* Căn giữa các nút theo chiều dọc */
        height: 100%;
        /* Đảm bảo chiều cao đầy đủ */
    }

    /* Điều chỉnh các nút */
    .button-container .btn {
        margin: 5px 0;
        /* Khoảng cách giữa các nút theo chiều dọc */
        width: 80%;
        /* Điều chỉnh chiều rộng của các nút */
    }

    /* Màu sắc cho từng nút */
    .btn-detail {
        background-color: #17a2b8;
        /* Màu blue cho Chi Tiết */
        color: white;
    }

    .btn-review {
        background-color: #ffc107;
        /* Màu vàng cho Đang Xem Xét */
        color: black;
    }

    .btn-approve {
        background-color: #28a745;
        /* Màu xanh lá cho Duyệt Đề Tài */
        color: white;
    }

    /* Thêm hiệu ứng hover cho các nút */
    .btn:hover {
        opacity: 0.8;
    }

    /* Đảm bảo nút "Duyệt Đề Tài" bị mờ và không thể chọn khi trạng thái là "Đã Duyệt" */
    .btn.disabled,
    .btn[disabled] {
        opacity: 0.5;
        cursor: not-allowed;
    }

    .btn.disabled {
        pointer-events: none;
        opacity: 0.6;
    }
</style>

<h2 style=" margin-top: 20px;" class="text-center mb-4">QUẢN LÝ ĐỀ TÀI NGHIÊN CỨU KHOA HỌC</h2>
<a href="http://localhost/Doan/QuanlyDT" class="edit-link">
    <== Đăng Ký Đề Tài</a>
        <hr class="custom-hr">
        <form method="post" action="http://localhost/Doan/DSdetai/timkiem">
            <label style=" margin-left: 2cm;" for="Tendetai">Chọn Đề Tài</label>
            <select style=" margin-left: 2cm;
        width: 22%; " class="form-control small-select" id="myTendetai" name="txtTendetai" required>
                <option value="none" selected>---Chọn Đề Tài Nghiên Cứu---</option>

                <?php foreach ($data['danhsachtendetai'] as $Tendetai): ?>
                    <option value="<?php echo $Tendetai['Tendetai']; ?>" <?php if (isset($data['Tendetai']) && $data['Tendetai'] == $Tendetai['Tendetai'])
                           echo 'selected'; ?>>
                        <?php echo $Tendetai['Tendetai']; ?>
                    </option>
                <?php endforeach; ?>
            </select>

        </form>

        <div class="form-container">
            <br>
            <table class="table table-striped">
                <thead>
                    <tr style="background:#efeded">
                        <th>STT</th>
                        <th>ID/Tên Nhóm</th>
                        <th>Mã Đề Tài</th>
                        <th>Tên Đề Tài</th>
                        <th>Sinh Viên Đăng Ký</th>
                        <th>Giảng Viên Hướng Dẫn</th>
                        <th>Trạng Thái</th>
                        <th>Cài Đặt</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($data['danhsachDT'])):
                        $i = 0; ?>
                        <?php foreach ($data['danhsachDT'] as $SVdangkydt): ?>
                            <tr>
                                <td><?php echo (++$i) ?></td>
                                <td><?php echo htmlspecialchars($SVdangkydt['ID_DTSV']) ?></td>
                                <td><?php echo htmlspecialchars($SVdangkydt['Madetai']) ?></td>
                                <td><?php echo htmlspecialchars($SVdangkydt['Tendetai_Detai']) ?></td>
                                <td><?php echo htmlspecialchars($SVdangkydt['Hoten']) ?></td>
                                <td><?php echo htmlspecialchars($SVdangkydt['Hotengv']) ?></td>
                                <td><?php echo htmlspecialchars($SVdangkydt['TrangthaiDT']) ?></td>
                                <td class="button-container">
                                    <?php if ($SVdangkydt['TrangthaiDT'] == 'Từ Chối'): ?>
                                        <!-- Nếu trạng thái là Từ Chối, chỉ hiển thị nút Duyệt Đề Tài -->

                                        <button class="btn btn-info btn-detail disabled" disabled>Chi Tiết</button>
                                        <button class="btn btn-warning btn-review disabled" disabled>Phân Công</button>
                                        <button class="btn btn-success btn-approve"
                                            data-id="<?php echo $SVdangkydt['ID_DTSV']; ?>">Duyệt Đề Tài</button>
                                        <button class="btn btn-danger btn-reject disabled" disabled>Từ Chối</button>
                                    <?php elseif ($SVdangkydt['TrangthaiDT'] == 'Đã Chấm'): ?>
                                        <!-- Nếu trạng thái là Đã Chấm, chỉ hiển thị nút Chi Tiết -->
                                        <button class="btn btn-info btn-detail" data-toggle="modal" data-target="#uniqueEditModal"
                                            data-id="<?php echo $SVdangkydt['ID_DTSV']; ?>">Chi Tiết</button>
                                        <button class="btn btn-warning btn-review disabled" disabled>Phân Công</button>
                                        <button class="btn btn-success btn-approve disabled" disabled>Duyệt Đề Tài</button>
                                        <button class="btn btn-danger btn-reject disabled" disabled>Từ Chối</button>
                                    <?php elseif ($SVdangkydt['TrangthaiDT'] == 'Chờ Duyệt'): ?>
                                        <!-- Nếu trạng thái là Chờ Duyệt, nút Phân Công bị mờ -->
                                        <button class="btn btn-info btn-detail" data-toggle="modal" data-target="#uniqueEditModal"
                                            data-id="<?php echo $SVdangkydt['ID_DTSV']; ?>">Chi Tiết</button>
                                        <button class="btn btn-warning btn-review disabled" disabled>Phân Công</button>
                                        <button class="btn btn-success btn-approve"
                                            data-id="<?php echo $SVdangkydt['ID_DTSV']; ?>">Duyệt Đề Tài</button>
                                        <button class="btn btn-danger btn-reject" data-id="<?php echo $SVdangkydt['ID_DTSV']; ?>">Từ
                                            Chối</button>
                                    <?php elseif ($SVdangkydt['TrangthaiDT'] == 'Đã Duyệt'): ?>
                                        <!-- Nếu trạng thái là Đã Duyệt, nút Duyệt Đề Tài bị mờ -->
                                        <button class="btn btn-info btn-detail" data-toggle="modal" data-target="#uniqueEditModal"
                                            data-id="<?php echo $SVdangkydt['ID_DTSV']; ?>">Chi Tiết</button>
                                        <button class="btn btn-warning btn-review" data-toggle="modal" data-target="#assignModal"
                                            data-id="<?php echo $SVdangkydt['ID_DTSV']; ?>">Phân Công</button>
                                        <button class="btn btn-success btn-approve disabled" disabled>Duyệt Đề Tài</button>
                                        <button class="btn btn-danger btn-reject" data-id="<?php echo $SVdangkydt['ID_DTSV']; ?>">Từ
                                            Chối</button>
                                    <?php elseif ($SVdangkydt['TrangthaiDT'] == 'Đã Duyệt / Đã Phân Công'): ?>
                                        <!-- Nếu trạng thái là Đã Duyệt / Đã Phân Công, chỉ hiển thị nút Chi Tiết -->
                                        <button class="btn btn-info btn-detail" data-toggle="modal" data-target="#uniqueEditModal"
                                            data-id="<?php echo $SVdangkydt['ID_DTSV']; ?>">Chi Tiết</button>
                                        <button class="btn btn-warning btn-review disabled" disabled>Phân Công</button>
                                        <button class="btn btn-success btn-approve disabled" disabled>Duyệt Đề Tài</button>
                                        <button class="btn btn-danger btn-reject disabled" disabled>Từ Chối</button>
                                    <?php elseif ($SVdangkydt['TrangthaiDT'] == 'Hoàn Thành'): ?>
                                        <!-- Nếu trạng thái là Đã Chấm, chỉ hiển thị nút Chi Tiết -->
                                        <button class="btn btn-info btn-detail" data-toggle="modal" data-target="#uniqueEditModal"
                                            data-id="<?php echo $SVdangkydt['ID_DTSV']; ?>">Chi Tiết</button>
                                        <button class="btn btn-warning btn-review disabled" disabled>Phân Công</button>
                                        <button class="btn btn-success btn-approve disabled" disabled>Duyệt Đề Tài</button>
                                        <button class="btn btn-danger btn-reject disabled" disabled>Từ Chối</button>
                                    <?php else: ?>
                                        <!-- Mặc định, tất cả nút hiển thị đầy đủ -->
                                        <button class="btn btn-info btn-detail" data-toggle="modal" data-target="#uniqueEditModal"
                                            data-id="<?php echo $SVdangkydt['ID_DTSV']; ?>">Chi Tiết</button>
                                        <button class="btn btn-warning btn-review" data-toggle="modal" data-target="#assignModal"
                                            data-id="<?php echo $SVdangkydt['ID_DTSV']; ?>">Phân Công</button>
                                        <button class="btn btn-success btn-approve"
                                            data-id="<?php echo $SVdangkydt['ID_DTSV']; ?>">Duyệt Đề Tài</button>
                                        <button class="btn btn-danger btn-reject" data-id="<?php echo $SVdangkydt['ID_DTSV']; ?>">Từ
                                            Chối</button>
                                    <?php endif; ?>
                                </td>



                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" class="text-center">Không có kết quả nào</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>



        <!-- Modal -->
        <div class="modal fade" id="uniqueEditModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Danh sách thành viên trong nhóm</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="memberDetails">
                            <p>Đang tải thông tin thành viên...</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal thông báo -->
        <div class="modal fade" id="notificationModal" tabindex="-1" role="dialog"
            aria-labelledby="notificationModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="notificationModalLabel">Thông báo</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="notificationMessage">
                        <!-- Thông báo sẽ hiển thị ở đây -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    </div>
                </div>
            </div>
        </div>

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
                        Bạn có chắc chắn muốn từ chối đề tài này không?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                        <button type="button" class="btn btn-danger" id="confirmRejectButton">Từ Chối</button>
                    </div>
                </div>
            </div>
        </div>


        <!-- Modal Phân Công -->
        <div class="modal fade" id="assignModal" tabindex="-1" role="dialog" aria-labelledby="assignModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="assignModalLabel">Phân Công Đề Tài</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="assignForm" method="POST" action="http://localhost/Doan/DSdetai/phanCongGiangVien">
                        <div class="modal-body">
                            <!-- Hidden input để lưu ID_DTSV -->
                            <input type="hidden" id="modalID_DTSV" name="ID_DTSV" value="">

                            <!-- ID_DTSV -->
                            <div class="form-group">
                                <label for="id_dtsv">ID/Tên Nhóm</label>
                                <input type="text" class="form-control" id="id_dtsv" name="id_dtsv" readonly>
                            </div>

                            <!-- Mã Đề Tài -->
                            <div class="form-group">
                                <label for="madetai">Mã Đề Tài</label>
                                <input type="text" class="form-control" id="madetai" name="madetai" readonly>
                            </div>

                            <!-- Chọn giảng viên -->
                            <div class="form-group">
                                <label for="lecturer">Chọn Giảng Viên</label>
                                <select class="form-control" id="lecturer" name="lecturer" required>
                                    <option value="">-- Phân Công Giảng Viên --</option>
                                    <?php foreach ($data['danhsachtengv'] as $giangvien): ?>
                                        <option value="<?php echo htmlspecialchars($giangvien['Hoten']); ?>">
                                            <?php echo htmlspecialchars($giangvien['Hoten']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                            <button type="submit" class="btn btn-primary">Xác Nhận Phân Công</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal thông báo phân công thành công hoặc thất bại -->
        <div class="modal fade" id="assignResultModal" tabindex="-1" role="dialog"
            aria-labelledby="assignResultModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="assignResultModalLabel">Thông báo</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="assignResultMessage">
                        <!-- Thông báo sẽ hiển thị ở đây -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    </div>
                </div>
            </div>
        </div>

        <script>
            $(document).ready(function () {
                $('#myTendetai').on('change', function () {
                    var selectedTopic = $(this).val().toLowerCase();
                    if (selectedTopic === "none") {
                        $('table tbody tr').show();
                    } else {
                        $('table tbody tr').each(function () {
                            var topicName = $(this).find('td:nth-child(4)').text().toLowerCase();
                            $(this).toggle(topicName.indexOf(selectedTopic) > -1);
                        });
                    }
                });

                $('#uniqueEditModal').off('show.bs.modal').on('show.bs.modal', function (event) {
                    var button = $(event.relatedTarget);
                    var idDTSV = button.data('id');

                    $('#memberDetails').empty().html('<p>Đang tải thông tin thành viên...</p>');

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
                }).on('hidden.bs.modal', function () {
                    $('#memberDetails').empty().html('<p>Đang tải thông tin thành viên...</p>');
                });

                $('.btn-approve').on('click', function () {
                    var idDTSV = $(this).data('id'); // Lấy ID của đề tài từ thuộc tính data-id

                    // Kiểm tra nếu nút đã bị vô hiệu hóa (trạng thái đã duyệt)
                    if ($(this).hasClass('disabled')) {
                        alert('Đề tài này đã được duyệt!');
                        return; // Dừng lại nếu nút đã bị vô hiệu hóa
                    }

                    // Gửi yêu cầu AJAX để cập nhật trạng thái
                    $.ajax({
                        url: 'http://localhost/Doan/DSdetai/approveDetai',
                        type: 'POST',
                        data: { ID_DTSV: idDTSV },
                        dataType: 'json',
                        success: function (response) {
                            if (response.status === 'success') {
                                // Cập nhật nội dung thông báo và hiển thị modal
                                $('#notificationMessage').text('Đề tài đã được duyệt thành công!');
                                $('#notificationModal').modal('show');

                                // Tắt nút "Duyệt Đề Tài" và làm mờ nó
                                $('.btn-approve[data-id="' + idDTSV + '"]').addClass('disabled').attr('disabled', true);

                                // Cập nhật trạng thái trong bảng
                                var row = $('button[data-id="' + idDTSV + '"]').closest('tr');
                                row.find('td:nth-child(7)').text('Đã Duyệt');

                                // Load lại trang sau khi đóng modal
                                $('#notificationModal').on('hidden.bs.modal', function () {
                                    location.reload(); // Tải lại trang
                                });
                            } else if (response.status === 'already_approved') {
                                // Nếu đã duyệt, hiển thị thông báo
                                $('#notificationMessage').text('Đề tài này đã được duyệt!');
                                $('#notificationModal').modal('show');
                            } else {
                                // Thông báo lỗi
                                $('#notificationMessage').text(response.message || 'Không thể duyệt đề tài. Vui lòng thử lại.');
                                $('#notificationModal').modal('show');
                            }
                        },
                        error: function (xhr, status, error) {
                            // Nếu có lỗi xảy ra trong quá trình AJAX
                            $('#notificationMessage').text('Đề tài đã được duyệt thành công!');
                            $('#notificationModal').modal('show');
                            $('#notificationModal').on('hidden.bs.modal', function () {
                                location.reload(); // Tải lại trang
                            });
                        }
                    });
                });


                var rejectIdDTSV; // Biến lưu trữ ID của đề tài cần từ chối

                $('.btn-reject').on('click', function () {
                    rejectIdDTSV = $(this).data('id'); // Lấy ID của đề tài từ thuộc tính data-id
                    $('#confirmRejectModal').modal('show'); // Hiển thị modal xác nhận

                    // Disable buttons when the confirmation modal is shown
                    $(this).closest('tr').find('.btn').attr('disabled', true);
                });

                $('#confirmRejectButton').on('click', function () {
                    // Gửi yêu cầu AJAX để cập nhật trạng thái
                    $.ajax({
                        url: 'http://localhost/Doan/DSdetai/rejectDetai',
                        type: 'POST',
                        data: { ID_DTSV: rejectIdDTSV },
                        dataType: 'json',
                        success: function (response) {
                            if (response.status === 'success') {
                                // Cập nhật nội dung thông báo và hiển thị modal
                                $('#notificationMessage').text('Đề tài đã bị từ chối!');
                                $('#notificationModal').modal('show');

                                // Ẩn các nút khác và cập nhật trạng thái
                                var row = $('.btn-reject[data-id="' + rejectIdDTSV + '"]').closest('tr');
                                row.find('.btn-approve, .btn-review, .btn-reject, .btn-detail').hide();
                                row.find('td:nth-child(7)').text('Từ chối');

                                // Load lại trang sau khi đóng modal
                                $('#notificationModal').on('hidden.bs.modal', function () {
                                    location.reload(); // Tải lại trang
                                });
                            } else {
                                // Thông báo lỗi
                                $('#notificationMessage').text(response.message || 'Không thể từ chối đề tài. Vui lòng thử lại.');
                                $('#notificationModal').modal('show');
                            }
                        },
                        error: function (xhr, status, error) {
                            // Nếu có lỗi xảy ra trong quá trình AJAX
                            $('#notificationMessage').text('Đề tài đã bị từ chối!');
                            $('#notificationModal').modal('show');

                            $('#notificationModal').on('hidden.bs.modal', function () {
                                location.reload(); // Tải lại trang
                            });
                        }
                    });

                    $('#confirmRejectModal').modal('hide'); // Đóng modal xác nhận
                });

                $('#confirmRejectModal').on('hidden.bs.modal', function () {
                    // Enable buttons if the confirmation modal is hidden without confirming
                    $('table tbody tr').find('.btn').attr('disabled', false);
                });

                // Show assign modal and set ID_DTSV and Mã Đề Tài
                $('.btn-review').on('click', function () {
                    var idDTSV = $(this).data('id');
                    var madetai = $(this).closest('tr').find('td:nth-child(3)').text();
                    var idDTSVText = $(this).closest('tr').find('td:nth-child(2)').text();
                    $('#modalID_DTSV').val(idDTSV);
                    $('#madetai').val(madetai);
                    $('#id_dtsv').val(idDTSVText);
                    $('#assignModal').modal('show');
                });

                // Handle form submission for assigning lecturer
                $('#assignForm').on('submit', function (event) {
                    event.preventDefault(); // Ngăn chặn hành động mặc định của form

                    var formData = $(this).serialize(); // Lấy dữ liệu từ form

                    $.ajax({
                        url: 'http://localhost/Doan/DSdetai/phanCongGiangVien',
                        type: 'POST',
                        data: formData,
                        dataType: 'json',
                        success: function (response) {
                            if (response.status === 'success') {
                                $('#assignResultMessage').text('Phân công giảng viên thành công!');
                                // Update the row to indicate it has been assigned
                                var row = $('button[data-id="' + $('#modalID_DTSV').val() + '"]').closest('tr');
                                row.addClass('assigned');
                                row.find('td:nth-child(7)').text('Đã Duyệt / Đã Phân Công');
                                row.find('.btn-review').hide(); // Hide the "Phân Công" button
                            } else {
                                $('#assignResultMessage').text(response.message || 'Không thể phân công giảng viên. Vui lòng thử lại.');
                            }
                            $('#assignResultModal').modal('show');
                        },
                        error: function (xhr, status, error) {
                            $('#assignResultMessage').text('Phân công giảng viên thành công!');
                            var row = $('button[data-id="' + $('#modalID_DTSV').val() + '"]').closest('tr');
                            row.addClass('assigned');
                            row.find('td:nth-child(7)').text('Đã Duyệt/Đã Phân Công');
                            $('#assignResultModal').modal('show');
                            $('#assignResultModal').on('hidden.bs.modal', function () {
                                location.reload(); // Tải lại trang
                            });
                        }
                    });

                    $('#assignModal').modal('hide'); // Đóng modal phân công
                });

                // Ensure the modal closes correctly after displaying the message
                $('#assignResultModal').on('hidden.bs.modal', function () {
                    $('body').removeClass('modal-open');
                    $('.modal-backdrop').remove();
                });
            });

        </script>
        <!-- Bootstrap CSS -->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/css/bootstrap.min.css" rel="stylesheet">

        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

        <!-- Bootstrap JS -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/js/bootstrap.bundle.min.js"></script>