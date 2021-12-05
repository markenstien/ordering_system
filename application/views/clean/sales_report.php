<style type="text/css">
	div.items table td,
	div.items table th{
		font-size: 10px;
	}
</style>
<div class="container">
	<div class="col-md-8 mx-auto">
		<div class="content">
			<div class="mt-2 text-center">
				<h3>Sales Report</h3>
				As of <?php echo date('Y-m-d H:i:s')?>
				<hr>
				<div class="header-sub-items">
					<p>From : <?php echo $date['start_date']?> to <?php echo $date['end_date']?></p>
				</div>
			</div>
			
			<div class="header-sub-items">
				<table class="table table-bordered">
					<tr>
						<td>Total Sales Amount</td>
						<td>Total Sales Count</td>
						<td>Total Items Sold</td>
					</tr>
					<tr>
						<td><?php echo $report['total_sales_amount']?></td>
						<td><?php echo $report['total_sales_count']?></td>
						<td><?php echo $report['total_sales_item_count']?></td>
					</tr>
				</table>
			</div>

			<div class="body">
				<h4>Top Product</h4>
					<table class="table">
						<tr>
							<td>Product</td>
							<td>Total Sales Amount</td>
							<td>Total Sales Count</td>
						</tr>
						<tr>
							<td><?php echo $report['top_product']['name']?></td>
							<td><?php echo $report['top_product']['total_sales_count']?></td>
							<td><?php echo $report['top_product']['total_sales_amount']?></td>
						</tr>
					</table>

					<div class="row">
						<div class="col-md-5">
							<h5>Top 10</h5>
							<table class="table table-bordered">
								<thead>
									<th>Product</th>
									<th><span title="Total Sales Amount">TSA</span></th>
									<th><span title="Total Sales Count">TSC</span></th>
								</thead>

								<tbody>
									<?php foreach($report['item_summarized'] as $key => $row): ?>
										<?php if($key >= 10) break?>
										<tr>
											<td><?php echo $row['name']?></td>
											<td><?php echo $row['total_sales_amount']?></td>
											<td><?php echo $row['total_sales_count']?></td>
										</tr>
									<?php endforeach?>
								</tbody>
							</table>
						</div>
						<div class="col-md-7">
							<h5>Addresses</h5>
							<table class="table table-bordered">
								<thead>
									<th>Address</th>
									<th>Total</th>
								</thead>

								<tbody>
									<?php $counter = 0 ?>
									<?php foreach($report['top_addresses'] as $key => $row): ?>
										<?php if($counter >= 10) break?>
										<tr>
											<td><?php echo $key?></td>
											<td><?php echo $row?></td>
										</tr>
									<?php $counter++?>
									<?php endforeach?>
								</tbody>
							</table>
						</div>
					</div>

				<?php if(isset($orders_grouped)) :?>
					<!-- if and only grouped is cheked -->
					<hr>
					<?php require_once(APPPATH.DIRECTORY_SEPARATOR.'views/templates/partial/sales_report_grouped.php')?>

				<?php endif?>
				<!-- -->
			</div>

			<div class="items mt-5">
				<h4>Items</h4>
				<table class="table table-bordered">
					<thead>
						<th>Product</th>
						<th>Price</th>
						<th>Qty</th>
						<th>Amount Total</th>
					</thead>

					<tbody>
						<?php foreach($report['items'] as $key => $items) : ?>
							<?php foreach( $items as $item ) :?>
								<tr>
									<td><?php echo $item['name']?></td>
									<td><?php echo $item['rate']?></td>
									<td><?php echo $item['qty']?></td>
									<td><?php echo $item['amount']?></td>
								</tr>
							<?php endforeach?>
						<?php endforeach?>
					</tbody>
				</table>
			</div>

			<button onclick="window.print()" class="btn btn-sm btn-primary">Print this page</button>

			<a href="<?php echo base_url('reports/advance')?>" class="btn btn-sm btn-primary">Cancel</a>
		</div>
	</div>
</div>