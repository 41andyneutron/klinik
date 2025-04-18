<?php
/* @var $this JenisKunjunganController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Jenis Kunjungans',
);

$this->menu=array(
	array('label'=>'Create JenisKunjungan', 'url'=>array('create')),
	array('label'=>'Manage JenisKunjungan', 'url'=>array('admin')),
);
?>

<h1>Jenis Kunjungans</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
