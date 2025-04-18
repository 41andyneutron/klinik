<?php
/* @var $this JenisKunjunganController */
/* @var $model JenisKunjungan */

$this->breadcrumbs=array(
	'Jenis Kunjungans'=>array('index'),
	$model->id_jenis_kunjungan,
);

$this->menu=array(
	array('label'=>'List JenisKunjungan', 'url'=>array('index')),
	array('label'=>'Create JenisKunjungan', 'url'=>array('create')),
	array('label'=>'Update JenisKunjungan', 'url'=>array('update', 'id'=>$model->id_jenis_kunjungan)),
	array('label'=>'Delete JenisKunjungan', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_jenis_kunjungan),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage JenisKunjungan', 'url'=>array('admin')),
);
?>

<h1>View JenisKunjungan #<?php echo $model->id_jenis_kunjungan; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_jenis_kunjungan',
		'nama_kunjungan',
	),
)); ?>
