<?php

/**
 * This is the model class for table "tblcategory".
 *
 * The followings are the available columns in table 'tblcategory':
 * @property integer $catID
 * @property string $catName
 * @property string $catNameE
 * @property string $catAlias
 * @property string $catAliasE
 * @property string $catDescription
 * @property string $catDescriptionE
 * @property string $catImageURL
 * @property string $catImageURLE
 * @property integer $catSortID
 */
class Category extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tblcategory';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('catName, catSortID', 'required'),
			array('catSortID', 'numerical', 'integerOnly'=>true),
			array('catName', 'length', 'max'=>100),
			array('catNameE, catAlias, catAliasE', 'length', 'max'=>255),
			array('catDescription, catDescriptionE, catImageURL, catImageURLE', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('catID, catName, catNameE, catAlias, catAliasE, catDescription, catDescriptionE, catImageURL, catImageURLE, catSortID', 'safe', 'on'=>'search'),
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
			'catID' => 'Cat',
			'catName' => 'Cat Name',
			'catNameE' => 'Cat Name E',
			'catAlias' => 'Cat Alias',
			'catAliasE' => 'Cat Alias E',
			'catDescription' => 'Cat Description',
			'catDescriptionE' => 'Cat Description E',
			'catImageURL' => 'Cat Image Url',
			'catImageURLE' => 'Cat Image Urle',
			'catSortID' => 'Cat Sort',
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

		$criteria->compare('catID',$this->catID);
		$criteria->compare('catName',$this->catName,true);
		$criteria->compare('catNameE',$this->catNameE,true);
		$criteria->compare('catAlias',$this->catAlias,true);
		$criteria->compare('catAliasE',$this->catAliasE,true);
		$criteria->compare('catDescription',$this->catDescription,true);
		$criteria->compare('catDescriptionE',$this->catDescriptionE,true);
		$criteria->compare('catImageURL',$this->catImageURL,true);
		$criteria->compare('catImageURLE',$this->catImageURLE,true);
		$criteria->compare('catSortID',$this->catSortID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Category the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/*
	Get List Category 
	*/

	public static function getListCatogoryForProduct(){
		$sql = "SELECT `catID`, `catName` FROM `tblcategory`";
		$result = Yii::app()->db->createCommand($sql)->queryAll();
		//return $result;
		$data=array();
		if(!empty($result)){
			foreach ($result as $catInfo) {
				$data[$catInfo['catID']] = $catInfo['catName'];
			}
		}
		$result = null;
		return $data;
	}

	public function getCategoryNameByID($catID){
		$catID = (int) $catID;
		$catName = Yii::app()->db->createCommand("SELECT  `catName` FROM  `tblcategory` WHERE  `catID`={$catID} limit 1")->queryScalar();
		return $catName ? $catName : 'N/A';
	}


		//echo Yii::app()->language

	public static function getListCatogoryByLanguage($language){

		if($language == 'vi'){
			$select = "`catID` as id, `catName` as name";
		}
		else $select = "`catID` as id, `catNameE` as name";
		$sql = "SELECT $select FROM `tblcategory` order by name";

		$result = Yii::app()->db->createCommand($sql)->queryAll();		
		$data=array();
		if(!empty($result)){
			foreach ($result as $catInfo) {
				
				$catInfo['alias'] = Yii::app()->helper->getAliasURL($catInfo['name']);
				$data[] = $catInfo;
			}
		}
		$result = null;
		return $data;
	}
}
