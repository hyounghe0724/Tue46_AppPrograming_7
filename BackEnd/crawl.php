<?php
require_once 'simple_html_dom.php';
// URL에서 가져오기
$html = file_get_html ( '학사일정.html');

$ret = $html->find( 'div[id="timeTableList"] ul' );
$string = implode(', ', $ret);
$JSON = json_encode($string);
echo $JSON
?>