<?php
/* @var $this JenisKunjunganController */
/* @var $model JenisKunjungan */

$this->breadcrumbs=array(
	'Jenis Kunjungans'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List JenisKunjungan', 'url'=>array('index')),
	array('label'=>'Manage JenisKunjungan', 'url'=>array('admin')),
);
?>

<h1>Create JenisKunjungan</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>