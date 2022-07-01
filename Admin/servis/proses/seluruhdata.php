<?php 
$query = mysqli_query($koneksi, "SELECT * FROM servis");
$no = 1;
if (0==mysqli_num_rows($query)) { ?>
	<table class="table">
		<tr>
			<td>Data tidak ada</td>
		</tr>
	</table>	
	<?php
}
else{?>
	<table class="table data">
		<thead class=" text-primary">
			<th>No</th>
			<th>Foto</th>
			<th>Informasi</th>
		</thead>
		<tbody>
			<?php foreach ($query as $ambil) {?>
				<tr>
					<td><?= $no ?></td>
					<td style="width: 17%;"><img src="../../assets/img/fotoservis/<?= $ambil['foto'] ?>" alt=""></td>
					<td><?= $ambil['info'] ?></td>
					<td>
						<a href="editdata.php?id=<?= $ambil['id'] ?>"><button class="btn Secondary">Edit</button></a>
						<a href="./proses/hapusdataservis.php?id=<?= $ambil['id'] ?>"><button class="btn btn-danger">Delete</button></a>
					</td>
				</tr>
				
			<?php $no++; } ?>
			<!--Start of Tawk.to Script-->
			<script type="text/javascript">
			var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
			(function(){
			var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
			s1.async=true;
			s1.src='https://embed.tawk.to/5e8708d269e9320caabfdd1e/default';
			s1.charset='UTF-8';
			s1.setAttribute('crossorigin','*');
			s0.parentNode.insertBefore(s1,s0);
			})();
			</script>
			<!--End of Tawk.to Script-->

		</tbody>
	</table>
	<?php
}
?>

<script type="text/javascript">
	$(document).ready(function(){
		$('.data').DataTable();
	});
</script>