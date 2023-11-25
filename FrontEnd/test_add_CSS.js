var selectedDate; // input type= date 의 선택된 value값 저장
let onlyTextarea;
var inputStudentNumber = document.querySelector("#studentNumber");

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
const delete_schedule = () => {
    if(selectedDate === undefined || selectedDate === null) {
        alert("날짜를 선택하지 않았습니다");
        return;
    }
    $.ajax({
        url: 'scheduleDelete.php',
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
const handleDateChange = (date) => {
    let deleteInput = document.querySelector("#deleteInput");
    if ( date !== undefined ){
        selectedDate = date;
    }
}
function read_data_todolist(date){
     onlyTextarea = document.querySelector("#onlyTextarea");
    let Temp;
    selectedDate = date;
    $.ajax({
        url: 'readMemo.php',
        type: 'GET',
        dataType: 'json',
        async:  false,
        success: function (data){
            console.log(data);
            console.log(data.memo);
            Temp = data.memo;
        },
        error: function (e){
        }

    })
    onlyTextarea.value = Temp;
    return Temp;
}
const OnSubmitStudentNumber = () => {
    
    let studentNumber = document.querySelector("#studentNumber").value;
    if(localStorage.getItem('studentNumber')){
        localStorage.removeItem('studentNumber');
    }
    $.ajax({ // DB내부에 이미 잇는지 확인
        url:"validateStudentNumber.php",
        type: 'post',
        dataType: 'json',
        data:{studentNumber: studentNumber},
        async: false,
        success: function (vaildatedNumber) {
            localStorage.setItem('studentNumber', vaildatedNumber);
        },

        error: function(data) {
            if(data === null){
                var confirmation = confirm("학번 정보가 없습니다. 생성하시겠습니까?");
                if (confirmation) {
                    $.ajax({
                        url:"createStudentNumber.php",
                        type: 'post',
                        dataType: 'json',
                        data:{studentNumber: studentNumber},
                        async: false,
                        success: function (data) {
                            console.log("Positive True");
                        },
                        error:function (data) {
                            console.log("Positive false");
                        }
                    })
                    alert("정보를 처리합니다.");
                }
                else {
                    console.log("Negative true");
                    alert("정보 처리를 취소했습니다.");
                }
            }
        }
    })
}
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

//  {

//     var date = document.getElementById("monthSelect").value;
//     var schedule = document.getElementById("scheduleInput").value;

//     var outputDiv = document.getElementById("output");

//     // 테이블 생성
//     var table = document.createElement("table");
//     table.style.width = "100%";

//     // 헤더 추가
//     var headerRow = table.insertRow(0);
//     var dateHeader = headerRow.insertCell(0);
//     dateHeader.innerHTML = "선택한 날짜";
//     var scheduleHeader = headerRow.insertCell(1);
//     scheduleHeader.innerHTML = "일정 및 메모";

//     // 데이터 추가
//     var dataRow = table.insertRow(1);
//     var dateCell = dataRow.insertCell(0);
//     dateCell.innerHTML = month + " " + date + "일";
//     var scheduleCell = dataRow.insertCell(1);
//     scheduleCell.innerHTML = schedule;

//     // 기존 내용 지우고 새로운 테이블 추가
//     outputDiv.innerHTML = "";
//     outputDiv.appendChild(table);

// }