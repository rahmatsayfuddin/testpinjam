<?php $this->load->view('nav') ?>
<!-- Modal -->
<div id="create" class="modal fade" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Add Item</h4>
			</div>
			<div class="modal-body">
				<form action="<?php echo site_url() ?>/master/add" method='post'>
					<div class="form-group">
						<label for="nama_item">Nama item:</label>
						<input type="text" class="form-control" id="nama_item" name="nama_item">
					</div>
					<div class="form-group">
						<label for="jumlah_item">Jumlah Item:</label>
						<input type="number" class="form-control" id="jumlah_item" name="jumlah_item">
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

	<h2>Master</h2>    
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
				<th>Nama Barang</th>
				<th>Stock</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			$i=1;
			foreach ($data as $data): ?>
				<tr>
					<td><?php echo $i?></td>
					<td><?php echo $data['nama_barang']?></td>
					<td><?php echo $data['stock']?></td>
				</tr>
				<?php 
				$i++;
			endforeach ?>
		</tbody>
	</table>
</div>