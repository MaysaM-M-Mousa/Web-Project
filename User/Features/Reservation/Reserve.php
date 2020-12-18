<?php
// validation for user SESSIONS

sleep(1);

?>


<!--Form Styling -->
<link rel="stylesheet" href="CSS/signup.css">
<!--Date Picker-->
<script src="../Vendor/DatePicker/ej2-base/dist/global/ej2-base.min.js" type="text/javascript"></script>
<script src="../Vendor/DatePicker/ej2-inputs/dist/global/ej2-inputs.min.js" type="text/javascript"></script>
<script src="../Vendor/DatePicker/ej2-buttons/dist/global/ej2-buttons.min.js" type="text/javascript"></script>
<script src="../Vendor/DatePicker/ej2-popups/dist/global/ej2-popups.min.js" type="text/javascript"></script>
<script src="../Vendor/DatePicker/ej2-lists/dist/global/ej2-lists.min.js" type="text/javascript"></script>
<script src="../Vendor/DatePicker/ej2-calendars/dist/global/ej2-calendars.min.js" type="text/javascript"></script>

<div class="container">
    <section>
        <h1 class="main-h1">Reservation</h1>
        <hr class="line">
        <p class="main-content">
            Book your stay with us directly and enjoy the best possible rate and early check in and late check out.
            The best offer you will find, guaranteed.
        </p>
    </section>
    <div class="row justify-content-center">
        <div class="col-11 col-sm-11 col-md-11 col-lg-11 col-xl-11 text-center p-0 mt-3 mb-2">
            <div class="px-0 pt-4 pb-0 mt-3 mb-3">
                <!-- Form Starts Here-->
                <form name="bookingForm" id="bookingForm">
                    <!--Start progressbar -->
                    <ul id="progressbar" class="d-none d-sm-block">
                        <li class="active" id="account"><strong>Period</strong></li>
                        <li id="room"><strong>Rooms</strong></li>
                        <li id="confirm"><strong>Finish</strong></li>
                    </ul>
                    <!--End progressbar -->
                    <!--Start DatePicker -->
                    <fieldset>
                        <div class="row">
                            <div class="col-7">
                                <h2 class="fs-title"> Duration Of Stay:</h2>
                            </div>
                            <div class="col-5">
                                <h2 class="steps">Step 1 - 3</h2>
                            </div>
                            <hr class="line">

                        </div>
                        <div id="date" class="row mt-5">
                            <div class="col-8 offset-2">
                                <input id="daterangepicker" name="date" type="text">
                            </div>
                        </div>
                        <div class="row">
                            <span id="errorDate" class="error"><i class="fas fa-exclamation-circle"></i> Please Fill All Fields Here</span>
                        </div>
                        <input type="button" onclick="validateForm()" name="next" class="next next0 action-button" value="Next"/>
                    </fieldset>
                    <!--End DatePicker -->
                    <fieldset>
                        <div class="row">
                            <div class="col-7">
                                <h2 class="fs-title">Room Type:</h2>
                            </div>
                            <div class="col-5">
                                <h2 class="steps">Step 2 - 3</h2>
                            </div>
                            <hr class="line">

                        </div>
                        <!--Start Room Section -->
                        <section>
                            <div class="container-fluid no-gutters">
                                <div class="room-items no-gutters">
                                    <div class="row">
                                        <div class="col-lg-3 col-md-6 col-12">
                                            <!--Start First Room-->
                                            <div class="room-item"
                                                 style="background-image: url('../Home/images/room-b1.jpg')">
                                                <input checked="checked" class="room-radio" type="radio" onclick="roomSelect()"
                                                       name="room" value="1"
                                                       id="room_1" checked="checked">
                                                <div class="bg-active"></div>
                                                <div class="hr-text">
                                                    <h3>Single Room</h3>
                                                    <h2>150$<span>/Pernight</span></h2>
                                                    <a href="#" style="visibility: hidden" class="primary-link">More
                                                        Details</a>
                                                </div>
                                            </div>
                                        </div>
                                        <!--Start Second Room-->
                                        <div class="col-lg-3 col-md-6 col-12">
                                            <div class="room-item"
                                                 style="background-image: url('../Home/images/room-b2.jpg')">
                                                <input class="room-radio" type="radio" onclick="roomSelect()"
                                                       name="room" value="2"
                                                       id="room_2">
                                                <div class="bg-active"></div>
                                                <div class="hr-text">
                                                    <h3>Double Room</h3>
                                                    <h2>200$<span>/Pernight</span></h2>
                                                    <a href="#" style="visibility: hidden" class="primary-link">More
                                                        Details</a>
                                                </div>
                                            </div>
                                        </div>
                                        <!--Start Third Room-->
                                        <div class="col-lg-3 col-md-6 col-12">
                                            <div class="room-item"
                                                 style="background-image: url('../Home/images/room-b3.jpg')">
                                                <input class="room-radio" onclick="roomSelect()" type="radio"
                                                       name="room" value="4"
                                                       id="room_3">
                                                <div class="bg-active"></div>
                                                <div class="hr-text">
                                                    <h3>Quad Room</h3>
                                                    <h2>250$<span>/Pernight</span></h2>
                                                    <a href="#" style="visibility: hidden" class="primary-link">More
                                                        Details</a>
                                                </div>
                                            </div>
                                        </div>
                                        <!--Start fourth Room-->
                                        <div class="col-lg-3 col-md-6 col-12">
                                            <div class="room-item"
                                                 style="background-image: url('../Home/images/room-b4.jpg')">
                                                <input class="room-radio" onclick="roomSelect()" type="radio"
                                                       name="room" value="6"
                                                       id="room_4">
                                                <div class="bg-active"></div>
                                                <div class="hr-text">
                                                    <h3>King Room </h3>
                                                    <h2>350$<span>/Pernight</span></h2>
                                                    <a href="#" style="visibility: hidden" class="primary-link">More
                                                        Details</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <!--End Room Section-->
                        <!--Start Booking Options Section-->
                        <section class="mt-5">
                            <div class="section over-hide z-bigger">
                                <input class="checkbox" type="checkbox" name="general" id="general">
                                <label class="for-checkbox" for="general"></label>
                                <div class="background-color"></div>
                                <div class="section over-hide z-bigger">
                                    <div class="container pb-2">
                                        <div class="row justify-content-center pb-5">
                                            <hr class="line">
                                            <div class="col-12">
                                                <p class="mb-2 pb-2 fs-title">Booking Options:</p>
                                            </div>
                                            <div class="col-12 pb-2">
                                                <input class="checkbox-booking" type="checkbox" name="booking"
                                                       id="booking-1">
                                                <label class="for-checkbox-booking" for="booking-1">
                                                    <i class='far fa-coffee mr-3'></i><span
                                                            class="text">breakfast</span>
                                                </label>

                                                <input class="checkbox-booking"
                                                       type="checkbox"
                                                       name="booking" id="booking-2">
                                                <label class="for-checkbox-booking" for="booking-2">
                                                    <i class='far fa-egg-fried mr-3'></i><span
                                                            class="text">dinner</span>
                                                </label>

                                                <input class="checkbox-booking"
                                                       type="checkbox"
                                                       name="booking" id="booking-4">
                                                <label class="for-checkbox-booking" for="booking-4">
                                                    <i class='far fa-flower mr-3'></i><span class="text">garden</span>
                                                </label>

                                                <input class="checkbox-booking"
                                                       type="checkbox"
                                                       name="booking" id="booking-5">
                                                <label class="for-checkbox-booking" for="booking-5">
                                                    <i class='far fa-wifi mr-3'></i><span class="text">internet</span>
                                                </label>

                                                <input class="checkbox-booking"
                                                       type="checkbox"
                                                       name="booking" id="booking-6">
                                                <label class="for-checkbox-booking" for="booking-6">
                                                    <i class='far fa-parking mr-3'></i><span class="text">parking</span>
                                                </label>

                                                <input class="checkbox-booking"
                                                       type="checkbox"
                                                       name="booking" id="booking-7">
                                                <label class="for-checkbox-booking" for="booking-7">
                                                    <i class='far fa-tv mr-3'></i><span class="text">television</span>
                                                </label>

                                                <input class="checkbox-booking"
                                                       type="checkbox"
                                                       name="booking" id="booking-8">
                                                <label class="for-checkbox-booking" for="booking-8">
                                                    <i class='far fa-book-open mr-3'></i><span class="text">books</span>
                                                </label>
                                                <input class="checkbox-booking"
                                                       type="checkbox"
                                                       name="booking" id="booking-10">
                                                <label class="for-checkbox-booking" for="booking-10">
                                                    <i class='far fa-glass-martini mr-3'></i><span
                                                            class="text">drink</span>
                                                </label>
                                                <input class="checkbox-booking"
                                                       type="checkbox"
                                                       name="booking" id="booking-11">
                                                <label class="for-checkbox-booking" for="booking-11">
                                                    <i class='far fa-dumbbell mr-3'></i><span class="text">gym</span>
                                                </label>
                                                <input class="checkbox-booking"
                                                       type="checkbox"
                                                       name="booking" id="booking-12">
                                                <label class="for-checkbox-booking" for="booking-12">
                                                    <i class='far fa-sign mr-3'></i><span
                                                            class="text">walking tours</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <!--End Booking Options Section-->
                        <input type="button" onclick="reserveARoom()" name="next" class="next next0 action-button" value="Next"/>
                        <input type="button" name="previous" class="previous action-button-previous" value="Previous"/>
                    </fieldset>
                    <!--Start Finish Section -->
                    <fieldset>
                        <div class="row ">
                            <div class="col-7">
                                <h2 class="fs-title">Finish:</h2>
                            </div>
                            <div class="col-5">
                                <h2 class="steps">Step 3 - 3</h2>
                            </div>
                            <hr class="line">
                        </div>
                        <br><br>
                        <h1 class="display-3" style="color:#B79040">Thank You!</h1>
                        <br>
                        <div class="row">
                            <div class="col-12 col-md-10 offset-md-1 justify-content-center"><p class="pb-5">
                                    Thank you for choosing our hotel.
                                    <br/>
                                    <br/>

                                    Our staff is ready to make your stay unforgettable.Please feel free to contact us
                                    for any special requests you may have, so we can make all necessary arrangements
                                    before your arrival.
                                    <br/>
                                    <br/>
                                    We wish you a good trip and we are looking forward for welcoming you very soon.
                                    <br/>

                                </p>
                                <p>
                                    Having trouble? <a href="">Contact us</a>
                                </p>
                            </div>
                        </div>
                        <hr class="line" style="width: 60%">

                    </fieldset>
                    <!--End Finish Section-->
                </form>
            </div>
        </div>
    </div>
</div>
<script src="Scripts/Reserve.js" type="text/javascript"></script>


