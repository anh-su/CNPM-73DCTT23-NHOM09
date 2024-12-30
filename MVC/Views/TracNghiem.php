<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập</title>
    <link rel="stylesheet" href="reset.css">
    <link rel="stylesheet" href="http://localhost/Doan/Public/Css/TracNghiem.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="backgr">
        <div class="nentong">
            <form style="max-width: 400px;" action="http://localhost/Doan/LoginController/login" method="post" class="login">
                <h1 class="tieude">Đăng Nhập</h1>
                <div class="nhom">
                    <i class="bi bi-people-fill"></i>
                    <input type="text" name="Tendangnhap" class="id" placeholder="Tên Đăng Nhập">
                </div>
                <div class="nhom">
                    <i class="bi bi-key-fill"></i>
                    <input type="password" name="Matkhau" class="id" placeholder="Mật Khẩu">
                    <div class="eye">
                        <i class="bi bi-eye-fill"></i>
                    </div>
                </div>
                <input type="submit" name="dangnhap" value="Đăng Nhập" class="submit">
            </form>
        </div>
    </div>

    <div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="errorModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div style="background-color: #ff7a7a;" class="modal-header">
                    <h5 class="modal-title" id="errorModalLabel">Thông Báo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php echo $error_message; ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successModalLabel">Thông Báo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php echo $success_message; ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="main.js"></script>

    <?php if (!empty($error_message)) { ?>
        <script>
            $(document).ready(function() {
                $('#errorModal').modal('show');
            });
        </script>
    <?php } ?>
    <?php if (!empty($success_message)) { ?>
        <script>
            $(document).ready(function() {
                $('#successModal').modal('show');
            });
        </script>
    <?php } ?>
</body>

</html>