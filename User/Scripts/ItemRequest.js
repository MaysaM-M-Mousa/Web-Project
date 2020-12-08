/*  ---------------------------------------------------
    Description: Item Request Scripts

         1. Back Button Handling
         2. Sub Category Ajax


---------------------------------------------------------  */

(function ($){


    //1. Back Button Handling
    $(document).ready(function (){
        $(".back-btn").on("click",function (){
            $("#content").load("Features/ItemRequest/ItemRequestCategories.php", "data1");
        } )
    });
    // 2. Sub Category Ajax
    $(document).ready(function (){
        $("#cat1").on("click",function (){
            $("#content").load("Features/ItemRequest/ItemRequestSub.php", "data1");
        } )
    });

})(jQuery);