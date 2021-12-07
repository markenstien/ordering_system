<?php foreach($order_group as $key => $or_group):?>
	<h4>Product Inventory Summary (<?php echo $key?>) </h4>
	<table class="table">
		<tr>
			<td>Product</td>
			<td>Total Stocks</td>
			<td>Min</td>
			<td>Max</td>
			<th>Remarks</th>
		</tr>
		<?php foreach($or_group['product_stock_summary'] as $prod_name => $prod_stock_total) :?>
			<tr>
				<td><?php echo $prod_name?></td>
				<td><?php echo $prod_stock_total['total_stock_count']?></td>
				<td><?php echo $prod_stock_total['min_stock']?></td>
				<td><?php echo $prod_stock_total['max_stock']?></td>
				<td>
					<?php
						if($prod_stock_total['total_stock_count'] > $prod_stock_total['max_stock'] )
						{
							echo 'OVER STOCKED';
						}elseif($prod_stock_total['total_stock_count'] < $prod_stock_total['min_stock'])
						{
							echo 'CRITICAL LEVEL STOCK';
						}else{
							echo 'OK';
						}
					?>
				</td>
			</tr>
		<?php endforeach?>
	</table>
<?php endforeach?>