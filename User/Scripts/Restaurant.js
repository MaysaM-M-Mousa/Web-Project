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
                $('#back-btn').on("click", function () {
                    $("#content").load("Features/Restaurant/RestaurantCategories.php", "data1");
                });

                $(".order-btn").on("click",function () {
                    if($(this).hasClass("toggled-button")){
                        $(this).siblings(":last").click();
                    }
                    else
                    $(this).addClass("toggled-button");

                });
            }
        })
}
function orderItem(item_id, quantity) {
    $.post('Features/Restaurant/RestaurantSub.php', {
        'item_id': item_id,
        'quantity':quantity
    }, function (data, status) {
        if (status === 'success') {
            document.getElementById('MSGTITLE').innerHTML = "Thank You!";
            document.getElementById('MSGBODY').innerHTML = "We will deliver this item to your room in the shortest time Possible";
            $("#trigermsg").click();
            countdown();
        }
    })
}
var seconds = 5;
function countdown() {
    seconds = seconds - 1;
    if (seconds < 0) {
        // Chnage your redirection link here
    $("#msg").modal('hide');

    } else {
        // Update remaining seconds
        // Count down using javascript
        window.setTimeout("countdown()", 1000);
    }
}