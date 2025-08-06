
//View pending table orders
//View completed table orders

//Pending Orders Pickup And Delivery
//Completed delivery and pickup orders
//Get pending order count on order dashboard

$(document).ready(function () {

    var base_url = 'http://localhost/emigo-restaurant-application/';
    // var base_url = 'https://qr-experts.com/emigo-restaurant-application/';

    //View pending table orders
    $(document).on('click', '.order_details', function () {
        $('#table_name').html($(this).attr('data-name'));
        document.getElementById('table_iframe_recipe').src = base_url + 'owner/order_kitchen/OrdersPendingPKDL/' + $(this).attr('data-id');
    });
    //end

    
 


    //view ready order details within popup
    $('.ready_order_details').click(function () {
        $('#table_name').html($(this).attr('data-name'));
        document.getElementById('table_iframe_recipe').src = base_url + 'owner/order_kitchen/ReadyOrderDetails/' + $(this).attr('data-id');
    });
    //end

    //view ready order details within popup
    $('.delivered_order_details').click(function () {
        $('#table_name').html($(this).attr('data-name'));
        document.getElementById('table_iframe_recipe').src = base_url + 'owner/order_kitchen/DeliveredOrderDetails/' + $(this).attr('data-id');
    });
    //end

    //View completed table orders
    $('.tableOrdercompleted').click(function () {
        $('#table_name').html('Order Details -' + $(this).attr('data-name'));
        document.getElementById('table_iframe_recipe').src = base_url + 'owner/order/tableOrders/' + $(this).attr('data-id');
    });
    //end


    //Pending Orders Pickup And Delivery
    $('.kitchen_orders').click(function () {
        $('#table_name').html($(this).attr('data-name'));
        document.getElementById('table_iframe_recipe').src = base_url + 'owner/order_kitchen/OrdersPKDL/' + $(this).attr('data-id');

    });
    //end

    //Completed delivery and pickup orders
    $('.kitchen_completedOrders').click(function () {
        $('#table_name').html($(this).attr('data-name'));
        document.getElementById('table_iframe_recipe').src = base_url + 'owner/order/completedOrdersPKDL/' + $(this).attr('data-id');
    });
    //end







    //Get pending order count on order dashboard
    // This function will be called every 5 seconds
    setInterval(function () {
        $.ajax({
            url: base_url + "owner/order_kitchen/get_Kitchen_Orders_Count_Status",
            type: 'POST',
            dataType: 'json',
            success: function (response) {
                
                
                //Approved orders
                if (Array.isArray(response['approved-orders'])) {
                    if(response['approved-orders'].length > 0){
                        $('#tabs__nav_approved_table_count').removeClass('d-none');
                        $('#tabs__nav_approved_table_count').text(response['approved-orders'].length);
                        pendingOrderAlert();
                    }else{
                        $('#tabs__nav_approved_table_count').addClass('d-none');
                    }
                    let approvedHtml = '';
                    response['approved-orders'].forEach(function (order) {
                        
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
                        
                        approvedHtml += `
                            <div class="order-table-list__item">
                            <a data-bs-toggle="modal" data-id="${order.orderno}" data-name="${order.orderno}" data-bs-target="#recipe" class="w-100 order_details" type="button" title="Table Orders">
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
                    $('#approved-orders').html(approvedHtml);
                }else{
                    $('#tabs__nav_approved_table_count').addClass('d-none');
                }
                // Approved orders
                
                
                //Ready orders
                if (Array.isArray(response['ready-orders'])) {
                    if (response.ready_order > 0) {
                        $('#tabs__nav_approved_ready_count').removeClass('d-none');
                        $('#tabs__nav_approved_ready_count').text(response.ready_order);
                    }else{
                        $('#tabs__nav_approved_ready_count').addClass('d-none');
                    }
                    let readyHtml = '';
                    response['ready-orders'].forEach(function (order) {
                        
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
                            <a data-bs-toggle="modal" data-id="${order.orderno}" data-name="${order.orderno}" data-bs-target="#recipe" class="w-100 order_details" type="button" title="Table Orders">
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
                    $('#ready-orders').html(readyHtml);
                }
                //Ready orders
                
                //Delivered orders
                if (Array.isArray(response['delivered-orders'])) {
                    let deliveredHtml = '';
                    response['delivered-orders'].forEach(function (order) {
                        
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
                        
                        deliveredHtml += `
                            <div class="order-table-list__item">
                            <a data-bs-toggle="modal" data-id="${order.orderno}" data-name="${order.orderno}" data-bs-target="#recipe" class="w-100 order_details" type="button" title="Table Orders">
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
                    $('#delivered-orders').html(deliveredHtml);
                }
                //Delivered orders
                
                
                // if (response.dining > 0) {
                //     // $('#tabs__nav_approved_table_count').removeClass('d-none');
                //     // $('#tabs__nav_approved_table_count').text(response.dining);
                //     pendingOrderAlert();
                //     response.table_ids.forEach(function (table) {
                //         $("#order-table-list__item-heading_" + table.table_id).addClass("order-table-list__item-heading_approved-order");
                //     });
                // } else {
                //     $('#tabs__nav_approved_table_count').text('');
                // }

                if (response.pickup > 0) {
                    $('#tabs__nav_approved_pickup_count').removeClass('d-none');
                    $('#tabs__nav_approved_pickup_count').text(response.pickup);
                    pendingOrderAlert();
                } else {
                    $('#tabs__nav_approved_pickup_count').text();
                }

                if (response.delivery > 0) {
                    $('#tabs__nav_approved_delivery_count').removeClass('d-none');
                    $('#tabs__nav_approved_delivery_count').text(response.delivery);
                    pendingOrderAlert();
                } else {
                    $('#tabs__nav_approved_delivery_count').text('');
                }
                // if (response.ready_order > 0) {
                //     $('#tabs__nav_approved_ready_count').removeClass('d-none');
                //     $('#tabs__nav_approved_ready_count').text(response.ready_order);
                // } else {
                //     $('#tabs__nav_approved_ready_count').text();
                // }
            },
            error: function (xhr, status, error) {
                console.error('Error fetching order counts:', error);
            }
        });
        
        //alert('hai');

    }, 5000); // Interval of 5000ms = 5 seconds

    //3.Order Alert using set interval
    function pendingOrderAlert() {
        const audio = document.getElementById('kitchen_alert-audio');
        audio.play();
    }




});