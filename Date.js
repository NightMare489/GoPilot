function hambruger(){
    var sidebar = document.getElementById("sideBar");
    var hambruger = document.getElementById("hambruger");

    if(sidebar.classList.contains("notactive")){

       sidebar.classList.remove("notactive");
       sidebar.classList.add("active");
       hambruger.classList.add("active");

    }else{

       sidebar.classList.remove("active");
       sidebar.classList.add("notactive");
       hambruger.classList.remove("active");

    }
   

}

const daysContainer = document.getElementById("daysContainer");
const prevBtn = document.getElementById("prevBtn");
const nextBtn = document.getElementById("nextBtn");
const monthYear = document.getElementById("monthYear");
const dateInput = document.getElementById("dateInput");
const calendar = document.getElementById("calendar");

let currentDate = new Date();
let selectedDate = null;

function handleDayClick(day) {
  selectedDate = new Date(
    currentDate.getFullYear(),
    currentDate.getMonth(),
    day
  );
  dateInput.value = selectedDate.toLocaleDateString("en-US");
  calendar.style.display = "none";
  renderCalendar();
}

function createDayElement(day) {
  const date = new Date(currentDate.getFullYear(), currentDate.getMonth(), day);
  const dayElement = document.createElement("div");
  dayElement.classList.add("day");

  if (date.toDateString() === new Date().toDateString()) {
    dayElement.classList.add("current");
  }
  if (selectedDate && date.toDateString() === selectedDate.toDateString()) {
    dayElement.classList.add("selected");
  }

  dayElement.textContent = day;
  dayElement.addEventListener("click", () => {
    handleDayClick(day);
  });
  daysContainer.appendChild(dayElement);
}

function renderCalendar() {
  daysContainer.innerHTML = "";
  const firstDay = new Date(
    currentDate.getFullYear(),
    currentDate.getMonth(),
    1
  );
  const lastDay = new Date(
    currentDate.getFullYear(),
    currentDate.getMonth() + 1,
    0
  );

  monthYear.textContent = `${currentDate.toLocaleString("default", {
    month: "long"
  })} ${currentDate.getFullYear()}`;

  for (let day = 1; day <= lastDay.getDate(); day++) {
    createDayElement(day);
  }
}

prevBtn.addEventListener("click", () => {
  currentDate.setMonth(currentDate.getMonth() - 1);
  renderCalendar();
});

nextBtn.addEventListener("click", () => {
  currentDate.setMonth(currentDate.getMonth() + 1);
  renderCalendar();
});

dateInput.addEventListener("click", () => {
  calendar.style.display = "block";
  positionCalendar();
});

document.addEventListener("click", (event) => {
  if (!dateInput.contains(event.target) && !calendar.contains(event.target)) {
    calendar.style.display = "none";
  }
});

function positionCalendar() {
  const inputRect = dateInput.getBoundingClientRect();
  calendar.style.top = inputRect.bottom + "px";
  calendar.style.left = inputRect.left + "px";
}

window.addEventListener("resize", positionCalendar);

renderCalendar();
positionCalendar();


function minus(e){
  var input = document.getElementsByClassName("NumOfPersons");
  var value = input[e].value;
  if(value>1&&e==0)
    value--;
  if(e==1&&value>0)
    value--;
  input[e].value = value;
}
function plus(e){
  var input = document.getElementsByClassName("NumOfPersons");
  var value = input[e].value;
  value++;
  input[e].value = value;
}