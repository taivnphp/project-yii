<?php

/**
 * This is the model class for table "tblproductphotos".
 *
 * The followings are the available columns in table 'tblproductphotos':
 * @property integer $prophotosID
 * @property integer $proID
 * @property string $prophotosImageURL
 * @property string $prophotosCaption
 * @property integer $prophotosSortID
 */
class ProductPhoto extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'tblproductphotos';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('proID, prophotosSortID', 'numerical', 'integerOnly' => true),
            array('prophotosImageURL, prophotosCaption', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('prophotosID, proID, prophotosImageURL, prophotosCaption, prophotosSortID', 'safe', 'on' => 'search'),
        );
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
            'prophotosID' => 'Prophotos',
            'proID' => 'Pro',
            'prophotosImageURL' => 'Prophotos Image Url',
            'prophotosCaption' => 'Prophotos Caption',
            'prophotosSortID' => 'Prophotos Sort',
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
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('prophotosID', $this->prophotosID);
        $criteria->compare('proID', $this->proID);
        $criteria->compare('prophotosImageURL', $this->prophotosImageURL, true);
        $criteria->compare('prophotosCaption', $this->prophotosCaption, true);
        $criteria->compare('prophotosSortID', $this->prophotosSortID);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return ProductPhoto the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
      Deleting Relations Product Photos
     * */
    public function doDeleteProductPhotos($productId) {
        $productPhotoModels = $this->findAll("proID=$productId");
        if (!empty($productPhotoModels)) {
            foreach ($productPhotoModels as $productPhoto) {
                # code...
                //Remove Product Photos
                $photoImgURL = $productPhoto->prophotosImageURL;
                @unlink($uploadPath . $photoImgURL);
                $productPhoto->delete();
            }
        }
        $productPhotoModels = null;
    }

    /**
      Upload Product Photos
     * */
    public function uploadProductPhotos($productPhotos, $productId, $uploadPath) {
        if (isset($productPhotos['name']) && count($productPhotos['name']) > 0) {

            $countPhotos = count($productPhotos['name']);

            //Loop through each file
            for ($i = 0; $i < $countPhotos; $i++) {
                //Get the temp file path
                if (!$productPhotos['name'][$i]) {
                    //empty file => skip it
                    continue;
                }

                $fileExtension = strtolower(pathinfo($productPhotos['name'][$i], PATHINFO_EXTENSION));
                $photoName = md5(time() . $productPhotos['name'][$i]) . '.' . $fileExtension;
                $tmpFilePath = $productPhotos['tmp_name'][$i];

                //Make sure we have a filepath
                if ($tmpFilePath != "") {
                    //Upload the file into the temp dir
                    if (move_uploaded_file($tmpFilePath, $uploadPath . $photoName)) {
                        $productPhoto = new ProductPhoto();
                        $productPhoto->proID = $productId;
                        $productPhoto->prophotosImageURL = $photoName;
                        $productPhoto->save();
                    }
                }
            }
        }
    }

    public function deleteProductPhoto($photos, $uploadPath) {
        foreach ($photos as $photoID) {
            $productPhotoModel = $this->findByPk($photoID);
            if (!empty($productPhotoModel)) {
                $photoImgURL = $productPhotoModel->prophotosImageURL;
                //Remove files
                @unlink($uploadPath . $photoImgURL);
                $productPhotoModel->delete();
            }
            $productPhotoModel = null;
        }
    }

    public function getProductPhotos($productId) {
        $productId = (int) $productId;
        $sql = "SELECT `prophotosID`, `prophotosImageURL`, `prophotosCaption`, `prophotosSortID` FROM `tblproductphotos` WHERE `proID`=$productId";
        return Yii::app()->db->createCommand($sql)->queryAll();
    }
}