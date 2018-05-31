	<?php $this->load->view('nav') ?>
	<div class="container">
		<h2>Edit</h2>
		<form action="<?php echo site_url()."/sales/action_edit/".$id ?>" method='post'>
			<div class="form-group">
				<label for="nama_barang">Nama Barang:</label>
				<select class="form-control" name="id_barang" ">
					<?php foreach ($list_barang as $list_barang): ?>
						<option value="<?php echo $list_barang['id'] ?>"  
							<?php if ($data->id_barang==$list_barang['id']){echo "selected";}?>>
							<?php echo $list_barang['nama_barang'] ?>
						</option>
					<?php endforeach ?>
				</select>
			</div>
			<div class="form-group">
				<label for="jumlah_barang">Jumlah Barang</label>
				<input type="number" class="form-control" id="jumlah_barang" name="jumlah_barang" value="<?php echo $data->jumlah_barang ?>">
			</div>
			<div class="form-group">
				<label for="harga">Harga</label>
				<input type="number" class="form-control" id="harga" name="harga" value="<?php echo $data->harga ?>">
			</div>
			<button type="submit" class="btn btn-default">Submit</button>
		</form>


	</div>