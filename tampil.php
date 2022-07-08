<!--Read-->
<?php
//memasukkan file config.php
include('config.php');
?>


	<div class="container" style="margin-top:20px">
		<center><font size="6">Data Pasien</font></center>
		<hr>
		<a href="index.php?page=tambah_mhs"><button class="btn btn-dark right">Tambah Data</button></a>
		<div class="table-responsive">
		<table class="table table-striped jambo_table bulk_action">
			<thead>
				<tr>
					<th>NO.</th>
					<th>NIK</th>
					<th>Nama Pasien</th>
					<th>Umur</th>
					<th>Jenis Kelamin</th>
					<th>Alamat</th>
					<th>Keluhan</th>
					<th>Ruang</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php
				//query ke database SELECT tabel data_pasien urut berdasarkan id yang paling besar (Tampil Data)
				$sql = mysqli_query($koneksi, "SELECT * FROM data_pasien ORDER BY nik DESC") or die(mysqli_error($koneksi));
				//jika query diatas menghasilkan nilai > 0 maka menjalankan script di bawah if...
				if(mysqli_num_rows($sql) > 0){
					//membuat variabel $no untuk menyimpan nomor urut
					$no = 1;
					//melakukan perulangan while dengan dari dari query $sql
					while($data = mysqli_fetch_assoc($sql)){
						//menampilkan data perulangan
						echo '
						<tr>
							<td>'.$no.'</td>
							<td>'.$data['nik'].'</td>
							<td>'.$data['nama_pasien'].'</td>
							<td>'.$data['umur_pasien'].'</td>
							<td>'.$data['jenis_kelamin'].'</td>
							<td>'.$data['alamat_pasien'].'</td>
							<td>'.$data['keluhan_pasien'].'</td>
							<td>'.$data['no_ruang'].'</td>
							<td>
								<a href="index.php?page=edit_mhs&nik='.$data['nik'].'" class="btn btn-secondary btn-sm">Edit</a>
								<a href="delete.php?nik='.$data['nik'].'" class="btn btn-danger btn-sm" onclick="return confirm(\'Yakin ingin menghapus data ini?\')">Delete</a>
							</td>
						</tr>
						';
						$no++;
					}
				//jika query menghasilkan nilai 0
				}else{
					echo '
					<tr>
						<td colspan="6">Tidak ada data.</td>
					</tr>
					';
				}
				?>
			<tbody>
		</table>
	</div>
	</div>
