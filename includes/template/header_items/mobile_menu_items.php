<?php echo !defined("GUVENLIK") ? die("Vaoww! Bu ne cesaret?") : null;?> <?php $mainMenu = $db->prepare("select * from header_menu where ust_id=:ust_id and dil=:dil and durum=:durum order by sira asc ");$mainMenu->execute(array('ust_id' => '0', 'dil' => $_SESSION['dil'], 'durum' => '1')); ?> <?php if($mainMenu->rowCount()>'0'  ) {?> <div class="mobile-menu-categories-main"> <div id="categories-parent-main"><ul ><?php foreach ($mainMenu as $menu1) {$altMenu = $db->prepare("select * from header_menu where ust_id=:ust_id and dil=:dil and durum=:durum order by sira asc ");$altMenu->execute(array('ust_id' => $menu1['id'], 'dil' => $_SESSION['dil'], 'durum' => '1')); ?><li <?php if($altMenu->rowCount()>'0'  ) { ?>class="parent"<?php }?> ><a <?php if($menu1['url'] == !null ) { ?>href="<?=$menu1['url']?>"<?php }else {?>href="javascript:void(0"<?php }?>><span><?=$menu1['baslik']?></span><?php if($altMenu->rowCount()>'0'  ) { ?><i class="arrow fa fa-chevron-right"></i><?php }?></a><?php if($altMenu->rowCount()>'0'  ) { ?><ul><?php foreach ($altMenu as $menu2) {$ucuncuMenu = $db->prepare("select * from header_menu where ust_id=:ust_id and dil=:dil and durum=:durum order by sira asc ");$ucuncuMenu->execute(array('ust_id' => $menu2['id'], 'dil' => $_SESSION['dil'] , 'durum' => '1')); ?><li <?php if($ucuncuMenu->rowCount()>'0'  ) { ?>class="parent"<?php }?>><a <?php if($menu2['url'] == !null ) { ?>href="<?=$menu2['url']?>"<?php }else {?>href="javascript:void(0"<?php }?>><span style="margin-left:10px"><?=$menu2['baslik']?></span><?php if($ucuncuMenu->rowCount()>'0'  ) { ?><i  class="arrow fa fa-chevron-right"></i><?php } ?></a><?php if($ucuncuMenu->rowCount()>'0'  ) { ?><ul><?php foreach ($ucuncuMenu as $menu3) {?><li ><a <?php if($menu3['url'] == !null ) { ?>href="<?=$menu3['url']?>"<?php }else {?>href="javascript:void(0"<?php }?>><span style="margin-left:20px"><?=$menu3['baslik']?></span></a></li><?php } ?></ul><?php } ?></li><?php } ?></ul><?php } ?></li><?php } ?></ul></div> </div> <?php }?>
