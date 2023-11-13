$(document).ready(function() {
	$(".PZwindow").parent("._obj").css("overflow","visible");
});
$(function() {
	var id = "";
	var cookieNm = "";
	
	//레이어 팝업
	if( $( "div.PZwindow._LYR" ).size() > 0 ) {
		//보지않음 처리된 레이어팝업 :  fadeOut
		$( "div.PZwindow._LYR" ).each( function() {
			id = $( this ).attr( "id" ).replace( "PZwindow", "" );
			cookieNm = "popup" + id;
			if( getCookie( cookieNm ) != "done" ) {
				$( '#PZwindow' + id ).fadeIn();
			}
		});
		
		//레이어 팝업창 draggable
		$( "div.PZwindow._LYR" ).draggable(); 
	}
	
	//윈도우팝업
	if( $( "div.PZwindow._WINDOW" ).size() > 0 ) {
		//보지않음 처리되지 않은 윈도우팝업 : window.open
		var mgWidth = "";
		var mgHeight = "";
		var lcTop = "";
		var lcLeft = "";
		var artclSj = "";
		var url = "";
		var windowOption = "";
		$( "div.PZwindow._WINDOW" ).each(function() {
			id = $( this ).attr( "id" ).replace( "PZwindow", "" );
			cookieNm = $( this ).find( "input[id='cookieNm" + id + "']" ).val();
			
			if( getCookie( cookieNm ) != "done" ) {
				mgWidth = $( this ).find( "input[id='mgWidth" + id + "']" ).val();
				mgHeight = parseInt( $( this ).find( "input[id='mgHeight" + id + "']" ).val() ) + 20;
				lcTop = $( this ).find( "input[id='lcTop" + id + "']" ).val();
				lcLeft = $( this ).find( "input[id='lcLeft" + id + "']" ).val();
				artclSj = $( this ).find( "input[id='artclSj" + id + "']" ).val();
				url = kurl( "/popup/" + $( "#popupSiteId" ).val() + "/" + id + "/viewWindowPopup" );
				windowOption = "width=" + mgWidth + "px, height=" + mgHeight + "px, left=" + lcLeft + "px, top=" + lcTop + "px";			
				
				window.open( url, artclSj, windowOption );
			}
		});
	}
});

function setCookie( name, value, expiredays ) {
	var todayDate = new Date();
	todayDate.setDate( todayDate.getDate() + expiredays );
	document.cookie = name + "=" + escape( value ) + "; path=/; expires=" + todayDate.toGMTString() + ";"
}

function PZwindowClose(popupArtclSeq, obj) {
	if ( $( obj ).attr( "checked" ) ) {
		if( $( obj ).val() == "day" ) {									
			setCookie( "popup" + popupArtclSeq, "done" , 1 ); 
		} else if( $( obj ).val() == "week" ) {									
			setCookie( "popup" + popupArtclSeq, "done" , 7 ); 
		} else if( $( obj ).val() == "none" ) {									
			setCookie( "popup" + popupArtclSeq, "done" , 365 ); 
		}
	}
	
	$( '#PZwindow' + popupArtclSeq ).hide();
}

function closeWin(popupArtclSeq){
	$( '#PZwindow' + popupArtclSeq ).fadeOut();
}

function getCookie(name){
	var nameOfCookie = name + "=";
	var x = 0;
	while ( x != document.cookie.length ){
		var y = ( x + nameOfCookie.length );
		if ( document.cookie.substring( x, y ) == nameOfCookie ) {
			if ( ( endOfCookie=document.cookie.indexOf( ";", y ) ) == -1 )
				endOfCookie = document.cookie.length;
				return unescape( document.cookie.substring( y, endOfCookie ) );
			}
			x = document.cookie.indexOf( " ", x ) + 1;
			if ( x == 0 )
				break;
	}
	
	return "";
}