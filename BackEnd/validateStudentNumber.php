<?php 
// 학번을 세팅 할때 확인한다
// 학번을 확인, 있으면 return해서 로컬스토리지 생성,

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
$studentNumber = (int)$studentNumber;
$password = $_POST['password'];
$hashed_pw = password_hash($password, PASSWORD_DEFAULT);

$searchUserQuery = "select * from user where (studentNumber = $studentNumber) AND (password = '$hashed_pw')";
$result = mysqli_query($conn, $searchUserQuery );
if ($result) {
    echo true;
}
else{
    echo false;
}
// 데이터베이스 연결 닫기
$conn->close();

?>