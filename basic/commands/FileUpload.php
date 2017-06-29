<?php
namespace app\commands;

use Yii;

use yii\console\Controller;

class FileUpload extends Controller{
	public static function uploadIntoDb($str=''){
            $connection = Yii::$app->getDb();
            $command = $connection->createCommand();
	}
}
?>
