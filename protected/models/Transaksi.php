<?php
/**
 * Class and Function List:
 * Function list:
 * - tableName()
 * - rules()
 * - relations()
 * - attributeLabels()
 * - search()
 * - model()
 * Classes list:
 * - Transaksi extends CActiveRecord
 */
/**
 * This is the model class for table "transaksi".
 *
 * The followings are the available columns in table 'transaksi':
 * @property string $id_transaksi
 * @property string $nik
 * @property integer $id_user_dokter
 * @property integer $id_jenis_kunjungan
 * @property string $id_obat_array
 * @property integer $biaya
 * @property string $deskripsi
 * @property string $status
 * @property string $tanggal
 * @property integer $id_user_kasir
 * @property integer $id_user_petugas
 */
class Transaksi extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'transaksi';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array(
                'id_user_dokter, id_jenis_kunjungan, biaya, id_user_kasir, id_user_petugas',
                'numerical',
                'integerOnly' => true
            ) ,
            array(
                'nik',
                'length',
                'max' => 16
            ) ,
            array(
                'id_obat_array',
                'length',
                'max' => 500
            ) ,
            array(
                'status',
                'length',
                'max' => 1
            ) ,
            array(
                'deskripsi, tanggal',
                'safe'
            ) ,
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array(
                'id_transaksi, nik, id_user_dokter, id_jenis_kunjungan, id_obat_array, biaya, deskripsi, status, tanggal, id_user_kasir, id_user_petugas',
                'safe',
                'on' => 'search'
            ) ,
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'pasien' => array(
                self::BELONGS_TO,
                'Pasien',
                'nik'
            ) ,
            'dokter' => array(
                self::BELONGS_TO,
                'User',
                'id_user_dokter'
            ) ,
            'petugas' => array(
                self::BELONGS_TO,
                'User',
                'id_user_petugas'
            ) ,
            'kasir' => array(
                self::BELONGS_TO,
                'User',
                'id_user_kasir'
            ) ,
            'jenisKunjungan' => array(
                self::BELONGS_TO,
                'JenisKunjungan',
                'id_jenis_kunjungan'
            ) ,
            'tindakan' => array(
                self::BELONGS_TO,
                'Tindakan',
                'id_tindakan'
            ) ,
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id_transaksi' => 'Id Transaksi',
            'nik' => 'Nik',
            'id_user_dokter' => 'Id User Dokter',
            'id_jenis_kunjungan' => 'Id Jenis Kunjungan',
            'id_obat_array' => 'Id Obat Array',
            'biaya' => 'Biaya',
            'deskripsi' => 'Deskripsi',
            'status' => 'Status',
            'tanggal' => 'Tanggal',
            'id_user_kasir' => 'Id User Kasir',
            'id_user_petugas' => 'Id User Petugas',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.
        $criteria = new CDbCriteria;

        $criteria->compare('id_transaksi', $this->id_transaksi, true);
        $criteria->compare('nik', $this->nik, true);
        $criteria->compare('id_user_dokter', $this->id_user_dokter);
        $criteria->compare('id_jenis_kunjungan', $this->id_jenis_kunjungan);
        $criteria->compare('id_obat_array', $this->id_obat_array, true);
        $criteria->compare('biaya', $this->biaya);
        $criteria->compare('deskripsi', $this->deskripsi, true);
        $criteria->compare('status', $this->status, true);
        $criteria->compare('tanggal', $this->tanggal, true);
        $criteria->compare('id_user_kasir', $this->id_user_kasir);
        $criteria->compare('id_user_petugas', $this->id_user_petugas);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Transaksi the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }
}

