
<div class="container-fluid">
<!--    Header start-->
    <div class="row">
        <div class="col-8 offset-2">
            <h1 class="main-h1">Item Request</h1>
            <hr class="line">
            <p class="main-content">
                Our Always-On-Duty staff are Happy to serve You what ever you need the moment you order it, making you feel Home-comfort is our pressure.
            </p>
        </div>
    </div>
<!-- Header end-->

<!-- Cards Start -->
    <div class="row">
    <?php
    for ($i = 0; $i < 4; $i++) {
        ?>
            <div id="cat1" class="card Catagories col-10 offset-1 col-xl-5 pr-0 <?php if($i%2==0) echo 'offset-xl-1'; else echo 'ml-xl-0 offset-xl-0';?>">
                <div class="container-fluid no-gutters">
                    <div class="row">
                        <img class="col-md-4 col-12 pr-0" src="../../Home/images/insta-1.jpg"
                                                     alt="...">
                        <div class="card-body col-12 col-md-8">
                            <h3 class="main-h3 card-title">Category 1</h3>
                            <hr class="card-line">
                            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to
                                additional
                                content. This content is a little bit longer.</p>
                        </div>
                    </div>
                </div>
            </div>
        <?php
    }
    ?>
    </div>
 <!--Card end-->
    <script src="Scripts/ItemRequest.js" type="text/javascript"></script>
</div>
