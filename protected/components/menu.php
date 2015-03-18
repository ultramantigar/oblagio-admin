<?php
	class menu
	{
		public static function nama_menu()
		{
			$db = Yii::app()->db;
			$controller = Yii::app()->controller->id;
			$nama_menu = $db->createCommand()->select('nama_menu')
				->from('menu')
				->where('controller=:controller' , [':controller' => $controller] )
				->queryScalar();

			return $nama_menu;
		}
		public static function controller_to($params)
		{
			$module = Yii::app()->controller->module->id;
			$controller = Yii::app()->controller->id;
			return Yii::app()->createUrl("$module/$controller/$params");
		}
		public static function aksi($aksi = "")
		{
			$action = Yii::app()->controller->action->id;
			if(!empty($aksi))
			{
				$hasil = $aksi;
			}else{
				
				if($action == 'index')
				{
					$hasil = 'List';
				}elseif($action == 'create'){
					$hasil = 'Tambah';
				}elseif($action == 'update'){
					$hasil = 'Edit';
				}elseif($action == 'view'){
					$hasil = 'View';
				}else{
					$hasil = $aksi;
				}
			}

			return $hasil;
		}

	}