<?php
// 1. Tên tệp CSV
$csv_file = '65HTTT_Danh_sach_diem_danh.csv'; 

// 2. Khởi tạo mảng để lưu dữ liệu
$data = [];
$headers = [];
$error_message = '';

// 3. Xử lý logic đọc file
if (file_exists($csv_file)) {
    // Mở tệp tin ở chế độ chỉ đọc ('r')
    if (($handle = fopen($csv_file, 'r')) !== FALSE) {
        // Lấy hàng đầu tiên làm tiêu đề (header)
        if (($headers = fgetcsv($handle, 1000, ',')) !== FALSE) {
            // Lặp qua các hàng còn lại để lấy dữ liệu
            while (($row = fgetcsv($handle, 1000, ',')) !== FALSE) {
                // Đảm bảo số lượng cột của dữ liệu khớp với tiêu đề
                if (count($row) == count($headers)) {
                    $data[] = $row;
                }
            }
        } else {
            $error_message = "Lỗi: Không thể đọc dòng tiêu đề của tệp CSV.";
        }
        
        // Đóng tệp
        fclose($handle);
    } else {
        $error_message = "Lỗi: Không thể mở tệp tin để đọc. Vui lòng kiểm tra quyền truy cập.";
    }
} else {
    $error_message = "❌ Lỗi: Không tìm thấy tệp tin **" . htmlspecialchars($csv_file) . "**.";
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Hiển Thị Dữ Liệu CSV</title>
    
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background-color: #f4f7f6; }
        .container { max-width: 1200px; margin: 0 auto; background-color: #ffffff; padding: 20px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        h1 { color: #34495e; text-align: center; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background-color: #3498db; color: white; text-transform: uppercase; }
        tr:nth-child(even) { background-color: #f2f2f2; }
        .error { color: red; font-weight: bold; text-align: center; padding: 10px; border: 1px solid red; }
    </style>
</head>
<body>

    <div class="container">
        <h1> Danh Sách Sinh Viên </h1>
        
        <?php
        if ($error_message) {
            // Hiển thị thông báo lỗi nếu có
            echo '<p class="error">' . $error_message . '</p>';
        } else if (empty($data)) {
            // Trường hợp không có dữ liệu
            echo '<p style="text-align: center;">Tệp tin rỗng hoặc không có dữ liệu để hiển thị.</p>';
        } else {
            // 4. Bắt đầu hiển thị bảng HTML
            echo '<table>';
            
            // Hiển thị TIÊU ĐỀ BẢNG
            echo '<thead><tr>';
            foreach ($headers as $header) {
                echo '<th>' . htmlspecialchars($header) . '</th>';
            }
            echo '</tr></thead>';
            
            // Hiển thị DỮ LIỆU
            echo '<tbody>';
            foreach ($data as $row) {
                echo '<tr>';
                foreach ($row as $cell) {
                    echo '<td>' . htmlspecialchars($cell) . '</td>';
                }
                echo '</tr>';
            }
            echo '</tbody>';
            
            echo '</table>';
        }
        ?>
    </div>

</body>
</html>