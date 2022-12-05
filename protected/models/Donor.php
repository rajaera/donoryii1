<?php

/**
 * This is the model class for table "donors".
 *
 * The followings are the available columns in table 'donors':
 * @property integer $id
 * @property string $first_name
 * @property string $last_name
 * @property string $address1
 * @property string $address2
 * @property string $address3
 * @property string $city
 * @property string $contact_number
 * @property string $identity_number
 * @property string $gender
 * @property string $source
 * @property string $deleted_at
 * @property string $created_at
 * @property string $updated_at
 * @property string $blood_group
 * @property integer $created_by
 */
class Donor extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'donors';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('first_name, address1, contact_number, identity_number, gender, source, created_at, created_by', 'required'),
			array('created_by', 'numerical', 'integerOnly'=>true),
			array('first_name, last_name, address1, address2, address3, city, source', 'length', 'max'=>50),
			array('contact_number', 'length', 'max'=>12),
			array('identity_number', 'length', 'max'=>15),
			array('gender', 'length', 'max'=>6),
			array('blood_group', 'length', 'max'=>4),
			array('deleted_at, updated_at', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, first_name, last_name, address1, address2, address3, city, contact_number, identity_number, gender, source, deleted_at, created_at, updated_at, blood_group, created_by', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'first_name' => 'First Name',
			'last_name' => 'Last Name',
			'address1' => 'Address1',
			'address2' => 'Address2',
			'address3' => 'Address3',
			'city' => 'City',
			'contact_number' => 'Contact Number',
			'identity_number' => 'Identity Number',
			'gender' => 'Gender',
			'source' => 'Source',
			'deleted_at' => 'Deleted At',
			'created_at' => 'Created At',
			'updated_at' => 'Updated At',
			'blood_group' => 'Blood Group',
			'created_by' => 'Created By',
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

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('first_name',$this->first_name,true);
		$criteria->compare('last_name',$this->last_name,true);
		$criteria->compare('address1',$this->address1,true);
		$criteria->compare('address2',$this->address2,true);
		$criteria->compare('address3',$this->address3,true);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('contact_number',$this->contact_number,true);
		$criteria->compare('identity_number',$this->identity_number,true);
		$criteria->compare('gender',$this->gender,true);
		$criteria->compare('source',$this->source,true);
		$criteria->compare('deleted_at',$this->deleted_at,true);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('updated_at',$this->updated_at,true);
		$criteria->compare('blood_group',$this->blood_group,true);
		$criteria->compare('created_by',$this->created_by);

		return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array('pageSize' => 20),
            'sort' => array(
                'defaultOrder' => 't.created_at DESC, t.first_name ASC',
            )
        ));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Donor the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}


	/**
	 * Static data
	 */

	public static function genderList() {
		return [
			'MALE' => 'MALE',
			'FEMALE' => 'FEMALE'
		];
	}

	public static function getSourceList() {
        return [
            1 => 'Social Media',
            2 => 'Church Announcment',
            3 => 'Looudspeakers',
            4 => 'Poster',
            5 => 'Call',
            6 => 'Letter',
            7 => 'Reference',
            8 => 'TCOL',
            9 => 'Navy'
        ];
    }

	public static function getSourceById($id) {
        $groups = self::getSourceList();

        return $groups[$id];
    }

	public static function getBloodGroupList() {
        return [
            1 => 'A+',
            2 => 'A-',
            3 => 'B+',
            4 => 'B-',
            5 => 'O+',
            6 => 'O-',
            7 => 'AB+',
            8 => 'AB-'
        ];
    }

    public static function getNameById($id) {
        $groups = self::getBloodGroupList();

        return $groups[$id];
    }
}
