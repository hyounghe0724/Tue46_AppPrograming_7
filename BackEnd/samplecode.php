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
$date = $_POST['date']; // json_decode(file_get_contents("php://input"))->{"date"};
$memo = $_POST['memo']; // json_decode(file_get_contents("php://input"))->{"memo"};

// 날짜를 기반으로 메모가 이미 존재하는지 확인
$sql = "SELECT * FROM todo_list WHERE date = '$date'"; // table name = todo_list
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // 메모가 이미 존재하면 업데이트
    $sql = "UPDATE todo_list SET memo = '$memo' WHERE date = '$date'";
    if ($conn->query($sql) === TRUE) {
        echo "메모 업데이트 성공";
    } else {
        echo "메모 업데이트 실패: " . $conn->error;
    }
} else {
    // 메모가 존재하지 않으면 새로 만듭니다.
    $sql = "INSERT INTO todo_list (date, memo) VALUES ('$date', '$memo')";
    if ($conn->query($sql) === TRUE) {
        echo "새로운 메모 생성 성공";
    } else {
        echo "메모 생성 실패: " . $conn->error;
    }
}

// 데이터베이스 연결 닫기
$conn->close();
?>