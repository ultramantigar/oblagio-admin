<?php
	class identitas
	{
		public static function attribute()
		{
			if(!empty(Yii::app()->user->id))
			{
				$model = User::model()->findByPk(Yii::app()->user->id);
				return $model;
			}else{
				throw new CHttpException(403 , "Anda Belum Login!!");
				
			}
		}	
	}