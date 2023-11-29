var selectedDate; // input type= date 의 선택된 value값 저장
let onlyTextarea;
var isLogined = localStorage.getItem("studentNumber") !== null;
var inputStudentNumber = document.querySelector("#studentNumber");
var inputStudentNumberLable = document.querySelector("#studentNumberLable");
var inputStudentPassword = document.querySelector("#studentPassword");
var inputStudentPasswordLable = document.querySelector("#studentPasswordLable");
var loginBtn = document.querySelector("#login");
var logoutBtn = document.querySelector("#logout");
var form = document.querySelector("#memoForm");
var formBtn = document.querySelector("#formBtn");

const months = [
    "January",
    "February",
    "March",
    "April",
    "May",
    "June",
    "July",
    "August",
    "September",
    "October",
    "November",
    "December"
];

const memoDelete = () => {
    if(!localStorage.getItem('studentNumber')){
    alert("로그인 정보가 없습니다");
    location.reload();
    return;
}
    if(selectedDate === undefined || selectedDate === null) {
        alert("날짜를 선택하지 않았습니다");
        return;
    }
    $.ajax({
        url: 'memoDelete.php',
        type: 'POST',
        data: {deleteDate : selectedDate},
        dataType: 'json',
        async:  false,
        success: function (data){
        },
        error: function (e){
            alert("선택한 날짜에 메모가 존재하지 않습니다")
        }

    });
}


function read_data_todolist(){ // 유저 정보랑 같이 보냄, 없으면 return
    if(!localStorage.getItem('studentNumber')){
        alert("로그인 정보가 없습니다");
        location.reload();
        return;
    }
    let onlyTextarea = document.querySelector("#onlyTextarea");
    let Temp;
    $.ajax({
        url: 'readMemo.php',
        type: 'post',
        data:{date:selectedDate},
        dataType: 'json',
        async:  false,
        success: function (data){
            Temp = data
        },
        error: function (e){
            console.dir(e);
        }

    })
    onlyTextarea.value = Temp;
    return;
} // memoRead
const validateStudentNumber = () => { // login 할떄
    if(localStorage.getItem('studentNumber')){
        alert("이미 로그인 되어있습니다");
        location.reload();
        return;
    }
    let studentNumber = document.querySelector("#studentNumber").value;
    let studentNumberPassword = document.querySelector("#studentPassword").value;
    localStorage.clear();
    $.ajax({ // DB내부에 이미 잇는지 확인
        url:"validateStudentNumber.php",
        type: 'POST',
        dataType: 'JSON',
        data:{studentNumber: studentNumber, password: studentNumberPassword},
        async: false,
        success: function (bool) {
            if(bool) {
                localStorage.setItem('studentNumber', studentNumber);
                isLogined = true;
                studentNumber = null;
                studentNumberPassword = "";
                cssHandler(isLogined);
                location.reload();
                alert("로그인 되었습니다");
            }else{
                fetch("http://34.64.38.149/test_add_CSS.html", {
                         method: 'GET',
                         headers: {
                             'Content-Type': 'application/json',
                         }
                     }
                 ).then((response) => response.json()).then(data => console.log(data));
            }
        },
        error: function(data) {
            console.dir(data);
        }
    });
}



const logout = () => {
    if(!localStorage.getItem('studentNumber')){
        alert("로그인 정보가 없습니다");
        location.reload();
        return;
    }else if (localStorage.getItem('studentNumber')){
        var confirmation = confirm("정말 로그 아웃 하시겠습니까?");
        if(confirmation){
            isLogined = false;
            cssHandler(isLogined);
            location.reload();
        }else{
            return;
        }

    }
    return;
}

const read_data_school_schedule = (month) => { // html parsing and ajax send

    let containercercleNumber = document.querySelector(".container-cercle-number");
    let monthTitle = document.querySelector(".month-title");
    let hoho = document.querySelector("#hoho");


    if (containercercleNumber.firstChild !== null) {
        containercercleNumber.removeChild(containercercleNumber.firstChild);
    }
    if (monthTitle.firstChild !== null) {
        monthTitle.removeChild(monthTitle.firstChild);
    }
    if (hoho.firstChild !== null) {
        hoho.removeChild(hoho.firstChild);
    }

    let doc;

    $.ajax({
        url: 'crawl.php',
        type: 'get',
        dataType: 'json',
        async: false,
        success: function (data) {

            var parser = new DOMParser();
            doc = parser.parseFromString(data, 'text/html').querySelector('ul').getElementsByTagName('li');
        },



        error: function(data) {
        }
    });
    const classNameNumMonth = doc[month -1].querySelector(".num em"); // 달 숫자
    const classNameDesc = doc[month -1].querySelector(".desc"); // 학사일정 내용

    containercercleNumber.appendChild(classNameNumMonth);
    monthTitle.innerText = `${months[month - 1]}`; // 월 영문을 month-title에 text로 삽입
    hoho.appendChild(classNameDesc);

    return
}
const handleDateChange = (date) => {
    let deleteInput = document.querySelector("#deleteInput");
    if ( date !== undefined ){
        selectedDate = date;
    }
}
const cssHandler = (bool) => { // login 되어있나에 따라 display : none; 적용 여부 핸들러
    if(bool){ // isLogined = true .. 로그인 되어있을때
        //logout 버튼 키고 login버튼 숨기기
        // login 입력창 숨기기
        logoutBtn.className = ""; // display none;
        loginBtn.className = "logInLogOutToggle";
        inputStudentNumber.className = "logInLogOutToggle";
        inputStudentPassword.className = "logInLogOutToggle";
        inputStudentNumberLable.className = "logInLogOutToggle";
        inputStudentPasswordLable.className = "logInLogOutToggle";
    }else{
        // logout 입력창 숨기기
        // login 입력창 켜기
        logoutBtn.className = "logInLogOutToggle"; // display none;
        loginBtn.className = "";
        loginBtn.className = "";
        inputStudentNumber.className = "";
        inputStudentPassword.className = "";
        inputStudentNumberLable.className = "";
        inputStudentPasswordLable.className = "";
        localStorage.clear(); // 로그아웃할때 로컬스토리지의 값을 지워야하기 때문에
    }
}
formBtn.addEventListener("click", function (event){
    if(!localStorage.getItem('studentNumber')){
        alert("로그인 정보가 없습니다");
        event.preventDefault();
        location.reload();
        return;
    }
    const hiddenInput = document.createElement('input');
    hiddenInput.type = 'hidden';
    hiddenInput.name = 'studentNumber';
    hiddenInput.value = localStorage.getItem("studentNumber");
    document.getElementById('memoForm').appendChild(hiddenInput);
    form.submit();
});

loginBtn.addEventListener("click", validateStudentNumber);
window.addEventListener('DOMContentLoaded', function () { // dom load at active function show schedule
    const date = new Date();
    read_data_school_schedule(date.getMonth() + 1);
    cssHandler(isLogined);
});
inputStudentNumber.addEventListener("keypress", function (event){
    if(event.key === "Enter"){
        event.preventDefault();
        document.getElementById("login").click();
    }
    // /input에서 number가 입력되고 enter가 눌리면 button을 의도적으로 클릭하게 해서 함수를 작동하게함
});