<?php

class HakAksesController extends Controller
{
	
	public $layout = '//layouts/administrator/utama';
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	public function allow() // fungsi mengecek apakah role user di autorisasi apa kaga di database
	{
		$cek_menu = menu::cek_menu();
		if(empty($cek_menu))
		{
			$allow = array();
		}else{
			$allow = array('allow', 
				'actions'=>array('index','update'),
				'users'=>array('@'),
			);
		}
		 return $allow;
	}
	
	public function accessRules()
	{
		return array(
			$this->allow()
			,
			
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	

	
	public function actionUpdate($id)
	{
		extract($_POST,EXTR_SKIP);
		$db = Yii::app()->db;
		$model=$this->loadModel($id);
		$transaction = $db->beginTransaction();
		try
		{
			if(isset($_POST['Role']))
			{
				@$count = count($cek);
				$delete = $db->createCommand()
					->delete('hak_akses' , 'role_id=:role_id' , [':role_id' => $model->id] );
					

				for($a=0;$a<$count;$a++)
				{
					$insert = $db->createCommand()
						->insert('hak_akses' , [
							'role_id' => $model->id,
							'menu_id' => $cek[$a]
						]);
				}
				$transaction->commit();
				Yii::app()->user->setFlash('success' ,'Data telah diupdate!');
				$this->redirect(['index']);
			}
		}catch(Exception $e){
				$transaction->rollback();
				Yii::app()->user->setFlash('danger' ,'Lost Connection!');
				$this->redirect(['index']);
		}
			

		$this->render('_form',array(
			'model'=>$model,
		));
	}

	
	public function actionIndex()
	{
		$model=new Role('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Role']))
			$model->attributes=$_GET['Role'];

		$this->render('index',array(
			'model'=>$model,
		));
	}


	public function loadModel($id)
	{
		$model=Role::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='crud-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
