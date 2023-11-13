$(document).ready(function(){
	//방문로그
	visitLogReigst();
});	
		
/*
* 방문페이지 카운트 증가
*/
function visitLogReigst(){
	var curUrl = location.href;
	var siteId = $("#siteIdVal").val();
	if(siteId != null && curUrl.indexOf("/index") != -1){
		//index page만 카운트 증가 : 정책이 정해진경우 변경해야함.
		$.ajax({
			url : kurl( "/visitLog/"+siteId+"/regist" ),
			type : "post",
			data : {
				"url" : curUrl
			},
			cache:false,
			async:true,
			success:function(e){
			},
			error:function(){
			}
		});
	}
}