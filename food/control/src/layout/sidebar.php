        <style>
          .modal-header {
            background: linear-gradient(to right, #e52d27, #b31217);
            color: white;
          }
        </style>

        <?php
        if (!isset($_SESSION['adminid'])) {
          header("Location: ../../login");
        ?>
          <script>
            window.location.replace("../../login");
          </script>
        <?php
          die();
        }
        $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        $sidemenu = select('sidebar_menu', [
          "conditions" => [
            'status' => 1
          ],
          "order" => [
            "order_by" => 'asc'
          ]
        ]);
        // pr($sidemenu);


        ?>








        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar" style="background: #0f2027;background: -webkit-linear-gradient(to right, #0f2027, #203a43, #2c5364);background: linear-gradient(to right, #0f2027, #30464d, #091b23);">
          <!-- sidebar: style can be found in sidebar.less -->
          <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
            

            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu">

              <?php

              foreach ($sidemenu as $menu) {

                if (in_array($_SESSION['adminid'], explode(",", $menu['access_account']))) {
              ?>

                  <li class="<?php if (strpos($actual_link, $menu["folder_name"]) !== false) {
                                echo "active";
                              } ?>">
                    <a href="../<?php echo $menu["folder_name"]; ?>">
                      <?php echo $menu["icon"]; ?>
                      <span> <?php echo $menu["name"]; ?> </span>
                    </a>
                  </li>

              <?php
                }
              }

              ?>





              <!--<li class="<?php if (strpos($actual_link, "inventory") !== false || strpos($actual_link, "add_inventory_items") !== false || strpos($actual_link, "add_unites") !== false || strpos($actual_link, "stocks") !== false || strpos($actual_link, "issue") !== false) {
                                echo "active";
                              } ?>">-->
              <!--  <a href="../inventory">-->
              <!--    <i class="fa fa-th" style="color: #C60 !important;"></i> <span>Inventory Management</span> -->
              <!--  </a>-->
              <!--</li>-->


            </ul>
          </section>
          <!-- /.sidebar -->
        </aside>
        <!-- Right side column. Contains the navbar and content of the page -->
        <div class="content-wrapper">


          <!-- Main content -->
          <section class="content">