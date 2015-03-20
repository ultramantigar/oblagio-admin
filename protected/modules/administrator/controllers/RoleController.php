<?php

class RoleController extends Controller
{
	
	public $layout = '//layouts/administrator/utama';
	public function filters()
	{
		return array(
			'accessControl', 
			'postOnly + delete', 
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
			
					'actions'=>array('index','create' ,'hapus' , 'update'),
					'users'=>array('@'),
			);
		}
		 return $allow;
	}
	
	public function accessRules()
	{
		return array(
			
			$this->allow(),
			
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}
	public function actionCreate()
	{
		$model=new Role;
		$this->performAjaxValidation($model);

		if(isset($_POST['Role']))
		{
			$model->attributes=$_POST['Role'];
			if($model->save())
				Yii::app()->user->setFlash('success' , 'Data Telah Disimpan');
				$this->redirect(array('index'));
		}

		$this->render('_form',array(
			'model'=>$model,
		));
	}

	
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		if(isset($_POST['Role']))
		{
			$model->attributes=$_POST['Role'];
			if($model->save())
				Yii::app()->user->setFlash('success' , 'Data Telah Diupdate');
				$this->redirect(array('index'));
		}

		$this->render('_form',array(
			'model'=>$model,
		));
	}

	
	public function actionHapus($id)
	{
		if($this->loadModel($id)->delete())
		{
			Yii::app()->user->setFlash('success' , 'Data Telah Dihapus');
			$this->redirect(['index']);	
		}
		
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
