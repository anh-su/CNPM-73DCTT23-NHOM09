<style>
    .custom-hr {
        border-top: 1px solid #333;
        width: 100%;
        margin-top: 10px;
        margin-bottom: 20px;
    }
</style>

<h2 style="margin-top: 20px;" class="text-center mb-4">THỐNG KÊ NHIỆM VỤ</h2>

<hr class="custom-hr">



<?php if (!isset($data['Tendetai']) || $data['Tendetai'] == 'none'): ?>
    <canvas id="myChart" style="margin-top: 20px;"></canvas>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Mảng màu sắc cho các cột biểu đồ
        const colors = [
            'rgb(255, 99, 133)', // Đỏ đậm
            'rgb(54, 163, 235)', // Xanh dương đậm
            'rgb(255, 207, 86)', // Vàng đậm
            'rgb(75, 192, 192)', // Xanh lam đậm
            'rgb(153, 102, 255)', // Tím đậm
            'rgb(255, 160, 64)',  // Cam đậm
            'rgb(201, 203, 207)'  // Xám đậm
        ];

        // Dữ liệu từ PHP để hiển thị trên biểu đồ
        const topics = <?php echo json_encode(array_column($data['danhSachDeTai'], 'Tendetai')); ?>;
        const counts = <?php echo json_encode(array_column($data['danhSachDeTai'], 'SoNhomDaCham')); ?>;

        // Tạo datasets cho biểu đồ
        const datasets  = topics.map((topic, index) => ({
            label: topic, // Nhãn tương ứng với từng đề tài
            data: topics.map((_, i) => (i === index ? counts[index] : 0)), // Chỉ hiển thị giá trị tại đúng vị trí đề tài
            backgroundColor: colors[index % colors.length], // Màu sắc tương ứng
        borderColor: colors[index % colors.length], // Màu viền
        borderWidth: 1
        }));

        // Dữ liệu cho biểu đồ
        const data = {
            labels: topics, // Tên đề tài (trục X)
            datasets: datasets // Tất cả các cột hiển thị trong một dataset
        };

        // Tạo biểu đồ với Chart.js
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',  // Loại biểu đồ là cột
            data: data,  // Dữ liệu
            options: {
                responsive: true,
                scales: {
                    y: {
                        min: 0,  // Thiết lập giá trị tối thiểu cho trục Y là 0
                        max: 10, // Thiết lập giá trị tối đa cho trục Y
                        ticks: {
                            stepSize: 1, // Khoảng cách giữa các giá trị là 1
                            callback: function(value) {
                                if (Number.isFinite(value)) {
                                    return value.toFixed(1); // Hiển thị giá trị với một chữ số thập phân
                                }
                            }
                        },
                        title: {
                            display: true,
                            text: 'Số Nhóm'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Tên Đề Tài'
                        }
                    }
                },
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            font: {
                                size: 12 // Điều chỉnh kích thước chữ cho legend
                            }
                        }
                    }
                }
            }
        });
    </script>
<?php endif; ?>



