<div class="content-wrapper">
  <section class="content-header">
    <h1>Manage
      <small>payment</small></h1>
  </section>

  <section class="content">
    <div class="box">
      <div class="box-header">
        <h4 class="box-title">Edit GCASH Payment</h4>
      </div>

      <div class="box-body">
        <?php
            echo f_open([
                'method' => 'post',
                'action' => base_url('Payment/gcash_edit/'.$gcash['id']),
                'enctype' => 'multipart/form-data'
            ] , true);
        ?>

        <input type="hidden" name="amount" value="<?php echo $order['net_amount']?>">
        <input type="hidden" name="method" value="online">
        <input type="hidden" name="order_id" value="<?php echo $order['id']?>">
        <input type="hidden" name="user_id" value="<?php echo $user_data['id']?>">

        <div class="row">
          <div class="col-md-7">
            <div class="form-group">
              <?php
                  echo f_label('Account Name');
                  echo f_text('account_name' , $gcash['account_name'] , [
                      'class' => 'form-control',
                      'required' => true
                  ]);
              ?>
            </div>

            <div class="form-group">
                <?php
                    echo f_label('Account Number');
                    echo f_text('account_number' , $gcash['account_number'] , [
                        'class' => 'form-control',
                        'required' => true
                    ]);
                ?>
            </div>

            <div class="form-group">
                <?php
                    echo f_label('Amount');
                    echo f_text('amount_paid' , $gcash['amount_paid'] , [
                        'class' => 'form-control',
                        'required' => true
                    ]);

                    echo "Total Amount to pay {$order['net_amount']}";
                ?>
            </div>

            <div class="form-group">
                <?php
                    echo f_label('GCASH-Reference Number');
                    echo f_text('reference_number' , $gcash['reference_number'] , [
                        'class' => 'form-control',
                        'required' => true
                    ]);
                ?>
            </div>

          </div>

          <div class="col-md-5">
            <div class="form-group">
                <label>Image</label>
                <input type="file" name="payment_image" class="form-control">
            </div>

            <img src="<?php echo base_url($gcash['image_src'])?>">
          </div>
        </div>
        <div class="form-group">
            <input type="submit" name="btn_send_payment" class="btn btn-primary" value="Update Payment">
        </div>
        <?php echo f_close() ?>
      </div>
    </div>
  </section>
</div>