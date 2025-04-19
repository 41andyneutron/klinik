<?php
/* @var $this PasienController */
/* @var $model Pasien */

$this->breadcrumbs=array(
	'Pasiens'=>array('index'),
	$model->nik,
);

$this->menu=array(
	array('label'=>'List Pasien', 'url'=>array('index')),
	array('label'=>'Create Pasien', 'url'=>array('create')),
	array('label'=>'Update Pasien', 'url'=>array('update', 'id'=>$model->nik)),
	array('label'=>'Delete Pasien', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->nik),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Pasien', 'url'=>array('admin')),
);
?>

<h1>Data Pasien #<?php echo $model->nik; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'nik',
		'nama_pasien',
		'tempat_lahir',
		'tanggal_lahir',
		'jk',
		'tanggal_daftar',
	),
)); ?>

<h3>Buat Kunjungan</h3>
<?php echo CHtml::beginForm(array('transaksi/create'), 'post'); ?>
<?php
echo CHtml::hiddenField('Transaksi[nik]', $model->nik);

?>
<label>Jenis Kunjungan</label>
<select name="Transaksi[id_jenis_kunjungan]" required>
	<option value="">Pilih</option>
	<?php
foreach ($listKunjungan as $key) {
	?><option value="<?=$key['id_jenis_kunjungan'];?>"><?=$key['nama_kunjungan'];?></option> <?php
}
?>
</select><br>
<label>Dokter Tujuan</label>
<select name="Transaksi[id_user_dokter]" required>
	<option value="">Pilih</option>
	<?php
foreach ($list_dokter as $key2) {
	?><option value="<?=$key2['id_user'];?>"><?=$key2['nama_user'];?></option> <?php
}
?>
</select><br>

    <?php echo CHtml::submitButton('Submit'); ?>

<?php echo CHtml::endForm(); ?>
