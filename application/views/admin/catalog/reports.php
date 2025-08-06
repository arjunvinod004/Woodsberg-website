<div class="application-content reports-content">
    <div class="application-content__container reports-content__container container">
        <!--<h1 class="application-content__page-heading">Reports</h1>-->
        <div class="reports-content__data">

           <!-- retail start -->

        <div class="modal-container">
                <a class="modal-trigger reports-content__item sales" data-store-id="<?php echo $store_id; ?>"
                    data-name="SALES">
                    <img src="<?php echo base_url();?>assets/admin/images/dollar-icon.svg" alt="dollar icon"
                        class="reports-content__item-icon">
                    <h2 class="reports-content__item-text">Retail</h2>
                </a>
                <div class="modal-window">
                    <div class="modal-wrapper">
                    <div class="modal-data">
                    <div class="row">
                    <div class="">
                    <div class="table-responsive-sm">
            <form class="row g-3">
                <!-- Product ID Field -->
              

                <!-- Date Field -->
                <div class="col-md-3 mb-3">
                    <label for="date" class="form-label">Date</label>
                    <input type="date" class="form-control" id="retail-date" name="retail-date" value="<?php echo date('Y-m-d'); ?>">
                
                </div>

                <div class="col-md-3" >
                 <label for="name" class="form-label">Name</label>
                <input type="text " class="form-control" id="retail-name" name="retail-name" value="">
                </div>

                <div class="col-md-3">
                 <label for="name" class="form-label">Phone No</label>
                <input type="text " class="form-control" id="retail-phone" name="retail-phone" value="">
                </div>


            </form>

        <div>
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
            <thead>
            <tr>
            <th>Date</th>
            <th>Retail</th>
            <th>Wholesale</th>
            <th>B2B</th>
            <th>Export</th>
            </tr>
            </thead>
            <tbody id="retail-report">
            <tr><td colspan="4" class="text-center">No sales data available.</td></tr>
            </tbody>
            </table>
        </div>

        </div>
        </div>
        </div>
        </div>
        <div class="close-icon"></div>
        </div>
        </div>
        </div>
    <!-- retail end -->

  

        </div>

    </div>
</div>