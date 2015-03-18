<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            <?= menu::nama_menu(); ?>
          </h1>
        </section>

        <!-- Main content -->
        <section class="content">
          
          <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                      <div class="box-header">
                        <h3 class="box-title">  <?= menu::aksi(); ?></h3>
                      </div>
                      <div class = 'box-body'>
                                    
                          <?php $form=$this->beginWidget('CActiveForm', array(
                            'id'=>'crud-form',
                           'enableClientValidation' => true,
                           /* 'enableAjaxValidation'=>true,
                            'clientOptions' => [
                              'validateOnSubmit' => true,
                              'validateOnKeyUp' => true
                            ]*/
                          )); ?>
                         
                              <div class="form-group">
                                <?= $form->labelEx($model , 'role'); ?>
                                <?= $form->textField($model , 'role' , ['class' => 'form-control']); ?>
                                <?= $form->error($model , 'role' , ['style' => 'color:red;'] ); ?> 
                              </div>
                              <div class="box-footer">
                                <button class="btn btn-primary" type="submit"><?= $model->isNewRecord ? 'Simpan' : 'Update'; ?></button>
                              </div>
                          <?php $this->endWidget(); ?>

                      </div>
                    </div>
                </div>
          </div>

          </div>
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->