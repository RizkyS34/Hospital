<?php include('config.php'); ?>

		<center><font size="6">Tambah Data Pasien</font></center>
		<hr>
		<?php
		if(isset($_POST['submit'])){
			$nik				= $_POST['nik'];
			$nama				= $_POST['nama_pasien'];
			$umur				= $_POST['umur_pasien'];
			$jk					= $_POST['jenis_kelamin'];
			$alamat				= $_POST['alamat_pasien'];
			$keluhan			= $_POST['keluhan_pasien'];
			$noruang			= $_POST['no_ruang'];

			$cek = mysqli_query($koneksi, "SELECT * FROM data_pasien WHERE nik='$nik'") or die(mysqli_error($koneksi));

			if(mysqli_num_rows($cek) == 0){
				$sql = mysqli_query($koneksi, "INSERT INTO data_pasien(nik, nama_pasien, umur_pasien, jenis_kelamin, alamat_pasien, keluhan_pasien, no_ruang ) VALUES('$nik', '$nama', '$umur', '$jk', '$alamat', '$keluhan', '$noruang')") or die(mysqli_error($koneksi));

				if($sql){
					echo '<script>alert("Berhasil menambahkan data."); document.location="index.php?page=tampil_mhs";</script>';
				}else{
					echo '<div class="alert alert-warning">Gagal melakukan proses tambah data.</div>';
				}
			}else{
				echo '<div class="alert alert-warning">Gagal, NIK sudah terdaftar.</div>';
			}
		}
		?>

		<form action="index.php?page=tambah_mhs" method="post">
			<div class="item form-group">
				<label class="col-form-label col-md-3 col-sm-3 label-align">Nik</label>
				<div class="col-md-6 col-sm-6 ">
					<input type="text" name="nik" class="form-control" size="4" required>
				</div>
			</div>
			<div class="item form-group">
				<label class="col-form-label col-md-3 col-sm-3 label-align">Nama Pasien</label>
				<div class="col-md-6 col-sm-6">
					<input type="text" name="nama_pasien" class="form-control" required>
				</div>
			</div>
			<div class="item form-group">
				<label class="col-form-label col-md-3 col-sm-3 label-align">Umur</label>
				<div class="col-md-6 col-sm-6">
					<input type="text" name="umur_pasien" class="form-control" required>
				</div>
			</div>
			<div class="item form-group">
				<label class="col-form-label col-md-3 col-sm-3 label-align">Jenis Kelamin</label>
				<div class="col-md-6 col-sm-6 ">
					<div class="btn-group" data-toggle="buttons">
						<label class="btn btn-secondary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
							<input type="radio" class="join-btn" name="jenis_kelamin" value="Laki-Laki" required>Laki-Laki
						</label>
						<label class="btn btn-primary " data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
							<input type="radio" class="join-btn" name="jenis_kelamin" value="Perempuan" required>Perempuan
						</label>
					</div>
				</div>
			</div>
			<div class="item form-group">
				<label class="col-form-label col-md-3 col-sm-3 label-align">Alamat</label>
				<div class="col-md-6 col-sm-6">
					<input type="text" name="alamat_pasien" class="form-control" required>
				</div>
			</div>
			<div class="item form-group">
				<label class="col-form-label col-md-3 col-sm-3 label-align">Keluhan</label>
				<div class="col-md-6 col-sm-6">
					<input type="text" name="keluhan_pasien" class="form-control" required>
				</div>
			</div>
			<div class="item form-group">
				<label class="col-form-label col-md-3 col-sm-3 label-align">Ruang</label>
				<div class="col-md-6 col-sm-6">
					<select name="no_ruang" class="form-control" required>
						<option value="">Pilih Ruang Rawat</option>
						<option value="ICU">Unit Perawatan Intensif (ICU)</option>
						<option value="NICU">Unit Perawatan Intensif Neonatal (NICU)</option>
						<option value="PICU">Unit Perawatan Intensif Anak (PICU)</option>
						<option value="CCU">Unit Perawatan Koroner (CCU)</option>
						<option value="PACU">Unit Perawatan Pasca-anestesi (PACU)</option>
						<option value="HDU">High Dependency Unit (HDU)</option>
						<option value="SICU">Unit Perawatan Intensif Bedah (SICU)</option>
					</select>
				</div>
			</div>
			<div class="item form-group">
				<div  class="col-md-6 col-sm-6 offset-md-3">
					<input type="submit" name="submit" class="btn btn-primary" value="Simpan">
			</div>
		</form>
	</div>
