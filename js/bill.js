bill();


function bill() {

    var f1 = new FormData();

    var r1 = new XMLHttpRequest();

    r1.onreadystatechange = function () {
        if (r1.readyState == 4 && r1.status == 200) {
            var t1 = r1.responseText;

            var res = t1.split(",");

            document.getElementById("total").innerHTML = res[0];
            document.getElementById("tax").innerHTML = res[1];
            document.getElementById("reading").innerHTML = res[2];
            document.getElementById("dateTime").innerHTML = res[3];

        }
    }

    r1.open("POST", "processes/billCalculation.php", true);
    r1.send(f1);

}

setInterval(bill, 5000);
