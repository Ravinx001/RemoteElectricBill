bill();


function bill() {

    var f1 = new FormData();

    var r1 = new XMLHttpRequest();

    r1.onreadystatechange = function () {
        if (r1.readyState == 4 && r1.status == 200) {
            var t1 = r1.responseText;

            var res = t1.split(",");

            document.getElementById("bill_total").innerHTML =
                document.getElementById("total").innerHTML = res[0];

            document.getElementById("bill_tax").innerHTML =
                document.getElementById("tax").innerHTML = res[1];

            document.getElementById("bill_reading").innerHTML =
                document.getElementById("reading").innerHTML = res[2];

            document.getElementById("bill_dateTime").innerHTML =
                document.getElementById("dateTime").innerHTML = res[3];

            var tax_per = (res[1] / res[0]) * 100;
            document.getElementById("bill_taxPercentage").innerHTML = tax_per.toFixed(2);


        }
    }

    r1.open("POST", "processes/billCalculation.php", true);
    r1.send(f1);

}

setInterval(bill, 5000);
