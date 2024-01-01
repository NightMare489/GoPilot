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