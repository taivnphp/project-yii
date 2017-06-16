<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{

    private $_id;
    private $_email;
    private $_name;
    public function authenticate()
	{                
        
        $htmlPurifier = new CHtmlPurifier();
        $htmlPurifier->options = array('URI.AllowedSchemes'=>array(
          'http'  => true,
          'https' => true,
        ));
        $username = trim($htmlPurifier->purify($this->username));        
        $password = trim($this->password);
		$account  = Account::model()->find('accUsername=:e', array(':e' => $username));
        
        if(!$account){
            $this->errorCode=self::ERROR_USERNAME_INVALID;
        }        
        else {                        
            if ($account->accPassword != md5($password)) {
                //invalid password
                $this->errorCode=  self::ERROR_PASSWORD_INVALID;
            }
            else{
                //ok
                $this->_id = $account->accID;                            
                $this->_name=$account->accUsername;                
                $this->errorCode=self::ERROR_NONE;
            }                        
        }
		return !$this->errorCode;
	}

    public function getId() {
        return $this->_id;
    }
    
    public function getName(){
        return $this->_name;
    }

    public function getEmail(){
        return $this->_email;
    }
}