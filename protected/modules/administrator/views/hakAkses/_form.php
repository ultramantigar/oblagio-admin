<?php
  $base = Yii::app()->baseUrl."/web/administrator";
  $db = Yii::app()->db;

  //closure chekced
    $cek = function($menu_id) use ($db, $model)
    {
      $query_cek = $db->createCommand()
        ->select('menu_id')
        ->from('hak_akses')
        ->where('role_id=:role_id AND menu_id=:menu_id' , 
              [
                ':role_id' => $model->id,
                ':menu_id' => $menu_id
              ]
          )
          ->queryScalar();

         if(!empty($query_cek))
          return 'checked';
         else
          return '';
         
    }
  //
?>
<script type="text/javascript" src="<?php echo $base; ?>/js/jquery.checkboxtree.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $base; ?>/css/jquery.checkboxtree.css"/>
<?php /*<link rel="stylesheet" type="text/css" href="<?php echo $base; ?>/css/jquery-ui-1.8.12.custom.css"/>*/ ?>
<script type="text/javascript">
  $(document).ready(
    function()
    {
       $('#tree1').checkboxTree({
         collapseImage: '<?php echo $base; ?>/images/minus.png',
         expandImage: '<?php echo $base; ?>/images/plus.png',
          initializeChecked: 'expanded',
           initializeUnchecked: 'collapsed'
       });
    }
  );
</script>
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
                        <h3 class="box-title">&nbsp;</h3>
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
                                <?= $form->textField($model , 'role' , ['class' => 'form-control' , 'readonly' => true] ); ?>
                                <?= $form->error($model , 'role' , ['style' => 'color:red;'] ); ?> 
                              </div>
                              <div>
                                  List Menu
                              </div>
                              <div class="form-group">
                              <?php



                              $sql_parent = $db->createCommand()->select('menu.id , menu.nama_menu')
                                ->from('menu menu')
                                ->where('menu.parent_id=:nol' , 
                                          [
                                            ':nol' => 0,
                                          ]

                                        )
                                ->queryAll();
                             

                              foreach($sql_parent as $parent)
                              {
                                  $checked_parent  = $cek($parent['id']);
                              ?>
                                  <ul id="tree1">
                                      <li><input type="checkbox" <?= $checked_parent; ?> name = 'cek[]' value = '<?= $parent['id'] ?>'><label><?php echo $parent['nama_menu']; ?></label>
                                          <ul>
                                            <?php
                                            $sql_child = $db->createCommand()->select('menu.id , menu.nama_menu')
                                              ->from('menu  menu')
                                              ->where('parent_id=:parent_id' , 
                                                      [
                                                        ':parent_id' => $parent['id'] ,
                                                      ]
                                                    )
                                              ->queryAll();
                                            
                                            foreach($sql_child as $child)
                                            {
                                                $checked_child  = $cek($child['id']);
                                            ?>
                                                <li><input type="checkbox" <?= $checked_child; ?> name = 'cek[]' value = '<?= $child['id'] ?>' ><label><?= $child['nama_menu'] ?></label>
                                            <?php
                                            }
                                            ?>


                                          </ul>
                                  </ul>
                              <?php
                              }

                              ?>
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