 <div class="mainbar">

    <div class="container">

        <button data-target=".mainbar-collapse" data-toggle="collapse" class="btn mainbar-toggle" type="button">
            <i class="fa fa-bars"></i>
        </button>

        <div class="mainbar-collapse collapse">

            <ul class="nav navbar-nav mainbar-nav col-md-9">

                <li id="dashboard" <?php echo ($current_route=='common/vdi_dashboard')? 'class="active"':''; ?>>
                    <a href="<?php echo $home; ?>"> <i class="fa fa-dashboard"></i> <span><?php echo $text_dashboard; ?></span></a>
                </li>

                <li id="catalog" class="dropdown <?php echo ($current_route=='catalog/vdi_product' || $current_route=='catalog/vdi_information')? 'active':''; ?>">
                    <a data-hover="dropdown" data-toggle="dropdown" class="dropdown-toggle" href="#about">
                        <i class="fa fa-tags fa-fw"><span class="badge"><?=$top_product_total;?></span></i>
                        <span><?php echo $text_catalog; ?></span>
                        <span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu">
                        <li><a href="<?php echo $vdi_product; ?>"><i class="fa fa-bars nav-icon"></i> <?php echo $text_product; ?></a></li>
                        <!--<li><a href="<?php echo $vdi_information; ?>"><i class="fa fa-list-alt nav-icon"></i> <?php echo $text_information; ?></a></li>-->
                    </ul>
                </li>

                <li id="sale" class="dropdown <?php echo ($current_route=='sale/vdi_order' || $current_route=='report/vdi_transaction')? 'active':''; ?>">
                    <a data-hover="dropdown" data-toggle="dropdown" class="dropdown-toggle" href="javascript:;">
                        <i class="fa fa-shopping-cart fa-fw"></i>
                        <span><?php echo $text_sale; ?></span>
                        <span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu">
                        <li>
                            <a href="<?php echo $vdi_sale_order; ?>">
                                <i class="fa fa-money nav-icon"></i>
                                <?php echo $text_order; ?>
                            </a>
                        </li>

                        <li>
                            <a href="<?php echo $vdi_transaction; ?>">
                                <i class="fa fa-table nav-icon"></i>
                                <?php echo $text_vendor_transaction; ?>
                            </a>
                        </li>
                    </ul>
                </li>


                <li id="reports" class="dropdown <?php echo ($current_route=='report/vdi_product_viewed' || $current_route=='report/vdi_product_purchased')? 'active':''; ?>">
                    <a data-hover="dropdown" data-toggle="dropdown" class="dropdown-toggle" href="javascript:;">
                        <i class="fa fa-bar-chart-o fa-fw"></i>
                        <span><?php echo $text_reports; ?></span>
                        <span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu">
                        <li><a href="<?php echo $vdi_report_product_viewed; ?>"><i class="fa fa-line-chart nav-icon"></i> <?php echo $text_report_product_viewed; ?></a></li>
                        <li><a href="<?php echo $vdi_report_product_purchased; ?>"><i class="fa fa-dollar nav-icon"></i> <?php echo $text_report_product_purchased; ?></a></li>
                    </ul>
                </li>

                <li id="my_carriers" <?php echo ($current_route=='module/vdi_my_carriers')? 'class="active"':''; ?>>
                    <a href="<?php echo $vdi_my_carriers; ?>">

                        <i class="fa fa-truck nav-icon"><span class="badge"><?=$top_transporteurs;?></span></i>
                        <span><?php echo $text_my_carriers; ?></span></a>
                </li>


                <li id="reports" class="dropdown <?php echo ($current_route=='catalog/vdi_vendor_profile' || $current_route=='catalog/vdi_vendor_profile'  || $current_route=='catalog/vdi_contract_history')? 'active':''; ?> ">
                    <a data-hover="dropdown" data-toggle="dropdown" class="dropdown-toggle" href="#contact">
                        <i class="fa fa-user fa-fw"></i>
                        <span><?php echo $text_vendor_personal; ?></span>
                        <span class="caret"></span>
                    </a>

                    <ul role="menu" class="dropdown-menu">
                        <?php if ($expiration_date) { ?>
                        <li>
                            <a href="<?php echo $vdi_contract_history; ?>">
                                <i class="fa fa-history"></i>
                                <?php echo $text_contract_history; ?>
                            </a>
                        </li>
                        <?php } ?>

                        <li>
                            <a href="<?php echo $vdi_update_vendor_profile; ?>">
                                <i class="fa fa-pencil-square-o"></i>
                                &nbsp;&nbsp;<?php echo $text_vendor_update_profile; ?>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo $vdi_user_password; ?>">
                                <i class="fa fa-pencil-square-o"></i>
                                &nbsp;&nbsp;<?php echo $text_vendor_update_password; ?>
                            </a>
                        </li>

                    </ul>
                </li>

                <!--<li><?php echo $stats; ?></li>-->
            </ul>
            <ul class="nav navbar-nav navbar-right col-md-3 welcome-info">
                <li><?php echo $welcome.' '.$firstname.', '; ?></li>
                <li><?php echo $user_group ?></li>
                <li><?php echo $company ?></li>
                 <li>ID&nbsp;<?php echo $vendor_id ?></li>
                <li><?php echo date('d/m/Y'); ?></li>
            </ul>

        </div> <!-- /.navbar-collapse -->

    </div> <!-- /.container -->

</div>
