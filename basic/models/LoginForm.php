<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;

    private $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
		['username','required','message' => 'Campo requerido'],
		['username','match','pattern' => "/^.{3,50}$/",'message' => 'Mínimo 3 y máximo 50 caracteres'],
		['username','match','pattern' => "/^[0-9a-z]+$/i",'message' => 'Sólo se aceptan letras y números'],
		['username','valid_user'],
		['password','required','message' => 'Campo requerido'],
		['password','match','pattern' => "/^.{3,50}$/",'message' => 'Mínimo 3 y máximo 50 caracteres'],
		['password','match','pattern' => "/^[0-9a-z]+$/i",'message' => 'Sólo se aceptan letras y números'],
		['password','validatePassword']
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
    	$table = Userchat::find()
    	->where ( "passwordUser=:passwordUser", 
    			[":passwordUser"=>crypt($this->password, Yii::$app->params["salt"])] )
    	->andWhere("nameUser=:nameUser", [":nameUser"=>$this->username]);
		if ($table->count() == 1)return true;
		else $this->addError( $attribute, "El password es erroneo" );
    }

    /**
     * Logs in a user using the provided username and password.
     * @return bool whether the user is logged in successfully
     */
    public function login(){
        if ($this->validate()) {
            return Yii::$app->user->login(
			$this->getUser(), 
			$this->rememberMe ? 3600*24*30 : 0
		);
        }
        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser(){
        if ($this->_user === false) {
            $this->_user = Userchat::findByUsername($this->username);
        }
	return $this->_user;
    }

    /**
     * Valida user por ajax
     *
     */
    public function valid_user($attribute, $params){
        if (($this->getUser()) && ($this->activ_user())) {
            return true;
        }
    	else $this->addError($attribute, "El usuario no existe" );
	return false;
    }
    
    /**
     * @return boolean true si el usuario existe y está activo
     */
    private function activ_user(){
	$aux = $this->getUser();
	if($aux->activUser === 1) return true;
 	return false;
    }
}
