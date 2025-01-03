<style>
    .custom-hr {
        border-top: 1px solid #333;
        width: 100%;
        margin-top: 10px;
        margin-bottom: 20px;
    }

    .btn-custom {
        font-size: 1rem;
        width: 100%;
    }

    .btn-container {
        display: flex;
        justify-content: space-between;
    }
</style>

<div style="margin-top: 1rem !important;" class="container mt-5">
    <h2 class="mb-4">Gửi Thông Báo</h2>
    <form id="formThongbao" action="http://localhost/Doan/GuithongbaoHS/saveThongbao" method="POST">
        <hr class="custom-hr">
        <div class="form-group">
            <label for="title">Tiêu Đề</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Nhập tiêu đề" required>
        </div>
        <div class="form-group">
            <label for="message">Nội Dung</label>
            <textarea class="form-control" id="message" name="message" rows="5" placeholder="Nhập nội dung thông báo" required></textarea>
        </div>
        <div class="form-group">
            <label for="ID_DTSV">ID Nhóm</label>
            <select class="form-control" id="ID_DTSV" name="ID_DTSV">
                <?php foreach ($data['danhSachID_DTSV'] as $ID_DTSV) : ?>
                    <option value="<?php echo $ID_DTSV['ID_DTSV']; ?>">
                        <?php echo $ID_DTSV['ID_DTSV']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group btn-container">
            <button style="background-color:#26a69a; margin-right: 5px;" type="submit" class="btn btn-primary btn-custom" name="btnluu">Gửi</button>
            <button style="background-color:#26a69a;" type="button" class="btn btn-secondary btn-custom" name="btnReset" id="btnReset">Reset</button>
        </div>
    </form>
</div>

<!-- Display Announcements with Modals -->
<div class="container mt-5">
    <h4 class="mb-4">Danh sách thông báo</h4>
    <table id="tableThongbao" class="table table-striped">
        <thead>
            <tr>
                <th>Tiêu Đề</th>
                <th>Nội Dung</th>
                <th>ID Nhóm</th>
                <th>Người Gửi</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($data['danhSachThongBao'])) : ?>
                <?php foreach ($data['danhSachThongBao'] as $thongbao) : ?>
                    <tr>
                        <td><?php echo $thongbao['Tieude']; ?></td>
                        <td><?php echo $thongbao['Noidung']; ?></td>
                        <td><?php echo $thongbao['ID_DTSV']; ?></td>
                        <td><?php echo $thongbao['Hoten']; ?></td>
                        <td>
                            <!-- Edit Button (Modal Trigger) -->
                            <a href="#" class="edit-link" data-id="<?php echo $thongbao['ID']; ?>" data-title="<?php echo $thongbao['Tieude']; ?>" data-message="<?php echo $thongbao['Noidung']; ?>" data-id_dtsv="<?php echo $thongbao['ID_DTSV']; ?>" data-toggle="modal" data-target="#editModal">
                                <img src="http://localhost/Doan/Public/Pictures/edit.gif" alt="Edit">
                            </a>
                            
                            <!-- Delete Button (Modal Trigger) -->
                            <a href="#" class="delete-link" data-id="<?php echo $thongbao['ID']; ?>" data-toggle="modal" data-target="#deleteModal">
                                <img src="http://localhost/Doan/Public/Pictures/13.png" alt="Delete">
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="5" class="text-center">Không có thông báo nào</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<!-- Modal Sửa Thông Báo -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Sửa Thông Báo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editForm" method="POST" action="http://localhost/Doan/GuithongbaoHS/suaThongbao">
                    <input type="hidden" id="edit_id" name="edit_id">
                    <div class="form-group">
                        <label for="edit_title">Tiêu đề</label>
                        <input type="text" class="form-control" id="edit_title" name="edit_title" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_message">Nội dung</label>
                        <textarea class="form-control" id="edit_message" name="edit_message" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="edit_id_dtsv">ID Nhóm</label>
                        <select class="form-control" id="edit_id_dtsv" name="edit_id_dtsv" required>
                            <?php foreach($data['danhSachID_DTSV'] as $ID_DTSV): ?>
                                <option value="<?php echo $ID_DTSV['ID_DTSV']; ?>"><?php echo $ID_DTSV['ID_DTSV']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="deleteForm" action="http://localhost/Doan/GuithongbaoHS/xoaThongbao" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Xác nhận xoá thông báo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="delete_id" name="delete_id">
                    <p>Bạn có chắc chắn muốn xoá thông báo này?</p>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Xoá</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Reset Confirmation Modal -->
<div class="modal fade" id="resetModal" tabindex="-1" role="dialog" aria-labelledby="resetModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="resetModalLabel">Xác nhận reset thông báo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Bạn có chắc chắn muốn reset tất cả thông báo?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                <button type="button" class="btn btn-danger" id="confirmResetButton">Reset</button>
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
            <div class="modal-body">
                <?php
                if (!empty($data['result'])) {
                    if ($data['result'] == 'success') {
                        echo ' Thành công!';
                    } else {
                        echo ' Thất bại!-- Vui Lòng Thử Lại!';
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function() {
        // Edit Modal - Populate form fields on edit link click
        $('.edit-link').on('click', function() {
            var id = $(this).data('id');
            var title = $(this).data('title');
            var message = $(this).data('message');
            var id_dtsv = $(this).data('id_dtsv');

            $('#edit_id').val(id);
            $('#edit_title').val(title);
            $('#edit_message').val(message);
            $('#edit_id_dtsv').val(id_dtsv);

            $('#editModal').modal('show');
        });

        // Delete Modal - Populate hidden input for deletion on delete link click
        $('.delete-link').click(function(e) {
            e.preventDefault();
            var thongbaoId = $(this).data('id');
            $('#delete_id').val(thongbaoId);
            $('#deleteModal').modal('show');
        });

        // Handle delete form submission with Ajax
        $('#deleteForm').submit(function(e) {
            e.preventDefault();
            var id = $('#delete_id').val();
            $.ajax({
                url: 'http://localhost/Doan/GuithongbaoHS/xoaThongbao/' + id,
                type: 'POST',
                success: function(response) {
                    // Reload page after successful deletion
                    $('#deleteModal').modal('hide');
                    location.reload();
                },
                error: function(xhr, status, error) {
                    console.error('Xoá thất bại: ' + xhr.responseText);
                }
            });
        });

        // Handle reset button click
        $('#btnReset').click(function() {
            $('#resetModal').modal('show');
        });

        // Handle confirm reset button click
        $('#confirmResetButton').click(function() {
            $.ajax({
                url: 'http://localhost/Doan/GuithongbaoHS/resetThongbao',
                type: 'POST',
                success: function(response) {
                    // Reload page after successful reset
                    $('#resetModal').modal('hide');
                    location.reload();
                },
                error: function(xhr, status, error) {
                    console.error('Reset thất bại: ' + xhr.responseText);
                }
            });
        });

        // Show result modal if result is set
        <?php if (!empty($data['result'])): ?>
            $('#resultModal').modal('show');
        <?php endif; ?>
    });
</script>
