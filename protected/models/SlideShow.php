<?php

/**
 * This is the model class for table "tblslideshow".
 *
 * The followings are the available columns in table 'tblslideshow':
 * @property integer $slideshowID
 * @property string $slideshowImageURL
 * @property string $slideshowURL
 * @property integer $slideshowSortID
 * @property string $slideshowCaption
 * @property string $slideshowCaptionE
 */
class SlideShow extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tblslideshow';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('slideshowImageURL, slideshowURL', 'required'),
			array('slideshowSortID', 'numerical', 'integerOnly'=>true),
			array('slideshowCaption, slideshowCaptionE', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('slideshowID, slideshowImageURL, slideshowURL, slideshowSortID, slideshowCaption, slideshowCaptionE', 'safe', 'on'=>'search'),
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
			'slideshowID' => 'Slideshow',
			'slideshowImageURL' => 'Slideshow Image Url',
			'slideshowURL' => 'Slideshow Url',
			'slideshowSortID' => 'Slideshow Sort',
			'slideshowCaption' => 'Slideshow Caption',
			'slideshowCaptionE' => 'Slideshow Caption E',
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

		$criteria->compare('slideshowID',$this->slideshowID);
		$criteria->compare('slideshowImageURL',$this->slideshowImageURL,true);
		$criteria->compare('slideshowURL',$this->slideshowURL,true);
		$criteria->compare('slideshowSortID',$this->slideshowSortID);
		$criteria->compare('slideshowCaption',$this->slideshowCaption,true);
		$criteria->compare('slideshowCaptionE',$this->slideshowCaptionE,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return SlideShow the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function getSlideShows()
	{
		$sql = "SELECT `slideshowImageURL`, `slideshowURL`, `slideshowSortID`, `slideshowCaption`, `slideshowCaptionE` FROM  `tblslideshow` ORDER BY  `slideshowSortID` ASC ";
		return Yii::app()->db->createCommand($sql)->queryAll();
	}
}
