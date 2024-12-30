<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Sinh Viên</title>
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
            width: 1200px;
            height: auto;
            background-image: url('http://localhost/Doan/Public/Pictures/OIP.jpeg');
            background-size: cover;
            background-position: center;
            border: 2px solid #ccc;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
            padding: 40px;
            box-sizing: border-box;
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
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table thead {
            background: #efeded;
        }
        table th,
        table td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: center;
            font-size: 14px;
        }
        table th {
            font-weight: bold;
            color: #333;
        }
        table tr:nth-child(even) {
            background: #f9f9f9;
        }
        table img {
            max-width: 24px;
            cursor: pointer;
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
        .modal {
            display: none;
            position: fixed;
            z-index: 1050;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }
        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 600px;
            border-radius: 10px;
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: black;
text-decoration: none;
            cursor: pointer;
        }
        .custom-hr {
    border-top: 1px solid #333; /* Màu và độ dày của đường kẻ */
    width: 100%; /* Chiều rộng của đường kẻ */
    margin-top: 10px; /* Khoảng cách giữa đường kẻ và các phần khác */
    margin-bottom: 20px; /* Khoảng cách với phần dưới đường kẻ */
  }
    </style>
</head>
<body>

<form method="post" action="http://localhost/Doan/Sinhvien/themmoi">
   <div class="container-fluid mt-3">
      <h4 class="mb-2">Thêm Sinh Viên</h4>
     
      <hr class="custom-hr">
      <div class="form-row">
         <div class="form-group col-sm-4">
            <label for="myID_Sinhvien">ID Sinh Viên:</label>
            <input type="text" class="form-control" id="myID_Sinhvien" name="txtID_Sinhvien" required>
         </div>
         <div class="form-group col-sm-4">
            <label for="myHoten">Họ và Tên:</label>
            <input type="text" class="form-control" id="myHoten" name="txtHoten" required>
         </div>
         <div class="form-group col-sm-4">
            <label for="myNgaysinh">Ngày Sinh</label>
            <input type="date" class="form-control" id="myNgaysinh" name="txtNgaysinh" required>
         </div>
      </div>
      <div class="form-row">
      <div class="form-group col-sm-4">
         <label for="myDiaChi">Địa Chỉ</label>
         <input type="text" class="form-control" id="myDiaChi" name="txtDiachi" required>
      </div>
      <div class="form-group col-sm-4">
            <label for="myEmail">Email</label>
            <input type="email" class="form-control" id="myEmail" name="txtEmail" required>
         </div>
      <div class="form-group col-sm-4">
         <label for="mySdt">Số Điện Thoại</label>
         <input type="tel" class="form-control" id="mySdt" name="txtSdt" required>
      </div>
      </div>
      <div class="form-row">
     
         <div class="form-group col-sm-4">
            <label for="myGioitinh">Giới Tính:</label>
            <select class="form-control" id="myGioitinh" name="txtGioitinh" required>
               <option value="Nam">Nam</option>
               <option value="Nữ">Nữ</option>
               <option value="Khác">Khác</option>
            </select>
         </div>
         <div class="form-group col-sm-4">
            <label for="myID_Lop">ID Lớp:</label>
            <select class="form-control" id="myID_Lop" name="txtID_Lop">
               <?php foreach ($data['danhSachID_Lop'] as $idlop) : ?>
                  <option value="<?php echo $idlop['ID_Lop']; ?>" <?php if (isset($data['ID_Lop']) && $data['ID_Lop'] == $idlop['ID_Lop']) echo 'selected'; ?>>
                     <?php echo $idlop['ID_Lop']; ?>
                  </option>
               <?php endforeach; ?>
            </select>
         </div>
         <div class="form-group col-sm-4">
            <label for="myID_Khoa">ID Khoa:</label>
            <select class="form-control" id="myID_Khoa" name="txtID_Khoa">
               <?php foreach ($data['danhSachID_Khoa'] as $idkhoa) : ?>
                  <option value="<?php echo $idkhoa['ID_Khoa']; ?>" <?php if (isset($data['ID_Khoa']) && $data['ID_Khoa'] == $idkhoa['ID_Khoa']) echo 'selected'; ?>>
                     <?php echo $idkhoa['ID_Khoa']; ?>
                  </option>
               <?php endforeach; ?>
            </select>
         </div>
      </div>
      <div class="form-row justify-content-center">
         <div class="form-group col-sm-1">
            <button style="background-color: #26a69a; width: 4cm;" type="submit" class="btn btn-primary" name="btnthemsv">Thêm</button>
         </div>
      </div>
   </div>
</form>

    <hr class="custom-hr">

    
    <div class="container">
        <div class="info-box">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <h2 class="info-title">Danh Sách Sinh Viên</h2>
          
    </div>
            <table>
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Mã Học Sinh</th>
                        <th>Họ và Tên</th>
                        <th>Ngày Sinh</th>
                        <th>Địa Chỉ</th>
                        <th>Điện Thoại</th>
                        <th>Email</th>
                        <th>Giới Tính</th>
                        <th>Lớp Học</th>
                        <th>Khoa</th>
                        <th>Thao Tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($data['dulieu'])):
                        $i = 0; ?>
                        <?php foreach ($data['dulieu'] as $row): ?>
                            <tr>
                                <td><?php echo ++$i; ?></td>
                                <td><?php echo $row['ID_Sinhvien']; ?></td>
                                <td><?php echo $row['Hoten']; ?></td>
                                <td><?php echo $row['Ngaysinh']; ?></td>
                                <td><?php echo $row['Diachi']; ?></td>
                                <td><?php echo $row['Sdt']; ?></td>
                                <td><?php echo $row['Email']; ?></td>
                                <td><?php echo $row['Gioitinh']; ?></td>
                                <td><?php echo $row['ID_Lop']; ?></td>
                                <td><?php echo $row['ID_Khoa']; ?></td>
                                <td>
                                <a href="#" class="edit-link" 
   data-mahs="<?php echo $row['ID_Sinhvien']; ?>"
   data-hoten="<?php echo $row['Hoten']; ?>"
   data-ngaysinh="<?php echo $row['Ngaysinh']; ?>"
   data-diachi="<?php echo $row['Diachi']; ?>" 
   data-dienthoai="<?php echo $row['Sdt']; ?>"
   data-email="<?php echo $row['Email']; ?>"
   data-gioitinh="<?php echo $row['Gioitinh']; ?>" 
   data-idlop="<?php echo $row['ID_Lop']; ?>"
   data-idkhoa="<?php echo $row['ID_Khoa']; ?>"
   data-toggle="modal"
   data-target="#editStudentModal">
   <img src="http://localhost/Doan/Public/Pictures/edit.gif" alt="Edit">
</a>

                                    <a href="http://localhost/Doan/Sinhvien/deleteSinhvien/<?php echo $row['ID_Sinhvien']; ?>">
                                        <img src="http://localhost/Doan/Public/Pictures/13.png" alt="Delete">
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
<?php else: ?>
                    
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="modal" id="editStudentModal" tabindex="-1" role="dialog" aria-labelledby="editStudentModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 800px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editStudentModalLabel">Chỉnh sửa thông tin sinh viên</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="http://localhost/Doan/Sinhvien/capnhatsv" id="editStudentForm">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="editMaHS">Mã Học Sinh:</label>
                            <input type="text" class="form-control" id="editMaHS" name="mahs" readonly>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="editHoTen">Họ và Tên:</label>
                            <input type="text" class="form-control" id="editHoTen" name="hoten">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="editNgaySinh">Ngày Sinh:</label>
                            <input type="date" class="form-control" id="editNgaySinh" name="ngaysinh">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="editDiaChi">Địa Chỉ:</label>
                            <input type="text" class="form-control" id="editDiaChi" name="diachi">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="editDienThoai">Điện Thoại:</label>
                            <input type="text" class="form-control" id="editDienThoai" name="dienthoai">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="editEmail">Email:</label>
                            <input type="email" class="form-control" id="editEmail" name="email">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="editGioiTinh">Giới Tính:</label>
                            <select class="form-control" id="editGioiTinh" name="gioitinh">
                                <option value="Nam">Nam</option>
                                <option value="Nữ">Nữ</option>
                                <option value="khac">Khác</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="editIDLop">Lớp Học:</label>
                            <select class="form-control" id="editIDLop" name="id_lop">
                                <?php foreach ($data['danhSachID_Lop'] as $idlop) : ?>
                                    <option value="<?php echo $idlop['ID_Lop']; ?>"><?php echo $idlop['ID_Lop']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="editIDKhoa">Khoa:</label>
                            <select class="form-control" id="editIDKhoa" name="id_khoa">
                                <?php foreach ($data['danhSachID_Khoa'] as $idkhoa) : ?>
                                    <option value="<?php echo $idkhoa['ID_Khoa']; ?>"><?php echo $idkhoa['ID_Khoa']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                <button type="submit" class="btn btn-primary" form="editStudentForm">Lưu</button>
            </div>
        </div>
    </div>
</div>

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
                    <?php if (isset($data['deleteResult'])): ?>
                        <?php if ($data['deleteResult'] == 'success'): ?>
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
               if (!empty($data['resultt'])) {
                switch ($data['resultt']) {
                    case 'duplicate':
                        echo 'Trùng ID Sinh Viên!';
                        break;
                    case 'fail':
                        echo 'Thêm thất bại!';
                        break;
                    case 'success':
                        echo 'Thêm thành công!';
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
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        
        $(document).ready(function () {
            <?php if (!empty($data['resultt'])): ?>
                $('#resultModal').modal('show');
            <?php endif; ?>

            <?php if (isset($data['resultdl'])): ?>
                $('#deleteResultModal').modal('show');
            <?php endif; ?>

            <?php if (isset($data['editResult'])): ?>
                $('#editResultModal').modal('show');
            <?php endif; ?>

            $('.edit-link').click(function () {
    var ID_Sinhvien = $(this).data('mahs');
    var Hoten = $(this).data('hoten');
    var Ngaysinh = $(this).data('ngaysinh');
    var Diachi = $(this).data('diachi');
    var Sdt = $(this).data('dienthoai');
    var Email = $(this).data('email');
    var Gioitinh = $(this).data('gioitinh');
    var ID_Lop = $(this).data('idlop');
    var ID_Khoa = $(this).data('idkhoa');

    // Điền giá trị vào các trường trong modal
    $('#editMaHS').val(ID_Sinhvien);
    $('#editHoTen').val(Hoten);
    $('#editNgaySinh').val(Ngaysinh);
    $('#editDiaChi').val(Diachi);
    $('#editDienThoai').val(Sdt);
    $('#editEmail').val(Email);
    $('#editGioiTinh').val(Gioitinh);
    $('#editIDLop').val(ID_Lop);  // Đây là cách sử dụng JavaScript để điền giá trị
    $('#editIDKhoa').val(ID_Khoa);  // Tương tự với trường ID_Khoa
});


        });
    </script>

</body>

</html>