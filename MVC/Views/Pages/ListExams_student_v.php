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
        .btn-add-member {
            background-color: #007bff;
            color: white;
        }
        .btn-add-member:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<div class="container">
    <h2 class="text-center mb-4">Đăng ký đề tài</h2>
    <form method="post" action="http://localhost/Doan/Detai/themmoi" enctype="multipart/form-data">
        <div class="form-group">
            <label for="madetai">Mã đề tài</label>
            <input type="text" class="form-control" id="madetai" name="txtmadetai" placeholder="Nhập mã đề tài" required>
        </div>
        <div class="form-group">
            <label for="tendetai">Tên đề tài</label>
            <input type="text" class="form-control" id="tendetai" name="txttendetai" placeholder="Nhập tên đề tài" required>
        </div>
        <div class="form-group">
            <label for="masv">Mã số sinh viên</label>
            <input type="text" class="form-control" id="masv" name="txtmasv" placeholder="Nhập mã sinh viên" required>
        </div>
        <div class="form-group">
            <label for="giangvien">Giảng viên hướng dẫn</label>
            <input type="text" class="form-control" id="giangvien" name="txtgiangvien" placeholder="Nhập tên giảng viên" required>
        </div>
        <div class="form-group">
            <label for="ghichu">Ghi chú</label>
            <textarea class="form-control" id="ghichu" name="txtghichu" rows="4" placeholder="Nhập ghi chú"></textarea>
        </div>
        
        <!-- Button thêm thành viên -->
        <div class="form-group text-center">
            <button type="button" class="btn btn-add-member" data-toggle="modal" data-target="#addMemberModal">
                Thêm thành viên
            </button>
        </div>
        
        <!-- Danh sách thành viên -->
        <div class="member-list">
            <h4>Danh sách thành viên</h4>
            <div id="memberListContainer"></div>
        </div>

        <div class="form-group text-center">
            <button type="submit" class="btn btn-primary" name="btnthem">Đăng ký đề tài</button>
        </div>
    </form>
</div>

<!-- Modal Thêm Thành Viên -->
<div class="modal fade" id="addMemberModal" tabindex="-1" role="dialog" aria-labelledby="addMemberModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addMemberModalLabel">Thêm thành viên</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="newMemberName">Tên sinh viên</label>
                    <input type="text" class="form-control" id="newMemberName" placeholder="Nhập tên sinh viên">
                </div>
                <div class="form-group">
                    <label for="newMemberId">Mã số sinh viên</label>
                    <input type="text" class="form-control" id="newMemberId" placeholder="Nhập mã số sinh viên">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                <button type="button" class="btn btn-primary" id="addNewMemberBtn">Thêm</button>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    let members = [];
    document.getElementById('addNewMemberBtn').addEventListener('click', function () {
        const name = document.getElementById('newMemberName').value;
        const id = document.getElementById('newMemberId').value;

        if (name && id) {
            const member = { name, id };
            members.push(member);
            updateMemberList();
            $('#addMemberModal').modal('hide');
        } else {
            alert('Vui lòng nhập đầy đủ thông tin.');
        }
    });

    function updateMemberList() {
        const container = document.getElementById('memberListContainer');
        container.innerHTML = '';
        members.forEach((member, index) => {
            const memberRow = document.createElement('div');
            memberRow.classList.add('member-row');
            memberRow.innerHTML = `
                <p><strong>${member.name}</strong> (Mã số: ${member.id})</p>
                <button class="btn btn-danger btn-remove-member" onclick="removeMember(${index})">Xóa</button>
            `;
            container.appendChild(memberRow);
        });
    }

    function removeMember(index) {
        members.splice(index, 1);
        updateMemberList();
    }
</script>
</body>
</html>
