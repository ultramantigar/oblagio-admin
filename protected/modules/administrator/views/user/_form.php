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
                           'enableAjaxValidation'=>true,
                            'clientOptions' => [
                              'validateOnSubmit' => true,
                              'validateOnKeyUp' => true
                             ]
                          )); ?>
                              <div class="form-group">
                                <?= $form->labelEx($model , 'role_id'); ?>
                                <?= $form->dropDownList($model , 'role_id' ,CHtml::listData(Role::model()->findAll() , 'id' , 'role') , ['class' => 'form-control' , 'empty' => '']); ?>
                                <?= $form->error($model , 'role_id' , ['style' => 'color:red;'] ); ?> 
                              </div>
                              <div class="form-group">
                                <?= $form->labelEx($model , 'username'); ?>
                                <?= $form->textField($model , 'username' , ['class' => 'form-control' , 'empty' => '']); ?>
                                <?= $form->error($model , 'username' , ['style' => 'color:red;'] ); ?> 
                              </div>
                               <div class="form-group">
                                <?= $form->labelEx($model , 'nama'); ?>
                                <?= $form->textField($model , 'nama' , ['class' => 'form-control' , 'empty' => '']); ?>
                                <?= $form->error($model , 'nama' , ['style' => 'color:red;'] ); ?> 
                              </div>
                               <div class="form-group">
                                <?= $form->labelEx($model , 'email'); ?>
                                <?= $form->textField($model , 'email' , ['class' => 'form-control' , 'empty' => '']); ?>
                                <?= $form->error($model , 'email' , ['style' => 'color:red;'] ); ?> 
                              </div>
                               <div class="form-group">
                                <?= $form->labelEx($model , 'password'); ?>
                                <?= $form->passwordField($model , 'password' , ['class' => 'form-control' , 'empty' => '']); ?>
                                <?= $form->error($model , 'password' , ['style' => 'color:red;'] ); ?> 
                              </div>
                              <div class="form-group">
                                <?= $form->labelEx($model , 'verifikasi_password'); ?>
                                <?= $form->passwordField($model , 'verifikasi_password' , ['class' => 'form-control' , 'empty' => '']); ?>
                                <?= $form->error($model , 'verifikasi_password' , ['style' => 'color:red;'] ); ?> 
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