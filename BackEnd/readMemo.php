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

// POST 요청에서 날짜 가져오기
$date = $_POST['date'];

// 날짜를 기반으로 메모 조회
$sql = "SELECT * FROM memo WHERE date = '$date'";
$result = $conn->query($sql);

// 결과를 담을 배열 초기화
$memo = "";

// 결과 확인
if ($result->num_rows > 0) {
    // 모든 레코드를 반복하여 가져옴
    while ($row = $result->fetch_assoc()) {
        // 각 레코드의 필드를 추출하여 배열에 추가
        $memo = $row['memo'];
    }
}

// 결과 배열을 JSON 형식으로 변환
$json = json_encode($memo);

// JSON 출력
echo $json;

// 데이터베이스 연결 닫기
$conn->close();
?>