<?php $this->load->view('nav') ?>
<!-- Modal -->
<div id="create" class="modal fade" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Add Invoice</h4>
			</div>
			<div class="modal-body">
				<form action="<?php echo site_url() ?>/sales/add" method='post'>
					<div class="form-group">
						<label for="nama_pelanggan">Nama Pelanggan:</label>
						<input type="text" class="form-control" id="nama_pelanggan" name="nama_pelanggan">
					</div>
					<div class="form-group">
						<label for="tanggal">Tanggal:</label>
						<input type="date" class="form-control" id="tanggl" name="tanggal">
					</div>
					<button type="submit" class="btn btn-default">Submit</button>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>

	</div>
</div>
<div class="container">

	<h2>Sales</h2>    
	<button type="button" class="btn btn-default" data-toggle="modal" data-target="#create">Create</button>
	<br>

	<?php if (isset($_SESSION['message'])): ?>
		<div class="alert alert-<?php echo $_SESSION['message_type'] ?>" role="alert">
			<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
			<?php echo $_SESSION['message']?>
		</div>
	<?php endif ?>

	<table class="table table-bordered">
		<thead>
			<tr>
				<th>No</th>
				<th>Nama Pelanggan</th>
				<th>Amount</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			$i=1;
			foreach ($data as $data): ?>
				<tr>
					<td><?php echo $i?></td>
					<td><?php echo $data['nama_pelanggan']?></td>
					<td><?php echo $data['total_amount']?></td>
					<td>
						<div class="btn-group">
							<?php if ($data['status']=='false'): ?>
								<a class="btn btn-warning" href="<?php echo site_url()."/sales/detail_transaksi/".$data['id_transaksi'] ?>">Process</a>
								<a  class="btn btn-success" href="<?php echo site_url()."/sales/confirm/".$data['id_transaksi'] ?>">Confirm</a>
							<?php endif ?>
						</div>
					</td>
				</tr>
				<?php 
				$i++;
			endforeach ?>
		</tbody>
	</table>
</div>