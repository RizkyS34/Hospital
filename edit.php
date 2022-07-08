<!--Update-->
<?php include('config.php'); ?>


	<div class="container" style="margin-top:20px">
		<center><font size="6">Edit Data</font></center>

		<hr>

		<?php
		//jika sudah mendapatkan parameter GET id dari URL
		if(isset($_GET['nik'])){
			//membuat variabel $id untuk menyimpan id dari GET id di URL
			$nik = $_GET['nik'];

			//query ke database SELECT tabel mahasiswa berdasarkan id = $id
			$select = mysqli_query($koneksi, "SELECT * FROM data_pasien WHERE nik='$nik'") or die(mysqli_error($koneksi));

			//jika hasil query = 0 maka muncul pesan error
			if(mysqli_num_rows($select) == 0){
				echo '<div class="alert alert-warning">ID tidak ada dalam database.</div>';
				exit();
			//jika hasil query > 0
			}else{
				//membuat variabel $data dan menyimpan data row dari query
				$data = mysqli_fetch_assoc($select);
			}
		}
		?>

		<?php
		//jika tombol simpan di tekan/klik
		if(isset($_POST['submit'])){
			$nama				  = $_POST['nama_pasien'];
			$umur				  = $_POST['umur_pasien'];
			$jk					  = $_POST['jenis_kelamin'];
			$alamat				  = $_POST['alamat_pasien'];
			$keluhan			  = $_POST['keluhan_pasien'];
			$noruang			  = $_POST['no_ruang'];

			$sql = mysqli_query($koneksi, "UPDATE data_pasien SET nama_pasien='$nama', jenis_kelamin='$jk', alamat_pasien='$alamat', keluhan_pasien='$keluhan', no_ruang='$noruang' WHERE nik='$nik'") or die(mysqli_error($koneksi));

			if($sql){
				echo '<script>alert("Berhasil menyimpan data."); document.location="index.php?page=tampil_mhs";</script>';
			}else{
				echo '<div class="alert alert-warning">Gagal melakukan proses edit data.</div>';
			}
		}
		?>

		<form action="index.php?page=edit_mhs&nik=<?php echo $nik; ?>" method="post">
			<div class="item form-group">
				<label class="col-form-label col-md-3 col-sm-3 label-align">Nik</label>
				<div class="col-md-6 col-sm-6">
					<input type="text" name="nik" class="form-control" size="4" value="<?php echo $data['nik']; ?>" readonly required>
				</div>
			</div>
			<div class="item form-group">
				<label class="col-form-label col-md-3 col-sm-3 label-align">Nama Pasien</label>
				<div class="col-md-6 col-sm-6">
					<input type="text" name="nama_pasien" class="form-control" value="<?php echo $data['nama_pasien']; ?>" required>
				</div>
			</div>
			<div class="item form-group">
				<label class="col-form-label col-md-3 col-sm-3 label-align">Umur</label>
				<div class="col-md-6 col-sm-6">
					<input type="text" name="umur_pasien" class="form-control" value="<?php echo $data['umur_pasien']; ?>" required>
				</div>
			</div>
			<div class="item form-group">
				<label class="col-form-label col-md-3 col-sm-3 label-align">Jenis Kelamin</label>
				<div class="col-md-6 col-sm-6 ">
					<div class="btn-group" data-toggle="buttons">
						<label class="btn btn-secondary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
							<input type="radio" class="join-btn" name="jenis_kelamin" value="Laki-Laki" <?php if($data['jenis_kelamin'] == 'Laki-Laki'){ echo 'checked'; } ?> required>Laki-Laki
						</label>
						<label class="btn btn-primary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
							<input type="radio" class="join-btn" name="jenis_kelamin" value="Perempuan" <?php if($data['jenis_kelamin'] == 'Perempuan'){ echo 'checked'; } ?> required>Perempuan
						</label>
					</div>
				</div>
			</div>
			<div class="item form-group">
				<label class="col-form-label col-md-3 col-sm-3 label-align">Alamat</label>
				<div class="col-md-6 col-sm-6">
					<input type="text" name="alamat_pasien" class="form-control" value="<?php echo $data['alamat_pasien']; ?>" required>
				</div>
			</div>
			<div class="item form-group">
				<label class="col-form-label col-md-3 col-sm-3 label-align">Keluhan</label>
				<div class="col-md-6 col-sm-6">
					<input type="text" name="keluhan_pasien" class="form-control" value="<?php echo $data['keluhan_pasien']; ?>" required>
				</div>
			</div>
			<div class="item form-group">
				<label class="col-form-label col-md-3 col-sm-3 label-align">Ruang</label>
				<div class="col-md-6 col-sm-6">
					<select name="no_ruang" class="form-control" required>
						<option value="">Pilih Ruang Rawat</option>
						<option value="ICU" <?php if($data['no_ruang'] == 'ICU'){ echo 'selected'; } ?>>Unit Perawatan Intensif (ICU)</option>
						<option value="NICU" <?php if($data['no_ruang'] == 'NICU'){ echo 'selected'; } ?>>Unit Perawatan Intensif Neonatal (NICU)</option>
						<option value="PICU" <?php if($data['no_ruang'] == 'PICU'){ echo 'selected'; } ?>>Unit Perawatan Intensif Anak (PICU)</option>
						<option value="CCU" <?php if($data['no_ruang'] == 'CCU'){ echo 'selected'; } ?>>Unit Perawatan Koroner (CCU)</option>
						<option value="PACU" <?php if($data['no_ruang'] == 'PACU'){ echo 'selected'; } ?>>Unit Perawatan Pasca-anestesi (PACU)</option>
						<option value="HDU" <?php if($data['no_ruang'] == 'HDU'){ echo 'selected'; } ?>>High Dependency Unit (HDU)</option>
						<option value="SICU" <?php if($data['no_ruang'] == 'SICU'){ echo 'selected'; } ?>>Unit Perawatan Intensif Bedah (SICU)</option>
					</select>
				</div>
			</div>
			<div class="item form-group">
				<div class="col-md-6 col-sm-6 offset-md-3">
					<input type="submit" name="submit" class="btn btn-primary" value="Simpan">
					<a href="index.php?page=tampil_mhs" class="btn btn-warning">Kembali</a>
				</div>
			</div>
		</form>
	</div>
