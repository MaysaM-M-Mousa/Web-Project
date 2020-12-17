/*  ---------------------------------------------------
    Description: Restaurant Scripts

         1. Flexslider initialize
         2. Back Button Handling
         3. Sub Category Ajax

---------------------------------------------------------  */

(function ($) {

    // 1. Flexslider initialize
    $(document).ready(function () {
        $('.flexslider').flexslider({
            animation: "slide"
        });
    });
    //2. Back Button Handling
    $(document).ready(function () {
        $(".back-btn").on("click", function () {
            $("#content").load("Features/Restaurant/RestaurantCategories.php", "data1");
        })
    });
    // 3. Sub Category Ajax
    $(document).ready(function () {
        // $("#cat1").on("click",function (){
        //     $("#content").load("Features/Restaurant/RestaurantSub.php", "data1");
        // } )

    });

})(jQuery);

function goToCategory(sub_cat_id) {
    $.post('Features/Restaurant/RestaurantSub.php', {
            'catChosen': 'catChosen',
            'sub_cat_id': sub_cat_id
        },
        function (data, status) {
            if (status === 'success') {
                document.getElementById('content').innerHTML = data;
            }
        })
}
function orderItem(item_id, quantity) {
    $.post('Features/Restaurant/RestaurantSub.php', {
        'item_id': item_id,
        'quantity':quantity
    }, function (data, status) {
        if (status === 'success') {
            document.getElementById('content').innerHTML = data;
        }
    })
}