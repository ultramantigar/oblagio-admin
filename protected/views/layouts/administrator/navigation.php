<?php $db = Yii::app()->db; ?>
<?php
 function display_menu($param1 , $param2)
  {
    if($param1 == $param2)
    {
      return "active";
    }else{
      return "";
    }
  }

  $controller = Yii::app()->controller->id;
?>

<aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            
            <li class="header">MAIN NAVIGATION</li>
              <?php
              $sql_parent = $db->createCommand()
                ->select('id , nama_menu')
                ->from('menu')
                ->where('parent_id=:nol' , [':nol' => 0] )
                ->queryAll();
                foreach($sql_parent as $parent)
                {
                  $cari_parent = $db->createCommand("SELECT parent_id FROM menu WHERE controller = '$controller' LIMIT 1")->queryScalar();
                  $cek_role_par = $db->createCommand("select menu_id FROM hak_akses WHERE menu_id = '$parent[id]' AND role_id = '".identitas::attribute()->role_id."'")->queryScalar();
                  if(!empty($cek_role_par))
                  {
              ?>
                <li class="treeview <?= display_menu($cari_parent, $parent['id']); ?>">
                  <a href="#">
                    <i class="fa fa-lock"></i> <span><?php  echo $parent['nama_menu']; ?></span> <i class="fa fa-angle-left pull-right"></i>
                  </a>
                  <ul class="treeview-menu">
                    <?php
                    $sql_child = $db->createCommand()
                      ->select('id , nama_menu , modules , controller , action')
                      ->from('menu')
                      ->where('parent_id=:parent' , [':parent' => $parent['id'] ] )
                      ->queryAll();

                    foreach($sql_child as $child)
                    {
                      $url = Yii::app()->createUrl("/$child[modules]/$child[controller]/$child[action]");
                      $cek_role_child = $db->createCommand("select menu_id FROM hak_akses WHERE menu_id = '$child[id]' AND role_id = '".identitas::attribute()->role_id."'")->queryScalar();
                      if(!empty($cek_role_child))
                      {
                    ?> 
                      <li>
                        <?php echo CHtml::link($child['nama_menu'] , $url ) ?>
                      </li>
                    <?php
                      }
                    }
                    ?>
                  </ul>
                </li>
                  <?php
                    }
                  ?>
              <?php
                }
              ?>
              <li class="treeview"><?=CHtml::link('<i class="fa fa-logout"></i><span>Logout</span>' , ['/site/logout'] ); ?></li>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>