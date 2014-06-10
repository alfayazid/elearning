<?php
	foreach($judul as $jdl)
	{
		?> <h1 class="page-header"><span class="glyphicon glyphicon-book"></span>  Mata Kuliah <?php echo $jdl->nama_matkul; ?></h1> <?php
		
	}
?>

<?php
	$nomer=1;
	foreach($query as $kat)
	{ ?>
		
		<h3><?php echo $nomer; ?>. <?php echo $kat->nama_matkul; ?> <a href="<? echo base_url(); ?>index.php/rest_client/ikutites/<? echo $kat->id_matkul; ?>/<? echo $kat->no_soal; ?>"><span class="glyphicon glyphicon-pencil"></span></a></h3>
		<?php $nomer++;
		
		
	}
?>