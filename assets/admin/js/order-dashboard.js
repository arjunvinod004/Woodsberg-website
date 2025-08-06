//Add new order
//View pending table orders
//View completed table orders
//Table Is resereved functionality
//Pending Orders Pickup And Delivery
//Completed delivery and pickup orders
//Get pending order count on order dashboard

$(document).ready(function () {

    var base_url = 'http://localhost/emigo-restaurant-application/';
    // var base_url = 'https://qr-experts.com/emigo-restaurant-application/';

    //View pending table orders
    $('.tableOrderPending').click(function () {
        $('#table_name').html($(this).attr('data-name'));
        document.getElementById('table_iframe_recipe').src = base_url + 'owner/order/OrdersPendingPKDL/' + $(this).attr('data-id');
    });
    //end

    //view ready order details within popup
    $(document).on('click', '.ready_order_details', function () {
        $('#table_name').html($(this).attr('data-name'));
        document.getElementById('table_iframe_recipe').src = base_url + 'owner/order_kitchen/ReadyOrderDetails/' + $(this).attr('data-id');
    });
    //end


    // $(document).on('click', '.accept_table_order', function () {
    //     alert('Order accepted successfully.');
    // })
    //View completed table orders
    $('.tableOrdercompleted').click(function () {
        $('#table_name').html('Order Details -' + $(this).attr('data-name'));
        document.getElementById('table_iframe_recipe').src = base_url + 'owner/order/tableOrders/' + $(this).attr('data-id');
    });
    //end

    //Table Is resereved functionality
    $('.cbIsReserved').on('click', function () {
        const isChecked = $(this).is(':checked') ? 1 : 0; // Get the checked state
        const tableId = $(this).attr('data-id'); // Get the data-id attribute value
        $.ajax({
            url: base_url + "owner/order/setTableReserved",
            type: 'POST',
            data: {
                isReserved: isChecked,
                tableId: tableId
            },
            dataType: 'json',
            success: function (response) {
                location.reload();
            }
        });

    });
    //end

    //Pending Orders Pickup And Delivery
    $('.orders').click(function () {
        $('#table_name').html($(this).attr('data-name'));
        document.getElementById('table_iframe_recipe').src = base_url + 'owner/order/OrdersPKDL/' + $(this).attr('data-id');

    });
    //end

    //Completed delivery and pickup orders
    $('.completedOrders').click(function () {
        $('#table_name').html($(this).attr('data-name'));
        document.getElementById('table_iframe_recipe').src = base_url + 'owner/order/completedOrdersPKDL/' + $(this).attr('data-id');
    });
    //end

    //Add new order
    $('.new_order').click(function () {
        $('#table_name').html('Order Details -' + $(this).attr('data-name'));
        document.getElementById('table_iframe_order').src = base_url + 'owner/order/newOrder/' + $(this).attr('data-id');
    });
    //end







    //Get pending order count on order dashboard
    // This function will be called every 5 seconds
    setInterval(function () {

        $.ajax({
            url: base_url + "owner/order/get_Pending_Orders_Count",
            type: 'POST',
            dataType: 'json',
            success: function (response) {
               
               
                //Ready orders
                if (Array.isArray(response['ready-orders-db'])) {
                    if(response['ready-orders-db'].length > 0){
                        $('#tabs__nav_approved_ready_count_db').removeClass('d-none');
                        $('#tabs__nav_approved_ready_count_db').text(response['ready-orders-db'].length);
                        pendingOrderAlert();
                    }else{
                        $('#tabs__nav_approved_ready_count_db').addClass('d-none');
                    }
                    let readyHtml = '';
                    response['ready-orders-db'].forEach(function (order) {
                        
                        let orderStatus = '';
                        let orderType = '';
                        let bgColor = '';
                        let btnClass = '';
                        

                        if (order.order_status === '1') {
                            orderStatus = 'Approved';
                            btnClass = 'btn-approved w-100 mt-2';
                        }
                        else if (order.order_status === '2') {
                            orderStatus = 'Cooking';
                            btnClass = 'btn-cooking w-100 mt-2';
                        }else if (order.order_status === '3') {
                            orderStatus = 'Ready';
                            btnClass = 'btn-ready w-100 mt-2';
                        } else if (order.order_status === '4') {
                            orderStatus = 'Delivered';
                            btnClass = 'btn-approved w-100 mt-2';
                        } else {
                            orderStatus = 'Pending';
                        }
                        
                        if (order.order_type === 'D') {
                            orderType = order.table_name;
                            bgColor = '#ede1db';
                        } else if (order.order_type === 'PK') {
                            orderType = 'Pickup';
                            bgColor = '#b4c9dd';
                        } else if (order.order_type === 'DL') {
                            orderType = 'Delivery';
                            bgColor = '#f1b3a1';
                        } else {
                            orderType = 'Unknown';
                        }
                        
                        readyHtml += `
                            <div class="order-table-list__item">
                            <a data-bs-toggle="modal" data-id="${order.orderno}" data-name="${order.orderno}" data-bs-target="#recipe" class="w-100 ready_order_details" type="button" title="Table Orders">
                            <div id="order-table-list__item-heading_${order.orderno}"
                                        class="order-table-list__item-heading order-table-list__item-heading"
                                        style="background-color: ${bgColor};">
                                        ${orderType} - ####${order.order_token}
                                        <img src="${base_url}assets/admin/images/table-icon.svg"
                                            alt="table icon" class="order-table-list__item-heading-icon">
                                    </div>
                            </a>
                                <button type="button" class="btn ${btnClass}">${orderStatus}</button>
                            </div>
                        `;
                    });
                    $('#ready-orders-db').html(readyHtml);
                }
                //Ready orders
               
                if (response.dining > 0) {
                    $('#tabs__nav_pending_table_count').removeClass('d-none');
                    $('#tabs__nav_pending_table_count').text(response.dining);
                    pendingOrderAlert();
                    response.table_ids.forEach(function (table) {
                        $("#order-table-list__item-heading_" + table.table_id).addClass("order-table-list__item-heading_pending-order bounce");
                        $("#order-table-list__unpaid-count_" + table.table_id).text(table.pending_orders);
                    });
                    
                    response.reorder_table_ids.forEach(function (table) {
                        $("#order-table-list__item-heading_" + table.table_id).addClass("bounce");
                    });
                    
                } else {
                    $('#tabs__nav_pending_table_count').text();
                }

                if (response.pickup > 0) {
                    $('#tabs__nav_pending_pickup_count').removeClass('d-none');
                    $('#tabs__nav_pending_pickup_count').text(response.pickup);
                    $("#order-pickup__unpaid-count").text(response.pickup);
                    pendingOrderAlert();
                } else {
                    $('#tabs__nav_pending_pickup_count').text();
                }

                if (response.delivery > 0) {
                    $('#tabs__nav_pending_delivery_count').removeClass('d-none');
                    $('#tabs__nav_pending_delivery_count').text(response.delivery);
                    $("#order-delivery__unpaid-count").text(response.delivery);
                    pendingOrderAlert();
                } else {
                    $('#tabs__nav_pending_delivery_count').text();
                }
                // if (response.ready_order > 0) {
                //     $('#tabs__nav_approved_ready_count').removeClass('d-none');
                //     $('#tabs__nav_approved_ready_count').text(response.ready_order);
                //     pendingOrderAlert();
                // } else {
                //     $('#tabs__nav_approved_ready_count').text();
                // }
            },
            error: function (xhr, status, error) {
                console.error('Error fetching order counts:', error);
            }
        });
        //alert('hqi');

    }, 5000); // Interval of 5000ms = 5 seconds


    //3.Order Alert using set interval
    function pendingOrderAlert() {
        const audio = document.getElementById('alert-audio');
        audio.play();
    }




});