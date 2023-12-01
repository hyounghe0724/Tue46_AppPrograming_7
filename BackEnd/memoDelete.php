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
    echo "<script>
        alert('날짜 정보가 없습니다');
        location.href = 'test_add_CSS.html';
        </script>";
} else if ($result->num_rows > 0) {
    $deleteSql = "DELETE FROM memo WHERE date = '$date' AND studentNumber = $studentNumber";
    if ($conn->query($deleteSql) === TRUE) {
        echo "<script>
            alert('메모 삭제 성공');
            location.href = 'test_add_CSS.html';
        </script>";
    } else {
        echo "<script>
            alert('메모 삭제 실패');
            location.href = 'test_add_CSS.html';
        </script>";
    }
} else {
    echo "선택한 날짜에 메모가 존재하지 않습니다.";
}
// 데이터베이스 연결 닫기
$conn->close();
?>