<!--====================  header area ====================-->
    <div class="header-area header-area--default bg-white">

        <!-- Header Bottom Wrap Start -->
        <header class="header-area   header-sticky">
            <div class="container-fluid container-fluid--cp-100">
                <div class="row">
                    <div class="col-lg-12 d-none d-md-block">
                        <div class="top-logo-area">
                            <div class="logo text-md-center">
                                <a href="index.html"><img src="assets/images/logo/logo.svg" alt=""></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row align-items-center pt-3 pb-3">

                    <div class="col-lg-3 col-lg-3 col-6">
                        <div class="header-right-items content__hidden d-none d-md-block">
                            <a href="#" class=""><span class="phone-number font-lg-p"> <i class="icon-telephone"></i> 09994208238</span></a>
                        </div>
                        <div class="logo__hidden text-start">
                            <a href="#"><img src="assets/images/logo/logo.svg" alt=""></a>
                        </div>
                    </div>

                    <div class="col-lg-6 col-lg-6  d-none d-lg-block">
                        <div class="header__navigation d-none d-lg-block">
                            <nav class="navigation-menu">
                                <ul class="justify-content-center">
                                     <?php if( isset($this->data['user_data']) ):?>
                                      <li><a class="nav-link" href="<?php echo base_url('users/profile')?>">Profile</a></li>
                                    <?php endif?>
                                    <li class="nav-item">
                                      <a class="nav-link" href="<?php echo base_url('landing/index')?>">Home
                                        <span class="visually-hidden">(current)</span>
                                      </a>
                                    </li>

                                    <li class="nav-item">
                                      <a class="nav-link" href="<?php echo base_url('landing/catalog')?>">Catalog
                                      </a>
                                    </li>
                                    <?php if( !isset($this->data['user_data']) ):?>
                                    &nbsp;
                                    <li class="nav-item">
                                        <a class="nav-link" href="<?php echo base_url('auth/login')?>">Login</a>
                                    </li>
                                    &nbsp;
                                    <li class="nav-item">
                                        <a class="nav-link" href="<?php echo base_url('users/register')?>">Register</a>
                                    </li>
                                  <?php endif?>

                                  <li class="nav-item">
                                      <a class="nav-link" href="<?php echo base_url('about/index')?>">About
                                      </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="col-lg-3 col-lg-3 col-6">
                        <div class="header-right-side text-end">
                            <div class="header-right-items">
                                <a href="javascript:void(0)" class="search-icon" id="search-overlay-trigger">
                                    <i class="icon-magnifier"></i>
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
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Header Bottom Wrap End -->

    </div>
    <!--====================  End of header area  ====================-->