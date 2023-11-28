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

// POST 요청에서 학생 번호, 날짜, 메모 내용 가져오기
$studentNumber = $_POST['studentNumber'];
$studentNumber = (int)$studentNumber;
$pw = $_POST['password'];


$searchUserQuery = "select * from user where (studentNumber = $studentNumber)";
// 테이블이 이미 존재하는지 확인
$result = mysqli_query($conn, $searchUserQuery );
if ($result) {
    $row = $result->fetch_assoc();
    if (password_verify($pw, $row['password'])) {
        echo true; // 로그인 성공
    } else {
//        echo "
//        <script>
//        alert('비밀번호가 틀립니다');
//           </script>"; // 비밀번호 불일치
        echo false;
    }
}
else{
//    echo "<script>
//        alert('유저 정보가 존재하지 않습니다');
//           </script>";
    echo false;
}
// 데이터베이스 연결 닫기
$conn->close();

?>