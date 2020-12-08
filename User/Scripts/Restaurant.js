/*  ---------------------------------------------------
    Description: Restaurant Scripts

         1. Flexslider initialize
         2. Back Button Handling
         3. Sub Category Ajax

---------------------------------------------------------  */

(function ($){

    // 1. Flexslider initialize
    $(document).ready(function () {
        $('.flexslider').flexslider({
            animation: "slide"
        });
    });
    //2. Back Button Handling
    $(document).ready(function (){
        $(".back-btn").on("click",function (){
            $("#content").load("Features/Restaurant/RestaurantCategories.php", "data1");
        } )
    });
    // 3. Sub Category Ajax
    $(document).ready(function (){
        $("#cat1").on("click",function (){
            $("#content").load("Features/Restaurant/RestaurantSub.php", "data1");
        } )
    });


})(jQuery);