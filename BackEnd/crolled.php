<?php

// URL 설정
$url = "https://www.sungkyul.ac.kr/skukr/313/subview.do#this";

// 웹 페이지 내용 가져오기
$html = file_get_contents($url);

// HTML 파싱
$dom = new DOMDocument();
$dom->loadHTML($html);

// div 요소의 id가 "timeTableList"인 요소 선택
$divElement = $dom->getElementById("timeTableList");

// ul 자식들인 li 요소들 선택
$liElements = $divElement->getElementsByTagName("ul")[0]->getElementsByTagName("li");

// 크롤링한 데이터를 저장할 배열
$data = array();

// li 요소들을 순회하며 텍스트를 추출하여 배열에 저장
foreach ($liElements as $li) {
    $data[] = $li->textContent;
}

$JSON = json_encode($data);

echo $JSON;
?>