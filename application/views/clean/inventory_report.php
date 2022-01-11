<style type="text/css">
	div.items table td,
	div.items table th{
		font-size: 10px;
	}
</style>
<div class="container">

	<?php if(!empty($report)) :?>
		<div class="col-md-8 mx-auto">
			<div class="content">
				<div class="mt-2 text-center">
					<div style="margin-bottom:12px"><img src="<?php echo base_url('assets/images/bnk_logo_sm.png')?>" style="width: 100px;"></div>
					<h3>Inventory Report</h3>
					As of <?php echo date('Y-m-d H:i:s')?>
					<div>Report Created By : <?php echo $user_data['firstname'] . ' ' .$user_data['lastname'] ?></div>
					<hr>
					<div class="header-sub-items">
						<p>From : <?php echo $date['start_date']?> to <?php echo $date['end_date']?></p>
					</div>
				</div>
				
				<div class="header-sub-items">
					<table class="table table-bordered">
						<tr>
							<td>Total Stock Items</td>
							<td>Total Product Variety</td>
						</tr>
						<tr>
							<td><?php echo $report['inventory_stocks_count']?></td>
							<td><?php echo $report['product_stock_variety_count']?></td>
						</tr>
					</table>
				</div>
				<div class="body">
					<h4>Product Inventory Summary</h4>
					<table class="table">
						<tr>
							<td>Product</td>
							<td>Total Stocks</td>
							<td>Min</td>
							<td>Max</td>
							<th>Remarks</th>
						</tr>
						<?php foreach($report['product_stock_summary'] as $prod_name => $prod_stock_total) :?>
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
				</div>

				<?php if(isset($order_group) && $order_group) :?>
					<!-- if and only grouped is cheked -->
					<hr>
					<?php require_once(APPPATH.DIRECTORY_SEPARATOR.'views/templates/partial/inventory_report_grouped.php')?>

				<?php endif?>
				<div class="items mt-5">
					<h4>Stocks Itemized</h4>
					<table class="table table-bordered">
						<thead>
							<th>Product</th>
							<th>Qty</th>
							<th>Description</th>
							<th>Date</th>
						</thead>

						<tbody>
							<?php foreach($stocks as $key => $stock) : ?>
								<tr>
									<td><?php echo $stock['product_name']?></td>
									<td><?php echo $stock['quantity']?></td>
									<td><?php echo $stock['description']?></td>
									<td><?php echo $stock['date']?></td>
								</tr>
							<?php endforeach?>
						</tbody>
					</table>
				</div>

				<button onclick="window.print()" class="btn btn-sm btn-primary">Print this page</button>

				<a href="<?php echo base_url('reports/advance')?>" class="btn btn-sm btn-primary">Cancel</a>
			</div>
		</div>
	<?php else:?>
		<p>No reports to show</p>
		<a href="<?php echo base_url('reports/advance')?>">Back</a>
	<?php endif?>
</div>