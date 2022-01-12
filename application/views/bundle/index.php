<div class="site-wrapper-reveal border-bottom">

    <!-- cart start -->
    <div class="cart-main-area  section-space--ptb_90">
        <div class="container">
            <?php flash()?>
                <?php foreach($bundles as $key => $row) :?>
                    <?php $price_amount = 0?>
                    <form method="get" action="<?php echo base_url('/cart/checkout?bundle_id='.$row['id'])?>">
                        <input type="hidden" name="bundle_id" value="<?php echo $row['id']?>">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title"><?php echo $row['name']?></h4>
                            </div>

                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <th>Name</th>
                                        <th>Amount</th>
                                        <th>Item Quantity</th>
                                    </thead>

                                    <tbody>
                                        <?php foreach($row['items'] as $itemKey => $itemRow) :?>
                                            <?php $price_amount += ($itemRow['price'] * $itemRow['quantity'])?>
                                            <tr>
                                                <td><?php echo $itemRow['name']?></td>
                                                <td><?php echo $itemRow['price']?></td>
                                                <td><?php echo $itemRow['quantity']?></td>
                                            </tr>
                                        <?php endforeach?>
                                    </tbody>
                                </table>

                                <h4>Total: <s><?php echo amountHTML($price_amount)?></s> <?php echo amountHTML($price_amount - $row['discount'])?></h4>
                            </div>

                            <div class="card-footer">
                                <input type="submit" name="" value="Checkout" class="btn btn-primary">
                            </div>
                        </div>
                    </form>
                <?php endforeach?>
        </div>
    </div>
    <!-- cart end -->

</div>
