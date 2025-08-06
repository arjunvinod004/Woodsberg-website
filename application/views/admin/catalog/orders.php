<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="">
    <div class="page-content p-2">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="add-new-dish-list-combo mb-3">
                    
                    <a href="<?php echo base_url('admin/settings'); ?>"   class="add-new-dish-btn btn1">
                        <img src="https://img.icons8.com/ios-filled/30/FFFFFF/circled-left-2.png
                        " alt="add new dish" class="add-new-dish__icon" width="23" height="23">
                      Back
                    </a>
                </div>
                    </div>
            </div>

             <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
  <li class="nav-item" role="presentation">
    <button class="nav-link active" id="pills-retail-tab" data-bs-toggle="pill" data-bs-target="#pills-retail" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Retail</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="pills-wholesale-tab" data-bs-toggle="pill" data-bs-target="#pills-wholesale" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Wholesale</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="pills-b2b-tab" data-bs-toggle="pill" data-bs-target="#pills-b2b" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">B2B</button>
  </li>

   <li class="nav-item" role="presentation">
    <button class="nav-link" id="pills-exp-tab" data-bs-toggle="pill" data-bs-target="#pills-exp" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Export</button>
  </li>


</ul>
<!-- Tab -->
<div class="tab-content" id="pills-tabContent">
  <!-- Retail -->
  <div class="tab-pane fade show active" id="pills-retail" role="tabpanel" aria-labelledby="pills-retail-tab">

            <div class="row">
                <div class="">
                    <div class="table-responsive-sm">
                        <table id="example" class="table table-striped" style="width:100%">
                            <thead style="background: #e5e5e5;">
                                <tr>
                                    <th>No</th>
                                    <th>Order No</th>
                                    <th>Customer Name</th>
                                    <th>Phone No</th>
                                    <th>Total Amount</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                       if(!empty($orders)){
                       $count = 1;
                       foreach($orders as $val){ ?>
                        <?php if($val['order_type'] == 'rt'){ ?>
                                <tr>
                                    <td><?php echo $count;?></td>
                                    <td><?php echo $val['order_no'];?></td>
                                    <td>
                                      <?php echo $val['name'];?> 
                                    </td>
                                    <td><?php echo $val['phone'];?></td>
                                    <td><?php echo $val['total_amount'];?></td>

                                    <td class="pb-0 pt-0 d-flex">
                                            
                                            <button class="btn btn-success btn-sm  p-1 m-2  btn-sm tblEditBtn edit_order " type="submit" data-bs-toggle="modal" data-id="<?php echo $val['order_no']; ?>"data-bs-target="#edit-order">View Details</button>
                                        <!-- <a class="btn tblDelBtn pl-0 pr-0 del_category" type="button"
                                            data-bs-toggle="modal" data-id="<?php echo $val['id']; ?>"
                                            data-bs-original-title="Delete Category" data-bs-target="#delete-category"><i
                                                class="fa fa-trash"></i></a> -->

                                    </td>
                                </tr>
                                <?php $count++; }} ?>
                                <?php } ?>


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
  </div>
 <!-- Retail End -->
  <div class="tab-pane fade" id="pills-wholesale" role="tabpanel" aria-labelledby="pills-wholesale-tab">
   <!-- Wholesale -->
        <div class="row">
            <div class="">
                    <div class="table-responsive-sm">
                        <table id="example" class="table table-striped" style="width:100%">
                            <thead style="background: #e5e5e5;">
                                <tr>
                                    <th>No</th>
                                    <th>Order No</th>
                                    <th>Customer Name</th>
                                    <th>Phone No</th>
                                    <th>Total Amount</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                            <?php
                            if(!empty($orders)){
                            $count = 1;
                            foreach($orders as $val){ ?>
                            <?php if($val['order_type'] == 'ws'){ ?>
                                <tr>
                                    <td><?php echo $count;?></td>
                                    <td><?php echo $val['order_no'];?></td>
                                    <td>
                                      <?php echo $val['name'];?> 
                                    </td>
                                    <td><?php echo $val['phone'];?></td>
                                    <td><?php echo $val['total_amount'];?></td>

                                    <td class="pb-0 pt-0 d-flex">
                                            
                                            <button class="btn btn-success btn-sm  p-1 m-2  btn-sm tblEditBtn edit_order " type="submit" data-bs-toggle="modal" data-id="<?php echo $val['order_no']; ?>"data-bs-target="#edit-order">View Details</button>
                                        <!-- <a class="btn tblDelBtn pl-0 pr-0 del_category" type="button"
                                            data-bs-toggle="modal" data-id="<?php echo $val['id']; ?>"
                                            data-bs-original-title="Delete Category" data-bs-target="#delete-category"><i
                                                class="fa fa-trash"></i></a> -->

                                    </td>
                                </tr>
                                <?php $count++; }} ?>
                                <?php } ?>


                            </tbody>
                        </table>
                    </div>
                </div>
        </div>
  </div>
   <!-- Wholesale End -->

   <!-- b2b -->
  <div class="tab-pane fade" id="pills-b2b" role="tabpanel" aria-labelledby="pills-b2b-tab">
     <!-- b2b -->
            <div class="row">
            <div class="">
                    <div class="table-responsive-sm">
                        <table id="example" class="table table-striped" style="width:100%">
                            <thead style="background: #e5e5e5;">
                                <tr>
                                    <th>No</th>
                                    <th>Order No</th>
                                    <th>Customer Name</th>
                                    <th>Phone No</th>
                                    <th>Total Amount</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                            <?php
                            if(!empty($orders)){
                            $count = 1;
                            foreach($orders as $val){ ?>
                            <?php if($val['order_type'] == 'bb'){ ?>
                                <tr>
                                    <td><?php echo $count;?></td>
                                    <td><?php echo $val['order_no'];?></td>
                                    <td>
                                      <?php echo $val['name'];?> 
                                    </td>
                                    <td><?php echo $val['phone'];?></td>
                                    <td><?php echo $val['total_amount'];?></td>

                                    <td class="pb-0 pt-0 d-flex">
                                            
                                            <button class="btn btn-success btn-sm  p-1 m-2  btn-sm tblEditBtn edit_order " type="submit" data-bs-toggle="modal" data-id="<?php echo $val['order_no']; ?>"data-bs-target="#edit-order">View Details</button>
                                        <!-- <a class="btn tblDelBtn pl-0 pr-0 del_category" type="button"
                                            data-bs-toggle="modal" data-id="<?php echo $val['id']; ?>"
                                            data-bs-original-title="Delete Category" data-bs-target="#delete-category"><i
                                                class="fa fa-trash"></i></a> -->

                                    </td>
                                </tr>
                                <?php $count++; }} ?>
                                <?php } ?>


                            </tbody>
                        </table>
                    </div>
                </div>
        </div>
    <!-- b2b end -->
  </div>
<!-- b2b end -->


<!-- export -->
    <div class="tab-pane fade" id="pills-exp" role="tabpanel" aria-labelledby="pills-exp-tab">
            <div class="row">
            <div class="">
                    <div class="table-responsive-sm">
                        <table id="example" class="table table-striped" style="width:100%">
                            <thead style="background: #e5e5e5;">
                                <tr>
                                    <th>No</th>
                                    <th>Order No</th>
                                    <th>Customer Name</th>
                                    <th>Phone No</th>
                                    <th>Total Amount</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                            <?php
                            if(!empty($orders)){
                            $count = 1;
                            foreach($orders as $val){ ?>
                            <?php if($val['order_type'] == 'exp'){ ?>
                                <tr>
                                    <td><?php echo $count;?></td>
                                    <td><?php echo $val['order_no'];?></td>
                                    <td>
                                      <?php echo $val['name'];?> 
                                    </td>
                                    <td><?php echo $val['phone'];?></td>
                                    <td><?php echo $val['total_amount'];?></td>

                                    <td class="pb-0 pt-0 d-flex">
                                            
                                            <button class="btn btn-success btn-sm  p-1 m-2  btn-sm tblEditBtn edit_order " type="submit" data-bs-toggle="modal" data-id="<?php echo $val['order_no']; ?>"data-bs-target="#edit-order">View Details</button>
                                        <!-- <a class="btn tblDelBtn pl-0 pr-0 del_category" type="button"
                                            data-bs-toggle="modal" data-id="<?php echo $val['id']; ?>"
                                            data-bs-original-title="Delete Category" data-bs-target="#delete-category"><i
                                                class="fa fa-trash"></i></a> -->

                                    </td>
                                </tr>
                                <?php $count++; }} ?>
                                <?php } ?>


                            </tbody>
                        </table>
                    </div>
                </div>
        </div>
    <!-- export end -->
  </div>


</div>



            <!-- Modal for detailed view -->
            <div class="modal fade" id="emp_informations" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Employee Details</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <iframe src="emp-informations.html" style="width: 100%; height: 500px;"></iframe>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end -->
        </div>

    <!-- edit order -->
    <div class="modal fade" id="edit-order" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                       
                        <h2 class="modal-title vieworder" id="exampleModalLabel">view Order () </h2>
                        <button class="emigo-close-btn" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                     <form class="row mt-0 mb-0" id="edit_order" enctype="multipart/form-data" method="post" >
                         <input type="hidden" id="hidden_order_id" value="">
                    <div class="row">
                    <div class="table-responsive-sm">
                        <table id="orders" class="table table-striped" style="width:100%">
                        <thead style="background: #e5e5e5;">
                            <tr>
                                    
                                    <!-- <th>Order No</th> -->
                                    <th>Image</th>
                                    <th>Product Name</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Amount</th>
                                    
                            </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td id="order_no"></td>
                                    <td id="product_name"></td>
                                    <td id="quantity"></td>
                                    <td id="Total_Amount"></td>

                                    <!-- <td class="pb-0 pt-0 d-flex"> -->
                                            
                                            <!-- <button class="btn btn-success btn-sm  p-1 m-2  btn-sm tblEditBtn edit_order " type="submit" data-bs-toggle="modal" data-id="3" data-bs-target="#edit-order">View Details</button> -->
                                        <!-- <a class="btn tblDelBtn pl-0 pr-0 del_category" type="button"
                                            data-bs-toggle="modal" data-id="3"
                                            data-bs-original-title="Delete Category" data-bs-target="#delete-category"><i
                                                class="fa fa-trash"></i></a> -->

                                    <!-- </td> -->
                                </tr>
                                
                            </tbody>
                        </table>
                       <div class="d-flex justify-content-end">
                         <button class="btn btn-primary btn-lg mx-2" type="button" style=" font-size:16px !important;">Export Data</button>
                        <button class="btn btn-primary btn-lg fw-bold" type="button" style="font-size:16px !important;" id="total_price"></button>
                       </div>
                    </div>
                   
                    </div>
                    </form>
                    </div>
                   
                </div>
            </div>
        </div>

    </div>

    <!-- edit country -->



 <!-- success modal -->
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="emigo-modal__heading" id="exampleModalLabel"></h1>
                <button type="button" class="emigo-close-btn" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary reload-close-btn" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- success modal -->


    <!-- delete user -->
    <div class="modal fade " id="delete-category" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Delete</h1>
                    <button type="button" class="emigo-close-btn" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- if response within jquery -->
                    <div class="message d-none" role="alert"></div>
                    <input type="hidden" name="id" id="delete_cat_id" value="" />
                    <?php echo are_you_sure; ?>
                </div>
                <div class="modal-footer"><button class="btn btn-primary" type="button" data-bs-dismiss="modal">No</button>
                    <button class="btn btn-secondary" id="yes_cat_user" type="button" data-bs-dismiss="modal">Yes</button>
                </div>
    
                </form>
            </div>
        </div>
    </div>
    <!-- delete user -->










        </div>