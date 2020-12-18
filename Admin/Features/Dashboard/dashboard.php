<link href="https://cdn.syncfusion.com/ej2/ej2-base/styles/material.css" rel="stylesheet" type="text/css"/>
<link href="https://cdn.syncfusion.com/ej2/ej2-layouts/styles/material.css" rel="stylesheet" type="text/css"/>
<script src="../Vendor/DatePicker/ej2-base/dist/global/ej2-base.min.js" type="text/javascript"></script>
<script src="../Vendor/DatePicker/ej2-layouts/dist/global/ej2-layouts.min.js" type="text/javascript"></script>
<script src="Scripts/calender.js" type="text/javascript"></script>

<link rel="stylesheet" href="CSS/dashboard.css">
<link rel="stylesheet" href="CSS/calender.css">


<div class="container">
    <div id="element">
        <!-- Add the HTML <div> element  -->
        <div>
            <!--element which is going to render the dashboardlayout-->
            <div id="dashboard_inline">
                <div id="one" class="e-panel" data-row="0" data-col="0" data-sizeX="1" data-sizeY="1">
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
                <div id="two" class="e-panel" data-row="0" data-col="1" data-sizeX="3" data-sizeY="2">
                    <div class="e-panel-container">
                        <div class="content">1</div>
                    </div>
                </div>
                <div id="three" class="e-panel" data-row="0" data-col="4" data-sizeX="1" data-sizeY="3">
                    <div class="e-panel-container">
                        <div class="content">2</div>
                    </div>
                </div>
                <div id="four" class="e-panel" data-row="1" data-col="0" data-sizeX="1" data-sizeY="1">
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
                <div id="five" class="e-panel" data-row="2" data-col="0" data-sizeX="2" data-sizeY="1">
                    <div class="e-panel-container">
                        <div class="content">4</div>
                    </div>
                </div>
                <div id="six" class="e-panel" data-row="2" data-col="2" data-sizeX="1" data-sizeY="1">
                    <div class="e-panel-container">
                        <div class="content">5</div>
                    </div>
                </div>
                <div id="seven" class="e-panel" data-row="2" data-col="3" data-sizeX="1" data-sizeY="1">
                    <div class="e-panel-container">
                        <div class="content">6</div>
                    </div>
                </div>
            </div>

        </div>
        <script src="Scripts/dashboard.js"></script>


    </div>
</div>
