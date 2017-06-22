## Thao tac voi Database


- cach 1 : dung lenh SQL ( Query Builder ) . link doc : http://www.yiiframework.com/doc/guide/1.1/en/database.query-builder
 

   vi du 1:  Doi voi cac cau SELECT.
    	<?php 
    	$sql = "Select * from Product ..."; //
			$data = Yii::app()->db->createCommand($sql)->queryAll(); 
			?>
   		
   		trong do :

   		->queryAll() : lay tat ca cac record
   		->queryRow() : lay record dau tien
   		->queryScalar() : lay gia tri column dau tien cua record dau tien

   vi du 2 : doi voi cac cau INSERT, DELETE , UPDATE 
    $sql = "insert into Product...";

    Yii::app()->db->createCommand($sql)->execute(); // ->execute(); dung chung cho cac truong hop nay


 - Cach 2 : dung Model ( Active Record ) . link doc : http://www.yiiframework.com/doc/guide/1.1/en/database.ar

  
    <?php 
    //vi du 1 . Lay tat ca cac Products
    $data = Product::model()->findAll(); ->  findAll() no lay tat record

    // vi du 2. Tim product co ID=1
    $data = Product::model()->findByPk(ID); //  findByPK la viet tat cua tu Find By Private Key , 

    // vi du 3. Tim product voi cac dieu kien nhu proHot=1 (khuyen mai), proNew=1 (san pham moi)

    $conditions = "proHOT=1 or $proNEW=1";
	$data = Product::model()->find($conditions)   // cai nay no giong nhu Select ..from ... Where proHOT=1 or $proNEW=1 vay do

    ?>



## GII TOOL de tu dong generate cac file Model/Controller... 


vao link localhost/project_name/gii/default/login 
sau do nhap pass : 123456 

=> vo dc trang nay : http://prntscr.com/fmrz5p

Sau do bam vo link Model Generator , lam theo cac buoc sau

step 1: http://prntscr.com/fms08k

step 2: http://prntscr.com/fms0xz

Vo thu muc protected/models de kiem tra xem Model dc tao chua => done. Model duoc tao se co day du functions basic, chi can goi ra xai. Co the viet them nhung function moi tuy y may



