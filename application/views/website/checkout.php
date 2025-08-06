<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>checkout</title>
    <link rel="stylesheet" href="<?php echo base_url();?>assets/website/css/plugins1.css">
</head>

<body>
    <?php 
$total_amout = $sumofprice;
if($customerdetails['coupon_code'] != 0)
{
    $total_amout = $total_amout - $customerdetails['coupon_code'];
}
if($customerdetails['shipping_charge'] != 0)
{
    $total_amout = $total_amout + $customerdetails['shipping_charge'];
}
?>


    <?php 
$selected_state = ''; 
$token = $this->input->cookie('guest_token'); 
if ($token) {
    $customer = $this->db->where('user_token', $token)->get('customers')->row_array();
    if ($customer) {
        $selected_state = $customer['state'];
    }
}

if($ordertype == 'exp'){
  $symbol = '$'; // Assuming export prices are in dollars
}
else{
  $symbol = 'RS'; // Default symbol for other order types
}
?>


    <div class="main-wrapper">


        <section class="page-title-section bg-img cover-background">
            <div class="container">

                <div class="row">
                    <div class="col-md-7">
                        <h3>Checkout</h3>
                    </div>
                    <div class="col-md-5">
                        <ul class="text-md-end text-start mt-2 mt-lg-0 ps-0">
                            <li><a href="<?php echo base_url(); ?>">Home</a></li>
                            <li><a href="#!">Checkout</a></li>
                        </ul>
                    </div>
                </div>

            </div>
        </section>

        <section>
            <div class="container">

                <!-- form design block set -->
                <div class="row">

                    <!-- billing address -->
                    <div class="col-lg-5 col-md-6 mb-1-9 mb-md-0">



                        <h4 class="mb-4">Billing Address</h4>
                        <form id="usercheckout" method="post" enctype="multipart/form-data">



                            <div class="quform-elements">
                                <div class="row">

                                    <?php if($ordertype == 'ws' || $ordertype == 'bb' || $ordertype == 'exp' ): ?>
                                    <!-- Company Name field - shown only for WS and BB -->
                                    <div class="col-md-12">
                                        <div class="quform-element form-group">
                                            <label for="name">Company Name <span
                                                    class="quform-required">*</span></label>
                                            <div class="quform-input">
                                                <input class="form-control" type="text" name="checkout_company_name">
                                                <span class="error errormsg mt-2"
                                                    id="checkout_company_name_error"></span>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-md-12">
                                        <div class="quform-element form-group">
                                            <label for="name">Name<span class="quform-required">*</span></label>
                                            <div class="quform-input">
                                                <input class="form-control" type="text" name="checkout_username">
                                                <span class="error errormsg mt-2" id="checkout_username_error"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Phone field for WS/BB -->
                                    <div class="col-md-6">
                                        <div class="quform-element form-group">
                                            <label for="phone">Phone <span class="quform-required">*</span></label>
                                            <div class="quform-input">
                                                <input class="form-control" type="text" name="checkout_userphone">
                                                <span class="error errormsg mt-2" id="checkout_userphone_error"></span>
                                            </div>
                                        </div>
                                    </div>


                                    <!-- Email field for WS/BB -->
                                    <div class="col-md-6">
                                        <div class="quform-element form-group">
                                            <label for="phone">Email<span class="quform-required">*</span></label>
                                            <div class="quform-input">
                                                <input class="form-control" type="text" name="checkout_useremail">
                                                <span class="error errormsg mt-2" id="checkout_useremail_error"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <?php else: ?>
                                    <!-- All fields shown for RT (other order types) -->

                                    <!-- First Name -->
                                    <div class="col-md-12">
                                        <div class="quform-element form-group">
                                            <label for="name">First Name <span class="quform-required">*</span></label>
                                            <div class="quform-input">
                                                <input class="form-control" type="text" name="checkout_username">
                                                <span class="error errormsg mt-2" id="checkout_username_error"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Email -->
                                    <div class="col-md-6">
                                        <div class="quform-element form-group">
                                            <label for="email">Email Address <span
                                                    class="quform-required">*</span></label>
                                            <div class="quform-input">
                                                <input class="form-control" type="text" name="checkout_useremail">
                                                <span class="error errormsg mt-2" id="checkout_useremail_error"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Phone -->
                                    <div class="col-md-6">
                                        <div class="quform-element form-group">
                                            <label for="phone">Phone <span class="quform-required">*</span></label>
                                            <div class="quform-input">
                                                <input class="form-control" type="text" name="checkout_userphone">
                                                <span class="error errormsg mt-2" id="checkout_userphone_error"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- City -->
                                    <div class="col-md-6">
                                        <div class="quform-element form-group">
                                            <label for="city">City / Town <span class="quform-required">*</span></label>
                                            <div class="quform-input">
                                                <input class="form-control" type="text" name="checkout_usercity">
                                                <span class="error errormsg mt-2" id="checkout_usercity_error"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Postcode -->
                                    <div class="col-md-6">
                                        <div class="quform-element form-group">
                                            <label for="pPostcode">Postcode <span
                                                    class="quform-required">*</span></label>
                                            <div class="quform-input">
                                                <input class="form-control" id="postcode" type="text"
                                                    name="checkout_userpostcode">
                                                <span class="error errormsg mt-2"
                                                    id="checkout_userpostcode_error"></span>
                                            </div>
                                        </div>
                                    </div>



                                    <!-- Coupon code -->







                                    <!-- Country -->
                                    <div class="col-md-12">
                                        <div class="quform-element form-group">
                                            <label for="country1">Country <span class="quform-required">*</span></label>
                                            <div class="quform-input">
                                                <select class="form-control form-select" id="country1"
                                                    name="checkout_usercountry">
                                                    <!-- <select name="country" id="country" class="form-select"> -->
                                                    <option value="" selected="">Select a country</option>
                                                    <option selected value="india">India</option>
                                                    <input type="hidden" id="weight" class="form-control mb-2"
                                                        value="<?php echo $weightcalculation;?>">
                                                </select>
                                                <span class="error errormsg mt-2"
                                                    id="checkout_usercountry_error"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- State -->
                                    <div class="col-md-12">
                                        <div class="quform-element form-group">
                                            <label for="country1">State<span class="quform-required">*</span></label>
                                            <div class="quform-input">
                                                <select name="state" class="form-select mt-2" id="state">
                                                    <option value="">Select state</option>
                                                    <?php foreach ($shipping as $ships) : ?>
                                                    <option value="<?php echo $ships['state']; ?>"
                                                        data-shipping-charge="<?php echo $ships['shipping_charge']; ?>"
                                                        <?php echo ($selected_state == $ships['state']) ? 'selected' : ''; ?>>
                                                        <?php echo $ships['state']; ?>
                                                    </option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <p id="shipping_charge" class=""></p>
                                                <span class="error errormsg mt-2" id="shipping_code_error"></span>
                                                <span class="error errormsg mt-2" id="checkout_userstate_error"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Address -->
                                    <div class="col-md-12">
                                        <div class="quform-element form-group">
                                            <label for="name">Address <span class="quform-required">*</span></label>
                                            <div class="quform-input">
                                                <input class="form-control" type="text" name="checkout_useraddress">
                                                <span class="error errormsg mt-2"
                                                    id="checkout_useraddress_error"></span>
                                            </div>
                                        </div>
                                    </div>


                                    <!-- coupon code -->

                                    <?php endif; ?>

                                </div>
                            </div>

                        </form>
                    </div>

                    <div class="col-lg-5 offset-lg-2 col-md-6">
                        <div class="col-12 cart-total pt-3 pt-md-5">
                            <div class="row">
                                <!-- text input element -->
                                <div class="col-lg-12  col-md-6">
                                    <!-- Coupon code -->
                                    <form action="#" id="apply_coupon_form" method="post">
                                        <?php if ($ordertype == 'ws' || $ordertype == 'bb' || $ordertype == 'exp') {
                                            $dnone= 'd-none';
                                        } else {
                                            $dnone = '';
                                        } ?>
                                        <div class="col-md-12 <?php echo $dnone; ?>">
                                            <div class="quform-element form-group">
                                                <label for="country1">Coupon Code<span
                                                        class="quform-required">*</span></label>
                                                <div class="quform-input">
                                                    <input type="text" class="form-control mb-2" id="coupons_code"
                                                        name="coupons_code" placeholder="Enter Your Coupon code">
                                                    <input type="hidden" class="form-control mb-2" name="total_price"
                                                        id="total_price" value="<?php echo $sumofprice ?>" />

                                                    <button type="button" class="butn small float-end"
                                                        id="apply_coupon">
                                                        <span>Apply Code</span>
                                                    </button>

                                                </div>


                                            </div>
                                            <div>
                                                <span class="error errormsg mt-2" id="coupons_code_error"></span>
                                            </div>
                                        </div>

                                    </form>
                                    <table class="table cart-sub-total">
                                        <tbody>
                                            <tr class="total">
                                                <th class="text-end pe-0">Item Total(MRP)</th>
                                                <td class="text-end pe-0" style="font-weight: bold;">
                                                    <?php echo $symbol; ?>
                                                    <?php echo $sumofprice; ?>
                                                </td>
                                            </tr>


                                            <tr class="total d-none">
                                                <th class="text-end pe-0">Discount From MRP</th>
                                                <td class="text-end pe-0 couponcode">
                                                    <?php echo $symbol?> </td>
                                            </tr>


                                            <?php if ($customerdetails['coupon_code'] != 0): ?>
                                            <tr class="total">
                                                <th class="text-end pe-0">Discount From MRP</th>
                                                <td class="text-end pe-0"> <?php echo $symbol?>
                                                    <?php echo $couponcode; ?></td>
                                            </tr>
                                            <?php endif; ?>


                                            <?php if ($ordertype == 'ws' || $ordertype == 'bb' || $ordertype == 'exp') {
                                                    $dnone= 'd-none';
                                                } else {
                                                    $dnone = '';
                                                } ?>
                                            <tr class="delivery <?php echo $dnone; ?>">
                                                <th class="text-end pe-0 delivery-charge ">Delivery charge (total weight
                                                    : <?php echo $weightcalculation; ?>)</th>
                                                <td class="text-end pe-0 shipping">
                                                    <?php echo $customerdetails['shipping_charge'];  ?>
                                                </td>
                                            </tr>


                                            <?php
                    $total_amout = $sumofprice;
                    if ($customerdetails['coupon_code'] != 0) {
                        $total_amout -= $customerdetails['coupon_code'];
                    }
                    if ($customerdetails['shipping_charge'] != 0) {
                        $total_amout += $customerdetails['shipping_charge'];
                    }
                ?>
                                            <input type="hidden" id="total_amount" value="<?= $total_amout; ?>">
                                            <tr class="total">
                                                <th class="text-end pe-0">Total Amount</th>
                                                <td class="text-end pe-0 totalamount" style="font-weight: bold;">

                                                    <?php echo $symbol?> <?php echo $total_amout; ?>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td class="pe-0" colspan="2">
                                                    <hr>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <a class="butn primary float-end" id="saveuserorder" href="#!"><span>Place
                                            Order</span></a>



                                </div>



                                <div class="alert alert-success mt-4 d-none" role="alert">

                                </div>

                                <div class="alert alert-danger mt-4 d-none" role="alert">

                                </div>




                            </div>

                        </div>


                    </div>
                    <!-- end ship diffrent address -->

                    <!-- total block set -->
                    <div class="col-12 cart-total pt-3 pt-md-5">
                        <div class="row">

                            <div class="col-lg-5 col-md-6 mb-1-9 mb-md-0">



                            </div>


                        </div>
                    </div>
                    <!-- end total block set -->

                </div>
                <!-- end form design block set -->

            </div>
        </section>




    </div>

</body>

<script src="<?php echo base_url();?>assets/website/js/jquery.js"></script>
<script>
$(document).ready(function() {
    var $token = $('#product_token').val();
    //  alert($token);   
});


$('#state').on('change', function(e) {
    var stateId = $(this).val();

    if (stateId) {
        var charge = $(this).find('option:selected').data('shipping-charge');
        // Get the weight and extract value + unit
        var rawWeight = document.getElementById('weight').value.trim(); // e.g., "250g" or "1.5kg"
        var match = rawWeight.match(/^([\d.]+)\s*(kg|g)$/i);
        var weightValue = parseFloat(match[1]);
        var unit = match[2].toLowerCase();

        // Convert to kg if needed
        var weightInKg = unit === 'g' ? weightValue / 1000 : weightValue;

        // Calculate shipping
        var calculateweight = weightInKg * charge;

        // Apply minimum charge if under 1kg
        if (weightInKg < 1) {
            calculateweight = charge;
        }

        // Total price update
        var total_amount = parseFloat($('#total_price').val()) || 0;
        var total_amounts = total_amount + calculateweight;
        // Update UI
        $('.shipping').text('Rs. ' + calculateweight.toFixed(2));
        $('.total_amount').text('Rs. ' + total_amounts.toFixed(2));
        $('#total_price').val(total_amounts.toFixed(2));
        loadshippingchargedatabase(calculateweight);

    } else {
        $('#collapseTwo').collapse('show');
    }
});




function loadshippingchargedatabase(shipping_charge) {
    var selectedState = $('#state').val(); // get the selected state ID
    //  alert(selectedState);
    // alert(shipping_charge);
    $.ajax({
        url: '<?php echo base_url(); ?>' + 'cart/update_shipping_charge',
        type: 'POST',
        data: {
            'shipping_charge': shipping_charge,
            'selected_state': selectedState
        },
        dataType: 'json',
        success: function(response) {
            if (response.success == 'success') {
                console.log(response);
                $('.shipping').text('₹' + response.message);
                $('.totalamount').text(response.total_amout);
                // $('.total').removeClass('d-none');
                // $('.couponcode').text('₹' + response.coupon_code);
                $('#total_amount').val(response.total_amout);
                //  $('#shipping_calculation').addClass('d-none');  // ✅ Hide dropdown
                // $('#shipping_code_error').html(response.message);
            } else {}
        }
    })
}
</script>

</html>