readings();
wifi();

function readings() {

    var f1 = new FormData();

    var r1 = new XMLHttpRequest();

    r1.onreadystatechange = function () {
        if (r1.readyState == 4 && r1.status == 200) {
            var t1 = r1.responseText;

            document.getElementById("readings").innerHTML = t1;

        }
    }

    r1.open("POST", "processes/meterReadings.php", true);
    r1.send(f1);

}

function wifi() {

    var f2 = new FormData();

    var r2 = new XMLHttpRequest();

    r2.onreadystatechange = function () {
        if (r2.readyState == 4 && r2.status == 200) {
            var t2 = r2.responseText;

            document.getElementById("wifi").innerHTML = t2;

        }
    }

    r2.open("POST", "processes/wifi.php", true);
    r2.send(f2);

}

function visitors() {

    var f2 = new FormData();

    var r2 = new XMLHttpRequest();

    r2.onreadystatechange = function () {
        if (r2.readyState == 4 && r2.status == 200) {
            var t2 = r2.responseText;

            document.getElementById("visitors").innerHTML = t2;

        }
    }

    r2.open("POST", "processes/visitors.php", true);
    r2.send(f2);

}

setInterval(readings, 5000);
setInterval(wifi, 5000);