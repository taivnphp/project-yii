<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class ProductController extends Controller{
    
    public $layout = '//layouts/admin';
    protected $folderName = 'product/';
        
    
    public function loadModel($id) {
        $model = Product::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    public function actionAdmin(){
        Yii::app()->language = 'vi';
        $this->checkAccess();

    	$products = new Product('search');
        $products->unsetAttributes();  // clear any default values        
        $keyword = isset($_GET['k']) ? $_GET['k'] : '';
        $products->keyword = $keyword;
        if (isset($_GET['Product']))
            $products->attributes = $_GET['Product'];    

        $this->render('admin', array(
            'model' => $products,
            'keyword' => $keyword,
            'adminUrl' => Yii::app()->createUrl('product/admin'),
            'uploadPath' => Yii::app()->request->baseUrl . Yii::app()->params->pathForUploadFiles . $this->folderName
        ));
    }

    /**
    For Admin
    Update Product
    **/
    public function actionUpdate($id){
        $this->checkAccess();
        Yii::app()->language = 'vi';

        $productId = (int)$id;    
        $product = $this->loadModel($productId);
        if(isset($_POST['Product'])){
                    
            //Update Product Info
            $product->attributes = $_POST['Product'];
            $product->proNEW     = (isset($_POST['Product']['proNEW']) && $_POST['Product']['proNEW'] == 'on') ? '1' : '0';
            $product->proHOT     = (isset($_POST['Product']['proHOT']) && $_POST['Product']['proHOT'] == 'on') ? '1' : '0';
            $fileProductThumbnail = array();
            if (isset($_FILES["ProductThumbnail"]) && !empty($_FILES["ProductThumbnail"]['name'])){
                $fileProductThumbnail = $_FILES["ProductThumbnail"];
                $ext = strtolower(pathinfo($fileProductThumbnail['name'], PATHINFO_EXTENSION));                
                $product->proThumbImageURL = md5('thumb' . time()) . '.' . $ext ;                
            }
            

            if($product->save()){
                $uploadPath = $this->pUploadFiles . $this->folderName . $productId . '/';
                if(!is_dir($uploadPath)){            
                    $old = umask(0);
                    @mkdir($uploadPath, 0777);
                    umask($old);
                }
                //upload thumbnail
                if (!empty($fileProductThumbnail)){                    
                    @move_uploaded_file($fileProductThumbnail["tmp_name"], $uploadPath . $product->proThumbImageURL);                    
                }

                //Deleted Photos
                $ProductPhotoDeleted = isset($_POST['ProductPhotoDeleted']) ? array_filter(explode(',', $_POST['ProductPhotoDeleted'])) : array();
                ProductPhoto::model()->deleteProductPhoto($ProductPhotoDeleted, $uploadPath);                

                //Upload ProductPhotos                
                $productPhotos = isset($_FILES['ProductPhotos']) ? $_FILES['ProductPhotos'] : array();
                ProductPhoto::model()->uploadProductPhotos($productPhotos, $productId, $uploadPath);

                Yii::app()->user->setFlash('message', 'Thông tin sản phẩm đã được lưu');
                $this->redirect(array('update', 'id' => $productId));
            }
        }

        $this->render('form', array(
            'product' => $product,
            'productPhotos' => ProductPhoto::model()->getProductPhotos($productId),
            'uploadPath' => Yii::app()->request->baseUrl . Yii::app()->params->pathForUploadFiles . $this->folderName . $productId . '/'
        ));
    }

    /*
    For Admin : create new product
    */
    public function actionCreate(){
        $this->checkAccess();
        Yii::app()->language = 'vi';
        $product = new Product;
        if(isset($_POST['Product'])){
            //Create Product Info
            $product->attributes = $_POST['Product'];
            $product->proNEW     = (isset($_POST['Product']['proNEW']) && $_POST['Product']['proNEW'] == 'on') ? '1' : '0';
            $product->proHOT     = (isset($_POST['Product']['proHOT']) && $_POST['Product']['proHOT'] == 'on') ? '1' : '0';
            
            $fileProductThumbnail = array();
            if (isset($_FILES["ProductThumbnail"]) && !empty($_FILES["ProductThumbnail"]['name'])){
                $fileProductThumbnail = $_FILES["ProductThumbnail"];
                $ext = strtolower(pathinfo($fileProductThumbnail['name'], PATHINFO_EXTENSION));                
                $product->proThumbImageURL = md5('thumb' . time()) . '.'. $ext ;
            }
            if($product->save()){
                $productId = $product->proID;
                $uploadPath = $this->pUploadFiles . $this->folderName . $productId . '/';
                if(!is_dir($uploadPath)){            
                    $old = umask(0);
                    @mkdir($uploadPath, 0777);
                    umask($old);
                }
                //upload thumbnail
                if (!empty($fileProductThumbnail)){                    
                    @move_uploaded_file($fileProductThumbnail["tmp_name"], $uploadPath . $product->proThumbImageURL);                    
                }
                
                //Upload ProductPhotos                
                $productPhotos = isset($_FILES['ProductPhotos']) ? $_FILES['ProductPhotos'] : array();
                ProductPhoto::model()->uploadProductPhotos($productPhotos, $productId, $uploadPath);

                Yii::app()->user->setFlash('message', 'Thông tin sản phẩm đã được lưu');
                $this->redirect(array('update', 'id' => $productId));
            }
        }

        $this->render('form', array(
            'product' => $product,
            'productPhotos' => array(),
            'uploadPath' => Yii::app()->request->baseUrl . Yii::app()->params->pathForUploadFiles . $this->folderName . '0/'
        ));
    }

    /*
    For Admin : Delete a product
    */
    public function actionDelete($id){
        $this->checkAccess();
        $productId = (int) $id;        
        if ($productId) {      
            $uploadPath = $this->pUploadFiles . $this->folderName . $productId . '/';      
            Product::model()->doDeleteProduct($productId, $uploadPath);
                        
            if(!Yii::app()->request->isPostRequest)
                $this->redirect(array('product/admin'));
            
            if (!isset($_GET['ajax']))

            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));        
        }
    }

    /**
    For Admin : Delete Multi Products
    */
    public function actionDeleteMultiProducts(){
        $this->checkAccess();
        $productDelete = Yii::app()->request->getParam('ProductDelete', array());        
        if(!empty($productDelete)){
            foreach($productDelete as $productId){
                $uploadPath = $this->pUploadFiles . $this->folderName . $productId . '/';
                Product::model()->doDeleteProduct($productId, $uploadPath);
            }

            if(Yii::app()->request->isPostRequest){
                echo 'success';
            }                
            else $this->redirect(array('product/admin'));            
        }
    }

    /**/
    public function actionView($id){
        $this->setLanguage();
        $this->layout='website';
        $productId = (int)$id;
        $product = $this->loadModel($productId);

        //Increase Product View
        $product->proView=$product->proView+1;
        $product->save();
        $this->render('view', array(
            'language' => $this->getLanguage(),
            'product' => $product,
            'productPhotos' => ProductPhoto::model()->getProductPhotos($productId),
            'uploadPath' => Yii::app()->request->baseUrl . Yii::app()->params->pathForUploadFiles . $this->folderName
        ));
    }

    public function actionDemo(){
        //get data from Model
        $randomProduct = Product::model()->getRandomProduct();        

        //Render to view
        $this->render('demo', array('randomProduct'=>$randomProduct));
    }
}