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
$studentNumber = $_POST['studentNumber'];
$studentNumber = (int)$studentNumber;

// 날짜를 기반으로 메모가 이미 존재하는지 확인
$sql = "SELECT * FROM memo WHERE date = '$date'"; // 테이블 이름 = memo
$result = $conn->query($sql);


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

if ($result->num_rows < 1) {
    echo "메모 정보가 없습니다";
} else {
    $deleteSql = "DELETE FROM memo WHERE date = '$date' AND studentNumber = $studentNumber";
    if ($conn->query($deleteSql)) {
        echo "메모 삭제 성공";
    } else {
        echo '메모 삭제 실패';
    }
}
// 데이터베이스 연결 닫기
$conn->close();
?>