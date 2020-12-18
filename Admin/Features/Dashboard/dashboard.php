<link href="https://cdn.syncfusion.com/ej2/ej2-base/styles/material.css" rel="stylesheet" type="text/css"/>
<link href="https://cdn.syncfusion.com/ej2/ej2-layouts/styles/material.css" rel="stylesheet" type="text/css"/>
<script src="../Vendor/DatePicker/ej2-base/dist/global/ej2-base.min.js" type="text/javascript"></script>
<script src="../Vendor/DatePicker/ej2-layouts/dist/global/ej2-layouts.min.js" type="text/javascript"></script>
<script src="Scripts/calender.js" type="text/javascript"></script>

<link rel="stylesheet" href="CSS/dashboard.css">
<link rel="stylesheet" href="CSS/calender.css">
<script src="Scripts/dashboard.js"></script>


<div class="container">
    <div id="element">
        <!-- Add the HTML <div> element  -->
        <div>
            <!--element which is going to render the dashboardlayout-->
            <div id="dashboard_inline">
                <!--                //clock-->
                <div id="one" class="e-panel" data-row="0" data-col="4" data-sizeX="1" data-sizeY="1">
                    <div class="e-panel-container">
                        <div class="clock">
                            <div class="clock__second"></div>
                            <div class="clock__minute"></div>
                            <div class="clock__hour"></div>
                            <div class="clock__axis"></div>
                            <section class="clock__indicator"></section>
                            <section class="clock__indicator"></section>
                            <section class="clock__indicator"></section>
                            <section class="clock__indicator"></section>
                            <section class="clock__indicator"></section>
                            <section class="clock__indicator"></section>
                            <section class="clock__indicator"></section>
                            <section class="clock__indicator"></section>
                            <section class="clock__indicator"></section>
                            <section class="clock__indicator"></section>
                            <section class="clock__indicator"></section>
                            <section class="clock__indicator"></section>
                            <section class="clock__indicator"></section>
                            <section class="clock__indicator"></section>
                            <section class="clock__indicator"></section>
                            <section class="clock__indicator"></section>
                            <section class="clock__indicator"></section>
                            <section class="clock__indicator"></section>
                            <section class="clock__indicator"></section>
                            <section class="clock__indicator"></section>
                            <section class="clock__indicator"></section>
                            <section class="clock__indicator"></section>
                            <section class="clock__indicator"></section>
                            <section class="clock__indicator"></section>
                            <section class="clock__indicator"></section>
                            <section class="clock__indicator"></section>
                            <section class="clock__indicator"></section>
                            <section class="clock__indicator"></section>
                            <section class="clock__indicator"></section>
                            <section class="clock__indicator"></section>
                            <section class="clock__indicator"></section>
                            <section class="clock__indicator"></section>
                            <section class="clock__indicator"></section>
                            <section class="clock__indicator"></section>
                            <section class="clock__indicator"></section>
                            <section class="clock__indicator"></section>
                            <section class="clock__indicator"></section>
                            <section class="clock__indicator"></section>
                            <section class="clock__indicator"></section>
                            <section class="clock__indicator"></section>
                            <section class="clock__indicator"></section>
                            <section class="clock__indicator"></section>
                            <section class="clock__indicator"></section>
                            <section class="clock__indicator"></section>
                            <section class="clock__indicator"></section>
                            <section class="clock__indicator"></section>
                            <section class="clock__indicator"></section>
                            <section class="clock__indicator"></section>
                            <section class="clock__indicator"></section>
                            <section class="clock__indicator"></section>
                            <section class="clock__indicator"></section>
                            <section class="clock__indicator"></section>
                            <section class="clock__indicator"></section>
                            <section class="clock__indicator"></section>
                            <section class="clock__indicator"></section>
                            <section class="clock__indicator"></section>
                            <section class="clock__indicator"></section>
                            <section class="clock__indicator"></section>
                            <section class="clock__indicator"></section>
                            <section class="clock__indicator"></section>
                            <h3 class="main-h3 d-xl-block d-none"> Palestine's Time</h3>
                        </div>
                    </div>
                </div>
                <!--                //main chart-->
                <div id="two" class="e-panel" data-row="0" data-col="0" data-sizeX="4" data-sizeY="3">
                    <div class="e-panel-container container-fluid">
                        <div class="row" id="chart3Container">
                            <h2 id="holder" style="margin: 50px auto 0; display: block;" class="main-h2">Please Select a Type and date range to view charts</h2>
                            <canvas class="col-12" id="myChart3"></canvas>
                        </div>
                        <hr>
                        <div class="dash-border-2">
                            <div class="dash-border-1" style="height: 100%"><!--dates row-->
                                <div class="row">
                                    <div class="form-group col-6 row">
                                        <label for="firstDateCh3" class="col-3 col-form-label">First Date:</label>
                                        <div class="col-9">
                                            <input class="form-control" type="date" value="2020-12-10"
                                                   id="firstDateCh3">
                                        </div>
                                    </div>
                                    <div class="form-group col-6 row">
                                        <label for="secondDateCh3" class="col-3 col-form-label">Second Date:</label>
                                        <div class="col-9">
                                            <input class="form-control" type="date" value="2020-12-20"
                                                   id="secondDateCh3">
                                        </div>
                                    </div>
                                </div>
                                <!--selection row-->
                                <div class="row">
                                    <div class="row col-4">
                                        <label for="chartType" class="col-3 col-form-label">Chart Type:</label>
                                        <div class="col-9">
                                            <select class="form-select" id="chartTypeCh3">
                                                <option value="line">Line</option>
                                                <option value="radar">Radar</option>
                                                <option value="bar">Bar</option>
                                                <option value="doughnut">Doughnut</option>
                                                <option value="pie">Pie</option>
                                                <option value="polarArea">Polar Area</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row col-4">
                                        <label for="chartType" class="col-3 col-form-label">Method:</label>
                                        <div class="col-9">
                                            <select class="form-select" id="methodCh3">
                                                <option value="bookings">Bookings</option>
                                                <option value="orders">Orders</option>
                                                <option value="rooms">Rooms</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row col-4">
                                        <button class="btn btn-primary" id="clickBTN" onclick="getReport()">Get Report
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="four" class="e-panel" data-row="1" data-col="4" data-sizeX="1" data-sizeY="2">
                    <div class="e-panel-container">
                        <div class="yellow">
                            <div id="calendar">
                                <div id="dates" class="show">
                                    <div id="lastMt">&lsaquo;</div>
                                    <div id="nextMt">&rsaquo;</div>
                                    <div id="months-cont">
                                        <div id="months">
                                            <span class="active month">January</span><span
                                                    class="month">February</span><span class="month">March</span><span
                                                    class="month">April</span><span class="month">May</span><span
                                                    class="month">June</span><span class="month">July</span><span
                                                    class="month">August</span><span class="month">September</span><span
                                                    class="month">October</span><span class="month">November</span><span
                                                    class="month">December</span>
                                        </div>
                                    </div>
                                    <div id="daysotweek">
                                        <div class="day">S</div>
                                        <div class="day">M</div>
                                        <div class="day">T</div>
                                        <div class="day">W</div>
                                        <div class="day">T</div>
                                        <div class="day">F</div>
                                        <div class="day">S</div>
                                    </div>
                                    <div id="days">
                                    </div>
                                </div>
                                <div id="info" class="hide">
                                    <div id="actual-date"></div>
                                    <div id="back"><</div>
                                    <div id="month-name"></div>
                                    <div id="weather">
                                        <div id="sun"></div>
                                        <div id="mountains"></div>
                                        <div id="rain">
                                            <div class="raindrop" id="drop-1"></div>
                                            <div class="raindrop center" id="drop-2"></div>
                                            <div class="raindrop center" id="drop-3"></div>
                                            <div class="raindrop" id="drop-4"></div>
                                        </div>
                                        <div id="temp">57&deg;<span>F</span></div>
                                    </div>
                                    <div id="bg-card">
                                        <div class="content"></div>
                                    </div>
                                    <div id="card">
                                        <div class="content">
                                            <div id="event-name"></div>
                                            <div id="event-details">
                                                <div class="col-3">
                                                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                                                    <h3>Location</h3>
                                                    <p>12345 Generic Ave., Some City, Some State, 12345
                                                </div>
                                                <div class="col-3">
                                                    <i class="fa fa-clock-o" aria-hidden="true"></i>
                                                    <h3>Time</h3>
                                                    <p> 12:00 AM </p>
                                                </div>
                                                <div class="col-3">
                                                    <i class="fa fa-user" aria-hidden="true"></i>
                                                    <h3>Attendee</h3>
                                                    <p>Me, You, and 2+</p>
                                                </div>
                                                <div style="clear: both"></div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div id="colors" class="hide">
                                    <div id="close">&times;</div>
                                    <p>Choose theme color</p>
                                    <div class="color" id="salmon"></div>
                                    <div class="color" id="dkpink"></div>
                                    <div class="color" id="red"></div>
                                    <div class="color" id="redorg"></div>
                                    <div class="color" id="orange"></div>
                                    <div class="color" id="orgylw"></div>
                                    <div class="color active" id="yellow"></div>
                                    <div class="color" id="green"></div>
                                    <div class="color" id="aqua"></div>
                                    <div class="color" id="teal"></div>
                                    <div class="color" id="sltbl"></div>
                                    <div class="color" id="pwdbl"></div>
                                    <div class="color" id="blue"></div>
                                    <div class="color" id="purple"></div>
                                    <div class="color" id="dkprpl"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="five" class="e-panel" data-row="3" data-col="2" data-sizeX="3" data-sizeY="2">
                    <div class="e-panel-container">
                        <div class="content">
                            <canvas style="position:absolute;bottom: 10%;" id="myChart1"></canvas>
                        </div>
                    </div>
                </div>
                <div id="six" class="e-panel" data-row="3" data-col="0" data-sizeX="2" data-sizeY="2">
                    <div class="e-panel-container p-4">
                        <div class="chart-container" style="position: relative; height:90%; ">
                            <canvas id="myChart2" style="    position: absolute;display: block;width: 80%;left: 1%;"></canvas>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

