<?php
/* @var $this JenisKunjunganController */
/* @var $model JenisKunjungan */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id_jenis_kunjungan'); ?>
		<?php echo $form->textField($model,'id_jenis_kunjungan'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nama_kunjungan'); ?>
		<?php echo $form->textField($model,'nama_kunjungan',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->