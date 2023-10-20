function login() {

    var email = document.getElementById("email").value;
    var pwd = document.getElementById("pwd").value;
    var chbox = document.getElementById("chbox").value;

    var f1 = new FormData();
    f1.append("email", email);
    f1.append("pwd", pwd);
    f1.append("chbox", chbox);

    var r1 = new XMLHttpRequest();

    r1.onreadystatechange = function () {
        if (r1.readyState == 4 && r1.status == 200) {
            var t1 = r1.responseText;

            if (t1 == "PU1") {
                alert("Profile Data Updated !");
                // Redirect to a Login page
                window.location.href = "home.php";

            } else {
                alert(t1);
            }

        }
    }

    r1.open("POST", "processes/loginProcess.php", true);
    r1.send(f1);

}