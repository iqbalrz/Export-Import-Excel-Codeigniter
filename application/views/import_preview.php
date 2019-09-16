		// Upload alert
		if(isset($upload_error)){ 
			echo "<div style='color: red;'>".$upload_error."</div>";
			die; 
		}
		
		<form method='post' action="">
		
		// Empty fields alert
		<div style="color: red;" id="is-empty">
			Data NIS belum diisi, Ada <span id="jumlah_kosong"></span> data yang belum diisi.
		</div>
		
		<table>
			<tr>
				<th>NIS</th>
				<th>Nama</th>
				<th>Tempat Lahir</th>
				<th>Tanggal Lahir</th>
				<th>Jenis Kelamin</th>
				<th>Alamat</th>
				<th>Angkatan</th>

			</tr>
		
		$numrow = 1;
		$kosong = 0;
		
		// Lakukan perulangan dari data yang ada di excel
		// $sheet adalah variabel yang dikirim dari controller
		foreach($sheet as $row){ 
			// Ambil data pada excel sesuai Kolom
			$nis = $row['A']; // Ambil data NIS
			$siswa_nama = $row['B']; // Ambil data nama
			$siswa_tempat_lahir = $row['C']; // Ambil data jenis kelamin
			$siswa_tanggal_lahir = $row['D']; // Ambil data jenis kelamin
			$siswa_jk = $row['E']; // Ambil data alamat
			$siswa_alamat = $row['F']; // Ambil data alamat
			$angkatan = $row['G']; // Ambil data angkatan

			// Cek jika semua data tidak diisi
			if(empty($nis) && empty($siswa_nama) && empty($siswa_tempat_lahir) && empty($siswa_tanggal_lahir) && empty($siswa_jk) && empty($siswa_alamat) && empty($angkatan))
				continue; // Lewat data pada baris ini (masuk ke looping selanjutnya / baris selanjutnya)
			if(empty($nis))
				continue;
			// Cek $numrow apakah lebih dari 1
			// Artinya karena baris pertama adalah nama-nama kolom
			// Jadi dilewat saja, tidak usah diimport
			if($numrow > 1){
				// Validasi apakah semua data telah diisi
				$nis_td = ( ! empty($nis))? "" : " style='background: #E57373;'"; // Jika NIS kosong, beri warna kuning
				$nama_td = ( ! empty($siswa_nama))? "" : " style='background: #fdd835;'"; // Jika Nama kosong, beri warna kuning
				$tempat_lahir_td = ( ! empty($siswa_tempat_lahir))? "" : " style='background: #fdd835;'"; // Jika Jenis Kelamin kosong, beri warna kuning
				$tanggal_lahir_td = ( ! empty($siswa_tanggal_lahir))? "" : " style='background: #fdd835;'"; // Jika Jenis Kelamin kosong, beri warna kuning
				$jk_td = ( ! empty($siswa_jk))? "" : " style='background: #fdd835;'"; // Jika Jenis Kelamin kosong, beri warna kuning
				$alamat_td = ( ! empty($siswa_alamat))? "" : " style='background: #fdd835;'"; // Jika Alamat kosong, beri warna kuning
				$angkatan_td = ( ! empty($angkatan))? "" : " style='background: #fdd835;'"; // Jika Alamat kosong, beri warna kuning
				
				// Jika salah satu data ada yang kosong
				if(empty($nis)){
					$kosong++; // Tambah 1 variabel $kosong
				}
				// if(empty($nis) or empty($siswa_nama) or empty($siswa_tempat_lahir) or empty($siswa_tanggal_lahir) or empty($siswa_jk) or empty($siswa_alamat) or empty($angkatan)){
				// 	$kosong++; // Tambah 1 variabel $kosong
				// }
				
				echo "<tr>";
				echo "<td".$nis_td.">".$nis."</td>";
				echo "<td".$nama_td.">".$siswa_nama."</td>";
				echo "<td".$tempat_lahir_td.">".$siswa_tempat_lahir."</td>";
				echo "<td".$tanggal_lahir_td.">".$siswa_tanggal_lahir."</td>";
				echo "<td".$jk_td.">".$siswa_jk."</td>";
				echo "<td".$alamat_td.">".$siswa_alamat."</td>";
				echo "<td".$angkatan_td.">".$angkatan."</td>";
				echo "</tr>";
			}
			
			$numrow++; // Tambah 1 setiap kali looping
		}
		
		echo "</table>";
		
		// Cek apakah variabel kosong lebih dari 0
		// Jika lebih dari 0, berarti ada data yang masih kosong
		if($kosong > 0){
		?>	
			<script>
			$(document).ready(function(){
				// Ubah isi dari tag span dengan id jumlah_kosong dengan isi dari variabel kosong
				$("#jumlah_kosong").html('<?php echo $kosong; ?>');
				
				$("#kosong").show(); // Munculkan alert validasi kosong
			});
			</script>

		}else{ // Jika semua data sudah diisi
			echo "<hr>";
			
			// Buat sebuah tombol untuk mengimport data ke database
			echo "<button type='submit' class='btn btn-success' name='import'>Import</button>";
			echo "<a class='ml-2' href='".base_url("admin/data_siswa")."'>Cancel</a>";
		}
		
		</form>
	}