<?php

/**
 * This is the model class for table "tblproduct".
 *
 * The followings are the available columns in table 'tblproduct':
 * @property integer $proID
 * @property integer $catID
 * @property string $proCode
 * @property string $proName
 * @property string $proNameE
 * @property string $proPriceM
 * @property integer $proPriceL
 * @property string $proThumbImageURL
 * @property string $proFullImageURL
 * @property string $proShortDescription
 * @property string $proShortDescriptionE
 * @property string $proFullContent
 * @property string $proFullContentE
 * @property string $proHOT
 * @property string $proNEW
 * @property integer $proView
 * @property integer $proSortID
 */
class Product extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */

	public $keyword;
	public function tableName()
	{
		return 'tblproduct';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('proPriceL', 'required'),
			array('catID, proPriceL, proView, proSortID', 'numerical', 'integerOnly'=>true),
			array('proCode', 'length', 'max'=>50),
			array('proName', 'length', 'max'=>200),
			array('proNameE, proPriceM', 'length', 'max'=>255),
			array('proHOT, proNEW', 'length', 'max'=>10),
			array('proThumbImageURL, proFullImageURL, proShortDescription, proShortDescriptionE, proFullContent, proFullContentE', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('proID, catID, proCode, proName, proNameE, proPriceM, proPriceL, proThumbImageURL, proFullImageURL, proShortDescription, proShortDescriptionE, proFullContent, proFullContentE, proHOT, proNEW, proView, proSortID', 'safe', 'on'=>'search'),
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
			'proID' => 'Pro',
			'catID' => 'Cat',
			'proCode' => 'Pro Code',
			'proName' => 'Pro Name',
			'proNameE' => 'Pro Name E',
			'proPriceM' => 'Pro Price M',
			'proPriceL' => 'Pro Price L',
			'proThumbImageURL' => 'Pro Thumb Image Url',
			'proFullImageURL' => 'Pro Full Image Url',
			'proShortDescription' => 'Pro Short Description',
			'proShortDescriptionE' => 'Pro Short Description E',
			'proFullContent' => 'Pro Full Content',
			'proFullContentE' => 'Pro Full Content E',
			'proHOT' => 'Pro Hot',
			'proNEW' => 'Pro New',
			'proView' => 'Pro View',
			'proSortID' => 'Pro Sort',
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

		$criteria->compare('proID',$this->proID);
		$criteria->compare('catID',$this->catID);

		if($this->keyword){
			$keyword=trim($this->keyword);
			//search by Product Code, Product Name , Product Name English
			$condition = "( proCode like '%$keyword%' or proName like '%$keyword%' or proNameE like '%$keyword%' )";
			$criteria->addCondition($condition);
		}

		$criteria->compare('proPriceM',$this->proPriceM,true);
		$criteria->compare('proPriceL',$this->proPriceL);
		$criteria->compare('proThumbImageURL',$this->proThumbImageURL,true);
		$criteria->compare('proFullImageURL',$this->proFullImageURL,true);
		$criteria->compare('proShortDescription',$this->proShortDescription,true);
		$criteria->compare('proShortDescriptionE',$this->proShortDescriptionE,true);
		$criteria->compare('proFullContent',$this->proFullContent,true);
		$criteria->compare('proFullContentE',$this->proFullContentE,true);
		$criteria->compare('proHOT',$this->proHOT,true);
		$criteria->compare('proNEW',$this->proNEW,true);
		$criteria->compare('proView',$this->proView);
		$criteria->compare('proSortID',$this->proSortID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination' => array('pageSize' => 30)
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Product the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function doDeleteProduct($productId, $uploadPath){
		$modelProduct = $this->findByPk($productId);
		
		if(!empty($modelProduct)){
			ProductPhoto::model()->doDeleteProductPhotos($productId, $uploadPath);

			$modelProduct->delete();
		}                                                
	}

	//Test funtion  - get random Product
	public function getRandomProduct(){
		$sql = "SELECT `proID`, `catID`, `proCode`, `proName`, `proNameE`, `proPriceM`, `proPriceL`, `proThumbImageURL`, `proFullImageURL`, `proShortDescription`, `proShortDescriptionE`, `proFullContent`, `proFullContentE`, `proHOT`, `proNEW`, `proView`, `proSortID` FROM `tblproduct` ORDER by rand() limit 1";
		$result = Yii::app()->db->createCommand($sql)->queryRow();
		return $result;
	}

}