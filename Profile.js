var loadFile = function (event) {
    var image = document.getElementById("output");
    image.src = URL.createObjectURL(event.target.files[0]);
    document.getElementById("save").style.visibility = 'visible';

  };
  

  function checkpass() {
    var pass = document.getElementById("password").value;
    var cpass = document.getElementById("cpassword").value;
    if (pass != cpass) {
      document.getElementById('errorBox').style.backgroundColor = "#cc0000";
      document.getElementById('errorBox').style.animation = 'slideInFromRight 1s forwards';
      document.getElementById('errorMsg').innerText = "Passwords do not match";
      document.getElementById('errorBox').style.display = 'block';

      setTimeout(function () {
          document.getElementById('errorBox').style.animation = 'slideOutToRight 1s forwards';

      }, 3000);
      return false;
    }
  }
  let isOpened = false;

  function changePhone(){
    if(isOpened){
      document.getElementById("Efeild").style.visibility = 'hidden';
      document.getElementById("save").style.visibility = 'hidden';
      isOpened = false;
    }else{
      document.getElementById("Efeild").style.visibility = 'visible';
      document.getElementById("save").style.visibility = 'visible';
      isOpened = true;
    }
  }
  let passOpen = false;
  function changePassword(){
    var x=document.getElementsByClassName("Epass");
    if(passOpen){
      for(var i=0;i<x.length;i++){
        x[i].style.visibility = 'hidden';
        passOpen = false;
      }  
      document.getElementById("save").style.visibility = 'hidden';
    }else{
      for(var i=0;i<x.length;i++){
        x[i].style.visibility = 'visible';
        passOpen = true;
      }
      document.getElementById("save").style.visibility = 'visible';
    }
  }