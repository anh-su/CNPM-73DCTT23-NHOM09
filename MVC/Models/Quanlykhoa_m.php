<?php

class Quanlykhoa_m extends connectDB
{
      ///////////////ID_Admin///////////////////
      

 // Kiểm tra trùng lặp ID tài khoản
 function checktrungID_Khoa($ID_Khoa){
    // Kiểm tra xem $id có rỗng không
  

    $sql = "SELECT * FROM khoa WHERE ID_Khoa ='$ID_Khoa' " ;
    $dl = mysqli_query($this->con, $sql);

    return mysqli_num_rows($dl) > 0 ? "duplicate" : "not_duplicate";
}

// Thêm tài khoản Sinh viên vào cơ sở dữ liệu
function Quanlykhoa_ins($ID_Khoa, $Tenkhoa, $Email, $Sdt)
{
   

    // Gán vai trò luôn là 0 và ID_Giangvien, ID_Admin là NULL
  
    // Câu lệnh SQL thêm tài khoản sinh viên
    $sql = "INSERT INTO khoa (ID_Khoa, Tenkhoa, Email, Sdt) 
            VALUES ('$ID_Khoa', '$Tenkhoa', '$Email', '$Sdt')";

    // Debugging SQL query (in ra câu lệnh SQL để kiểm tra)


    // Thực hiện truy vấn và trả kết quả
    return mysqli_query($this->con, $sql) ? "success" : "fail: " . mysqli_error($this->con);
}


function Quanlykhoa_del($ID_Khoa)
{
    $sql = "DELETE FROM khoa WHERE ID_Khoa ='$ID_Khoa'";
    return mysqli_query($this->con, $sql);
}

//tìm kiếm theo id của các tài khoản

function Quanlykhoa_find($keyword)
{
    // SQL cơ bản
    $sql = "SELECT * FROM khoa WHERE 1=1";

    // Nếu có từ khóa tìm kiếm
    if (!empty($keyword)) {
        $keyword = $this->con->real_escape_string($keyword); // Xử lý để tránh SQL Injection
        $sql .= " AND (ID_Khoa LIKE '%$keyword%' 
                    OR Tenkhoa LIKE '%$keyword%' 
                    OR Email LIKE '%$keyword%' 
                    OR Sdt LIKE '%$keyword%')";
    }

    // Thực thi truy vấn
    $result = mysqli_query($this->con, $sql);

    if (!$result) {
        echo "Lỗi truy vấn: " . mysqli_error($this->con);
        return [];
    }

    // Trả về danh sách kết quả
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function Quanlykhoa_upd($ID_Khoa, $Tenkhoa, $Email, $Sdt)
{
// Sử dụng Prepared Statements để bảo vệ khỏi SQL Injection
$sql = "UPDATE khoa SET Tenkhoa = ?, Email = ? , Sdt = ? WHERE ID_Khoa = ?";

// Chuẩn bị câu lệnh SQL
$stmt = $this->con->prepare($sql);

// Liên kết tham số với câu lệnh SQL
$stmt->bind_param("ssss", $Tenkhoa, $Email, $Sdt,$ID_Khoa);

// Thực thi câu lệnh SQL
return $stmt->execute();
}





//lấy danh sách của các tài khoản

function danhsachkhoa()
{
    $sql = "SELECT * FROM khoa ";
    $result = $this->con->query($sql);

    if (!$result) {
        echo "Lỗi truy vấn: " . $this->con->error;
        return [];
    }

    $KHOAList = $result->fetch_all(MYSQLI_ASSOC);
    return $KHOAList;
}

}
?>

