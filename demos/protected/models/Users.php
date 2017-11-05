<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property integer $id
 * @property string $name
 * @property integer $country_id
 * @property string $email
 * @property integer $mobile
 * @property string $about
 * @property string $birthday
 */
class Users extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'users';
    }
    
    public static $countries = ['1' => 'India', '2' => 'USA', '3' => 'UK'];

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name, email', 'required'),
            array('email', 'unique', 'on' => 'create'),
            array('email', 'email'),
            array('name', 'CRegularExpressionValidator', 'pattern' => '/^[a-zA-z\s]{3,}$/', 'message' => "{attribute} should contain only letters."),
            array('mobile', 'CRegularExpressionValidator', 'pattern' => '/^[+]?[\d]+$/', 'message' => "Incorrect tel. number format."),
            array('birthday', 'validateDate'),
            array('mobile', 'length', 'min'=>10, 'max'=>12),
            array('country_id, mobile', 'numerical', 'integerOnly' => true),
            array('name, email, about, birthday', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, name, country_id, email, mobile, about, birthday', 'safe', 'on' => 'search'),
        );
    }

    public function validateDate($attribute, $params) {

        if (!empty($this->$attribute)) {
            $dateArray = explode('-', $this->$attribute);
            if (['', '', ''] != $dateArray && !$this->_isValidDate($dateArray)) {
                $this->addError($attribute, sprintf('%s is not a valid date', $this->getAttributeLabel($attribute)));
            }
        }
    }
    protected function _isValidDate($date) {
        return 3 == count($date) && checkdate((int) $date[1], (int) $date[2], (int) $date[0]);
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'name' => 'Name',
            'country_id' => 'Country',
            'email' => 'Email',
            'mobile' => 'Mobile',
            'about' => 'About',
            'birthday' => 'Birthday',
        );
    }

    /**
     * Retrieves a list of models based on the  current search/filter conditions.
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
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('country_id', $this->country_id);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('mobile', $this->mobile);
        $criteria->compare('about', $this->about, true);
        $criteria->compare('birthday', $this->birthday, true);
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Users the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
