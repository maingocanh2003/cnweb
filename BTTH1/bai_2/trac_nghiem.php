<?php
// Tên tệp tin
$file_name = 'Quiz.txt';
$questions = [];

// Xử lý logic đọc file
if (file_exists($file_name)) {
    $content = file_get_contents($file_name);
    // Tách nội dung thành các khối câu hỏi dựa trên các dòng trống
    // Biểu thức chính quy: /\n\s*\n/ tìm kiếm 2 ký tự xuống dòng liên tiếp (có thể có khoảng trắng ở giữa)
    $questions = preg_split('/\n\s*\n/', trim($content));
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Bài Trắc Nghiệm Android</title>
</head>
<body>

    <h1>Bài Trắc Nghiệm Android</h1>
    <hr>
    
    <?php
    if (empty($questions) || empty(trim($content))) {
        // Thông báo lỗi nếu không tìm thấy tệp hoặc tệp rỗng
        echo '<p style="color: red;">❌ Lỗi: Không tìm thấy tệp tin **' . htmlspecialchars($file_name) . '** hoặc nội dung tệp trống.</p>';
    } else {
        // Duyệt qua từng câu hỏi
        foreach ($questions as $index => $question_block_raw) {
            $question_block = trim($question_block_raw);

            if (empty($question_block)) {
                continue; // Bỏ qua nếu khối rỗng
            }
            
            $lines = explode("\n", $question_block);
            $answer_line = null;
            $question_text = '';

            // Tách nội dung và đáp án
            foreach ($lines as $line) {
                $line = trim($line);
                // Kiểm tra dòng đáp án bằng regex (không phân biệt hoa thường)
                if (preg_match('/^ANSWER:\s*/i', $line)) {
                    $answer_line = $line;
                } else {
                    $question_text .= $line . "\n";
                }
            }
            
            // Trích xuất đáp án
            $correct_answer = 'Chưa xác định';
            if ($answer_line) {
                $answer_parts = explode(':', $answer_line);
                $correct_answer = trim(end($answer_parts));
            }
            
            $question_number = $index + 1;

            // Bắt đầu hiển thị HTML cho từng câu hỏi
            echo '<div style="margin-bottom: 20px; border: 1px solid #ccc; padding: 15px;">';
            
            // Hiển thị số câu hỏi
            echo '<h2>Câu ' . $question_number . '</h2>';
            
            // Hiển thị nội dung câu hỏi và lựa chọn
            // Sử dụng <pre> hoặc nl2br() để giữ định dạng xuống dòng của các lựa chọn
            echo '<pre style="white-space: pre-wrap; font-size: 1em; padding: 10px; background-color: #f4f4f4;">';
            echo htmlspecialchars(trim($question_text)); 
            echo '</pre>';
            
            // Hiển thị đáp án
            echo '<p style="color: blue; font-weight: bold;"> Đáp án: ' . htmlspecialchars($correct_answer) . '</p>';
            
            echo '</div>'; // Kết thúc khối câu hỏi
        }
    }
    ?>

</body>
</html>