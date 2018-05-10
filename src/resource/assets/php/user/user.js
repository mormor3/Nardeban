function signinPanel() {
    document.getElementById("loginPanel").style.visibility = "visible";
    document.getElementsByTagName("body")[0].style.overflow = "hidden";
}

function signupPanel() {
    document.getElementById("signupPanel").style.visibility = "visible";
    document.getElementsByTagName("body")[0].style.overflow = "hidden";
}

function checkuser() {
    var username = document.getElementById("loginusername").value;
    var password = document.getElementById("loginpassword").value;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200 && this.responseText !== "not exist") {
            var result = this.responseText;
            exit();
            user = (result.split(' '))[0];
            for (var i = 0; i < result.length; i++) {
                if (result.charAt(i) === ' ') {
                    document.getElementById("userarea").innerHTML = result.substring(i + 1);
                    break;
                }
            }
        } else if (this.responseText === "not exist") {
            document.getElementById("loginerror").innerHTML = '<b>نام کاربری یا رمز عبور وارد شده، اشتباه می باشد</b>';
        }
    };
    xhttp.open("POST", "user/checkuser.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("username=" + username + "&password=" + password);
}

function exit() {
    document.getElementById("loginPanel").style.visibility = "hidden";
    document.getElementById("signupPanel").style.visibility = "hidden";
    document.getElementsByTagName("body")[0].style.overflow = "visible";
}

function checkEmail() {
    var email = document.getElementById("email").value;
    $.post("user/checkEmail.php", {
        email: email
    }, function (result) {
        console.log(result);
    });
}

function checkPhone() {
    var telphone = document.getElementById("telphone").value;
    if (telphone.length === 11) {
        $.post("user/checkPhone.php", {
            telphone: telphone
        }, function (result) {
            console.log(result);
        });
    } else if (telphone.length > 11) {
        console.log("phone number error");
    }
}

function checkUserName() {
    var userName = document.getElementById("signupusername").value;
    if (userName.length > 3) {
        $.post("user/checkUserName.php", {
            userName: userName
        }, function (result) {
            console.log(result);
        });
    } else {
        console.log("must be biiger than 3 character");
    }
}

function checkPassword() {
    var password = document.getElementById("signuppassword").value;
    if (password.length < 6) {
        console.log("please Enter bigger than 6 charecter");
    } else {
        passcheck = 1;
    }
}

function checkInput() {
    var firstName = document.getElementById("firstname").value;
    var lastName = document.getElementById("lastname").value;
    var email = document.getElementById("email").value;
    var telphone = document.getElementById("telphone").value;
    var userName = document.getElementById("signupusername").value;
    var password = document.getElementById("signuppassword").value;
    $.ajax({
        url: "user/adduser.php",
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded; charset=utf-8'
        },
        data: {
            firstname: firstName,
            lastname: lastName,
            email: email,
            telphone: telphone,
            username: userName,
            password: password
        },
        method: 'POST',
        success: function (result) {
            console.log(result);
            document.getElementById("loginusername").value = firstName;
            document.getElementById("loginpassword").value = password;
            checkuser();
        }
    });
}
