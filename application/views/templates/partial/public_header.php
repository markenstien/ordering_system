<!--====================  header area ====================-->
    <div class="header-area header-area--default">

        <!-- Header Bottom Wrap Start -->
        <header class="header-area  header_height-90 header-sticky">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-4 col-md-4 col-6">
                        <div class="logo text-md-center">
                            <a href="index.html"><img src="<?php echo base_url('assets/images/bnk_logo_sm.png')?>"
                                style="width: 60px;"></a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-6">
                        <div class="header-right-side text-end">
                            <?php if( isset($this->data['user_data']) ):?>
                                <div class="header-right-items  d-none d-md-block">
                                    <a href="<?php echo base_url('users/profile')?>">Profile <i class="icon-user"></i></a>
                                </div>
                            <?php endif?>

                            <div class="header-right-items">
                                <a href="<?php echo base_url('landing/catalog')?>">
                                    <i class="icon-list"></i></a>
                            </div>

                            <div class="header-right-items">
                                <a href="<?php echo base_url('bundles/index')?>">
                                    <i class="icon-box"></i>
                                </a>
                            </div>

                             <?php if( $cart_items ) :?>
                                <div class="header-right-items">
                                    <a href="#miniCart" class=" header-cart minicart-btn toolbar-btn header-icon">
                                        <i class="icon-bag2"></i>
                                        <span class="item-counter"><?php echo count( $cart_items )?></span>
                                    </a>
                                </div>
                            <?php endif?>

                            <?php if( !isset($this->data['user_data']) ):?>
                                <div class="header-right-items">
                                    <a href="<?php echo base_url('auth/login')?>">
                                        <i class="icon-user"></i>
                                    </a>
                                </div>

                                <div class="header-right-items">
                                    <a href="<?php echo base_url('users/register')?>">
                                        <i class="icon-user-plus"></i>
                                    </a>
                                </div>
                           <?php endif?>

                           <div class="header-right-items">
                                <a href="<?php echo base_url('about/index')?>">
                                    <i class="icon-cog"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Header Bottom Wrap End -->

    </div>
    <!--====================  End of header area  ====================-->
