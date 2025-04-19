<?php
/* @var $this PasienController */
/* @var $data Pasien */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('nik')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->nik), array('view', 'id'=>$data->nik)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nama_pasien')); ?>:</b>
	<?php echo CHtml::encode($data->nama_pasien); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tempat_lahir')); ?>:</b>
	<?php echo CHtml::encode($data->tempat_lahir); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tanggal_lahir')); ?>:</b>
	<?php echo CHtml::encode($data->tanggal_lahir); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('jk')); ?>:</b>
	<?php echo CHtml::encode($data->jk); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tanggal_daftar')); ?>:</b>
	<?php echo CHtml::encode($data->tanggal_daftar); ?>
	<br />


</div>