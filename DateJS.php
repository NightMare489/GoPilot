<script>

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


  let date = selectedDate;

  let year1 = date.getFullYear();
  let month1 = date.getMonth() + 1; 
  let day1 = date.getDate();


  month1 = month1 < 10 ? '0' + month1 : month1;
  day1 = day1 < 10 ? '0' + day1 : day1;

  let formattedDate = year1 + '-' +month1 + '-' + day1;


  window.location.replace("./Date.php?status=<?php echo $status ?>&airport=<?php echo $airport ?>&location=" + encodeURIComponent("<?php echo $location ?>") + "&lat=<?php echo $lat ?>&long=<?php echo $long ?>&date="+formattedDate);
  console.log(formattedDate);


}

  function createDayElement(day) {
    const date = new Date(currentDate.getFullYear(), currentDate.getMonth(), day);
    const dayElement = document.createElement("div");
    dayElement.classList.add("day");

    if (date.toDateString() === new Date().toDateString()) {
      dayElement.classList.add("current");
    }

    <?php

    if(isset($date)):
        echo "const selectedDate = new Date('$date');";

        echo 'if (selectedDate && date.toDateString() === selectedDate.toDateString()) {
          dayElement.classList.add("selected");
        }';


      endif;

    ?>

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

function checkNegativeBags(e){
  if(e.value<=0)
    e.value = 0;
}

function checkNegativePerson(e){
  if(e.value<=1)
    e.value = 1;
}

function handleBooking(id){
  let input = document.getElementsByClassName("NumOfPersons");

  let numPersons = input[0].value;
  let numBags = input[1].value;
  let date = "<?php echo $date ?>";
  let flightId = id;

  let status = "<?php echo $status ?>";
  let airport = "<?php echo $airport ?>";
  let location = "<?php echo $location ?>";
  let lat = "<?php echo $lat ?>";
  let long = "<?php echo $long ?>";


      let form = document.createElement('form');
      form.action = 'Ticket.php';
      form.method = 'POST';

      let data = {
        'numPersons': numPersons,
        'numBags': numBags,
        'date': date,
        'flightId': flightId,
        'status': status,
        'airport': airport,
        'location': location,
        'lat': lat,
        'long': long
      };

      for (let key in data) {
        let input = document.createElement('input');
        input.type = 'hidden';
        input.name = key;
        input.value = data[key];
        form.appendChild(input);
      }

      document.body.appendChild(form);

      form.submit();
    

}


 </script>