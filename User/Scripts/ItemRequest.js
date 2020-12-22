/*  ---------------------------------------------------
    Description: Item Request Scripts

         1. Back Button Handling
         2. Sub Category Ajax


---------------------------------------------------------  */

(function ($) {


    //1. Back Button Handling

    // 2. Sub Category Ajax
    $(document).ready(function () {
        $("#cat1").on("click", function () {
            $("#content").load("Features/ItemRequest/ItemRequestSub.php", "data1");
        })
    });


})(jQuery);

function goToItemReqSub(cat_id,cat_name) {
    localStorage.setItem('selectedCat',cat_id );
    localStorage.setItem('selectedCatName',cat_name );

    $.post('Features/ItemRequest/ItemRequestSub.php', {
            'subCatChosen': 'subCatChosen',
            'cat_id': cat_id
        },
        function (data, status) {
            if (status === 'success') {
                document.getElementById('content').innerHTML = data;
                document.getElementById('headerCat').innerHTML = cat_name;

                $(".back-btn").on("click", function () {
                    $("#content").load("Features/ItemRequest/ItemRequestCategories.php", "data1");
                })
            }
        }
    )
}

function goToItemReqItems(sub_cat_id,sub_cat_name) {
    $.post('Features/ItemRequest/ItemRequestItems.php', {
        'itemChosen': 'itemChosen',
        'sub_cat_id': sub_cat_id
    }, function (data, status) {
        if (status === 'success') {
            document.getElementById('content').innerHTML = data;
            document.getElementById('headerCat').innerHTML = sub_cat_name;

            $(".back-btn").on("click", function () {
                goToItemReqSub(localStorage.getItem('selectedCat'),localStorage.getItem('selectedCatName'));
            });
            $(".order-btn").on("click",function () {
                if($(this).hasClass("toggled-button")){
                    $(this).siblings(":last").click();
                }
                else {
                    $(".order-btn").removeClass("toggled-button");

                    $(this).addClass("toggled-button");
                }
            });
        }
    })
}
var seconds = 5;

function orderItem(item_id, quantity) {
    $.post('Features/ItemRequest/ItemRequestItems.php', {
        'item_id': item_id,
        'quantity': quantity
    }, function (data, status) {
        if (status === 'success') {
            document.getElementById('MSGTITLE').innerHTML = "Thank You!";
            document.getElementById('MSGBODY').innerHTML = "We will deliver the meal to your room in the shortest time Possible";
            $("#trigermsg").click();
            seconds = 4;
            countdown();
        }
    })
}


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