<?php
// MySQL 서버 연결 설정
$servername = "localhost";
$username = "사용자이름";
$password = "비밀번호";
$dbname = "데이터베이스이름";

// 데이터베이스에 연결
$conn = new mysqli($servername, $username, $password, $dbname);

// 연결 확인
if ($conn->connect_error) {
    die("데이터베이스 연결 실패: " . $conn->connect_error);
}

// POST 요청에서 날짜와 메모 내용 가져오기
$date = $_POST['seletedDate']; // json_decode(file_get_contents("php://input"))->{"date"};
if($date == null){
    echo null;
}
// 날짜를 기반으로 메모가 이미 존재하는지 확인
$sql = "SELECT * FROM todo_list WHERE date = '$date'"; // table name = todo_list

$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // 메모가 이미 존재하면 업데이트
    $deleteSql = "DELETE FROM todo_list  WHERE date = '$date'";
    if ($conn->query($deleteSql) === TRUE) {
        echo "메모 업데이트 성공";
    } else {
        echo "메모 업데이트 실패: " . $conn->error;
    }
}


// 데이터베이스 연결 닫기
$conn->close();
?>