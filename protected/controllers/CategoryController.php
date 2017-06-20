<?php

class CategoryController extends Controller
{
    public $layout = '//layouts/admin';
    protected $folderName = 'category/';
    public function actionIndex()
    {
        $this->redirect(array('category/admin'));
    }

    public function loadModel($id) {
        $model = Category::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, Yii::t( 'trans', 'Category_not_found'));
        return $model;
    }
    

    public function actionAdmin(){
        Yii::app()->language = 'vi';
        $this->checkAccess();

        $categories = new Category('search');
        $categories->unsetAttributes();  // clear any default values        
        $keyword = isset($_GET['k']) ? $_GET['k'] : '';
        $categories->keyword = $keyword;
        if (isset($_GET['categories']))
            $categories->attributes = $_GET['categories'];    

        $this->render('admin', array(
            'model' => $categories,
            'keyword' => $keyword,
            'adminUrl' => Yii::app()->createUrl('category/admin'),
            'uploadPath' => Yii::app()->request->baseUrl . Yii::app()->params->pathForUploadFiles . $this->folderName
        ));
    }

    public function actionCreate(){
        Yii::app()->language = 'vi';
        $this->checkAccess();
        $category = new Category;

        if(isset($_POST['Category'])){
            $category->attributes = $_POST['Category'];

            $fileCategoryThumbnail = array();
            if (isset($_FILES["CategoryThumbnail"]) && !empty($_FILES["CategoryThumbnail"]['name'])){
                $fileCategoryThumbnail = $_FILES["CategoryThumbnail"];
                $ext = strtolower(pathinfo($fileCategoryThumbnail['name'], PATHINFO_EXTENSION));                
                $category->catImageURL = md5('thumb' . time()) . '.' . $ext ; 
                $category->catImageURLE  = $category->catImageURL;             
            }

            if($category->save()){
                $uploadPath = $this->pUploadFiles . $this->folderName . $category->catID . '/';                            
                if(!is_dir($uploadPath)){            
                    $old = umask(0);
                    @mkdir($uploadPath, 0777);
                    umask($old);
                }
                //upload thumbnail
                if (!empty($fileCategoryThumbnail)){                                        
                    move_uploaded_file($fileCategoryThumbnail["tmp_name"], $uploadPath . $category->catImageURL);                    
                }                        

                Yii::app()->user->setFlash('message', 'Thông tin danh mục đã được lưu !');
                $this->redirect(array('update', 'id' => $category->catID));
            }
        }

        $this->render('form' , array(
            'category' => $category,
            'uploadPath' => Yii::app()->request->baseUrl . Yii::app()->params->pathForUploadFiles . $this->folderName . '/0/'
        ));
    }

    public function actionUpdate($id){
        Yii::app()->language = 'vi';
        $this->checkAccess();
        $catId = (int) $id;

        $category = $this->loadModel($catId);


        if(isset($_POST['Category'])){
            $category->attributes = $_POST['Category'];

            $fileCategoryThumbnail = array();
            if (isset($_FILES["CategoryThumbnail"]) && !empty($_FILES["CategoryThumbnail"]['name'])){
                $fileCategoryThumbnail = $_FILES["CategoryThumbnail"];
                $ext = strtolower(pathinfo($fileCategoryThumbnail['name'], PATHINFO_EXTENSION));                
                $category->catImageURL = md5('thumb' . time()) . '.' . $ext ; 
                $category->catImageURLE  = $category->catImageURL;             
            }

            if($category->save()){
                $uploadPath = $this->pUploadFiles . $this->folderName . $catId . '/';                            
                if(!is_dir($uploadPath)){            
                    $old = umask(0);
                    @mkdir($uploadPath, 0777);
                    umask($old);
                }
                //upload thumbnail
                if (!empty($fileCategoryThumbnail)){                                        
                    move_uploaded_file($fileCategoryThumbnail["tmp_name"], $uploadPath . $category->catImageURL);                    
                }                        

                Yii::app()->user->setFlash('message', 'Thông tin danh mục đã được lưu !');
                $this->redirect(array('update', 'id' => $catId));
            }
        }
        $this->render('form' , array(
            'category' => $category,
            'uploadPath' => Yii::app()->request->baseUrl . Yii::app()->params->pathForUploadFiles . $this->folderName . $catId . '/'
        ));

    }

    /*
    For Admin : Delete a product
    */
    public function actionDelete($id){
        $this->checkAccess();
        $catId = (int) $id;        
        if ($catId) {      
            $uploadPath = $this->pUploadFiles;                  
            Category::model()->doDeleteCategory($catId , $this->pUploadFiles);
                        
            
            if(!Yii::app()->request->isPostRequest)
                $this->redirect(array('category/admin'));
            
            if (!isset($_GET['ajax']))

            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        }
    }

    /**
    For Admin : Delete Multi Products
    */
    public function actionDeleteMultiCategories(){
        $this->checkAccess();
        $productDelete = Yii::app()->request->getParam('CategoryDelete', array());        
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

    public function actionView($id){
        $this->setLanguage();
        $this->layout = 'website';
        $catId=(int)$id;        
        $categoryModel = $this->loadModel($catId);

        //GetListProduct
        $products = new Product();
        $products->unsetAttributes();  // clear any default values        
        $keyword = Yii::app()->request->getParam('k');
        $products->keyword = $keyword;
        $products->catID = $catId;    
        
        $this->render('view', array(
            'category' => $categoryModel,
            'listCategories' => Category::model()->getListCatogoryByLanguage($this->getLanguage()),
            'language' => $this->getLanguage(),
            'listProducts' => $products->search()->getData(),
            'keyword' => $keyword         
        ));
    }
    
}