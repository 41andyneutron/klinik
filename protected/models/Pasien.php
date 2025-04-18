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
* - Pasien extends CActiveRecord
*/
/**
 * This is the model class for table "pasien".
 *
 * The followings are the available columns in table 'pasien':
 * @property string $nik
 * @property string $nama_pasien
 * @property string $tempat_lahir
 * @property string $tanggal_lahir
 * @property string $jk
 * @property string $tanggal_daftar
 */
class Pasien extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'pasien';
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
                'nik',
                'required'
            ) ,
            array(
                'nik',
                'length',
                'max' => 16
            ) ,
            array(
                'nama_pasien, tempat_lahir',
                'length',
                'max' => 100
            ) ,
            array(
                'jk',
                'length',
                'max' => 1
            ) ,
            array(
                'tanggal_lahir, tanggal_daftar',
                'safe'
            ) ,
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array(
                'nik, nama_pasien, tempat_lahir, tanggal_lahir, jk, tanggal_daftar',
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
        return array();
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'nik' => 'Nik',
            'nama_pasien' => 'Nama Pasien',
            'tempat_lahir' => 'Tempat Lahir',
            'tanggal_lahir' => 'Tanggal Lahir',
            'jk' => 'Jk',
            // 'tanggal_daftar' => 'Tanggal Daftar',
            
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

        $criteria->compare('nik', $this->nik, true);
        $criteria->compare('nama_pasien', $this->nama_pasien, true);
        $criteria->compare('tempat_lahir', $this->tempat_lahir, true);
        $criteria->compare('tanggal_lahir', $this->tanggal_lahir, true);
        $criteria->compare('jk', $this->jk, true);
        $criteria->compare('tanggal_daftar', $this->tanggal_daftar, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Pasien the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }
}

