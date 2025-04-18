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
* - Obat extends CActiveRecord
*/
/**
 * This is the model class for table "obat".
 *
 * The followings are the available columns in table 'obat':
 * @property string $id_obat
 * @property string $nama_obat
 * @property string $deskripsi
 * @property integer $stok
 * @property integer $harga
 */
class Obat extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'obat';
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
                'stok, harga',
                'numerical',
                'integerOnly' => true
            ) ,
            array(
                'nama_obat',
                'length',
                'max' => 100
            ) ,
            array(
                'deskripsi',
                'safe'
            ) ,
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array(
                'id_obat, nama_obat, deskripsi, stok, harga',
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
            'id_obat' => 'Id Obat',
            'nama_obat' => 'Nama Obat',
            'deskripsi' => 'Deskripsi',
            'stok' => 'Stok',
            'harga' => 'Harga',
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

        $criteria->compare('id_obat', $this->id_obat, true);
        $criteria->compare('nama_obat', $this->nama_obat, true);
        $criteria->compare('deskripsi', $this->deskripsi, true);
        $criteria->compare('stok', $this->stok);
        $criteria->compare('harga', $this->harga);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Obat the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }
}

