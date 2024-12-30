<!-- views/TopicView.php -->
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biểu đồ số lượng đề tài</title>
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
    <h2 >Biểu đồ số lượng đăng ký đề tài</h2>
    <hr class="custom-hr">
    <br>
    <!-- Canvas element cho biểu đồ -->
    <canvas id="topicsChart" width="400" height="200"></canvas>

    <script>
    // Dữ liệu từ controller
    const topics = <?php echo json_encode($data['topicNames']); ?>; // Tên các đề tài
    const counts = <?php echo json_encode($data['topicCount']); ?>; // Số lượng nhóm đăng ký theo từng đề tài

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

    // Tạo datasets riêng biệt cho mỗi đề tài
    const datasets = topics.map((topic, index) => ({
        label: topic, // Nhãn tương ứng với từng đề tài
        data: topics.map((_, i) => (i === index ? counts[index] : 0)), // Chỉ hiển thị giá trị tại đúng vị trí đề tài
        backgroundColor: colors[index % colors.length], // Màu sắc tương ứng
        borderColor: colors[index % colors.length], // Màu viền
        borderWidth: 1
    }));

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
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1, // Khoảng cách giữa các giá trị là 1
                        callback: function(value) {
                            if (Number.isInteger(value)) {
                                return value; // Chỉ hiển thị số nguyên
                            }
                        }
                    },
                    title: {
                        display: true,
                        text: 'Số lượng nhóm'
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
