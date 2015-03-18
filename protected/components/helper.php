<?php
	class helper
	{
		public static function enkrip($password)
		{
			return md5(md5(md5("!@#$%^&*()_+oblagioteam".$password)));
		}

		public static function nama_aplikasi($param)
		{
			$nama_aplikasi = Yii::app()->name;
			$pecah = explode(' ',$nama_aplikasi);
			return $pecah[$param];

		}
	}