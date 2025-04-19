<?php
/* @var $this PasienController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Pasiens',
);

$this->menu=array(
	array('label'=>'Create Pasien', 'url'=>array('create')),
	array('label'=>'Manage Pasien', 'url'=>array('admin')),
);
?>
<!-- http://localhost/neutron/klinik/index.php/pasien/create -->
<h1>List Pasien</h1>
<a href="<?=Yii::app()->request->baseUrl.'/pasien/create';?>"><button>+ Daftar Baru</button></a>
<p>
Untuk Kunjungan Silahkan Input NIK Pasien yang telah terdaftar.
<?php echo CHtml::beginForm(array('pasien/kunjungan'), 'get'); ?>

    <?php echo CHtml::label('NIK', 'nik'); ?>
    <?php echo CHtml::textField('nik'); ?>

    <?php echo CHtml::submitButton('Cek'); ?>

<?php echo CHtml::endForm(); ?></p>
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
