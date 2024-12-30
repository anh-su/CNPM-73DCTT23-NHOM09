<?php
class Thongtinad_m extends connectDB
{
    // Cập nhật thông tin admin
    public function Thongtinad_upd($ID_Admin, $Hoten, $Ngaysinh, $Diachi, $Email, $Sdt, $Gioitinh)
    {
        $sql = "UPDATE admin SET Hoten = ?, Ngaysinh = ?, Diachi = ?, Email = ?, Sdt = ?, Gioitinh = ? WHERE ID_Admin = ?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param('sssssss', $Hoten, $Ngaysinh, $Diachi, $Email, $Sdt, $Gioitinh, $ID_Admin);
        return $stmt->execute();
    }
}
?>
