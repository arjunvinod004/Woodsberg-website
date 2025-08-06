<div class="application-navigation container">
    <ul class="application-navigation__ul">
        <li class="application-navigation__li">
            <a href="<?php echo base_url('dashboard'); ?>"
                class="application-navigation__a <?php echo ($controller == 'Dashboard' || $controller == 'dashboard') ? 'application-navigation__a--active' : ''; ?>">Dashboard</a>
        </li>
        <li class="application-navigation__li">
            <a href="<?php echo base_url('admin/product/index/0'); ?>"
                class="application-navigation__a <?php echo ($controller == 'product') ? 'application-navigation__a--active' : ''; ?>">
                Catalog</a>
        </li>

        <li class="application-navigation__li">
            <a href="<?php echo base_url('admin/export/index/0'); ?>"
                class="application-navigation__a <?php echo ($controller == 'export') ? 'application-navigation__a--active' : ''; ?>">
                Export</a>
        </li>
        <!-- <li class="application-navigation__li">
            <a href="<?php echo base_url('admin/order'); ?>"
                class="application-navigation__a <?php echo ($controller == 'order') ? 'application-navigation__a--active' : ''; ?>">Order
                Monitor</a>
        </li> -->

        <li class="application-navigation__li">
            <a href="<?php echo base_url('admin/store'); ?>"
                class="application-navigation__a <?php echo ($controller == 'store') ? 'application-navigation__a--active' : ''; ?>">Store</a>
        </li>
        
        <li class="application-navigation__li">
            <a href="<?php echo base_url('admin/order'); ?>"
                class="application-navigation__a <?php echo ($controller == 'order') ? 'application-navigation__a--active' : ''; ?>">Order</a>
        </li>



        <li class="application-navigation__li">
            <a href="<?php echo base_url('admin/reports'); ?>"
                class="application-navigation__a <?php echo ($controller == 'reports') ? 'application-navigation__a--active' : ''; ?>">Reports</a>
        </li>
        <li class="application-navigation__li">
            <a href="<?php echo base_url('admin/settings'); ?>"
                class="application-navigation__a <?php echo ($controller == 'settings') ? 'application-navigation__a--active' : ''; ?>">Settings</a>
        </li>
       
        <li class="application-navigation__li">
            <a href="<?php echo base_url('admin/'); ?>" class="application-navigation__a">Logout</a>
        </li>
    </ul>
</div>