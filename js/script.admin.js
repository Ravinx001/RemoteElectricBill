current();
voltage();
power();
meter();

function power() {

    var f1 = new FormData();

    var r1 = new XMLHttpRequest();

    r1.onreadystatechange = function () {
        if (r1.readyState == 4 && r1.status == 200) {
            var t1 = r1.responseText;

            document.getElementById("powerUpdate").innerHTML = t1;

        }
    }

    r1.open("POST", "processes/powerUpdate.php", true);
    r1.send(f1);

}

function current() {

    var f2 = new FormData();

    var r2 = new XMLHttpRequest();

    r2.onreadystatechange = function () {
        if (r2.readyState == 4 && r2.status == 200) {
            var t2 = r2.responseText;

            document.getElementById("currentUpdate").innerHTML = t2;

        }
    }

    r2.open("POST", "processes/currentUpdate.php", true);
    r2.send(f2);

}

function voltage() {

    var f3 = new FormData();

    var r3 = new XMLHttpRequest();

    r3.onreadystatechange = function () {
        if (r3.readyState == 4 && r3.status == 200) {
            var t3 = r3.responseText;

            document.getElementById("voltageUpdate").innerHTML = t3;

        }
    }

    r3.open("POST", "processes/voltageUpdate.php", true);
    r3.send(f3);

}

function meter() {

    var f4 = new FormData();

    var r4 = new XMLHttpRequest();

    r4.onreadystatechange = function () {
        if (r4.readyState == 4 && r4.status == 200) {
            var t4 = r4.responseText;

            document.getElementById("meterUpdate").innerHTML = t4;

        }
    }

    r4.open("POST", "processes/meterUpdate.php", true);
    r4.send(f4);

}

// Call the functions every 2.5 seconds
setInterval(current, 2500);
setInterval(voltage, 2500);
setInterval(power, 2500);
setInterval(meter, 2500);