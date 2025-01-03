<!-- views/TopicView.php -->
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biểu đồ kết quả đăng ký</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<style>
    .custom-hr {
        border-top: 2px solid #333;
        width: 100%;
        margin-top: 10px;
        margin-bottom: 20px;
    }
    h2 {
        text-align: center;
    }
</style>
<body>
    <h2>Biểu đồ kết quả đăng ký</h2>
    <hr class="custom-hr">
    <br>
    <!-- Canvas element cho biểu đồ -->
    <canvas id="topicsChart" width="400" height="200"></canvas>

    <script>
    // Dữ liệu từ controller
    const topics = <?php echo json_encode($data['topicNames']); ?>; // Tên các đề tài
    const studentScores = <?php echo json_encode($data['studentScores']); ?>; // Điểm của sinh viên cho từng đề tài

    // Mảng màu tùy chỉnh cho mỗi đề tài
    const colors = [
        'rgb(255, 99, 133)', // Đỏ đậm
        'rgb(54, 163, 235)', // Xanh dương đậm
        'rgb(255, 207, 86)', // Vàng đậm
        'rgb(75, 192, 192)', // Xanh lam đậm
        'rgb(153, 102, 255)', // Tím đậm
        'rgb(255, 160, 64)',  // Cam đậm
        'rgb(201, 203, 207)'  // Xám đậm
    ];

    // Chuyển đổi dữ liệu điểm của sinh viên thành dạng có thể sử dụng trong biểu đồ
    const datasets = Object.keys(studentScores).map((studentID, index) => {
        return {
            label: 'Sinh viên ' + studentID, // Tên sinh viên
            data: topics.map((topic) => {
                // Nếu sinh viên có điểm cho đề tài này, lấy điểm, nếu không thì là null
                return studentScores[studentID][topic] || null;
            }),
            backgroundColor: colors[index % colors.length], // Màu sắc tương ứng
            borderColor: colors[index % colors.length], // Màu viền
            borderWidth: 1
        };
    });

    // Dữ liệu cho biểu đồ
    const data = {
        labels: topics, // Tên các đề tài (trục x)
        datasets: datasets // Mỗi cột là một dataset riêng
    };

    // Cấu hình cho biểu đồ
    const config = {
        type: 'bar',
        data: data,
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true // Hiển thị chú thích
                }
            },
            scales: {
                y: {
                    min: 0,  // Thiết lập giá trị tối thiểu là 0
                    max: 10, // Thiết lập giá trị tối đa là 10
                    ticks: {
                        stepSize: 0.5, // Khoảng cách giữa các giá trị là 0.5
                        callback: function(value) {
                            if (Number.isFinite(value)) {
                                return value.toFixed(1); // Hiển thị giá trị với một chữ số thập phân
                            }
                        }
                    },
                    title: {
                        display: true,
                        text: 'Điểm'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Tên đề tài'
                    }
                }
            }
        }
    };

    // Render biểu đồ
    const topicsChart = new Chart(
        document.getElementById('topicsChart'),
        config
    );
    </script>
</body>
</html>
