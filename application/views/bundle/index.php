<div class="site-wrapper-reveal border-bottom">

    <!-- cart start -->
    <div class="cart-main-area  section-space--ptb_90">
        <div class="container">
            <?php flash()?>
                <?php foreach($bundles as $key => $row) :?>
                    <?php $no_stock_item = false?>
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
                                            <?php
                                                $no_stock = false;
                                                if( $itemRow['stocks'] < $itemRow['min_stock']) {
                                                    $no_stock_item = true;
                                                    $no_stock = true;
                                                }
                                            ?>
                                            <?php $price_amount += ($itemRow['price'] * $itemRow['quantity'])?>
                                            <tr>
                                                <td><?php echo $itemRow['name']?> 
                                                <?php echo $no_stock ? '<span class="text-danger"> No Stock </span>' : '' ?> </td>
                                                <td><?php echo $itemRow['price']?></td>
                                                <td><?php echo $itemRow['quantity']?></td>
                                            </tr>
                                        <?php endforeach?>
                                    </tbody>
                                </table>

                                <h4>Total: <s><?php echo amountHTML($row['price_public'])?></s> <?php echo amountHTML($row['price_public'] - $row['discount'])?></h4>
                            </div>

                            <div class="card-footer">
                                <?php if(!$no_stock_item) :?>
                                <input type="submit" name="" value="Checkout" class="btn btn-primary">
                                <?php else:?>
                                    <p>No Stock</p>
                                <?php endif?>
                            </div>
                        </div>
                    </form>
                <?php endforeach?>
        </div>
    </div>
    <!-- cart end -->

</div>
