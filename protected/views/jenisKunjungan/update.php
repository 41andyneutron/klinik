<?php
/* @var $this JenisKunjunganController */
/* @var $model JenisKunjungan */

$this->breadcrumbs=array(
	'Jenis Kunjungans'=>array('index'),
	$model->id_jenis_kunjungan=>array('view','id'=>$model->id_jenis_kunjungan),
	'Update',
);

$this->menu=array(
	array('label'=>'List JenisKunjungan', 'url'=>array('index')),
	array('label'=>'Create JenisKunjungan', 'url'=>array('create')),
	array('label'=>'View JenisKunjungan', 'url'=>array('view', 'id'=>$model->id_jenis_kunjungan)),
	array('label'=>'Manage JenisKunjungan', 'url'=>array('admin')),
);
?>

<h1>Update JenisKunjungan <?php echo $model->id_jenis_kunjungan; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>