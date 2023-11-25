var selectedDate; // input type= date 의 선택된 value값 저장
let onlyTextarea;
var inputStudentNumber = document.querySelector("#studentNumber");
var loginBtn = document.querySelector("#sendStuNum");
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
    let studentNumber = document.querySelector("#studentNumber").value;
    let studentNumberPassword = document.querySelector("#studentPassword").value;
    localStorage.clear();
    $.ajax({ // DB내부에 이미 잇는지 확인
        url:"validateStudentNumber.php",
        type: 'POST',
        dataType: 'json',
        data:{studentNumber: studentNumber, password: studentNumberPassword},
        async: false,
        success: function (bool) {
            if(bool){
                localStorage.setItem('studentNumber', studentNumber);
                alert("로그인 되었습니다");
            }
        },

        error: function(data) {
            if(!data){
                var confirmation = confirm("학번 정보가 없습니다. 생성하시겠습니까?");
                if (confirmation) {
                    location.href = 'createUser.html';
                }
                else {
                    alert("정보 처리를 취소했습니다.");
                }
            }
        }
    })
    return;
}

const read_data_school_schedule = (month) => { // html parsing and ajax send
    let monthContainer = document.querySelector(".monthContainer");
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
formBtn.addEventListener("click", function (event){
    const hiddenInput = document.createElement('input');
    hiddenInput.type = 'hidden';
    hiddenInput.name = 'studentNumber';
    hiddenInput.value = parseInt(localStorage.getItem("studentNumber"));
    document.getElementById('memoForm').appendChild(hiddenInput);
    form.submit();
});

loginBtn.addEventListener("click", validateStudentNumber);
window.addEventListener('DOMContentLoaded', function () { // dom load at active function show schedule
    const date = new Date();
    read_data_school_schedule(date.getMonth() + 1);
});
inputStudentNumber.addEventListener("keypress", function (event){
    if(event.key === "Enter"){
        event.preventDefault();
        document.getElementById("sendStuNum").click();
    }
    // /input에서 number가 입력되고 enter가 눌리면 button을 의도적으로 클릭하게 해서 함수를 작동하게함
});