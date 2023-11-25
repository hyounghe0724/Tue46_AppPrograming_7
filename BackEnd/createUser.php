<?php

// 데이터베이스 연결 정보
$servername = "localhost";
$username = "korea";
$password = "1234";
$dbname = "test";

// POST로 전송된 데이터 받기
$id = $_POST['id'];
$pw = $_POST['pw'];

// 데이터베이스 연결
$conn = new mysqli($servername, $username, $password, $dbname);

// 연결 확인
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$checkUserQuery = "SELECT * FROM user WHERE studentNumber = '$id'";
$checkUserResult = $conn->query($checkUserQuery);

if ($checkUserResult->num_rows > 0) {
    echo "이미 회원 정보가 있습니다.";
} else {
    // 비밀번호 해싱 (보안을 위해 사용자 비밀번호를 해싱하여 저장)
    $hashed_pw = password_hash($pw, PASSWORD_DEFAULT);

    // SQL 쿼리 작성 및 실행
    $sql = "INSERT INTO user (studentNumber, password) VALUES ('$id', '$hashed_pw')";

    if ($conn->query($sql) === TRUE) {
        echo "회원가입이 완료되었습니다.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// 데이터베이스 연결 종료
$conn->close();
?>