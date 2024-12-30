<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trạng Thái Đề Tài</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-4">
        <h1 class="text-center">Trạng Thái Đề Tài</h1>
        <hr>

        <!-- Kiểm tra và hiển thị dữ liệu -->
        <?php if (!empty($listDetai)): ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Mã Đề Tài</th>
                        <th>Tên Đề Tài</th>
                        <th>Giảng Viên</th>
                        <th>Ghi Chú</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($listDetai as $row): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['madetai']) ?></td>
                            <td><?= htmlspecialchars($row['tendetai']) ?></td>
                            <td><?= htmlspecialchars($row['giangvien']) ?></td>
                            <td><?= htmlspecialchars($row['ghichu']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Không có đề tài nào liên quan đến bạn.</p>
        <?php endif; ?>
    </div>
</body>

</html>
