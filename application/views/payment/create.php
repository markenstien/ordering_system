<style type="text/css">
    
body{
  background-color: #eee;
}

.text-secondary-d1 {
    color: #728299!important;
}
.page-header {
    margin: 0 0 1rem;
    padding-bottom: 1rem;
    padding-top: .5rem;
    border-bottom: 1px dotted #e2e2e2;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-pack: justify;
    justify-content: space-between;
    -ms-flex-align: center;
    align-items: center;
}
.page-title {
    padding: 0;
    margin: 0;
    font-size: 1.75rem;
    font-weight: 300;
}
.brc-default-l1 {
    border-color: #dce9f0!important;
}

.ml-n1, .mx-n1 {
    margin-left: -.25rem!important;
}
.mr-n1, .mx-n1 {
    margin-right: -.25rem!important;
}
.mb-4, .my-4 {
    margin-bottom: 1.5rem!important;
}

hr {
    margin-top: 1rem;
    margin-bottom: 1rem;
    border: 0;
    border-top: 1px solid rgba(0,0,0,.1);
}

.text-grey-m2 {
    color: #888a8d!important;
}

.text-success-m2 {
    color: #86bd68!important;
}

.font-bolder, .text-600 {
    font-weight: 600!important;
}

.text-110 {
    font-size: 110%!important;
}
.text-blue {
    color: #478fcc!important;
}
.pb-25, .py-25 {
    padding-bottom: .75rem!important;
}

.pt-25, .py-25 {
    padding-top: .75rem!important;
}
.bgc-default-tp1 {
    background-color: rgba(121,169,197,.92)!important;
}
.bgc-default-l4, .bgc-h-default-l4:hover {
    background-color: #f3f8fa!important;
}
.page-header .page-tools {
    -ms-flex-item-align: end;
    align-self: flex-end;
}

.btn-light {
    color: #757984;
    background-color: #f5f6f9;
    border-color: #dddfe4;
}
.w-2 {
    width: 1rem;
}

.text-120 {
    font-size: 120%!important;
}
.text-primary-m1 {
    color: #4087d4!important;
}

.text-danger-m1 {
    color: #dd4949!important;
}
.text-blue-m2 {
    color: #68a3d5!important;
}
.text-150 {
    font-size: 150%!important;
}
.text-60 {
    font-size: 60%!important;
}
.text-grey-m1 {
    color: #7b7d81!important;
}
.align-bottom {
    vertical-align: bottom!important;
}

#bill-container{
  background-color: #fff;
  padding: 15px;
}
</style>
<div id="bill-container">
    <div class="text-center">
        <h2>INVOICE</h2>

        <?php if(isset($user_data) ):?>
            <a href="<?php echo base_url("/orders/show/{$order['id']}")?>" style="text-decoration:underline; color: #000;">Show Order</a>
        <?php endif?>
    </div>
    
    <?php flash()?>
  <div class="row">
      <div class="col-sm-6">
          <div>
              <span class="text-sm text-grey-m2 align-middle">To:</span>
              <span class="text-600 text-110 text-blue align-middle">
                <?php echo $order['customer_name']?>
                <input type="hidden" id="cx_name" value="<?php echo $order['customer_name']?>">        
            </span>
          </div>
          <div class="text-grey-m2">
              <div class="my-1">
                 <i class="fa fa-address-card"></i> <?php echo $order['customer_address']?>
              </div>
              <div class="my-1"><i class="fa fa-phone"></i> 
                <b class="text-600"><?php echo $order['customer_phone']?></b></div>
              <div class="my-1"><i class="fa fa-envelope"></i> <?php echo $order['customer_email']?></div>
          </div>
      </div>
      <!-- /.col -->

      <div class="text-95 col-sm-6 align-self-start d-sm-flex justify-content-end">
          <hr class="d-sm-none" />
          <div class="text-grey-m2">

              <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">Invoice#:</span> <?php echo $order['bill_no']?></div>

              <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> 
                <span class="text-600 text-90">Issue Date:</span>
                <?php echo date('Y-m-d' ,$order['date_time'])?>
              </div>

              <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> 
                <span class="text-600 text-90">Status:</span> <?php echo $order['payment_status']?>
              </div>
          </div>
      </div>
      <!-- /.col -->
  </div>

  <div class="mt-4">
      <div class="row text-600 text-white bgc-default-tp1 py-25">
          <div class="d-none d-sm-block col-1">#</div>
          <div class="col-9 col-sm-5">Description</div>
          <div class="d-none d-sm-block col-4 col-sm-2">Qty</div>
          <div class="d-none d-sm-block col-sm-2">Unit Price</div>
          <div class="col-2">Amount</div>
      </div>

      <div class="text-95 text-secondary-d3">
        <?php $total = 0 ?>
        <?php foreach( $order['items'] as $row) :?>
          <?php $total += $row['amount']?>
          <div class="row mb-2 mb-sm-0 py-25">
              <div class="d-none d-sm-block col-1">1</div>
              <div class="col-9 col-sm-5"><?php echo $row['name']?></div>
              <div class="d-none d-sm-block col-2"><?php echo $row['qty']?></div>
              <div class="d-none d-sm-block col-2 text-95"><?php echo $row['rate']?></div>
              <div class="col-2 text-secondary-d2"><?php echo $row['amount']?></div>
          </div>
        <?php endforeach?>
      <div class="row border-b-2 brc-default-l2"></div>

      <hr>
      <div class="row mt-3">
          <div class="col-12 col-sm-7 text-grey-d2 text-95 mt-2 mt-lg-0">

          </div>

          <div class="col-12 col-sm-5 text-grey text-90 order-first order-sm-last">
              <div class="row my-2 align-items-center bgc-primary-l3 p-2">
                  <div class="col-7 text-right">
                      Total Amount
                  </div>
                  <div class="col-5">
                      <span class="text-150 text-success-d3 opacity-2">PHP <?php amountHTML($order['net_amount']) ?></span>
                      
                      <?php if($order['discount']) : ?>
                          <div><small>Discount : <?php echo $order['discount']?> </small></div>
                      <?php endif?>

                      <input type="hidden" name="total_amount" id="total_amount" value="<?php echo $order['net_amount']?>">
                      <input type="hidden" name="bill_id" id="bill_id" value="<?php echo $order['id']?>">
                      <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_data['id'] ?? 0?>">
                  </div>
              </div>
          </div>
      </div>

      <hr />
      <div>
          <div class="card-footer text-center">
              <?php if( isEqual($order['paid_status'], 0) ) :?>
                <br><br><br>
                <div class="row">
                    <div class="col-md-6">
                        <h4>Pay Via Card/Paypal</h4>
                        <div id="paypal-button-container"></div>
                    </div>

                     <div class="col-md-6">
                        <h4>Pay Via Gcash</h4>
                        <img src="<?php echo base_url('assets/images/gcash_qr.png')?>">
                        <p>
                            Don't Know how to pay gcash using QR code? 
                            refer  <a href="https://help.gcash.com/hc/en-us/articles/360017722773-How-do-I-pay-using-the-QR-" target="_blank">
                                <span style="color:#000;text-decoration: underline;">here</span>.
                            </a>
                        </p>

                        <a href="#gCashPaymentAttachment" class="btn btn-primary toolbar-btn header-icon" 
                        data-toggle="modal" data-target="#exampleModal">Attach payment proof</a>
                    </div>
                </div>
                   
              <?php endif?>
          </div>
      </div>
  </div>
</div>



<!--- PAYMENT PROOF MODAL -->

<div class="offcanvas-minicart_wrapper" id="gCashPaymentAttachment">
    <div class="offcanvas-menu-inner">
        
        <div class="close-btn-box">
            <a href="#" class="btn-close"><i class="icon-cross2"></i></a>
        </div>
        <div class="offcanvas-content">
            <div class="row">
                <div class="col"><h4>Gcash Payment Attachment</h4></div>
                <div class="col"><img src="https://business.inquirer.net/wp-content/blogs.dir/5/files/2020/07/gcash-logo.png" style="width:50px"></div>
            </div>
            <hr>
            <?php
                echo f_open([
                    'method' => 'post',
                    'action' => base_url('Payment/submit_payment_gcash'),
                    'enctype' => 'multipart/form-data'
                ] , true);
            ?>

            <input type="hidden" name="amount" value="<?php echo $order['net_amount']?>">
            <input type="hidden" name="method" value="online">
            <input type="hidden" name="order_id" value="<?php echo $order['id']?>">
            <input type="hidden" name="user_id" value="<?php echo $user_data['id']?>">


            <div class="form-group">
                <?php
                    echo f_label('Account Name');
                    echo f_text('account_name' , '' , [
                        'class' => 'form-control',
                        'required' => true
                    ]);
                ?>
            </div>

            <div class="form-group">
                <?php
                    echo f_label('Account Number');
                    echo f_text('account_number' , '' , [
                        'class' => 'form-control',
                        'required' => true
                    ]);
                ?>
            </div>

            <div class="form-group">
                <?php
                    echo f_label('Amount');
                    echo f_text('amount_paid' , '' , [
                        'class' => 'form-control',
                        'required' => true
                    ]);

                    echo "Total Amount to pay {$order['net_amount']}";
                ?>
            </div>

            <div class="form-group">
                <?php
                    echo f_label('GCASH-Reference Number');
                    echo f_text('reference_number' , '' , [
                        'class' => 'form-control',
                        'required' => true
                    ]);
                ?>
            </div>

            <div class="form-group">
                <label>Image</label>
                <input type="file" name="payment_image" class="form-control" required>
            </div>

            <hr>

            <label>
                <input type="checkbox" name="" required>
                Tick the box to agree that you have paid the total amount of 
                <strong>PHP <?php echo amountHTML($order['net_amount']) ?></strong>
            </label>

            <div class="form-group">
                <input type="submit" name="btn_send_payment" class="btn btn-primary" value="Send Payment">
            </div>
            <?php echo f_close() ?>
        </div>
    </div>
</div>

<?php
  $thank_you_url =  base_url('payment/thank_you_page');
  $catch_payment_url = site_url('payment/submit_payment');
?>

<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
<script src="https://www.paypal.com/sdk/js?client-id=<?php echo paypal('client_id')?>&currency=PHP" defer></script>
<script defer>
    $( document ).ready( function(e)
    {
        let url = "<?php echo $catch_payment_url?>";
        let amount = parseInt(document.getElementById('total_amount').value);
        let bill_id = $('#bill_id').val();
        let user_id = $('#user_id').val();

        paypal.Buttons({
            // Set up the transaction
            createOrder: function(data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: amount
                        }
                    }]
                });
            },
            // Finalize the transaction
            onApprove: function(data, actions) {
                return actions.order.capture().then(function(orderData) 
                {
                    let payer = orderData.payer;
                    $.ajax({
                        url : url,
                        method :'post',
                        data : {
                            amount:amount,
                            method:'online',
                            external_reference: orderData.id,
                            acc_name : $("#cx_name").val(),
                            email : payer.email_address,
                            order_id: bill_id,
                            user_id: user_id
                        },

                        success: function(response)
                        {
                          console.log([
                            "Payment Success",
                            response
                          ]);
                        }
                    }).done( function() 
                    {
                      window.location = "<?php echo $thank_you_url?>?payment_ID="+orderData.id;
                    });
                });
            },

            onCancel:function(data){
                alert('Payment Cancelled');
            }
        }).render("#paypal-button-container");
    });
</script>