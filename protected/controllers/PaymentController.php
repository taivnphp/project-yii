<?php

class PaymentController extends Controller
{
	public $layout = '//layouts/website';
	public function actionCheckout(){
		$this->render('checkout');
	}
}