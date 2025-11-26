<?php
// admin.php
require 'flowers.php'; 

$page_title = 'Trang Quản Trị - Quản lý Danh sách Hoa';
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?></title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            margin: 20px; 
            background-color: #f4f7f6;
            color: #333;
        }
        h1 {
            color: #2c3e50;
            text-align: center;
            margin-bottom: 30px;
        }
        .add-new { 
            margin-bottom: 20px; 
            display: inline-block; 
            background-color: #28a745; 
            color: white; 
            padding: 10px 15px; 
            border-radius: 5px; 
            text-decoration: none; 
            font-weight: bold;
            transition: background-color 0.3s ease;
        }
        .add-new:hover {
            background-color: #218838;
        }
        table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-top: 20px; 
            background-color: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            border-radius: 8px;
            overflow: hidden; /* Đảm bảo góc bo tròn hoạt động */
        }
        th, td { 
            border: 1px solid #e0e0e0; 
            padding: 12px 15px; 
            text-align: left; 
            vertical-align: middle; /* Căn giữa nội dung ô theo chiều dọc */
        }
        th { 
            background-color: #f8f8f8; 
            font-weight: bold;
            color: #555;
            text-transform: uppercase;
            font-size: 14px;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        .flower-image {
            width: 80px; /* Kích thước ảnh nhỏ trong bảng */
            height: 80px;
            object-fit: cover; /* Đảm bảo ảnh không bị méo */
            border-radius: 4px;
            vertical-align: middle;
        }
        .actions {
            white-space: nowrap; /* Đảm bảo các nút không bị xuống dòng */
            text-align: center; /* Căn giữa các nút */
        }
        .actions a { 
            margin: 0 4px; 
            text-decoration: none; 
            padding: 6px 10px; 
            border-radius: 4px; 
            font-size: 13px;
            transition: background-color 0.3s ease, color 0.3s ease;
            display: inline-block; /* Để có thể thiết lập padding và margin dễ hơn */
        }
        .actions .view { 
            background-color: #007bff; 
            color: white; 
        }
        .actions .view:hover { background-color: #0056b3; }
        .actions .edit { 
            background-color: #ffc107; 
            color: #333; 
        }
        .actions .edit:hover { background-color: #e0a800; }
        .actions .delete { 
            background-color: #dc3545; 
            color: white; 
        }
        .actions .delete:hover { background-color: #bd2130; }

        .back-link {
            display: block;
            margin-top: 30px;
            text-align: center;
            font-size: 16px;
        }
        .back-link a {
            color: #007bff;
            text-decoration: none;
        }
        .back-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h1><?php echo $page_title; ?></h1>
    
    <a href="?action=create" class="add-new">➕ Thêm Hoa Mới</a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên Hoa</th>
                <th style="width: 30%;">Mô Tả</th> <th>Hình Ảnh</th> <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($flowers as $flower): ?>
            <tr>
                <td><?php echo $flower['id']; ?></td>
                <td><?php echo $flower['ten_hoa']; ?></td>
                <td><?php echo $flower['mo_ta']; ?></td>
                <td>
                    <img src="<?php echo $flower['hinh_anh']; ?>" alt="<?php echo $flower['ten_hoa']; ?>" class="flower-image">
                </td>
                <td class="actions">
                    <a href="?action=read&id=<?php echo $flower['id']; ?>" class="view">Xem</a>
                    <a href="?action=update&id=<?php echo $flower['id']; ?>" class="edit">Sửa</a>
                    <a 
                        href="?action=delete&id=<?php echo $flower['id']; ?>" 
                        class="delete" 
                        onclick="return confirm('Bạn có chắc chắn muốn xóa hoa <?php echo $flower['ten_hoa']; ?>?');"
                    >Xóa</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    
    <p class="back-link"><a href="user.php">Quay lại Trang Khách</a></p>
</body>
</html>