<div class="container-fluid">
    <div class="row">
        <div class="col-8 offset-2">
            <h1 class="main-h1">Restaurant</h1>
            <hr class="line">
            <p class="main-content">
                At La Terra Santa, we serve a tasting menu that highlights the best produce we can source
                from across the Country, with ideas and inspirations from around the world.
            </p>
        </div>
    </div>

    <div class="row mt-2">
        <section class="slider col-12 col-md-10 offset-md-1">
            <div class="flexslider">
                <ul class="slides">
                    <li style="background-image: url('../images/restaurnat-1.jpg')"></li>
                    <li style="background-image: url('../images/restaurnat-2.jpg')"></li>
                    <li style="background-image: url('../images/restaurant-3.jpg')"></li>
                </ul>
            </div>
        </section>
        <div class="col-8 offset-2">
            <h2 class="main-h2 mt-5">Categories</h2>
            <hr class="line">
        </div>
    </div>
    <div class="row">
    <?php
    for ($i = 0; $i < 4; $i++) {
        ?>
            <div onclick="goToCategory()" class="card Catagories col-10 offset-1 col-xl-5 pr-0 <?php if($i%2==0) echo 'offset-xl-1'; else echo 'ml-xl-0 offset-xl-0';?>">
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
</div>

<script>
    $(document).ready(function () {
        $('.flexslider').flexslider({
            animation: "slide"
        });
    });

</script>
