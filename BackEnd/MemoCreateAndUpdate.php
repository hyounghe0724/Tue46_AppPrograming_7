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
$studentNumber = $_POST['studentNumber'];
$studentNumber = (int)$studentNumber;
$memo = $_POST['memo'];
$date = $_POST['date'];
$convertedDate = str_replace("-", "", $date);
$password = $_POST['password'];
$date = date("y-m-d", strtotime($convertedDate));
// 날짜를 기반으로 메모가 이미 존재하는지 확인
$sql = "SELECT * FROM memo WHERE date = '$date'"; // table name = memo
$result = $conn->query($sql);

$stnSql = "SELECT * FROM user WHERE studentNumber = $studentNumber";
$stnResult = $conn->query($stnSql);

$row = $stnResult->fetch_assoc();
$studentNumber = $row['studentNumber']; // 학번 정보가 없으면 response해줌
if(!$studentNumber){
    echo "<script>
        alert('학번 정보가 없습니다');
        location.href = 'test_add_CSS.html';
    </script>";
}
if ($result->num_rows > 0) {
    // 메모가 이미 존재하면 업데이트
    $sql = "UPDATE memo SET memo = '$memo' WHERE date = '$date' AND studentNumber = $studentNumber";
    if ($conn->query($sql) === TRUE) {
        echo "<script>
        alert('메모 업데이트 성공');
        location.href = 'test_add_CSS.html';
    </script>";
    } else {
        echo "<script>
        alert('메모 업데이트 실패');
        location.href = 'test_add_CSS.html';
    </script>";;
    }
} else {

    // 메모가 존재하지 않으면 새로 만듭니다
    $sql = "INSERT INTO memo (studentNumber, date, memo)
        VALUES ($studentNumber, '$date','$memo')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
        alert('새로운 메모가 생성되었습니다');
        location.href = 'test_add_CSS.html';
    </script>";
    } else {
        echo "<script>
        alert('메모 생성을 실패 하였습니다.');
        location.href = 'test_add_CSS.html';
    </script>";
    }
}
// echo로 작성된 메모 return, 또는 memo를 객체로 가져오는 php파일 작성
// 데이터베이스 연결 닫기
$conn->close();
?>