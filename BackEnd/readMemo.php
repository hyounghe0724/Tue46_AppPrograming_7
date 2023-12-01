<?php
// MySQL 서버 연결 설정
$servername = "localhost";
$username = "korea";
$password = "1234";
$dbname = "test";
// 데이터베이스에 연결
$conn = new mysqli($servername, $username, $password, $dbname);

$date = $_POST['date'];
$studentNumber = $_POST['studentNumber'];
$studentNumber = (int)$studentNumber;

$stnSql = "SELECT * FROM user WHERE studentNumber = $studentNumber";
$stnResult = $conn->query($stnSql);

$row = $stnResult->fetch_assoc();
$studentNumber = $row['studentNumber']; // 학번 정보가 없으면 response해줌
if(!$studentNumber) {
    echo "<script>
        alert('학번 정보가 없습니다');
        location.href = 'test_add_CSS.html';
    </script>";
}

if ($conn->connect_error) {
    die("데이터베이스 연결 실패: " . $conn->connect_error);
}

$sql = "SELECT * FROM memo WHERE date = '$date' AND studentNumber = $studentNumber";
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
}else{
    $memo = "";
}

// 결과 배열을 JSON 형식으로 변환
$json = json_encode($memo);

// JSON 출력
echo $json;

// 데이터베이스 연결 닫기
$conn->close();
?>