<div id="main-wrapper">
  <div class="site-wrapper-reveal">
      <div class="hero-box-area">
          <div class="container">
            <div class="col-md-8 mx-auto">
            <?php flash()?>
            <?php
              __([
                f_open(['url' => base_url('users/register') , 'action' => 'post' ]),
                f_hidden('is_verified' , false),
                f_hidden('user_type' , 'customer')
              ]);
            ?>

            <div class="form-group mb-3">
              <div class="row">
                <div class="col-md-6">
                  <?php
                    __(
                      f_col(f_label('first name*', 'firstname'),
                      f_text('firstname' , '', ['class' => 'form-control' , 'id' => 'id_firstname' ,
                        'placeholder' => 'First Name' , 'required' => true]))
                    );
                  ?>
                </div>
                <div class="col-md-6">
                  <?php
                    __(
                      f_col(f_label('last name*', 'lastname'),
                      f_text('lastname' , '', ['class' => 'form-control' , 'id' => 'id_lastname' ,
                      'placeholder' => 'Last name' , 'required' => true]))
                    );
                  ?>
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="row">
                <div class="col-md-6">
                  <?php
                    __(
                      f_col(f_label('Email*', 'email'),
                      f_text('email' , '', ['class' => 'form-control' , 'id' => 'id_email' ,
                        'placeholder' => 'email' , 'required' => true]))
                    );
                  ?>
                </div>
                <div class="col-md-6 mb-3">
                  <?php
                    __(
                      f_col(f_label('Phone Number*', 'phone'),
                      f_text('phone' , '', ['class' => 'form-control' , 'id' => 'id_phone' ,
                      'placeholder' => 'eg.09xxxxxxxx' , 'required' => true]))
                    );
                  ?>
                </div>
              </div>
            </div>

            <div class="form-group mb-3">
              <div class="row">
                <div class="col-md-6">
                  <?php
                    __(
                      f_col(f_label('username', 'username'),
                      f_text('username' , '', ['class' => 'form-control' , 'id' => 'id_username']))
                    );
                  ?>
                </div>

                <div class="col-md-6">
                  <?php
                    __(
                      f_col(f_label('password', 'password'),
                      f_password('password' , '', ['class' => 'form-control' , 'id' => 'id_password']))
                    );
                  ?>
                </div>
              </div>
            </div>

            <div class="form-group mb-3">
              <?php
                __(
                  f_col(f_label('Delivery Address', 'address'),
                  f_textarea('address' , '', ['class' => 'form-control' , 'id' => 'id_password']))
                );
              ?>
            </div>

            <?php echo f_submit('Register' , 'Register')?>
            <?php __( f_close() )?>
          </div>
          </div>
      </div>
  </div>
</div>