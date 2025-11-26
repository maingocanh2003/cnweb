<?php
// index.php
require 'flowers.php'; 

$page_title = 'Danh sách các loài hoa tuyệt đẹp thích hợp trồng để khoe hương sắc dịp xuân hè';
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?></title>
    <style>
        body { 
            font-family: 'Times New Roman', Times, serif; /* Phông chữ thường dùng trong văn bản */
            line-height: 1.6; 
            margin: 0 auto; 
            padding: 20px;
            max-width: 800px; /* Giới hạn chiều rộng trang như một bài viết */
        }
        h1 {
            font-size: 24px;
            color: #333;
            margin-bottom: 30px;
            text-align: center;
        }
        .flower-item { 
            margin-bottom: 40px; 
        }
        .flower-item img { 
            width: 100%; 
            height: auto; 
            display: block; /* Loại bỏ khoảng trắng thừa dưới ảnh */
            margin-bottom: 15px;
            border-radius: 4px;
        }
        .flower-item h3 { 
            font-size: 18px;
            font-weight: bold;
            color: #000; /* Màu đen như tiêu đề bài viết */
            margin-top: 0;
            margin-bottom: 10px;
            /* Thêm số thứ tự như trong bài viết mẫu */
            counter-increment: flower-counter;
        }
        .flower-item h3::before {
            content: counter(flower-counter) ". "; 
        }
        p {
            margin-bottom: 15px;
            text-align: justify; /* Căn đều hai bên như bài viết */
        }
    </style>
</head>
<body>
    <h1><?php echo $page_title; ?></h1>

    <div class="list-container">
        <?php 
        // Đảm bảo CSS đếm từ 1
        echo '<style> .list-container { counter-reset: flower-counter; } </style>'; 
        ?>
        <?php foreach ($flowers as $flower): ?>
            <div class="flower-item">
                
                <img src="<?php echo $flower['hinh_anh']; ?>" alt="<?php echo $flower['ten_hoa']; ?>">
                
                <h3><?php echo $flower['ten_hoa']; ?></h3>
                
                <p><?php echo $flower['mo_ta']; ?></p>
                </div>
        <?php endforeach; ?>
    </div>
    
    <hr>
    <p style="text-align: center;"><a href="admin.php">Truy cập Trang Quản trị</a></p>
</body>
</html>