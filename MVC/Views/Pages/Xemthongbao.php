<style>
    .custom-hr {
        border-top: 2px solid #333;
        width: 100%;
        margin-top: 10px;
        margin-bottom: 20px;
    }
    .container {
        position: relative;
        width: 1000px;
        height: auto;
       
        background-size: cover;
        background-position: center;
        border: 2px solid #ccc;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        padding: 40px;
        box-sizing: border-box;
        filter: brightness(1);
    }
    </style>

<div class="container">
    <h4 class="mb-4">Danh sách thông báo</h4>
    <hr class="custom-hr">
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>STT</th>
                    <th scope="col">Tiêu Đề</th>
                    <th scope="col">Nội Dung</th>
                    <th scope="col">ID / Nhóm</th>
                    <th scope="col">Người Gửi</th>
                    <th scope="col">Thời Gian</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($data['thongbao'])):
                    $i = 0 ?>
                    <?php foreach ($data['thongbao'] as $thongbao): ?>
                        <tr>
                            <td><?php echo (++$i) ?></td>
                            <td><?php echo htmlspecialchars($thongbao['Tieude'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($thongbao['Noidung'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($thongbao['ID_DTSV'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($thongbao['Hoten'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($thongbao['Thoigian'], ENT_QUOTES, 'UTF-8'); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center">Không có thông báo nào</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>