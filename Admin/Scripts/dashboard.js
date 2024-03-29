(function ($) {
    $(document).ready(function () {
        // Javascript is used to set the clock to your computer time.

        var currentSec = getSecondsToday();

        var seconds = (currentSec / 60) % 1;
        var minutes = (currentSec / 3600) % 1;
        var hours = (currentSec / 43200) % 1;

        setTime(60 * seconds, "second");
        setTime(3600 * minutes, "minute");
        setTime(43200 * hours, "hour");

        function setTime(left, hand) {
            $(".clock__" + hand).css("animation-delay", "" + left * -1 + "s");
        }

        function getSecondsToday() {
            let now = new Date();

            let today = new Date(now.getFullYear(), now.getMonth(), now.getDate());

            let diff = now - today;
            return Math.round(diff / 1000);
        }
    });

    //Initialize DashboardLayout component
    var dashboard = new ej.layouts.DashboardLayout({
        cellSpacing: [10, 10],
        columns: 5
    });
    //Render initialized DashboardLayout component
    dashboard.appendTo('#element');


    // chart1 **********************************************************************************************************
    $.post('Features/Charts/chart1.php',
        function (data, status) {
            if (status === 'success') {
                var obj = JSON.parse(data);

                var labelsArr = [];
                var dataArr = [];

                for (var i = 0; i < obj.length; i++) {
                    labelsArr.push(obj[i]['date']);
                    dataArr.push(obj[i]['freqs']);
                }

                var ctx = document.getElementById('myChart1').getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labelsArr,
                        datasets: [{
                            label: 'Bookings Last 7 Days',
                            data: dataArr,
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)',
                                'rgba(0, 110, 110, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)',
                                'rgba(0, 110, 110, 1)'
                            ],
                            borderWidth: 1,
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });


            }// end of success

        })
    // end of chart1 ***************************************************************************************************


    // chart2 **********************************************************************************************************
    $.post('Features/Charts/chart2.php',
        function (data, status) {
            if (status === 'success') {
                var obj = JSON.parse(data);

                var labelsArr = [];
                var dataArr = [];

                for (var i = 0; i < obj.length; i++) {
                    labelsArr.push(obj[i]['date']);
                    dataArr.push(obj[i]['freqs']);
                }

                var ctx = document.getElementById('myChart2').getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: labelsArr,
                        datasets: [{
                            label: 'Bookings Last 7 Days',
                            data: dataArr,
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)',
                                'rgba(0, 110, 110, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)',
                                'rgba(0, 110, 110, 1)'
                            ],
                            borderWidth: 1,
                        }]
                    },
                    options: {
                        aspectRatio: 1,

                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });


            }// end of success

        })


    // end of chart2 ***************************************************************************************************

})(jQuery);

// chart3 *******************because it's a function, it has to be in global context************************************
function getReport() {

    var firstDate = document.getElementById('firstDateCh3').value;
    var secondDate = document.getElementById('secondDateCh3').value;
    var method = document.getElementById('methodCh3').value;
    var chartType = document.getElementById('chartTypeCh3').value;
    var mainLabel = "";

    switch (method) {
        case 'bookings':
            mainLabel = 'Bookings count from ' + firstDate + ' to ' + secondDate;
            break;
        case 'orders':
            mainLabel = 'Orders count from ' + firstDate + ' to ' + secondDate;
            break;
        case 'rooms':
            mainLabel = 'Booked rooms count from ' + firstDate + ' to ' + secondDate;
            break;
    }
    // alert(chartType + mainLabel);


    $.post('Features/Charts/chart3.php', {
        'method': method,
        'firstDate': firstDate,
        'secondDate': secondDate
    }, function (data, status) {
        if (status === 'success') {

            // remove old canvas and add new canvas because they are gonna collapse with each other*****************
            removeElement('myChart3');
            // removeElement('holder');
            var html = '<canvas></canvas>';
            addElement('chart3Container', 'canvas', 'myChart3', html);

            // json parsing
            var obj = JSON.parse(data);

            var labelsArr = [];
            var dataArr = [];
            var colors = [];
            var borderColors = [];

            if (obj.length === 0)
                return;

            for (var i = 0; i < obj.length; i++) {

                var red = Math.floor(Math.random() * 255);
                var green = Math.floor(Math.random() * 255);
                var blue = Math.floor(Math.random() * 255);

                colors.push("rgb(" + red + "," + green + "," + blue + ",.2)")
                borderColors.push("rgb(" + red + "," + green + "," + blue + ",1)")

                labelsArr.push(obj[i]['date']);
                dataArr.push(obj[i]['freqs']);
            }

            // chart creating
            var ctx = document.getElementById('myChart3').getContext('2d');
            var myChart = new Chart(ctx, {
                type: chartType,
                data: {
                    labels: labelsArr,
                    datasets: [{
                        label: mainLabel,
                        data: dataArr,
                        backgroundColor: colors,
                        borderColor: borderColors,
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });

        }
    })
}




//***********************************************************************
function addElement(parentId, elementTag, elementId, html) {
    // Adds an element to the document
    var p = document.getElementById(parentId);
    var newElement = document.createElement(elementTag);
    newElement.setAttribute('id', elementId);
    newElement.innerHTML = html;
    p.appendChild(newElement);
}

function removeElement(elementId) {
    // Removes an element from the document
    var element = document.getElementById(elementId);
    element.parentNode.removeChild(element);
}

var today = new Date();
var dd = String(today.getDate()).padStart(2, '0');
var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
var yyyy = today.getFullYear();
yyyy+=1;

today = yyyy + '-' + mm + '-' + dd;

document.getElementById("secondDateCh3").defaultValue = today;


var dd = String(today.getDate() - 2).padStart(2, '0');
today = yyyy + '-' + mm + '-' + dd;
document.getElementById("firstDateCh3").defaultValue = today;

// end of chart3 ***************************************************************************************************

// first initialization
(function () {
    document.getElementById('clickBTN').click();
})()