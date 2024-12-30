<?php
class Thongtingv_m extends connectDB
{
    // Cập nhật thông tin admin
    function Thongtingv_upd($ID_Giangvien, $Hoten, $Ngaysinh, $Diachi, $Email, $Sdt, $Gioitinh)
    {
        // Sử dụng Prepared Statements để bảo vệ khỏi SQL Injection
        $sql = "UPDATE giangvien SET Hoten = ?, Ngaysinh = ?, Diachi = ?, Email = ?, Sdt = ?, Gioitinh = ? WHERE ID_Giangvien = ?";

        // Chuẩn bị câu lệnh SQL
        $stmt = $this->con->prepare($sql);

        // Kiểm tra nếu câu lệnh chuẩn bị không thành công
        if ($stmt === false) {
            // Trả về false nếu có lỗi
            return false;
        }

        // Liên kết tham số với câu lệnh SQL
        // "sssssss" chỉ ra rằng tất cả tham số đều là chuỗi (s), nhưng Ngaysinh có thể là ngày tháng, bạn cần xác nhận kiểu ngày tháng hoặc để nó là string nếu nó được định dạng chuỗi
        $stmt->bind_param("sssssss", $Hoten, $Ngaysinh, $Diachi, $Email, $Sdt, $Gioitinh, $ID_Giangvien);

        // Thực thi câu lệnh SQL
        $result = $stmt->execute();

        // Kiểm tra kết quả của câu lệnh SQL
        if ($result) {
            return true;  // Trả về true nếu cập nhật thành công
        } else {
            return false;  // Trả về false nếu có lỗi
        }
    }
    
}