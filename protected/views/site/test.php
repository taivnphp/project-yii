<?php
/* @var $this SiteController */
/* @var $model ContactForm */
/* @var $form CActiveForm */

$this->pageTitle=Yii::app()->name . ' - Contact Us';
$this->breadcrumbs=array(
	'Contact',
);
$sql = "SELECT DimPatient.PatientID, DimPatient.LastNm, DimPatient.FirstNm, DimPatient.DOB, EncounterDate, EncounterType
FROM aspicio_edw.DimPatient, aspicio_edw.FactEncounter
WHERE DimPatient.PatientID=FactEncounter.PatientID
ORDER BY DimPatient.PatientID, EncounterDate DESC";

$dataProvider=new CSqlDataProvider($sql, array(
    'db' => Yii::app()->edw,
    'totalItemCount'=>5215,
    'keyField' => 'PatientID',
    'pagination'=>array(
        'pageSize'=>100,
    ),
));

$this->widget('ext.widgets.grid.GroupGridView', array(
    'dataProvider' => $dataProvider,
    'template' => "{items}",
    // 'columns' => Person::getGridColumns(),
    'mergeColumns' => array('PatientID', 'LastNm', 'FirstNm', 'DOB')
));
?>
