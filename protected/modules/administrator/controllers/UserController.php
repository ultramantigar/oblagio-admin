<?php

class UserController extends Controller
{
	
	public $layout = '//layouts/administrator/utama';
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	
	public function accessRules()
	{
		return array(
			
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','create' ,'hapus' , 'update'),
				'users'=>array('@'),
			),
			
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
		$model=new User;
		$this->performAjaxValidation($model);

		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
			if($model->save())
			{
				Yii::app()->user->setFlash('success' , 'Data Telah Disimpan');
				$this->redirect(array('index'));
			}
				
		}

		$this->render('_form',array(
			'model'=>$model,
		));
	}

	
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		$this->performAjaxValidation($model);
		$model->password = '';
		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
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
		$model=new User('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['User']))
			$model->attributes=$_GET['User'];

		$this->render('index',array(
			'model'=>$model,
		));
	}


	public function loadModel($id)
	{
		$model=User::model()->findByPk($id);
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
