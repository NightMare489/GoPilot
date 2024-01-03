var loadFile = function (event) {
    var image = document.getElementById("output");
    image.src = URL.createObjectURL(event.target.files[0]);
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

  function changePhone(){
    document.getElementById("Efeild").style.visibility = 'visible';
  }
  function changePassword(){
    var x=document.getElementsByClassName("Epass");
    for(var i=0;i<x.length;i++){
      x[i].style.visibility = 'visible';
    }
  }