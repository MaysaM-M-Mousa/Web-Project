/*  ---------------------------------------------------
    Description: Admin Section Main Scripts

         1. SideBar Start
         2. Ajax loader
         3. DashBoard On Start
         4. Ajax Requests
         5. Reservation Ajax
         6. Restaurant Ajax
         7. ItemRequest Ajax
         8. Settings Ajax
         9. Log Out

---------------------------------------------------------  */

(function ($) {
    // 3. Load DashBoard On Start
    $(document).ready(function () {
        $("#content").load("Features/Dashboard/dashboard.php");
        $("#dashboard").addClass("active");
    })
    $(document).ready(function () {
        "use strict";
        var fullHeight = function () {
            $('.js-fullheight').css('height', $(window).height());
            $(window).resize(function () {
                $('.js-fullheight').css('height', $(window).height());
            });
        };
        fullHeight();
// 1. SideBar Start
        $('#sidebarCollapse').on('click', function () {
            if (window.innerWidth > 992) {
                $('#sidebar').toggleClass('active');
                submenu();
            } else {
                $('#sidebar').toggleClass('active-mobile');
            }
        });
        $(".sidebar-dropdown > a").on("click", submenu);
        $("#content").on("click", submenu);

        $(".sidebar-dropdown > i").on("click", function (event) {
            var menu_id = "#" + event.target.id;
            if (!$('#sidebar').hasClass('active') || window.innerWidth > 992) {
                $(".sidebar-submenu").removeAttr('style');
                if ($(menu_id).siblings(":last").hasClass("hoverMenu")) {
                    $(menu_id).siblings(":last").removeClass("hoverMenu");
                    $(".sub-line").css("display", "block");

                } else {
                    $(".sidebar-submenu").removeClass("hoverMenu");
                    $(menu_id).siblings(":last").addClass("hoverMenu");
                    $(".sub-line").css("display", "none");
                    $(".catagories").css("color", "#eeeeee");
                    $(".cat-menu").css("display", "none");
                    $(menu_id).siblings(":last").slideDown(200);
                }
            }
        });
        $(".catagories").on("click", function () {
            if ($(this).siblings(":last").hasClass("active")) {
                $(this).siblings(":last").removeClass("active");
                $(this).siblings(":last").slideUp(200);
            } else {
                $(this).siblings(":last").addClass("active");
                $(this).siblings(":last").slideDown(200);
            }
        })

        function submenu() {
            $(".sidebar-submenu").slideUp(200);
            if ($(this).parent().hasClass("active")) {
                $(".sidebar-dropdown").removeClass("active");
                $(this).parent().removeClass("active");
            } else {
                $(".sidebar-dropdown").removeClass("active");
                if ($('#sidebar').hasClass('active')) {
                    $(this).next(".sidebar-submenu").slideDown(200);
                }
                $(this).parent().addClass("active");
            }
        }

        // for log out icon
        $("#logOutItem").click(function () {
            window.location.replace("../PHP/LogOut/logout.php");
        })

        $("#Rooms").click(function () {
            $('#content').load('Features/Room/AllRooms.php');
        })

        $("#dashboard").click(function () {
            $("#content").load("Features/Dashboard/dashboard.php");
            $("#dashboard").addClass("active");
        })
        $("#addRoom").click(function () {
            $('#content').load('Features/Room/addRoom.php');
        })
        $("#addEmployee").click(function () {
            $('#content').load('Features/Staff/AddStaff.php');
        })
        $("#allEmployees").click(function () {
            $('#content').load('Features/Staff/AllStaff.php');
        })
    });

// when categories.php is loaded, each category card has Browse btn, this function handles the event when it's clicked
// it will invoke the cards for the particular category
// function goToCategory() {
//     $("#content").load("../Features/Restaurant/category.php", "data1");
// }

// AJAX for Contacts Feature
    $("#contactLink").click(function () {
        $.ajax({
            type: 'POST',
            url: 'Features/Contacts/Contacts.php',
            success: function (data) {
                $("#content").html(data);
            }
        })

    })


// AJAX for Job Applications
    $("#jobLink").click(function () {
        $("#content").load('Features/JobApplications/JobApps.php');
    })


// AJAX for customer item
    $("#customerLink").click(function () {
        $("#content").load('Features/Users/AllUsers.php');
    })
    $("#ordersLink").click(function () {
        $("#content").load('Features/Orders/allOrders.php');
    })
})(jQuery);

//End jQuery


function deleteJobCard(form_id, counter) {
    var mainDivID = 'cardJobDiv' + counter;
    document.getElementById(mainDivID).style.display = 'none';
    $.post('Features/JobApplications/JobApps.php', {
        'deleteForm': 'deleteForm',
        'form_id': form_id
    })
}

function jobSearch() {
    document.getElementById('searchJobResult').innerHTML =
        '<img width="55px" height="50px" style="position: absolute;top: 50%;left: 50%;transform: translate(-50%,-50%)' +
        '" src="images/VZvw.gif">';

    var searchBar = document.getElementById('searchJobBar').value;
    var filter = document.getElementById('searchAppsFilter').value;
    var orderBy = document.getElementById('searchAppsOrdering').value;
    var repliedFlag = document.getElementById('repliedAppCB').checked;
    $.ajax({
        type: 'POST',
        data: {
            'searchBar': searchBar,
            'filter': filter,
            'order_by': orderBy,
            'replied': repliedFlag
        },
        url: 'Features/JobApplications/SearchJobApps.php',
        success: function (data) {
            $("#searchJobResult").html(data);
            let count = $("#counter").attr('class');
        }
    })

}

function sendEmailJobBTN(form_id, counter) {
    var divID = 'MSG' + counter;
    var emailMSG = 'reply' + counter;
    var emailSender = 'emailSender' + counter;
    var statusID = 'status' + counter;
    var edit = editor[counter];
    document.getElementById(statusID).innerHTML = '<img width="35px" height="30px"  src="../images/VZvw.gif">';
    $.post('Features/JobApplications/JobApps.php', {
        'sendReplyJobEmail': 'sendReplyJobEmail',
        'emailSender': document.getElementById(emailSender).innerText,
        'email_message': edit.root.innerHTML,
        'form_id': form_id
    }, function (data, status) {
        if (status === 'success') {
            document.getElementById(divID).innerHTML = data;
            document.getElementById(statusID).innerHTML = '<i class="fa fa-check"></i> Replied';
        }
    })
}


function deleteContactCard(contact_id, counter) {
    var mainDivID = 'cardContactDiv' + counter;
    document.getElementById(mainDivID).style.display = 'none';
    $.post('Features/Contacts/Contacts.php', {
        'deleteContact': 'deleteContact',
        'contact_id': contact_id
    })

}

function contactSearch() {

    // centering the GIF in the center till response
    document.getElementById('searchContactResult').innerHTML =
        '<img width="55px" height="50px" style="position: absolute;top: 50%;left: 50%;transform: translate(-50%,-50%)' +
        '" src="images/VZvw.gif">';

    var searchBar = document.getElementById('searchContactBar').value;
    var filter = document.getElementById('searchContactFilter').value;
    var orderBy = document.getElementById('searchContactOrdering').value;
    var repliedFlag = document.getElementById('repliedContactCB').checked;
    $.ajax({
        type: 'POST',
        data: {
            'searchBar': searchBar,
            'filter': filter,
            'order_by': orderBy,
            'replied': repliedFlag
        },
        url: 'Features/Contacts/SearchContacts.php',
        success: function (data) {
            $("#searchContactResult").html(data);
            let count = $("#counter").attr('class');
        }
    })
}

// contact email
function sendEmailBTN(contact_id, counter) {
    var divID = 'MSG' + counter;
    var emailMSG = 'email_message' + counter;
    var emailSender = 'emailSender' + counter;
    var statusID = 'status' + counter;
    var edit = editor[counter];
    document.getElementById(statusID).innerHTML = '<img width="35px" height="30px"  src="../images/VZvw.gif">';
    console.log(divID);
    $.post('Features/Contacts/Contacts.php', {
        'sendReplyEmail': 'sendReplyEmail',
        'emailSender': document.getElementById(emailSender).innerText,
        'email_message': edit.root.innerHTML,
        'contact_id': contact_id
    }, function (data, status) {
        if (status === 'success') {
            document.getElementById(divID).innerHTML = data;
            document.getElementById(statusID).innerHTML = '<i class="fa fa-check"></i> Replied';
        }
    })
}

function roomSearch() {
    document.getElementById('searchRoomResult').innerHTML =
        '<img width="55px" height="50px" style="position: absolute;top: 50%;left: 50%;transform: translate(-50%,-50%)' +
        '" src="images/VZvw.gif">';

    var searchBar = document.getElementById('searchRoomBar').value;
    var filter = document.getElementById('searchRoomFilter').value;
    var orderBy = document.getElementById('searchRoomOrdering').value;
    var takenFlag = document.getElementById('takenRoomCB').checked;

    $.get('Features/Room/SearchRoom.php', {
        'searchBar': searchBar,
        'filter': filter,
        'order_by': orderBy,
        'taken': takenFlag
    }, function (data, status) {
        if (status === 'success') {
            document.getElementById('searchRoomResult').innerHTML = data;
        }
    })
}


function deleteRoom(room_id) {
    document.getElementById('content').innerHTML =
        '<img width="55px" height="50px" style="position: absolute;top: 50%;left: 50%;transform: translate(-50%,-50%)' +
        '" src="images/VZvw.gif">';

    $.post('Features/Room/DeleteRoom.php', {
        'deleteRoom': 'deleteRoom',
        'room_id': room_id
    }, function (data, status) {
        document.getElementById('content').innerHTML = data;
    })
}

// AJAX for Services

// 1.AJAX for Categories Menu

$("#AllCategoriesLink").click(function () {
    $.ajax({
        type: 'POST',
        url: 'Features/Services/Categories/AllCategories.php',
        success: function (data) {
            $("#content").html(data);
            if ($("#categoriesTable").length > 0) {
                var table = $('#categoriesTable').DataTable({
                    "scrollX": true,
                    responsive: true
                });
            }
        }
    })
});

$("#AddCategoriesLink").click(function () {

    $.ajax({
        type: 'POST',
        url: 'Features/Services/Categories/AddCategory.php',
        success: function (data) {
            $("#content").html(data);
            $("#form1").dropzone({url:"Features/Services/Categories/AddCategory.php"});
        }
    })
})

function addCategoryBTN() {
    // $.post('Features/Services/Categories/AddCategory.php', {
    //     'category_name': document.getElementById('categoryName').value,
    //     'description': document.getElementById('categoryDescription').value,
    //     'image': 'none'
    // }, function (data, status) {
    //     if (status === 'success') {
    //         document.getElementById('addCatResult').innerHTML = data;
    //     }
    // })

    var data = new FormData();
    data.append('category_name', document.getElementById('categoryName').value);
    data.append('description', document.getElementById('categoryDescription').value);
    data.append('image', 'none');
    data.append('image2', $('input[type=file]')[0].files[0]);

    alert($('input[type=file]')[0].files[0]);
    $.ajax({
        type: 'POST',
        url: 'Features/Services/Categories/AddCategory.php',
        data: data,
        success: function (data) {
            $("#content").html(data);
        }, contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
        processData: false, // NEEDED, DON'T OMIT THIS

    })
}

function EditCategory(cat_id) {
    $.ajax({
        type: 'POST',
        data: {
            'editCategory': 'editCategory',
            'cat_id': cat_id
        },
        url: 'Features/Services/Categories/EditCategory.php',
        success: function (data) {
            $("#content").html(data);
            if ($("#back-btn").length > 0) {
                $("#back-btn").click(function () {
                    $.ajax({
                        type: 'POST',
                        url: 'Features/Services/Categories/AllCategories.php',
                        success: function (data) {
                            $("#content").html(data);
                            if ($("#categoriesTable").length > 0) {
                                var table = $('#categoriesTable').DataTable({
                                    "scrollX": true,
                                    responsive: true
                                });
                            }
                        }
                    })
                });
            }
        }
    })
}

function submitChangingCategory(cat_id) {
    $.post('Features/Services/Categories/EditCategory.php', {
        'category_name_Edit': document.getElementById('categoryNameEdit').value,
        'description_Edit': document.getElementById('categoryDescriptionEdit').value,
        'image_Edit': 'none',
        'cat_id_Edit': cat_id
    }, function (data, status) {
        if (status === 'success') {
            document.getElementById('editCatResult').innerHTML = data;
        }
    })
}

function deleteCategoryBTN(cat_id) {
    $.post('Features/Services/Categories/DeleteCategory.php', {
        'deleteCategory': 'deleteCategory',
        'cat_id': cat_id
    }, function (data, status) {
        if (status === 'success') {
            document.getElementById('content').innerHTML = data;
        }
    })
}


// 2.AJAX for sub Categories Menu

$("#AllSubCategoriesLink").click(function () {

    $.ajax({
        type: 'POST',
        url: 'Features/Services/Sub-Categories/AllSubCategories.php',
        success: function (data) {
            $("#content").html(data);
            if ($("#subcategoriesTable").length > 0) {
                var table = $('#subcategoriesTable').DataTable({
                    "scrollX": true,
                    responsive: true
                });
            }
        }
    })
});


$("#AddSubCategoriesLink").click(function () {
    $.post('Features/Services/Sub-Categories/AddSubCategory.php', {}, function (data, status) {
        if (status === 'success') {
            document.getElementById('content').innerHTML = data;
        }
    })
})

function addSubCategoryBTN() {

    $.post('Features/Services/Sub-Categories/AddSubCategory.php', {
        'sub_cat_name': document.getElementById('subCategoryName').value,
        'description': document.getElementById('subCategoryDescription').value,
        'cat_id': document.getElementById('parentCategory').value,
        'image': 'none'
    }, function (data, status) {
        if (status === 'success') {
            document.getElementById('addSubCatResult').innerHTML = data;
        }
    })
}

function EditSubCategory(sub_cat_id) {
    $.ajax({
        type: 'POST',
        data: {
            'editSubCategory': 'editSubCategory',
            'sub_cat_id': sub_cat_id
        },
        url: 'Features/Services/Sub-Categories/EditSubCategory.php',
        success: function (data) {
            $("#content").html(data);
            if ($("#back-btn").length > 0) {
                $("#back-btn").click(function () {
                    $.ajax({
                        type: 'POST',
                        url: 'Features/Services/Sub-Categories/AllSubCategories.php',
                        success: function (data) {
                            $("#content").html(data);
                            if ($("#categoriesTable").length > 0) {
                                var table = $('#categoriesTable').DataTable({
                                    "scrollX": true,
                                    responsive: true
                                });
                            }
                        }
                    })
                });
            }
        }
    })
}

function submitChangingSubCategory(sub_cat_id) {

    $.post('Features/Services/Sub-Categories/EditSubCategory.php', {
        'sub_cat_name_edit': document.getElementById('subCategoryNameEdit').value,
        'description_edit': document.getElementById('subCategoryDescriptionEdit').value,
        'cat_id_edit': document.getElementById('parentCategoryEdit').value,
        'sub_cat_id_edit': sub_cat_id,
        'image_edit': 'none'
    }, function (data, status) {
        if (status === 'success') {
            document.getElementById('editSubCatResult').innerHTML = data;
        }
    })
}

function deleteSubCategoryBTN(sub_cat_id) {
    $.post('Features/Services/Sub-Categories/DeleteSubCategory.php', {
        'deleteSubCategory': 'deleteSubCategory',
        'sub_cat_id': sub_cat_id
    }, function (data, status) {
        if (status === 'success') {
            document.getElementById('content').innerHTML = data;
        }
    })
}

// 3.AJAX for Items Menu
$("#AllItemsLink").click(function () {
    $.ajax({
        type: 'POST',
        url: 'Features/Services/Items/AllItems.php',
        success: function (data) {
            $("#content").html(data);
            if ($("#itemsTable").length > 0) {
                var table = $('#itemsTable').DataTable({
                    "scrollX": true,
                    responsive: true
                });
            }
        }
    })
})

$("#AddItemsLink").click(function () {
    $.post('Features/Services/Items/AddItem.php', {}, function (data, status) {
        if (status === 'success') {
            document.getElementById('content').innerHTML = data;
        }
    })
})

function getSubCategories() {
    $.post('Features/Services/Items/AddItem.php', {
        'findMainCategory': 'findMainCategory',
        'cat_id': document.getElementById('mainCategory').value
    }, function (data, status) {
        if (status === 'success') {
            document.getElementById('subCategory').innerHTML = data;
        }
    })
}

function addItemBTN() {

    $.post('Features/Services/Items/AddItem.php', {
        'item_name': document.getElementById('itemName').value,
        'item_price': document.getElementById('itemPrice').value,
        'item_description': document.getElementById('itemDescription').value,
        'sub_cat_id': document.getElementById('subCategory').value,
        'cat_id': document.getElementById('mainCategory').value,
        'image': 'none'
    }, function (data, status) {
        if (status === 'success') {
            document.getElementById('addItemResult').innerHTML = data;
        }
    })
}

function EditItem(item_id) {
    $.ajax({
        type: 'POST',
        data: {
            'editItem': 'editSubCategory',
            'item_id': item_id
        },
        url: 'Features/Services/Items/EditItem.php',
        success: function (data) {
            $("#content").html(data);
            if ($("#back-btn").length > 0) {
                $("#back-btn").click(function () {
                    $.ajax({
                        type: 'POST',
                        url: 'Features/Services/Items/AllItems.php',
                        success: function (data) {
                            $("#content").html(data);
                            if ($("#itemsTable").length > 0) {
                                var table = $('#itemsTable').DataTable({
                                    "scrollX": true,
                                    responsive: true
                                });
                            }
                        }
                    })
                });
            }
        }
    })
}

function submitChangingItem(item_id) {

    $.post('Features/Services/Items/EditItem.php', {
        'item_name_edit': document.getElementById('itemNameEdit').value,
        'item_price_edit': document.getElementById('itemPriceEdit').value,
        'cat_id_edit': document.getElementById('mainCategory').value,
        'sub_cat_id_edit': document.getElementById('subCategory').value,
        'item_description_edit': document.getElementById('itemDescriptionEdit').value,
        'item_id_edit': item_id,
        'image_edit': 'none'
    }, function (data, status) {
        if (status === 'success') {
            document.getElementById('editItemResult').innerHTML = data;
        }
    })
}

function deleteItemBTN(item_id) {
    $.post('Features/Services/Items/DeleteItem.php', {
        'deleteItem': 'deleteItem',
        'item_id': item_id
    }, function (data, status) {
        if (status === 'success') {
            document.getElementById('content').innerHTML = data;
        }
    })
}

// AJAX for Booking feature
$("#bookingLink").click(function () {
    $.ajax({
        type: 'POST',
        url: 'Features/Booking/AllBooking.php',
        success: function (data) {
            $("#content").html(data);
            if ($("#bookings").length > 0) {
                var table = $('#bookings').DataTable({
                    "scrollX": true,
                    responsive: true
                });
            }
        }
    })
})

function EditBook(book_id) {
    $.post('Features/Booking/EditBooking.php', {
        'book_id': book_id
    }, function (data, status) {
        if (status === 'success')
            document.getElementById('content').innerHTML = data;
    })
}

function EditBooking(roomType, person_id) {

    $.post('Features/Booking/EditBooking.php', {
        'checkForRoomType': 'checkForRoomType',
        'room_type': roomType,
        'start_date': document.getElementById('startDateEdit').value,
        'end_date': document.getElementById('endDateEdit').value,
        'person_id': person_id,

    }, function (data, status) {
        if (status === 'success') {

            if (data.includes('<span')) {
                document.getElementById('editBookingResult').innerHTML = data;
                document.getElementById('roomNumberFB').innerHTML = '<option>Available Rooms</option>';
            } else {
                document.getElementById('roomNumberFB').innerHTML = data;
                document.getElementById('editBookingResult').innerHTML = "";
            }

        }
    })
}

function submitChangingBooking(book_id, person_id) {

    $.post('Features/Booking/EditBooking.php', {
        'editBook': 'editBook',
        'book_id': book_id,
        'person_id': person_id,
        'start_date': document.getElementById('startDateEdit').value,
        'end_date': document.getElementById('endDateEdit').value,
        'room_id': document.getElementById('roomNumberFB').value
    }, function (data, status) {
        if (status === 'success') {
            document.getElementById('editBookingResult').innerHTML = data;
        }
    })
}

function deleteBook(book_id, start_date) {
    $.post('Features/Booking/DeleteBook.php', {
        'deleteBook': 'deleteBook',
        'book_id': book_id,
        'start_date': start_date
    }, function (data, status) {
        if (status === 'success') {
            document.getElementById('content').innerHTML = data;
        }
    })
}

// $("#fullName").autocomplete({
//     source: "Features/Staff/search.php",
//     minLength: 2,
//     select: function (event, ui) {
//         log(ui.item ? "Selected: " + ui.item.value + " aka " + ui.item.id : "Nothing selected, input was " + this.value);
//     }
// });

