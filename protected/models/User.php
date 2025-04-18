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
* - User extends CActiveRecord
*/
/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property string $id_user
 * @property string $username
 * @property string $password
 * @property string $nama_user
 * @property string $level
 */
class User extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'user';
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
                'username, password',
                'length',
                'max' => 50
            ) ,
            array(
                'nama_user',
                'length',
                'max' => 100
            ) ,
            array(
                'level',
                'length',
                'max' => 1
            ) ,
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array(
                'id_user, username, password, nama_user, level',
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
            'id_user' => 'Id User',
            'username' => 'Username',
            'password' => 'Password',
            'nama_user' => 'Nama User',
            'level' => 'Level',
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

        $criteria->compare('id_user', $this->id_user, true);
        $criteria->compare('username', $this->username, true);
        $criteria->compare('password', $this->password, true);
        $criteria->compare('nama_user', $this->nama_user, true);
        $criteria->compare('level', $this->level, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return User the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }
}

