<?php

// 학번을 세팅 할때 확인한다
// 학번을 확인, 있으면 return해서 로컬스토리지 생성, ( 이 파일은 없을때 생성)
//

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

// POST 요청에서 학생 번호, 날짜, 메모 내용 가져오기
$studentNumber = $_POST['studentNumber'];
$tablename = "student_" . $studentNumber;

// 테이블이 이미 존재하는지 확인
$tableExistsQuery = "SHOW TABLES LIKE '$tablename'";
$tableExistsResult = $conn->query($tableExistsQuery);
if ($tableExistsResult->num_rows <= 0) {
    $createTableQuery = "CREATE TABLE $tablename (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        date DATE,
        memo TEXT
    )";
    if ($conn->query($createTableQuery) === TRUE) {
        echo '<script type="text/javascript">
            alert("학번정보가 저장되었습니다.")
            //header("Location: https://example.com/myOtherPage.php"); 서버 url로 바꿀것
            exit();
        </script>';
    }
} else{
    echo null;
}
// 데이터베이스 연결 닫기
$conn->close();

