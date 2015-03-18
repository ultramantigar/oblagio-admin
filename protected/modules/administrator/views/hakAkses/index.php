
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            <?= menu::nama_menu(); ?>
          </h1>
        </section>

        <!-- Main content -->
        <section class="content">

          	<?php foreach(Yii::app()->user->getFlashes() as $key => $val){ ?>
	          <div class="alert alert-success alert-dismissable" id = 'pesan'>
	            <button aria-hidden="true" data-dismiss="alert" class="close" id = 'x' type="button">×</button>
	            <h4><i class="icon fa fa-check"></i> <?= $key ?></h4>
	            <?= $val ?>
	          </div>
          	<?php } ?>
         
          <div class="row">
                <div class="col-md-12">
	              <div class="box box-primary">
	                <div class="box-header">
	                  <h3 class="box-title">  <?= menu::aksi(); ?></h3>
	                </div>
	                <div class = 'box-body'>
	                	 <?php $this->widget('zii.widgets.grid.CGridView', array(
							'id'=>'crud-grid',
							'dataProvider'=>$model->search(),
							'filter'=>$model,
							'columns'=>array(
								'role',
								array(
									'class'=>'CButtonColumn',
									'template' => '{update}',
								),
							),
						)); ?>
					</div>


	               </div>
				 </div>
	        </div>

          </div>
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->