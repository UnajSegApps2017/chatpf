<?php
namespace app\models;

use yii\base\Model;
use app\models\Userchat;

class RegisterForm extends Model{

	public $username;
	public $email;
	public $password;
	public $password_repeat;
	public $publicKey;
	
	public function rules() {
	return [
		[['username', 'email', 'password','password_repeat','publicKey'], 'required', 'message' => 'Campo requerido'],
		['username', 'match', 'pattern' => "/^.{3,50}$/",'message' => 'Mínimo 3 y máximo 50 caracteres'],
		['username', 'match', 'pattern' => "/^[0-9a-z]+$/i", 'message' => 'Sólo se aceptan letras y números'],
		['username', 'username_existe'],
		['email', 'match', 'pattern' => "/^.{5,80}$/",'message' => 'Mínimo 5 y máximo 80 caracteres'],
		['email', 'email', 'message' => 'Formato no válido'],
		['email', 'email_existe'],
		['password', 'match', 'pattern' => "/^.{8,16}$/",'message' => 'Mínimo 6 y máximo 16 caracteres'],
		['password_repeat', 'compare', 'compareAttribute'=> 'password', 'message' => 'Los passwords no coinciden'],
		];
	}

	public function email_existe($attribute, $params)
	{
		$table = Userchat::find()->where("mailUser=:mailUser",[":mailUser" =>$this->email]);
		$aux1 = $table->count();			
		if ($table->count() >0)
			{	
				$table=null;
				$table = Userchat::find()->where("mailUser=:mailUser",[":mailUser" =>$this->email])
                                        //->andwhere("RRHH_idRRHH=:RRHH_idRRHH",[":RRHH_idRRHH"=>$this->RRHH_idRRHH])
                                        ;
				if($table->count()!=$aux1)
				$this->addError($attribute, "El email seleccionado no es individual");
			}
	}

	public function username_existe($attribute, $params)	{
		$table = Userchat::find()->where("nameUser=:nameUser",[":nameUser" =>$this->username]);
		if ($table->count() >= 1)$this->addError($attribute, "El usuario seleccionado existe");
	}
}
