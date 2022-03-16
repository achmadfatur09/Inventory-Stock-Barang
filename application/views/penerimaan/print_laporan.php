<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compataible" content="IE-edge">
	<link rel="stylesheet" type="text/css" href="">
	<title> Print laporan</title>
</head>
<body>

	<h1><?php echo "$title"; ?></h1>
	<h2><?php echo "$subtitle"; ?></h2>

	<br>
	<br>
	<hr>

	<table border="1">
		<thead>
			<tr>
				<th>No</th>
				<th>No Terima</th>
				<th>Tanggal Terima</th>
				<th>Supplier</th>
				<th>Nama Petugas</th>
			</tr>
		</thead>
		<tbody>
				<?php $no=1; foreach ($datafilter as $row): ?>
			<tr>
				<td><?php echo $no++; ?></td>
				<td><?php echo $row->no_terima; ?></td>
				<td><?php echo $row->tgl_terima; ?></td>
				<td><?php echo $row->nama_supplier; ?></td>
				<td><?php echo $row->nama_petugas; ?></td>
			</tr>

				<?php endforeach ?>
		</tbody>	
	</table>

</body>
</html>