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
				<form action="<?php echo site_url()."/sales/prosess/".$id_transaksi ?>" method='post'>
					<div class="form-group">
						<label for="nama_barang">Nama Barang:</label>
						<select class="form-control" name="id_barang">
							<?php foreach ($list_barang as $list_barang): ?>
								<option value="<?php echo $list_barang['id'] ?>">
									<?php echo $list_barang['nama_barang'] ?>
								</option>
							<?php endforeach ?>
						</select>
					</div>
					<div class="form-group">
						<label for="jumlah_barang">Jumlah Barang</label>
						<input type="number" class="form-control" id="jumlah_barang" name="jumlah_barang">
					</div>
					<div class="form-group">
						<label for="harga">Harga</label>
						<input type="number" class="form-control" id="harga" name="harga">
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

	<h2>Detail Sales</h2>    
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
				<th>Jumlah Barang</th>
				<th>Harga</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			$i=1;
			foreach ($data as $data): ?>
				<tr>
					<td><?php echo $i?></td>
					<td><?php echo $data['nama_barang']?></td>
					<td><?php echo $data['jumlah_barang']?></td>
					<td><?php echo $data['harga']?></td>
					<td><div class="btn-group">
						<a class="btn btn-warning" href="<?php echo site_url()."/sales/edit_detail_sales/".$data['id'] ?>">edit</a>
						<a  class="btn btn-danger" href=<?php echo site_url()."/sales/delete_detail/".$data['id'] ?>>delete</a>
					</div></td>
				</tr>
				<?php 
				$i++;
			endforeach ?>
		</tbody>
	</table>
</div>