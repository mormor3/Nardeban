document.getElementsByClassName("btn btn-light action-button")[0].setAttribute("onclick",'signUpPanel()');

document.getElementsByClassName("btn btn-primary btn-block")[0].setAttribute("onclick",'signUpPanel()');

document.getElementsByClassName("btn btn-primary btn-block")[1].setAttribute("onclick",'signInPanel()');

document.getElementsByClassName("login")[0].setAttribute("onclick",'signInPanel()');

function signUpPanel(){
    var display = document.getElementsByClassName("register-photo")[0].style.display;
    if (display === "block"){
        document.getElementsByClassName("register-photo")[0].style.display="none"
    }else{
        document.getElementsByClassName("register-photo")[0].style.display="block"
    }
}

function signInPanel(){
    var display = document.getElementsByClassName("login-clean")[0].style.display;
    if (display === "block"){
        document.getElementsByClassName("login-clean")[0].style.display="none"
    }else{
        document.getElementsByClassName("login-clean")[0].style.display="block"
    }
}

// $.get("searchoptions.php", function (data) {
//         document.getElementById("options").innerHTML = data;
// });

searchInProduct("");