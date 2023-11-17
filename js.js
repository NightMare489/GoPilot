function toggleSingup() {
    const logform = document.getElementById("LogForm");
    const mainBG = document.getElementsByClassName("mainBG")[0];
    const signupform = document.getElementById("signupform");
    const loginform = document.getElementById("loginform");
    const blurgroup = document.getElementById("blurgroup");
    const Logoimg = document.getElementById("LOGOIMG");


  if (document.getElementById("chkbox").checked) {
      blurgroup.classList.add("blurgroup");

    mainBG.classList.remove("mainBGLeft");
    logform.classList.add("signupclass");
    mainBG.classList.add("mainBGRight");
    logform.classList.remove("loginclass");

    setTimeout(()=>{
        signupform.hidden = false;
        loginform.hidden = true;


    }, 40)

    setTimeout(()=>{
        blurgroup.classList.remove("blurgroup");
    }, 1000)


  } else {
    blurgroup.classList.add("blurgroup");
    mainBG.classList.remove("mainBGRight");
    mainBG.classList.add("mainBGLeft");
    logform.classList.add("loginclass");
    logform.classList.remove("signupclass");


    setTimeout(()=>{
        signupform.hidden = true;
        loginform.hidden = false;

    }, 40)

    setTimeout(()=>{
        blurgroup.classList.remove("blurgroup");
    }, 1000)


  }
}


// loginform.classList.add("nonedisplay");
// loginform.classList.remove("nonedisplay");
// loginform.classList.add("blockdisplay");
// loginform.classList.remove("blockdisplay");
// loginform.classList.add("nonedisplay");





// signupform.classList.add("nonedisplay");
// signupform.classList.remove("nonedisplay");
// signupform.classList.add("nonedisplay");


// signupform.classList.remove("nonedisplay");