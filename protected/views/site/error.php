<?php
/* @var $this SiteController */
/* @var $error array */

$this->pageTitle=Yii::app()->name . ' - Error';
$this->breadcrumbs=array(
	'Error',
);
?>

<h2>Error <?php echo $code; ?></h2>

<div class="error">
<?php echo CHtml::encode($message); ?>
</div>
<br/>
<div>
<?php echo CHtml::link('Go to Home Page Click Here!' , ['/site'] , ['style' => 'color:blue;'] ); ?>
</div> 