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

//To add loader while Ajax Process
function setLoader() {
    $("#content").html(" <div style='left: 40%; top:40%' id=\"loader\" class=\"loader-wrapper animate__animated animate__fadeIn\">\n" +
        "        <div class=\"globe-loader fas fa-globe-americas\">\n" +
        "            <i class=\"fas fa-plane\"></i>\n" +
        "        </div>\n" +
        "    </div>");
    return;
}

(function ($) {

    // 3. Load DashBoard On Start
    $(document).ready(function () {
        setLoader();
        $("#content").load("Features/Dashboard/dashboard.php");
        $("#dashboard").addClass("active");
    })
    //start Sub menu Handling
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
    });
    //end Sub menu Handling

    /*******************************************
     *    Start Sub Menu Ajax Requests          *
     ********************************************/

// AJAX for Booking feature
    $("#dashboard").click(function () {
        setLoader();
        $("#content").load("Features/Dashboard/dashboard.php");
        $(".components li").removeClass("active");
        $("#dashboard").addClass("active");
    })
// AJAX for Booking feature
    $("#bookingLink").click(function () {
        $(".components li").removeClass("active");
        $("#bookingLink").addClass("active");
        setLoader();
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

// AJAX for Contacts Feature All rooms ,add Room
    $("#Rooms").click(function () {
        $(".components li").removeClass("active");
        $("#roomLink").addClass("active");
        setLoader();
        $('#content').load('Features/Room/AllRooms.php');
    })
    $("#addRoom").click(function () {
        setLoader();

        $(".components li").removeClass("active");
        $("#roomLink").addClass("active");
        $(".components li").removeClass("active");
        $("#addRoom").addClass("active");
        setLoader();
        $('#content').load('Features/Room/addRoom.php');
    })
// AJAX for Categories

    $("#AllCategoriesLink").click(function () {
        $(".components li").removeClass("active");
        $("#servicesLink").addClass("active");
        setLoader();
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
        setLoader();
        $(".components li").removeClass("active");
        $("#servicesLink").addClass("active");
        $.ajax({
            type: 'POST',
            url: 'Features/Services/Categories/AddCategory.php',
            success: function (data) {
                $("#content").html(data);
            }
        })
    })

// AJAX for Sub Categories
    $("#AllSubCategoriesLink").click(function () {
        $(".components li").removeClass("active");
        $("#servicesLink").addClass("active");
        setLoader();
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
        $(".components li").removeClass("active");
        $("#servicesLink").addClass("active");
        setLoader();
        $.post('Features/Services/Sub-Categories/AddSubCategory.php', {}, function (data, status) {
            if (status === 'success') {
                document.getElementById('content').innerHTML = data;
            }
        })
    })
    // AJAX for Items Menu
    $("#AllItemsLink").click(function () {
        $(".components li").removeClass("active");
        $("#servicesLink").addClass("active");
        setLoader();
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
        $(".components li").removeClass("active");
        $("#servicesLink").addClass("active");
        setLoader();
        $.post('Features/Services/Items/AddItem.php', {}, function (data, status) {
            if (status === 'success') {
                document.getElementById('content').innerHTML = data;
            }
        })
    })

// AJAX for Job Applications
    $("#jobLink").click(function () {
        $(".components li").removeClass("active");
        $("#jobLink").addClass("active");
        setLoader();
        $("#content").load('Features/JobApplications/JobApps.php');
    })
// AJAX for Employees

    $("#addEmployee").click(function () {
        $(".components li").removeClass("active");
        $("#employeeLink").addClass("active");
        setLoader();
        $('#content').load('Features/Staff/AddStaff.php');
    })
    $("#allEmployees").click(function () {
        $(".components li").removeClass("active");
        $("#employeeLink").addClass("active");
        setLoader();
        $('#content').load('Features/Staff/AllStaff.php');
    })

// AJAX for customer item
    $("#customerLink").click(function () {
        $(".components li").removeClass("active");
        $("#customerLink").addClass("active");
        setLoader();
        $("#content").load('Features/Users/AllUsers.php');
    })
    $("#ordersLink").click(function () {
        $(".components li").removeClass("active");
        $("#orderLink").addClass("active");
        setLoader();
        $("#content").load('Features/Orders/allOrders.php');
    })
// AJAX for Contacts Feature
    $("#contactLink").click(function () {
        $(".components li").removeClass("active");
        $("#contactLink").addClass("active");
        setLoader();
        $.ajax({
            type: 'POST',
            url: 'Features/Contacts/Contacts.php',
            success: function (data) {
                $("#content").html(data);
            }
        })

    })
// Ajax for log out icon
    $("#logOutItem").click(function () {
        window.location.replace("../PHP/LogOut/logout.php");
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
        '<div style="margin: 20% auto; display: block;" class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>';

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
    document.getElementById(statusID).innerHTML =
        '<div class="lds-ring" style="display: block;margin: auto;"><div></div><div></div><div></div><div></div></div>';
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


function addCategoryBTN() {
    var file_data = $('#catImage').prop('files')[0];
    var form_data = new FormData();
    form_data.append('file', file_data);
    form_data.append('category_name', document.getElementById('categoryName').value);
    form_data.append('description', document.getElementById('categoryDescription').value);
    $.ajax({
        url: 'Features/Services/Categories/AddCategory.php', // point to server-side PHP script
        dataType: 'text',  // what to expect back from the PHP script, if anything
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
        success: function (data) {
            $("#addCatResult").html(data); // display response from the PHP script, if any
        }
    });
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

    var file_data = $('#catImageEdit').prop('files')[0];
    var form_data = new FormData();
    form_data.append('file', file_data);
    form_data.append('cat_id_Edit', cat_id);
    form_data.append('category_name_Edit', document.getElementById('categoryNameEdit').value);
    form_data.append('description_Edit', document.getElementById('categoryDescriptionEdit').value);

    $.ajax({
        url: 'Features/Services/Categories/EditCategory.php', // point to server-side PHP script
        dataType: 'text',  // what to expect back from the PHP script, if anything
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
        success: function (data) {
            $("#editCatResult").html(data); // display response from the PHP script, if any
        }
    });
}

function deleteCategoryBTN(cat_id, image) {
    $.post('Features/Services/Categories/DeleteCategory.php', {
        'deleteCategory': 'deleteCategory',
        'cat_id': cat_id,
        'image': image
    }, function (data, status) {
        if (status === 'success') {
            document.getElementById('content').innerHTML = data;
        }
    })
}


// 2.AJAX for sub Categories Menu


function addSubCategoryBTN() {

    var file_data = $('#subCatImage').prop('files')[0];
    var form_data = new FormData();

    form_data.append('file', file_data);
    form_data.append('sub_cat_name', document.getElementById('subCategoryName').value);
    form_data.append('description', document.getElementById('subCategoryDescription').value);
    form_data.append('cat_id', document.getElementById('parentCategory').value);

    $.ajax({
        url: 'Features/Services/Sub-Categories/AddSubCategory.php', // point to server-side PHP script
        dataType: 'text',  // what to expect back from the PHP script, if anything
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
        success: function (data) {
            $("#addSubCatResult").html(data); // display response from the PHP script, if any
        }
    });
}

function addItemBTN() {

    var file_data = $('#itemImage').prop('files')[0];
    var form_data = new FormData();

    form_data.append('file', file_data);
    form_data.append('item_name', document.getElementById('itemName').value);
    form_data.append('item_price', document.getElementById('itemPrice').value);
    form_data.append('item_description', document.getElementById('itemDescription').value);
    form_data.append('sub_cat_id', document.getElementById('subCategory').value);
    form_data.append('cat_id', document.getElementById('mainCategory').value);

    $.ajax({
        url: 'Features/Services/Items/AddItem.php', // point to server-side PHP script
        dataType: 'text',  // what to expect back from the PHP script, if anything
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
        success: function (data) {
            $("#addItemResult").html(data); // display response from the PHP script, if any
        }
    });
}

function deleteSubCategoryBTN(sub_cat_id, image) {
    $.post('Features/Services/Sub-Categories/DeleteSubCategory.php', {
        'deleteSubCategory': 'deleteSubCategory',
        'sub_cat_id': sub_cat_id,
        'image': image
    }, function (data, status) {
        if (status === 'success') {
            document.getElementById('content').innerHTML = data;
        }
    })
}

function deleteItemBTN(item_id, image) {
    $.post('Features/Services/Items/DeleteItem.php', {
        'deleteItem': 'deleteItem',
        'item_id': item_id,
        'image': image
    }, function (data, status) {
        if (status === 'success') {
            document.getElementById('content').innerHTML = data;
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
                $("#back-btn").on("click", function () {
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
            }
        }
    })
}

function submitChangingSubCategory(sub_cat_id) {
    var file_data = $('#subCatImageEdit').prop('files')[0];
    var form_data = new FormData();
    form_data.append('file', file_data);
    form_data.append('sub_cat_name_edit', document.getElementById('subCategoryNameEdit').value);
    form_data.append('description_edit', document.getElementById('subCategoryDescriptionEdit').value);
    form_data.append('sub_cat_id_edit', sub_cat_id);
    form_data.append('cat_id_edit', document.getElementById('parentCategoryEdit').value);

    $.ajax({
        url: 'Features/Services/Sub-Categories/EditSubCategory.php', // point to server-side PHP script
        dataType: 'text',  // what to expect back from the PHP script, if anything
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
        success: function (data) {
            $("#editSubCatResult").html(data); // display response from the PHP script, if any
        }
    });

    // $.post('Features/Services/Sub-Categories/EditSubCategory.php', {
    //     'sub_cat_name_edit': document.getElementById('subCategoryNameEdit').value,
    //     'description_edit': document.getElementById('subCategoryDescriptionEdit').value,
    //     'cat_id_edit': document.getElementById('parentCategoryEdit').value,
    //     'sub_cat_id_edit': sub_cat_id,
    //     'image_edit': 'none'
    // }, function (data, status) {
    //     if (status === 'success') {
    //         document.getElementById('editSubCatResult').innerHTML = data;
    //     }
    // })
}

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
    var file_data = $('#itemImageEdit').prop('files')[0];
    var form_data = new FormData();
    form_data.append('item_name_edit', document.getElementById('itemNameEdit').value);
    form_data.append('item_price_edit', document.getElementById('itemPriceEdit').value);
    form_data.append('cat_id_edit', document.getElementById('mainCategory').value);
    form_data.append('sub_cat_id_edit', document.getElementById('subCategory').value);
    form_data.append('item_description_edit', document.getElementById('itemDescriptionEdit').value);
    form_data.append('item_id_edit', item_id);
    form_data.append('file', file_data);
    $.ajax({
        url: 'Features/Services/Items/EditItem.php', // point to server-side PHP script
        dataType: 'text',  // what to expect back from the PHP script, if anything
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
        success: function (data) {
            $("#editItemResult").html(data); // display response from the PHP script, if any
        }
    });
}


var counter = 0;

function EditBook(book_id) {
    setLoader();
    $.post('Features/Booking/EditBooking.php', {
        'book_id': book_id
    }, function (data, status) {
        if (status === 'success')
            document.getElementById('content').innerHTML = data;
        if ($("#back-btn").length > 0) {
            $("#back-btn").on("click", function () {
                setLoader();
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
            });
        }

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


// AJAX for employee

function addEmpBTN() {

    var file_data = $('#empImage').prop('files')[0];
    var form_data = new FormData();
    form_data.append('file', file_data);
    form_data.append('empID', document.getElementById('empID').value);
    form_data.append('empSalary', document.getElementById('empSalary').value);
    form_data.append('empJoiningDate', document.getElementById('empJoiningDate').value);
    form_data.append('empPosition', document.getElementById('empPosition').value);
    $.ajax({
        url: 'Features/Staff/AddStaff.php', // point to server-side PHP script
        dataType: 'text',  // what to expect back from the PHP script, if anything
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
        success: function (data) {
            $("#empMSG").html(data); // display response from the PHP script, if any
        }
    });

}

function EditEmployee(emp_id) {
    $.post('Features/Staff/EditStaff.php', {
        'empID': emp_id
    }, function (data, status) {
        if (status === 'success') {
            document.getElementById('content').innerHTML = data;
        }
    })

}

function submitSaveEmpChangesBTN(emp_id, person_id) {

    var file_data = $('#empImageEdit').prop('files')[0];
    var form_data = new FormData();
    form_data.append('file', file_data);
    form_data.append('empIDEdit', emp_id);
    form_data.append('personIDEdit', person_id);
    form_data.append('empSalaryEdit', document.getElementById('empSalaryEdit').value);
    form_data.append('empJoiningDateEdit', document.getElementById('empJoiningDateEdit').value);
    form_data.append('empPositionEdit', document.getElementById('empPositionEdit').value);
    $.ajax({
        url: 'Features/Staff/EditStaff.php', // point to server-side PHP script
        dataType: 'text',  // what to expect back from the PHP script, if anything
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
        success: function (data) {
            $("#editStaffResult").html(data); // display response from the PHP script, if any
        }
    });

}

function deleteEmployee(emp_id, image) {

    $.post('Features/Staff/DeleteStaff.php', {
        'deleteStaff': 'deleteStaff',
        'employee_id': emp_id,
        'image': image
    }, function (data, status) {
        if (status === 'success') {
            document.getElementById('content').innerHTML = data;
        }
    })
}


// loading more cards for job applications
var jobApplicationsCounter = 3;

function loadMoreCardsJA() {
    jobApplicationsCounter += 3;
    $.ajax({
        type: 'POST',
        data: {
            'counter': jobApplicationsCounter
        },
        url: 'Features/JobApplications/JobApps.php',
        success: function (data) {
            $("#content").html(data);
        }
    })
}

// loading more cards for job applications
var jobApplicationsSMCounter = 3;

function loadMoreCardsSMJA() {
    jobApplicationsSMCounter += 3;
    // document.getElementById('searchJobResult').innerHTML =
    //     '<img width="55px" height="50px" style="position: absolute;top: 50%;left: 50%;transform: translate(-50%,-50%)' +
    //     '" src="images/VZvw.gif">';

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
            'replied': repliedFlag,
            'counter': jobApplicationsSMCounter
        },
        url: 'Features/JobApplications/SearchJobApps.php',
        success: function (data) {
            $("#searchJobResult").html(data);
            let count = $("#counter").attr('class');
        }
    })
}

// loading more cards for contacts
var ContactsCounter = 3;

function loadMoreCardsContacts() {
    ContactsCounter += 3;
    $.ajax({
        type: 'POST',
        url: 'Features/Contacts/Contacts.php',
        data: {
            'counter': ContactsCounter
        },
        success: function (data) {
            $("#content").html(data);
        }
    })
}

// loading more cards for contacts
var ContactsSMCounter = 3;

function loadMoreCardsSMContacts() {
    ContactsSMCounter += 3;
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
            'replied': repliedFlag,
            'counter': ContactsSMCounter
        },
        url: 'Features/Contacts/SearchContacts.php',
        success: function (data) {
            $("#searchContactResult").html(data);
            let count = $("#counter").attr('class');
        }
    })
}



