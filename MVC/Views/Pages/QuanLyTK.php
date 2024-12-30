<style>
  h4 {
    text-align: center; /* Căn chữ ở giữa trong thẻ */
    margin-top: 1cm;
  }

  .custom-hr {
    border-top: 1px solid #333; /* Màu và độ dày của đường kẻ */
    width: 100%; /* Chiều rộng của đường kẻ */
    margin-top: 10px; /* Khoảng cách giữa đường kẻ và các phần khác */
    margin-bottom: 20px; /* Khoảng cách với phần dưới đường kẻ */
  }

  .bangnoidung {
    border-collapse: collapse;
    width: 100%; /* Chiều rộng của bảng */
  }

  .bangnoidung tr th {
    border: none; /* Loại bỏ viền của các ô */
    width: 400px;
    height: 200px;
    font-size: 24px;
  }

  .bangnoidung a:hover {
    text-decoration: none; /* Bỏ dấu gạch dưới */
    color: rgb(95, 91, 91);
  }



  .s1 {
    color: black;
  }

  .box1ND {
    padding: 1cm 0.5cm;
  }

  .box2Nd {
    padding: 1cm 0cm;
  }

  .box1 {
    width: 5cm;
    height: 3cm;
    background-color: #ffffff;
    display: block;
    margin: auto;
    border-radius: 15px;
  }

  .s2 {
    color: black;
  }

  .box2 {
    width: 5cm;
    height: 3cm;
    background-color: #ffffff;
    display: block;
    margin: auto;
    border-radius: 15px;
  }
</style>


      <h4 class="mb-2">ĐĂNG KÝ TÀI KHOẢN</h4>
      <hr class="custom-hr">
    

<body>

    <table class="bangnoidung">
        <tr>
            <th>
                <div class="box1">
                    <div class="box1ND">
                        <img src="./Public/Pictures/user.png" alt="">
                        <a class="s1" href="http://localhost/Doan/DStaikhoansv">Sinh Viên</a>
                    </div>
                </div>
            </th>
            <th>
                <div class="box1">
                    <div class="box1ND">
                        <img src="./Public/Pictures/Ionic-Ionicons-People-sharp.32.png" alt="">
                        <a class="s1" href="http://localhost/Doan/DStaikhoangv">Giáo Viên</a>
                    </div>
                </div>
            </th>
            <th>
                <div class="box2">
                    <div class="box1ND">
                        <img src="./Public/Pictures/Microsoft-Fluentui-Emoji-Mono-Books.32.png" alt="">
                        <a class="s1" href="http://localhost/Doan/DStaikhoanad">Admin</a>
                    </div>
                </div>
            </th>
        </tr>
    </table>
</body>

<!-- Modal chỉnh sửa -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Tài Khoản Học Sinh</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Nội dung form thêm tài khoản -->
                <form method="post" action="http://localhost/DOAN/QuanlyTK/ThemmoiTKSV">
                    <div class="container-fluid mt-3">
                        <div class="form-row">
                            <div class="form-group col-sm-4">
                                <label for="modalMahs">ID_Taikhoan</label>
                                <input type="number" class="form-control" id="modalID_TK" name="txtID_TK" >
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="modalHoten">Tên Đăng Nhập</label>
                                <input type="text" class="form-control" id="modalHoten" name="txtHoten">
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="modalNgaysinh">Mật Khẩu</label>
                                <input type="text" class="form-control" id="modalNgaysinh" name="txtNgaysinh">
                            </div>
                        </div>
                       
                        <div class="form-group">
                            <label for="modalDienthoai">ID_Sinhvien</label>
                            <input type="text" class="form-control" id="modalDienthoai" name="txtDienthoai">
                        </div>
                       
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Thêm Tài Khoản</button>
                        <button type="submit" class="btn btn-primary">Danh Sách Tài Khoản</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {

        // If there's a delete result, show the delete result modal
        <?php if (isset($data['result'])) : ?>
            $('#deleteResultModal').modal('show');
        <?php endif; ?>

        // If there's an edit result, show the edit result modal
        <?php if (isset($data['editResult'])) : ?>
            $('#editResultModal').modal('show');
        <?php endif; ?>

        $('.edit-link').click(function() {
            var mahs = $(this).data('mahs');
            var hoten = $(this).data('hoten');
            var ngaysinh = $(this).data('ngaysinh');
            var diachi = $(this).data('diachi');
            var dienthoai = $(this).data('dienthoai');
            var email = $(this).data('email');
            var gioitinh = $(this).data('gioitinh');
            var tenlop = $(this).data('tenlop');


            $('#modalMahs').val(mahs);
            $('#modalHoten').val(hoten);
            $('#modalNgaysinh').val(ngaysinh);
            $('#modalDiachi').val(diachi);
            $('#modalDienthoai').val(dienthoai);
            $('#modalEmail').val(email);
            $('#modalGioitinh').val(gioitinh);
            $('#modalTenlop').val(tenlop);

        });
    });
</script>


      
     
     