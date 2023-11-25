<?php
// MySQL 서버 연결 설정
$servername = "localhost";
$username = "korea";
$password = "1234";
$dbname = "test";

// 데이터베이스에 연결
$conn = new mysqli($servername, $username, $password, $dbname);

// 연결 확인
if ($conn->connect_error) {
    die("데이터베이스 연결 실패: " . $conn->connect_error);
}

// POST 요청에서 날짜와 메모 내용 가져오기
$date = $_POST['deleteDate'];

// 날짜를 기반으로 메모가 이미 존재하는지 확인
$sql = "SELECT * FROM memo WHERE date = '$date'"; // 테이블 이름 = memo

$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $deleteSql = "DELETE FROM memo WHERE date = '$date'";
    if ($conn->query($deleteSql) === TRUE) {
        echo "메모 삭제 성공";
    } else {
        echo "메모 삭제 실패: " . $conn->error;
    }
} else {
    echo "선택한 날짜에 메모가 존재하지 않습니다.";
}

// 데이터베이스 연결 닫기
$conn->close();
?>