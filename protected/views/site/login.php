
		<p class="login-box-msg">Sign in to start your session</p>
        <?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'login-form',
			'enableClientValidation'=>true,
			'clientOptions'=>array(
				'validateOnSubmit'=>true,
			),
		)); ?>
          <div class="form-group has-feedback">
            <?php echo $form->textField($model,'username' , ['class' => 'form-control' , 'placeholder' => 'Username']); ?>
            <?= $form->error($model ,'username' , ['style' => 'color:red;']); ?>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <?php echo $form->passwordField($model,'password' , ['class' => 'form-control' , 'placeholder' => 'Password']); ?>
             <?= $form->error($model ,'password' , ['style' => 'color:red;']); ?>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-8">    
              <div class="checkbox icheck">
                <!--label>
                  <input type="checkbox"> Remember Me
                </label-->
                &nbsp;
              </div>                        
            </div><!-- /.col -->
            <div class="col-xs-4">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
            </div><!-- /.col -->
          </div>
       <?php $this->endWidget(); ?>