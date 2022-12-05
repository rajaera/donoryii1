<?php

/**
 * This is the model class for table "camps".
 *
 * The followings are the available columns in table 'camps':
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $location
 * @property string $scheduled_date
 * @property string $created_at
 * @property string $updated_at
 * @property integer $created_by
 * @property integer $is_done
 */
class Camp extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'camps';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, description, location, scheduled_date, created_at, created_by', 'required'),
			array('created_by, is_done', 'numerical', 'integerOnly'=>true),
			array('name, location', 'length', 'max'=>150),
			array('description', 'length', 'max'=>255),
			array('updated_at', 'safe'),
			array('scheduled_date', 'type', 'type' => 'date', 'message' => '{attribute}: is not a validate date!', 'dateFormat' => 'yyyy-MM-dd'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, description, location, scheduled_date, created_at, updated_at, created_by, is_done', 'safe', 'on'=>'search'),
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
			'name' => 'Name',
			'description' => 'Description',
			'location' => 'Location',
			'scheduled_date' => 'Scheduled Date',
			'created_at' => 'Created At',
			'updated_at' => 'Updated At',
			'created_by' => 'Created By',
			'is_done' => 'Is Done',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('location',$this->location,true);
		$criteria->compare('scheduled_date',$this->scheduled_date,true);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('updated_at',$this->updated_at,true);
		$criteria->compare('created_by',$this->created_by);
		$criteria->compare('is_done',$this->is_done);

		return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array('pageSize' => 20),
            'sort' => array(
                'defaultOrder' => 't.scheduled_date ASC',
            )
        ));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Camp the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function markupNameColumn() {
		if( isset(Yii::app()->session['live_camp_id']) && Yii::app()->session['live_camp_id'] == $this->id) {
			return '<span style="color:green;font-weight:bold;">LIVE >></span>&nbsp;' . $this->name;
		} else {
			return $this->name;
		}
		
	}
}
