<div class="container-fluid">

    <!--Back Button-->
    <div class="back-btn">
        <i class="fal fa-arrow-left"></i>
    </div>

    <!--Header-->
    <div class="row">
        <div class="col-8 offset-2">
            <h2 class="main-h2 mt-5">Categorie 1</h2>
            <hr class="line">
        </div>
    </div>

    <!--Cards-->
    <?php
    for ($i = 0; $i < 3; $i++) {
        echo '<div class="row">'; ?>
        <?php for ($j = 0; $j < 4; $j++) {
            ?>
            <div class="card card-food col-10 offset-1 col-xl-5 pr-0 ">
                <div class="container-fluid no-gutters">
                    <div class="row">
                        <img class="col-4 pr-0" src="../Home/images/insta-1.jpg"
                             alt="...">
                        <div class="card-body col-8">
                            <div class="price"><div class="price-text">15$                            <hr class="card-line">
                                </div>
                            </div>
                            <h3 class="main-h3 card-title">Category 1</h3>
                            <hr class="card-line"/>
                            <p class="card-text">This is a wider card with supporting text below as a natural lead-in
                                to</p>
                            <button class="order btn btn-primary col-12">Order Now</button>

                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
        <?php echo '</div>' ?>
    <?php } ?>

    <script src="Scripts/ItemRequest.js" type="text/javascript"></script>
</div>


