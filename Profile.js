var loadFile = function (event) {
    var image = document.getElementById("output");
    image.src = URL.createObjectURL(event.target.files[0]);
  };
  

  function checkpass() {
    var pass = document.getElementById("password").value;
    var cpass = document.getElementById("cpassword").value;
    if (pass != cpass) {
      alert("password and confirm password must be same");
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