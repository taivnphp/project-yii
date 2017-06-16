<?php $this->layout = 'login';?>
<div class="inner">
    <div class="contentpanel" style="min-height: 267px;">
        <div class="container">
            <div class="row">    
                <div class="login">                    
                    <div class="trans-box login <?php if($flagErr) {echo 'shake';} else { echo 'fadeInDown';} ?>">
                        <section class="login">                        
                            <div class="logo tab-wrap"><a href="javascript:;" data-target=".login-tab" class="login_tab_open active">LOGIN</a></div>
                            <div class="l-tab">
                                <div class="login-tab">
                                    <div class="log-frm">                                    
                                        <h1 class="login-ttl">                                        
                                            Welcome. <span>Please login.</span>
                                        </h1>
                                        <?php
	                                        $lgForm = $this->beginWidget('CActiveForm', array(
	                                            'id'                     => 'log-frm',
	                                            'enableClientValidation' => true,
	                                            'clientOptions'          => array(
	                                                'validateOnSubmit' => true,
	                                            ),
	                                            'htmlOptions'      => array(
	                                                'class'                  => 'frm login-frm'
	                                            )                                        
                                            ));
                                        ?>       
                                        <?php Yii::app()->helper->renderMessage(); ?>                                        
                                        <div class="frow">
                                        <?php if (isset($_COOKIE['remember_me'])) $userLoginForm->username = $_COOKIE['remember_me']; ?>
                                            <?php echo $lgForm->textField($userLoginForm, 'username', array('class'       => 'ipt txt-ipt', 'placeholder' => 'Username', 'maxlength' => 50)); ?>
                                        </div>
                                        <div class="frow"> 
                                            <?php echo $lgForm->passwordField($userLoginForm, 'password', array('class'       => 'ipt txt-ipt', 'placeholder' => 'Password', 'maxlength' => 50)); ?>
                                        </div>
                                        <div class="frow"> 
                                        <?php echo CHtml::submitButton('Login', array('class' => 'btn btn-primary btn-block uppercase')); ?>
                                        </div>
                                        <div class="frow login-lik"> 
                                            <div class="f-l">                                            
                                                <input type="checkbox" name="rememberMe" id="remember" <?php if (isset($_COOKIE['remember_me'])) {echo 'checked="checked"';} ?> />
                                                <label for="remember">Remember me</label>
                                            </div>                                        
                                        </div>                        
                                        <?php $this->endWidget(); ?>                                    
                                    </div>
                                </div>                                                                                                        
                            </div>

                        </section>   
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>