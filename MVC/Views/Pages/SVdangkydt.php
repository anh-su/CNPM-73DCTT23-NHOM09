<style>
    .custom-hr {
        border-top: 1px solid #333;
        width: 100%;
        margin-top: 10px;
        margin-bottom: 20px;
    }

    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f9;
        margin: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .forms-container {
        display: flex;
        justify-content: flex-start;
        /* Các form sẽ được xếp theo chiều ngang */
        width: 100%;
        /* Đảm bảo container chiếm hết chiều rộng */
        gap: 20px;
        /* Khoảng cách giữa các form */
    }

    .form-container {
        background-color: white;
        padding: 20px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        width: 400px;
        /* Form đầu tiên có chiều rộng cố định */
    }

    .form-container:last-child {
        flex-grow: 1;
        /* Form thứ hai chiếm hết không gian còn lại */
    }

    h4 {
        text-align: center;
        margin-bottom: 20px;
        background-color: DARKGRAY;
    }

    label {
        font-size: 14px;
        color: #555;
        display: block;
        margin: 10px 0 5px;
    }

    input,
    select,
    textarea {
        width: 100%;
        padding: 10px;
        margin-bottom: 20px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 14px;
    }

    .themsv {
        width: 100%;
        padding: 10px;
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
    }

    .dangky {
        width: 100%;
        padding: 10px;
        background-color: rgb(34, 111, 255);
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
    }

    .themsv:hover {
        background-color: #45a049;
    }

    .dangky:hover {
        background-color: rgb(34, 111, 255);
    }

    /* Style for dynamic student input fields */
    .input-container {
        margin-bottom: 15px;
    }

    .input-container input {
        display: inline-block;
        width: calc(50% - 5px);
        margin-right: 10px;
    }

    .xoa {
        background-color: red;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 18px;
    }

    .them {
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 18px;
        margin-left: 0.5cm;
    }

    .modal-xl-custom {
        max-width: 80%;
        /* Chiếm 90% chiều rộng màn hình */
        width: 80%;
    }

    .modal-body .container-fluid {
        padding: 20px;
    }

    .modal-body .form-row {
        margin-bottom: 15px;
    }
</style>

<body>
    <div class="forms-container">
        <div class="form-container">
            <h4>Đăng Ký Đề Tài</h4>
            <hr class="custom-hr">
            <form id="dangkydetai" action="http://localhost/Doan/SVdangkydt/dangky" method="post">
                <label for="ID_DTSV">Tên Nhóm/ID: </label>
                <input type="text" class="form-control" id="ID_DTSV" name="txtID_DTSV" required>
                <label for="Tendetai">Tên Đề Tài</label>
                <select class="form-control" id="myTendetai" name="txtTendetai" required>
                    <option value="" disabled selected>---Chọn Đề Tài Nghiên Cứu---</option>
                    <?php foreach ($data['danhsachtendetai'] as $Tendetai): ?>
                        <option value="<?php echo $Tendetai['Tendetai']; ?>" <?php if (isset($data['Tendetai']) && $data['Tendetai'] == $tenlop['Tendetai'])
                               echo 'selected'; ?>>
                            <?php echo $Tendetai['Tendetai']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <label for="ID_Sinhvien">Mã Sinh Viên:</label>
                <input type="text" class="form-control" id="ID_Sinhvien" name="txtID_Sinhvien"
                    value="<?php echo $_SESSION['ID']; ?>" readonly>

                <label for="Hoten">Họ tên:</label>
                <input type="text" class="form-control" id="Hoten" name="txtHoten"
                    value="<?php echo $_SESSION['Hoten']; ?>" readonly>

                <label for="Tenkhoa">Khoa: </label>
                <select class="form-control" id="myHTenkhoa" name="txtTenkhoa" required>
                    <option value="" disabled selected>---Chọn Khoa---</option>
                    <?php foreach ($data['danhsachtenkhoa'] as $Tenkhoa): ?>
                        <option value="<?php echo $Tenkhoa['Tenkhoa']; ?>" <?php if (isset($data['Tenkhoa']) && $data['Tenkhoa'] == $Tenkhoa['Tenkhoa'])
                               echo 'selected'; ?>>
                            <?php echo $Tenkhoa['Tenkhoa']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <label for="Hotengv">Giảng viên hướng dẫn: </label>
                <select class="form-control" id="myHotengv" name="txtHotengv" required>
                    <option value="" disabled selected>---Chọn Giảng Viên---</option>
                    <?php foreach ($data['danhsachtengv'] as $Hoten): ?>
                        <option value="<?php echo $Hoten['Hoten']; ?>" <?php if (isset($data['Hoten']) && $data['Hoten'] == $Hoten['Hoten'])
                               echo 'selected'; ?>>
                            <?php echo $Hoten['Hoten']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <label for="Mota">Mô tả: </label>
                <textarea id="Mota" name="txtMota"></textarea>

                <!-- Nút thêm sinh viên -->
                <button type="button" id="themsv" class="themsv" data-toggle="modal" data-target="#addStudentModal">
                    Thêm sinh viên
                </button>
                <br><br>
                <button class="dangky" name="btndangky" type="submit">Đăng Ký</button>
            </form>
        </div>

        <div class="form-container">
            <h4>Đề Tài Đã Đăng Ký</h4>
            <hr class="custom-hr">
            <form action="#" method="post">


                <br>
                <table class="table table-striped">
                    <thead>
                        <tr style="background:#efeded">
                            <th>STT</th>
                            <th>ID</th>
                            <th>Mã Đề Tài</th>
                            <th>Tên Đề Tài</th>
                            <th>Giảng Viên Hướng Dẫn</th>
                            <th>Trạng Thái</th>
                           




                        </tr>
                    </thead>
                    <tbody>

                        <?php if (!empty($data['danhsachdkdetai'])):
                            $i = 0; ?>
                            <?php foreach ($data['danhsachdkdetai'] as $SVdangkydt): ?>
                                <tr>
                                    <td><?php echo (++$i) ?></td>
                                    <td><?php echo htmlspecialchars($SVdangkydt['ID_DTSV']) ?></td>
                                    <td><?php echo htmlspecialchars($SVdangkydt['Madetai']) ?></td>
                                    <td><?php echo htmlspecialchars($SVdangkydt['Tendetai_Detai']) ?></td>
                                    <td><?php echo htmlspecialchars($SVdangkydt['Hotengv']) ?></td>
                                    <td><?php echo htmlspecialchars($SVdangkydt['TrangthaiDT']) ?></td>
                                  


                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="text-center">Không có kết quả nào</td>
                            </tr>
                        <?php endif; ?>

                    </tbody>

                </table>

            </form>
        </div>
    </div>

    <!-- Modal Thêm Sinh Viên -->
    <div class="modal fade" id="addStudentModal" tabindex="-1" role="dialog" aria-labelledby="addStudentModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addStudentModalLabel">Danh Sách Thành Viên</h5>
                    <button type="submit" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="studentForm">
                        <div id="studentInputs">
                            <div class="input-container">
                                <label for="ID_Sinhvien">Mã Sinh Viên:</label>
                                <input type="text" name="studentId[]" class="form-control"
                                    value="<?php echo $_SESSION['ID']; ?>" readonly>
                                <button type="button" class="them" id="addStudentInput">+</button>
                                <label for="Hoten">Họ tên:</label>
                                <input type="text" name="studentName[]" class="form-control"
                                    value="<?php echo $_SESSION['Hoten']; ?>" readonly>

                            </div>
                        </div>
                    </form>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary ml-auto" data-dismiss="modal">Hủy</button>
                    <button type="button" class="btn btn-primary" id="saveStudents">Lưu</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Thành Công -->
    <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div style="background-color:green;" class="modal-header">
                    <h5 class="modal-title" id="successModalLabel">Thành Công</h5>

                </div>
                <div class="modal-body">
                    Các sinh viên đã được lưu thành công!
                </div>

            </div>
        </div>
    </div>

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

   


    <script>
        let addCount = 0; // Biến đếm số lần thêm input
        const students = []; // Mảng lưu các sinh viên đã thêm

        document.getElementById("addStudentInput").addEventListener("click", function () {
            if (addCount < 3) { // Giới hạn thêm tối đa 3 sinh viên
                const newInput = document.createElement("div");
                newInput.classList.add("input-container");
                newInput.innerHTML = `
                <label for="ID_Sinhvien">Mã Sinh Viên:</label>
                <input type="text" name="studentId[]" class="form-control" placeholder="Nhập mã sinh viên" required>
                <label for="Hoten">Họ tên:</label>
                <input type="text" name="studentName[]" class="form-control" placeholder="Nhập tên sinh viên" required>
                <button type="button" class="remove-btn" onclick="removeInput(this)">×</button>
            `;
                document.getElementById("studentInputs").appendChild(newInput);
                addCount++; // Tăng biến đếm lên sau mỗi lần nhấn
            } else {
                alert("Bạn chỉ có thể thêm tối đa 3 thành viên!");
            }
        });

        // Xóa input khi nhấn "×"
        function removeInput(button) {
            button.parentElement.remove();
            addCount--; // Giảm số lần thêm khi xóa
        }

        // Lưu sinh viên vào form chính khi nhấn "Lưu"
        document.getElementById("saveStudents").addEventListener("click", function () {
            const studentInputs = document.querySelectorAll("#studentInputs .input-container");
            let hasDuplicate = false; // Biến kiểm tra trùng lặp

            studentInputs.forEach((input) => {
                const studentId = input.querySelector("input[name='studentId[]']").value.trim();
                const studentName = input.querySelector("input[name='studentName[]']").value.trim();

                // Kiểm tra nếu mã sinh viên hoặc tên sinh viên bị bỏ trống
                if (!studentId || !studentName) {
                    alert("Vui lòng nhập đầy đủ thông tin sinh viên!");
                    hasDuplicate = true;
                    return; // Bỏ qua sinh viên không hợp lệ
                }

                // Kiểm tra mã sinh viên đã tồn tại trong mảng tạm thời
                if (students.some((student) => student.ID_Sinhvien === studentId)) {
                    alert(`Sinh viên với mã "${studentId}" đã có trong nhóm!`);
                    hasDuplicate = true;
                    return; // Bỏ qua sinh viên trùng lặp
                }

                // Nếu không trùng, thêm sinh viên vào mảng tạm thời
                students.push({ ID_Sinhvien: studentId, Hoten: studentName });
            });

            // Nếu không có lỗi, thực hiện thêm vào form chính
            if (!hasDuplicate) {
                const studentDataField = document.createElement("input");
                studentDataField.type = "hidden";
                studentDataField.name = "members"; // Tên trường dữ liệu để gửi qua POST
                studentDataField.value = JSON.stringify(students); // Chuyển mảng thành chuỗi JSON

                // Thêm vào form chính
                document.querySelector("form").appendChild(studentDataField);

                // Hiển thị modal thành công
                $('#successModal').modal('show'); // Hiển thị modal thành công

                // Đóng modal thêm sinh viên sau một khoảng thời gian ngắn (500ms)
                setTimeout(function () {
                    $('#addStudentModal').modal('hide'); // Đóng modal thêm sinh viên
                }, 500); // Đợi 500ms trước khi đóng modal thêm sinh viên
            }
        });

        <?php if (!empty($data['result'])): ?>
            $('#resultModal').modal('show');
        <?php endif; ?>


    </script>

   


    <!-- Thêm thư viện jQuery và Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
