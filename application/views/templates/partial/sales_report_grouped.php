<div>
	<h5>Type : <?php echo strtoupper( $order_group ) ?></h5>
	<?php foreach($orders_grouped as $date_key => $reports) :?>
		<h6>
			<?php
				if(isEqual($order_group, 'monthly'))
				{
					echo date('F', mktime(0, 0, 0, $date_key, 10));
				}else if(isEqual($order_group, 'yearly') )
				{
					echo date('Y', mktime(0, 0, 0, $date_key, 10));
				}else{
					echo $date_key;
				}
			?>
			(<?php echo count($reports)?>)</h6>
		<?php foreach($reports as $report) :?>
		<p>Total Sales Amount : <?php echo $report['total_sales_amount']?> |
		Total Sales Count  : <?php echo $report['total_sales_count']?>  | Total Items Sold  : <?php echo $report['total_sales_item_count']?></p>
		<div class="items">
			<table class="table table-bordered">
				<tr>
					<td>Product</td>
					<td>Total Sales Amount</td>
					<td>Total Sales Count</td>
				</tr>
				<?php foreach($report['item_summarized'] as $row) :?>
					<tr>
						<td><?php echo $row['name']?></td>
						<td><?php echo $row['total_sales_amount']?></td>
						<td><?php echo $row['total_sales_count']?></td>
					</tr>
				<?php endforeach?>
			</table>
		</div>
		<?php endforeach?>
	<?php endforeach?>
</div>