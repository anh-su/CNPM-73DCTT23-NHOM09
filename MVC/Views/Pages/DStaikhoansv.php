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
  <h4 class="mb-2">ĐĂNG KÝ TÀI KHOẢN SINH VIÊN</h4>
  <hr class="custom-hr">

  <!-- Form Đăng Ký -->
  <div class="form-container">
    <form method="post" action="http://localhost/Doan/QuanlyTK/themmoi">
      <div class="form-row">
        <div class="form-group col-sm-12">
          <label for="myID_TK">ID Tài Khoản</label>
          <input type="text" class="form-control" id="myID_TK" name="txtID_TK" required>
        </div>
      </div>

      <div class="form-row">
        <div class="form-group col-sm-12">
          <label for="myTendangnhap">Tên Đăng Nhập</label>
          <input type="text" class="form-control" id="myTendangnhap" name="txtTendangnhap" required>
        </div>
      </div>

      <div class="form-row">
        <div class="form-group col-sm-12">
          <label for="myMatkhau">Mật Khẩu</label>
          <input type="text" class="form-control" id="myMatkhau" name="txtMatkhau" required>
        </div>
      </div>

      <div class="form-row">
        <div class="form-group col-sm-12">
          <label for="myID_Sinhvien">ID Sinh Viên</label>
          <input type="text" class="form-control" id="myID_Sinhvien" name="txtID_Sinhvien" required>
        </div>
      </div>

      <div class="form-group">
        <button style="background-color: #26a69a;" type="submit" class="btn btn-primary" name="btnThemSinhvien">Đăng Ký Tài Khoản</button>
      </div>
    </form>
  </div>


  <!-- Danh sách tài khoanr học sinh  -->


  <form method="post" action="http://localhost/Doan/QuanlyTK/timkiem">
    <br>
    <hr class="custom-hr">
    
    <h3>Danh Sách Tài Khoản</h3>
    <br>
    <div class="form-inline d-flex align-items-center">
    <div class="form-group">
        <label for="myID_TK">ID Tài Khoản: </label>
        <input type="number" class="form-control1" id="myID_TK" name="txtID_TK" value="<?php if (isset($data['ID_TK'])) echo $data['ID_TK'] ?>">
    </div>

    <div class="form-group" style="margin-left: 1cm;">
        <label for="myID_Sinhvien">ID Sinh Viên: </label>
        <input type="text" class="form-control1" id="myID_Sinhvien" placeholder="" name="txtID_Sinhvien" value="<?php if (isset($data['ID_Sinhvien'])) echo $data['ID_Sinhvien'] ?>">
    </div>
    <div class="form-group">
    <button style="margin-left: 1cm; background-color: #26a69a;" type="submit" class="btn btn-primary" name="btnTimkiem">Tìm Kiếm</button>
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
                <th>ID Tài Khoản</th>
                <th>Tên Đăng Nhập</th>
                <th>Mật Khẩu</th>
                <th>Vai Trò</th>
                <th>ID Sinh Viên</th>
                <th>Cài Đặt</th>
                
               
            </tr>
        </thead>
        <tbody>
          
        <?php if (!empty($data['danhSachTaiKhoansv'])) :
            $i=0; ?>
            <?php foreach ($data['danhSachTaiKhoansv'] as $QuanlyTK) : ?>
            <tr>
                        
                <td><?php  echo (++$i) ?></td>
                <td><?php echo $QuanlyTK['ID_TK'] ?></td>
                <td><?php echo $QuanlyTK['Tendangnhap'] ?></td>
                <td><?php echo $QuanlyTK['Matkhau'] ?></td>
                <td><?php echo $QuanlyTK['Vaitro'] ?></td>
                <td><?php echo $QuanlyTK['ID_Sinhvien'] ?></td>
                <td>
                    <a href="#" class="edit-link" data-ID_TK="<?php echo $QuanlyTK['ID_TK']; ?>" data-Tendangnhap="<?php echo $QuanlyTK['Tendangnhap']; ?>" data-Matkhau="<?php echo $QuanlyTK['Matkhau']; ?>" data-Vaitro="<?php echo $QuanlyTK['Vaitro']; ?>" data-ID_Sinhvien="<?php echo $QuanlyTK['ID_Sinhvien']; ?>" data-toggle="modal" data-target="#editModal">
                        <img src="http://localhost/Doan/Public/Pictures/edit.gif" alt="Edit">
                    </a>
                    <a href="http://localhost/Doan/QuanlyTK/xoa/<?php echo$QuanlyTK['ID_TK'] ?>">
                        <img src="http://localhost/Doan/Public/Pictures/13.png" alt="Delete">
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="7" class="text-center">Không có tài khoản nào</td>
                </tr>
            <?php endif; ?>
</tbody>

    </table>
</form>

  <!-- Modal -->
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
                        case 'duplicate':
                            echo 'Trùng mã Tài Khoản!';
                            break;
                    
                        case 'upload_error':
                            echo 'Lỗi khi tải file lên!';
                            break;
                        case 'fail':
                            echo 'Đăng Ký thất bại!';
                            break;
                        case 'success':
                            echo 'Đăng Ký thành công!';
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
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Chỉnh sửa thông tin tài khoản</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Nội dung form chỉnh sửa -->
                <form method="post" action="http://localhost/Doan/QuanlyTK/capnhat">
                    <div class="container-fluid mt-3">
                        <div class="form-row">
                            <div class="form-group col-sm-4">
                                <label for="modalID_TK">ID Tài Khoản</label>
                                <input type="text" class="form-control" id="modalID_TK" name="txtID_TK" readonly>
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="modalTendangnhap">Tên Đăng Nhập</label>
                                <input type="text" class="form-control" id="modalTendangnhap" name="txtTendangnhap">
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="modalMatkhau">Mật Khẩu</label>
                                <input type="text" class="form-control" id="modalMatkhau" name="txtMatkhau">
                            </div>
                        </div>
                        <div class="form-row">
                        <div class="form-group col-sm-6">
                            <label for="modalVaitro">Vai Trò</label>
                            <input type="text" class="form-control" id="modalVaitro" name="txtVaitro" readonly>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="modalID_Sinhvien">ID Sinh Viên</label>
                            <input type="text" class="form-control" id="modalID_Sinhvien" name="txtID_Sinhvien" readonly>
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
<div class="modal fade" id="editResultModal" tabindex="-1" role="dialog" aria-labelledby="editResultModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editResultModalLabel">Kết Quả Sửa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php if (isset($data['editResult'])) : ?>
                    <?php if ($data['editResult'] == 'success') : ?>
                        <p>Sửa thành công!</p>
                    <?php else : ?>
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
<div class="modal fade" id="deleteResultModal" tabindex="-1" role="dialog" aria-labelledby="deleteResultModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div style="background-color: #78dd78;" class="modal-header">
                <h5 class="modal-title" id="deleteResultModalLabel">Kết Quả Xóa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php if (isset($data['resultdl'])) : ?>
                    <?php if ($data['resultdl'] == 'success') : ?>
                        <p>Xóa thành công!</p>
                    <?php else : ?>
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
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>  <!-- Thay thế bằng bản đầy đủ -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <script>
$(document).ready(function() {
    <?php if (!empty($data['result'])) : ?>
        $('#resultModal').modal('show');
    <?php endif; ?>

    <?php if (isset($data['resultdl'])) : ?>
        $('#deleteResultModal').modal('show');
    <?php endif; ?>

    <?php if (isset($data['editResult'])) : ?>
        $('#editResultModal').modal('show');
    <?php endif; ?>

    $('.edit-link').click(function() {
        var ID_TK = $(this).data('id_tk');
        var Tendangnhap = $(this).data('tendangnhap');
        var Matkhau = $(this).data('matkhau');
        var Vaitro = $(this).data('vaitro');
        var ID_Sinhvien = $(this).data('id_sinhvien');

        // Kiểm tra trong console
        console.log(ID_TK, Tendangnhap, Matkhau, Vaitro, ID_Sinhvien);

        $('#modalID_TK').val(ID_TK);
        $('#modalTendangnhap').val(Tendangnhap);
        $('#modalMatkhau').val(Matkhau);
        $('#modalVaitro').val(Vaitro);
        $('#modalID_Sinhvien').val(ID_Sinhvien);
    });
});



    
  </script>
</body>
</html>
