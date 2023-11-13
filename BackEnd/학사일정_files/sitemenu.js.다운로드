$(document).ready(function() {
	$(".hidden").each(function() {
		var fnctValue = $(this).text().trim();
		var iValue = fnctValue.indexOf("fnctId=sitemenu");
		if(iValue != -1){
			var fnctArr = fnctValue.split(',');
			var menuUIviewType = fnctArr[1].substring(fnctArr[1].indexOf("=")+1,fnctArr[1].length);
			//console.log("menuUIviewType : " + menuUIviewType);
			$("#menuUI"+menuUIviewType).find("li").children("div").addClass("_childDiv");
			$("._childDiv").parent("li").addClass("_useChildDiv");
		}
	});
});