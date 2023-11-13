function jf_addMenu() {
    var pathMenuSeqs = $("#pathMenuSeqs").val().split(",");
    var menu = "";

    for (var i = 1; i < pathMenuSeqs.length; i++) {
        if (i == pathMenuSeqs.length - 1) {
            menu += "<strong>" + $('.wrap-contents .subject h2').text() + "</strong>";
        } else {
            menu += "<span>" + $('.wrap-contents .subject h2').text() + "</span>";
        }
    }

    favoriteSetCookie(menu);
    $('.btnFavorite').focus();	// ie11 때문에 포커스를 강제로 이동
}

function favoriteSetCookie(navi) {
    var currentUrl = location.href;
    var ret = favoriteGetCookie(currentUrl);

    if (ret) {
        alert('이미 즐겨찾는 메뉴로 등록되어 있습니다.');
        favoriteGetCookieList();
    } else {
        var menuCnt = favoriteGetMenuCookieNumber();
        if (menuCnt > 5) {
            alert('더 이상 등록 할수 없습니다.');
        } else {
            var menu = 'menu' + menuCnt;
            var name = navi + '@';
            var todayDate = new Date();
            todayDate.setDate(todayDate.getDate() + 1);
            document.cookie = escape(menu) + "=" + escape(name + currentUrl) + "; path=/; expires=" + todayDate.toGMTString() + ";";
            favoriteGetCookieList();
        }
    }
}

function favoriteGetMenuCookieNumber() {
    var allCookies = unescape(document.cookie);
    var cnt = 1;
    var name = 'menu' + cnt;
    var strCnt = name.length;

    for (var i = 1; i < 6; i++) {
        var pos = allCookies.indexOf(name + "="); // pos가 -1 이면 해당 쿠키가 없다.
        if (pos <= -1) {
            if (i == 1) {
                return 1;
            } else {
                return cnt;
            }
        } else {
            cnt++;
            name = "";
            name = 'menu' + cnt;
        }
    }
    return cnt;
}

function favoriteGetCookieList() {
    var currentPage = location.href;
    var ret = favoriteGetCookie(currentPage);
    var favoriteTitleButton = document.getElementById("favoriteTitleButton");

    if (ret) {
        $('#favoriteTitle').html('<strong>이미 즐겨찾는 메뉴로 등록되어 있습니다.</strong>');
        $(".box-sub-favo .control button.add").hide();
        $(".box-sub-favo .control").addClass('on');
    } else {
        $('#favoriteTitle').html('<strong>현재 페이지를 즐겨찾는 메뉴로 등록하시겠습니까?</strong>');
        $(".box-sub-favo .control button.add").show();
        $(".box-sub-favo .control").removeClass('on');
    }

    var allCookies = unescape(document.cookie);
    var strCnt = 4;
    var favoListHtml = "";

    for (var i = 1; i < 6; i++) {
        var name = "";
        name = 'menu' + i;
        var pos = allCookies.indexOf(name + "="); // pos가 -1 이면 해당 쿠키가 없다.   
        if (pos > -1) {
            var start = pos + strCnt + 1;
            var end = allCookies.indexOf(";", start);
            if (end == -1) end = allCookies.length;
            var value = allCookies.substring(start, end);

            var idx = value.indexOf("@", 0);
            var menu = value.substring(1, idx);
            var menuUrl = value.substring(idx + 1, value.length);

            //			var html = '<a href="'+ menuUrl + '">' + menu + '</a><a href="javascript:favoriteRemoveCookie(\'menu' + i + '\');" class="delF">삭제</a>';
            //			$('#menu' + i).html(html);

            favoListHtml += '<li id="menu' + i + '"><a href="' + menuUrl + '">' + menu + '</a><button type="button" onclick="favoriteRemoveCookie(\'menu' + i + '\');" class="del">삭제</button></li>';
        }
    }

    if (favoListHtml != "") {
        if ($('#favoriteList').length < 1) {
            favoListHtml = '<ul id="favoriteList">' + favoListHtml + '</ul>';
            $('.box-sub-favo .control.list').before(favoListHtml);
        } else {
            $('#favoriteList').empty().append(favoListHtml);
        }
        $('.box-sub-favo .control.list').addClass('on');
        $('.box-sub-favo .control button.reset').show();
    } else {
        $('#favoriteList').remove();
        $('.box-sub-favo .control.list').removeClass('on');
        $('.box-sub-favo .control button.reset').hide();
    }

}

function favoriteGetCookie(url) {
    var allCookies = unescape(document.cookie);
    var pos = allCookies.indexOf(url); // pos가 -1 이면 해당 쿠키가 없다.   
    var ret = true;

    if (pos == -1) {
        ret = false;
        return ret;

    } else {
        ret = true;
        return ret;
    }
}

function favoriteRemoveCookie(menu) {
    document.cookie = escape(menu) + "=" + " " + "; path=/; max-age=" + (0);
    //	document.getElementById(menu).innerHTML = "";
    $('#' + menu).remove();
    favoriteGetCookieList();
    $('.btnFavorite').focus();	// ie11 때문에 포커스를 강제로 이동
}

function favoriteRemoveCookieAll() {
    var name = "menu";
    for (var i = 1; i < 6; i++) {
        name += i;
        document.cookie = escape(name) + "=" + " " + "; path=/; max-age=" + (0);
        name = "menu";
    }

    //	$('#menu1, #menu2, #menu3, #menu4, #menu5').html("");	
    $('.favoriteTitle').html('<strong>현재 페이지를 즐겨찾는 메뉴로 등록하시겠습니까?</strong>(즐겨찾는 메뉴는 최근 등록한 5개 메뉴가 노출됩니다)');
    $('#favoriteList').remove();
    $('.box-sub-favo .control button.reset').hide();
    $(".box-sub-favo .control button.add").show();

}

$(document).ready(function () {

  // 즐겨찾기 목록 가져오기 //
   favoriteGetCookieList();

    // 즐겨찾기 추가 //
    $('.box-sub-favo .control button.add').on('click', function (e) {
        e.preventDefault();
        jf_addMenu();
    });

    // 즐겨찾기 초기화 //
    $('.box-sub-favo .control button.reset').on('click', function (e) {
        e.preventDefault();
        favoriteRemoveCookieAll();
        $(".box-sub-favo .control").removeClass('on');
    });

    // 즐겨찾기 레이어 표시 //
    $('.btnFavorite').on('click', function (e) {
        e.preventDefault();
        if ($('.favoriteWrap').css('display') == "none") {
            $('.shareWrap').slideUp('normal');
            $('.favoriteWrap').slideDown('normal');
        } else {
            $('.favoriteWrap').slideUp('normal');
        }
    });

    // 즐겨찾기 레이어 닫기 //
    $('.favoriteClose').on('click focusout', function (e) {
        e.preventDefault();
        $('.favoriteWrap').slideUp('normal');
    });

    // 포커스 이동시 active //
    $('.btnFavorite').on('focusin', function () {
        $(this).addClass('active');
    });
    $('.btnFavorite').on('focusout', function () {
        $(this).removeClass('active');
    });
});
