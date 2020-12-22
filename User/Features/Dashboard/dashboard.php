<?php
require 'pdo.php';
sleep(1);
session_start();

if (!isset($_SESSION['person_id']) || !isset($_SESSION['person_role']) || !isset($_SESSION['activated']) || $_SESSION['activated'] != 1) {
    header("Location: ../../../Home/HTML/index.php");
    return;
}


$sql = "select * from booking,room where booking.person_id = ".$_SESSION['person_id']." and booking.room_id=room.room_id order by end_date DESC";
$result = $pdo->query($sql);
$sub="Null";
$room="You Dont have Any rooms Registered";
$wifi="Please Reserve a Room to enjoy free wifi";
if($result->rowCount()>0){
    $row = $result->fetch(PDO::FETCH_ASSOC);
    $sub= "You can Enjoy your stay with us Until ". $row['end_date'] ;
    $room= "Your Room Number is ". $row['room_number'];
    $wifi="Wifi Code for your room is :987852";
}
else
    $sub= "You dont have any active reservations";

?>

<section class="section-invert dashboard-section animate__animated animate__fadeIn">
    <div class="container-fluid">
        <div class="row">
            <div class="col-8 offset-2 animate__animated animate__fadeIn">
                <h1 class="main-h1">Welcome</h1>
                <hr class="line">
                <p class="main-content">
                    Discover the exceptional luxury experience we’ve been refining since 1972. Explore a
                    collection of
                    exclusive special offers and curated getaways that will elevate your next visit to the Old
                    City.
                </p>
            </div>
        </div>
        <div class="row">
            <div class="animate__animated animate__zoomIn col-lg-4 col-sm-12 col-md-6 px-0">
                <div class="dashboard-item">
                    <i class="far fa-hotel my-3" style="font-size: 50px"></i>
                    <h4>Reservation</h4>
                    <p><?php echo $sub ?></p>
                </div>
            </div>
            <div class="animate__animated animate__zoomIn animate__delay-1s col-lg-4 col-sm-12 col-md-6 px-0">
                <div class="dashboard-item dashboard-item-odd">
                    <i class="fal fa-key my-3" style="font-size: 50px"></i>
                    <h4>Room</h4>
                    <p><?php echo $room ?></p>
                </div>
            </div>
            <div class="animate__animated animate__zoomIn animate__delay-2s col-lg-4 col-sm-12 col-md-6 px-0">
                <div class="dashboard-item">
                    <i class="fal fa-wifi my-3" style="font-size: 50px"></i>
                    <h4>Free Wifi</h4>
                    <p><?php echo $wifi ?></p>
                </div>
            </div>
            <div class="animate__animated animate__zoomIn animate__delay-3s col-lg-4 col-sm-12 col-md-6 px-0">
                <div class="dashboard-item dashboard-item-odd">
                    <i class="fal fa-user-alt my-3" style="font-size: 50px"></i>
                    <h4>Discover Your Account</h4>
                    <p>Check Out the incredible advantages of having Hotel account by navigating the Sidemenu sections.</p>
                </div>
            </div>
            <div class="animate__animated animate__zoomIn animate__delay-4s col-lg-4 col-sm-12 col-md-6 px-0">
                <div class="dashboard-item">
                    <i class="fal fa-taxi my-3" style="font-size: 50px"></i>
                    <h4>Hire Driver</h4>
                    <p>We Will arrange everything for you, just tell one of the staff and be there in time..</p>
                </div>
            </div>
            <div class="animate__animated animate__zoomIn animate__delay-5s col-lg-4 col-sm-12 col-md-6 px-0">
                <div class="dashboard-item dashboard-item-odd">
                    <i class="fal fa-map my-3" style="font-size: 50px"></i>
                    <h4>Daily City Tour</h4>
                    <p>Dont miss our specialized tutors' tours round all the nice places in the city.</p>
                </div>
            </div>
        </div>
    </div>
</section>