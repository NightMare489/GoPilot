function toggleSingup() {
    const logform = document.getElementById("LogForm");
    const planeBox = document.getElementsByClassName("planeBox")[0];
    const mainBG = document.getElementsByClassName("mainBG")[0];

  if (document.getElementById("chkbox").checked) {
    try {
        
        planeBox.classList.remove("planeBoxLeft");
        mainBG.classList.remove("mainBGLeft");
    } catch (error) {
        console.log("ماشي")
    }

    logform.classList.add("signupclass");
    planeBox.classList.add("planeBoxRight");
    mainBG.classList.add("mainBGRight");

    logform.classList.remove("loginclass");
  } else {
    planeBox.classList.remove("planeBoxRight");
    mainBG.classList.remove("mainBGRight");

    planeBox.classList.add("planeBoxLeft");
    mainBG.classList.add("mainBGLeft");

    logform.classList.add("loginclass");
    logform.classList.remove("signupclass");
  }
}
