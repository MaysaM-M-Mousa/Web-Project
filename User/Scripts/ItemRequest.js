/*  ---------------------------------------------------
    Description: Item Request Scripts

         1. Back Button Handling
         2. Sub Category Ajax


---------------------------------------------------------  */

(function ($) {


    //1. Back Button Handling
    $(document).ready(function () {

    });
    // 2. Sub Category Ajax
    $(document).ready(function () {
        $("#cat1").on("click", function () {
            $("#content").load("Features/ItemRequest/ItemRequestSub.php", "data1");
        })
    });

})(jQuery);

function goToItemReqSub(cat_id) {
    $.post('Features/ItemRequest/ItemRequestSub.php', {
            'subCatChosen': 'subCatChosen',
            'cat_id': cat_id
        },
        function (data, status) {
            if (status === 'success') {
                document.getElementById('content').innerHTML = data;
                $(".back-btn").on("click", function () {
                    $("#content").load("Features/ItemRequest/ItemRequestCategories.php", "data1");
                })
            }
        }
    )
}

function goToItemReqItems(sub_cat_id) {
    $.post('Features/ItemRequest/ItemRequestItems.php', {
        'itemChosen': 'itemChosen',
        'sub_cat_id': sub_cat_id
    }, function (data, status) {
        if (status === 'success') {
            document.getElementById('content').innerHTML = data;
            $(".back-btn").on("click", function () {
                $("#content").load("Features/ItemRequest/ItemRequestSub.php", "data1");
            })
        }
    })
}

function orderItem(item_id, quantity) {
    $.post('Features/ItemRequest/ItemRequestItems.php', {
        'item_id': item_id,
        'quantity': quantity
    }, function (data, status) {
        if (status === 'success') {
            document.getElementById('content').innerHTML = data;
        }
    })
}


