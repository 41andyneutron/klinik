<?php
/* @var $this JenisKunjunganController */
/* @var $data JenisKunjungan */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_jenis_kunjungan')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_jenis_kunjungan), array('view', 'id'=>$data->id_jenis_kunjungan)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nama_kunjungan')); ?>:</b>
	<?php echo CHtml::encode($data->nama_kunjungan); ?>
	<br />


</div>