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
$password = $_POST['password'];
$tablename = "student_" . $studentNumber;

// 테이블이 이미 존재하는지 확인
$tableExistsQuery = "SHOW TABLES LIKE '$tablename'";
// usertable만들어여함 $UsertableExistsQuery = "SELECT * FROM USER WHERE studentNumber = $studentNumber";
// usertable insert value쿼리도 써야함 아래에
// usertable에서 유저를 찾고 있으면 return 없으면생성, user table에 학번과 password를 저장하고, table의 학번으로 table생성
// USER가 많아질경우 한개의 TABLE에서 관리가 어려우니 파티셔닝 구현, 하지만 안할거
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

