<?php echo !defined("GUVENLIK") ? die("Vaoww! Bu ne cesaret?") : null;?> <?php if(isMobileDevice()  ) {?><?php $altKatVarmi = $db->prepare("select * from urun_cat where dil=:dil and durum=:durum and ust_id=:ust_id order by sira asc ");$altKatVarmi->execute(array('dil' => $_SESSION['dil'], 'durum' => '1', 'ust_id' => $katMain['id'])); ?><!-- Mobile Nav Bar !--><div class="category-detail-mobile-acc"><div class="category-detail-mobile-acc-in"><?php if($altKatVarmi->rowCount()>'0'  ) {?><a class="category-detail-mobile-acc-subcat" data-toggle="collapse" data-target="#subcatAccordion" aria-expanded="false" aria-controls="collapseForm"><?=$diller['kategori-detay-text42']?></a><?php }?><a class="category-detail-mobile-acc-filter"  data-toggle="collapse" data-target="#filterAccordion" aria-expanded="false" aria-controls="collapseForm"><i class="fa fa-filter"></i> <?=$diller['kategori-detay-text41']?></a></div><div id="accordion" class="accordion"><?php if($altKatVarmi->rowCount()>'0'  ) {?><div class="collapse" id="subcatAccordion" data-parent="#accordion"><div class="subpage-mobile-nav border-top "><div class="subpage_navigation pl-3 pr-3 pt-2 pb-2" ><?php foreach ($altKatVarmi as $altkategori) {?><div class="category-sub-design-box"><li><a href="<?=$altkategori['seo_url']?>/"><?php if($altkategori['icon'] == !null ) {?><i class="<?=$altkategori['icon']?>"></i><?php }?> <?=$altkategori['baslik']?></a></li></div><?php }?></div></div></div><?php } ?><div class="collapse" id="filterAccordion" data-parent="#accordion"><div class="subpage-mobile-nav border-top "><div class="subpage_navigation p-3" ><?php if ($islemayar['filtre_bedavakargo'] == '1' || $islemayar['filtre_yeniler'] == '1' || $islemayar['filtre_firsatlar'] == '1' || $islemayar['filtre_indirimler'] == '1' || $islemayar['filtre_taksitler'] == '1' || $islemayar['filtre_hizlikargo'] == '1') { ?><div class="cat-left-box-main"><div class="cat-left-box-h"><?=$diller['kategori-detay-text1']?><div style="width: 30px; height: 3px; background-color: #<?= $islemayar['sol_nav_ayirac'] ?>; margin-top: 7px;  "></div></div><div class="cat-left-box-out-first" id="cat-left-overflow"><?php if ($islemayar['filtre_bedavakargo'] == '1') { ?><div class="cat-left-box-t"><div class="custom-control custom-checkbox"><?php if($_GET['uk'] == '1'  ) {?><input type="checkbox" class="custom-control-input" id="uk" onclick="javascript:window.location='<?=$browser_link?>?<?=$ukParselMain?>'" checked ><?php }?> <?php if($_GET['uk'] == '0' || !isset($_GET['uk'])    ) {?><input type="checkbox" class="custom-control-input" id="uk" onclick="javascript:window.location='<?=$browser_link?><?php if(!isset($_GET['s'])) { ?>?s=<?=$islemayar['siralama_secim']?><?php }else{?>?<?php } ?><?=$ukParselMain?>&uk=1'" ><?php }?><label class="custom-control-label" for="uk"><?=$diller['kategori-detay-text2']?></label></div></div><?php } ?> <?php if ($islemayar['filtre_yeniler'] == '1') { ?><div class="cat-left-box-t"><div class="custom-control custom-checkbox"><?php if($_GET['new'] == '1'  ) {?><input type="checkbox" class="custom-control-input" id="new" onclick="javascript:window.location='<?=$browser_link?>?<?=$npParselMain?>'" checked ><?php }?> <?php if($_GET['new'] == '0' || !isset($_GET['new'])    ) {?><input type="checkbox" class="custom-control-input" id="new" onclick="javascript:window.location='<?=$browser_link?><?php if(!isset($_GET['s'])) { ?>?s=<?=$islemayar['siralama_secim']?><?php }else{?>?<?php } ?><?=$npParselMain?>&new=1'" ><?php }?><label class="custom-control-label" for="new"><?=$diller['kategori-detay-text3']?></label></div></div><?php } ?> <?php if ($islemayar['filtre_firsatlar'] == '1') { ?><div class="cat-left-box-t"><div class="custom-control custom-checkbox"><?php if($_GET['firsat'] == '1'  ) {?><input type="checkbox" class="custom-control-input" id="firsat" onclick="javascript:window.location='<?=$browser_link?>?<?=$opParselMain?>'" checked ><?php }?> <?php if($_GET['firsat'] == '0' || !isset($_GET['op'])    ) {?><input type="checkbox" class="custom-control-input" id="firsat" onclick="javascript:window.location='<?=$browser_link?><?php if(!isset($_GET['s'])) { ?>?s=<?=$islemayar['siralama_secim']?><?php }else{?>?<?php } ?><?=$opParselMain?>&firsat=1'" ><?php }?><label class="custom-control-label" for="firsat"><?=$diller['kategori-detay-text4']?></label></div></div><?php } ?> <?php if ($islemayar['filtre_indirimler'] == '1') { ?><div class="cat-left-box-t"><div class="custom-control custom-checkbox"><?php if($_GET['indirim'] == '1'  ) {?><input type="checkbox" class="custom-control-input" id="indirim" onclick="javascript:window.location='<?=$browser_link?>?<?=$indirimParselMain?>'" checked ><?php }?> <?php if($_GET['indirim'] == '0' || !isset($_GET['indirim'])    ) {?><input type="checkbox" class="custom-control-input" id="indirim" onclick="javascript:window.location='<?=$browser_link?><?php if(!isset($_GET['s'])) { ?>?s=<?=$islemayar['siralama_secim']?><?php }else{?>?<?php } ?><?=$indirimParselMain?>&indirim=1'" ><?php }?><label class="custom-control-label" for="indirim"><?=$diller['kategori-detay-text5']?></label></div></div><?php } ?> <?php if ($islemayar['filtre_taksitler'] == '1') { ?><div class="cat-left-box-t"><div class="custom-control custom-checkbox"><?php if($_GET['taksit'] == '1'  ) {?><input type="checkbox" class="custom-control-input" id="taksit" onclick="javascript:window.location='<?=$browser_link?>?<?=$taksitParselMain?>'" checked ><?php }?> <?php if($_GET['taksit'] == '0' || !isset($_GET['taksit'])    ) {?><input type="checkbox" class="custom-control-input" id="taksit" onclick="javascript:window.location='<?=$browser_link?><?php if(!isset($_GET['s'])) { ?>?s=<?=$islemayar['siralama_secim']?><?php }else{?>?<?php } ?><?=$taksitParselMain?>&taksit=1'" ><?php }?><label class="custom-control-label" for="taksit"><?=$diller['kategori-detay-text6']?></label></div></div><?php } ?> <?php if ($islemayar['filtre_hizlikargo'] == '1') { ?><div class="cat-left-box-t"><div class="custom-control custom-checkbox"><?php if($_GET['hizlikargo'] == '1'  ) {?><input type="checkbox" class="custom-control-input" id="hizlikargo" onclick="javascript:window.location='<?=$browser_link?>?<?=$hkParselMain?>'" checked ><?php }?> <?php if($_GET['hizlikargo'] == '0' || !isset($_GET['hizlikargo'])    ) {?><input type="checkbox" class="custom-control-input" id="hizlikargo" onclick="javascript:window.location='<?=$browser_link?><?php if(!isset($_GET['s'])) { ?>?s=<?=$islemayar['siralama_secim']?><?php }else{?>?<?php } ?><?=$hkParselMain?>&hizlikargo=1'" ><?php }?><label class="custom-control-label" for="hizlikargo"><?=$diller['kategori-detay-text7']?></label></div></div><?php } ?> <?php if ($islemayar['filtre_editor'] == '1') { ?><div class="cat-left-box-t"><div class="custom-control custom-checkbox"><?php if($_GET['editor'] == '1'  ) {?><input type="checkbox" class="custom-control-input" id="editorsecimi" onclick="javascript:window.location='<?=$browser_link?>?<?=$editorParselMain?>'" checked ><?php }?> <?php if($_GET['editor'] == '0' || !isset($_GET['editor'])    ) {?><input type="checkbox" class="custom-control-input" id="editorsecimi" onclick="javascript:window.location='<?=$browser_link?><?php if(!isset($_GET['s'])) { ?>?s=<?=$islemayar['siralama_secim']?><?php }else{?>?<?php } ?><?=$editorParselMain?>&editor=1'" ><?php }?><label class="custom-control-label" for="editorsecimi"><?=$diller['kategori-detay-text38']?></label></div></div><?php } ?></div></div><?php } ?> <?php if($katMain['fiyat_filtre'] == '1' ) {?><?php if($varsayilankur['kod'] == $secilikur['kod'] ) {?><?php if($maxPrice > '0' && $minPrice >= '0'  ) {?><div class="cat-left-box-main"><div class="cat-left-box-h"><?=$diller['kategori-detay-text25']?><div style="width: 30px; height: 3px; background-color: #<?= $islemayar['sol_nav_ayirac'] ?>; margin-top: 7px;  "></div></div><div class="cat-left-box-out-first"  ><fieldset class="filter-price"><div class="price-field"><?php $minPrice1 = number_format(kurhesapla($varsayilankur['deger'],$secilikur['deger'],$minPrice ), $secilikur['para_format']);$maxPrice2 = number_format(kurhesapla($varsayilankur['deger'],$secilikur['deger'],$maxPrice ), $secilikur['para_format']); ?><input type="range" min="<?=$minPrice?>" max="<?=$maxPrice?>" value="<?=$minPrice?>" id="lower" name="min"><input  type="range" min="<?=$minPrice?>" max="<?=$maxPrice?>" value="<?=$maxPrice?>" id="upper" name="max"></div><div class="price-wrap"><input id="one" type="hidden" ><input id="two" type="hidden" ><div class="price-wrap-outputbox"><?php if($secilikur['simge_gosterim'] == '0' ) {?> <?=$secilikur['sol_simge']?><?php }?> <?php if($secilikur['simge_gosterim'] == '1' ) {?> <?=$secilikur['sag_simge']?><?php }?><span class="output"><?php echo number_format(kurhesapla($varsayilankur['deger'],$secilikur['deger'],$minPrice ), $secilikur['para_format']); ?></span><?php if($secilikur['simge_gosterim'] == '2' ) {?> <?=$secilikur['sol_simge']?><?php }?> <?php if($secilikur['simge_gosterim'] == '3' ) {?> <?=$secilikur['sag_simge']?><?php }?></div><div class="price-wrap-outputbox" style="margin-right: 0;"><?php if($secilikur['simge_gosterim'] == '0' ) {?> <?=$secilikur['sol_simge']?><?php }?> <?php if($secilikur['simge_gosterim'] == '1' ) {?> <?=$secilikur['sag_simge']?><?php }?><span class="output2"><?php echo number_format(kurhesapla($varsayilankur['deger'],$secilikur['deger'],$maxPrice ), $secilikur['para_format']); ?></span><?php if($secilikur['simge_gosterim'] == '2' ) {?> <?=$secilikur['sol_simge']?><?php }?> <?php if($secilikur['simge_gosterim'] == '3' ) {?> <?=$secilikur['sag_simge']?><?php }?></div></div><div class="price-filter-range-button"><?php if(isset($_GET['max']) && isset($_GET['min'])  ) {?><button class="<?=$islemayar['fiyat_range_button']?> button-1x" style="width: 100%;  " id="submit" onclick="javascript:window.location='<?=$browser_link?><?php if(!isset($_GET['s'])) { ?>?s=<?=$islemayar['siralama_secim']?><?php }else{?>?<?php } ?><?=$PriceFilterParselMain?>&max='+document.getElementById('upper').value+'&min='+document.getElementById('lower').value"><?=$diller['kategori-detay-text26']?></button><?php }else { ?><button class="<?=$islemayar['fiyat_range_button']?> button-1x" style="width: 100%; " id="submit" onclick="javascript:window.location='<?=$browser_link?><?php if(!isset($_GET['s'])) { ?>?s=<?=$islemayar['siralama_secim']?><?php }else{?>?<?php } ?><?=$PriceFilterParselMain?>&max='+document.getElementById('upper').value+'&min='+document.getElementById('lower').value"><?=$diller['kategori-detay-text26']?></button><?php }?></div></fieldset></div></div> <!-- Fiyat Aralığı !--><script> var lowerSlider = document.querySelector('#lower');var upperSlider = document.querySelector('#upper');document.querySelector('#two').value = upperSlider.value;document.querySelector('#one').value = lowerSlider.value;var lowerVal = parseInt(lowerSlider.value);var upperVal = parseInt(upperSlider.value);/* Lover için span ///////////////////////////////////////////*/var input  = document.querySelector("[id=\"lower\"]"), output = document.querySelector(".output");function keydownHandler() {output.innerHTML = this.value;}input.addEventListener("input", keydownHandler);/* Lover için span SON ///////////////////////////////////////////*//* upper için span ///////////////////////////////////////////*/var input2  = document.querySelector("[id=\"upper\"]"), output2 = document.querySelector(".output2");function keydownHandler2() {output2.innerHTML = this.value;}input2.addEventListener("input", keydownHandler2);/* upper için span SON ///////////////////////////////////////////*/upperSlider.oninput = function () {lowerVal = parseInt(lowerSlider.value);upperVal = parseInt(upperSlider.value);if (upperVal < lowerVal + 4) {lowerSlider.value = upperVal - 4;if (lowerVal == lowerSlider.min) {upperSlider.value = 4;}}document.querySelector('#two').value = this.value;};lowerSlider.oninput = function () {lowerVal = parseInt(lowerSlider.value);upperVal = parseInt(upperSlider.value);if (lowerVal > upperVal - 4) {upperSlider.value = lowerVal + 4;if (upperVal == upperSlider.max) {lowerSlider.value = parseInt(upperSlider.max) - 4;}}document.querySelector('#one').value = this.value;};</script><!--  <========SON=========>>> Fiyat Aralığı SON !--><?php }?><?php }?><?php }?> <?php if($katMain['marka_filtre'] == '1' ) {?><?php if($MarkaFiltreListele->rowCount()>'0'  ) {?><!-- Kategorinin Marka Filtresi !--><div class="cat-left-box-main"><div class="cat-left-box-h"><?=$diller['kategori-detay-text8']?><div style="width: 30px; height: 3px; background-color: #<?= $islemayar['sol_nav_ayirac'] ?>; margin-top: 7px;  "></div></div><div class="cat-left-box-out" id="cat-left-overflow"><?php foreach ($MarkaFiltreListele as $markafiltre) {$markaSorgula = $db->prepare("select * from urun_marka where id=:id and durum=:durum");$markaSorgula->execute(array('id' => $markafiltre['marka'], 'durum' => '1'));$markaRow = $markaSorgula->fetch(PDO::FETCH_ASSOC); ?><?php if($markaSorgula->rowCount()>'0'  ) {/* Markalar Parseli */$MarkaParselMain  = $parseParts['query'];$oldMARKAParselMain   = '&marka[]='.$markaRow['id'].'';$newMARKAParselMain   = '';$MarkaParselMain = str_replace($oldMARKAParselMain, $newMARKAParselMain, $MarkaParselMain);/*  <========SON=========>>> Markalar Parseli SON */ ?><div class="cat-left-box-t"><div class="custom-control custom-checkbox"><?php if(isset($_GET['marka'])) {?><input type="checkbox" class="custom-control-input" id="a<?=$markaRow['id']?>" onclick="javascript:window.location='<?=$browser_link?><?php if(!isset($_GET['s'])) { ?>?s=<?=$islemayar['siralama_secim']?><?php }else{?>?<?php } ?><?=$MarkaParselMain?>&marka[]=<?=$markaRow['id']?>'" ><?php foreach ($_GET['marka'] as $mar1) {?><?php if($mar1 == $markaRow['id']  ) {?><input type="checkbox" checked  class="custom-control-input" id="b<?=$markaRow['id']?>" onclick="javascript:window.location='<?=$browser_link?><?php if(!isset($_GET['s'])) { ?>?s=1<?php }else{?>?<?php } ?><?=$MarkaParselMain?>'" ><?php }?><?php }?><label class="custom-control-label" <?php foreach ($_GET['marka'] as $mar2) {?> <?php if($mar2 == $markaRow['id']  ) {?>for="b<?=$markaRow['id']?>"<?php }}?> for="a<?=$markaRow['id']?>" ><?=$markaRow['baslik']?></label><?php }else { ?><input type="checkbox"  class="custom-control-input" id="a<?=$markaRow['id']?>" onclick="javascript:window.location='<?=$browser_link?><?php if(!isset($_GET['s'])) { ?>?s=<?=$islemayar['siralama_secim']?><?php }else{?>?<?php } ?><?=$MarkaParselMain?>&marka[]=<?=$markaRow['id']?>'" ><label class="custom-control-label" for="a<?=$markaRow['id']?>"><?=$markaRow['baslik']?></label><?php }?></div></div><?php }?><?php }?></div></div><?php }?><!--  <========SON=========>>> Kategorinin Marka Filtresi SON !--><?php }?> <?php if($katMain['ozellik_filtre'] == '1' ) {?><?php if($ozellikFiltreListele->rowCount()>'0'  ) {?><?php foreach ($ozellikFiltreListele as $ozellikGrup) {$ozellikCek = $db->prepare("select * from filtre_ozellik where kat_id like '%$katMain[id]%' and filtre='1' and kontrol=:kontrol group by baslik order by sira asc");$ozellikCek->execute(array('kontrol' => $ozellikGrup['kontrol'])); ?><?php if($ozellikCek->rowCount()>'0'  ) {?><!-- Kategorinin Özellik Filtresi !--><div class="cat-left-box-main"><div class="cat-left-box-h"><?=$ozellikGrup['baslik']?><div style="width: 30px; height: 3px; background-color: #<?= $islemayar['sol_nav_ayirac'] ?>; margin-top: 7px;  "></div></div><div class="cat-left-box-out" id="cat-left-overflow"><?php foreach ($ozellikCek as $ozellikm) {/* Özellik Filtreleri Parseli */$ozellikFiltreParsel  = $parseParts['query'];$oldOZELLIKParselMain   = '&oz[]='.$ozellikm['ozellik_id'].'';$newOZELLIKParselMain   = '';$ozellikFiltreParsel = str_replace($oldOZELLIKParselMain, $newOZELLIKParselMain, $ozellikFiltreParsel);/*  <========SON=========>>> Özellik Filtreleri Parseli SON */ ?><div class="cat-left-box-t"><div class="custom-control custom-checkbox"><?php if(isset($_GET['oz'])) {?><input type="checkbox" class="custom-control-input" id="oz_a_<?=$ozellikm['ozellik_id']?>" onclick="javascript:window.location='<?=$browser_link?><?php if(!isset($_GET['s'])) { ?>?s=<?=$islemayar['siralama_secim']?><?php }else{?>?<?php } ?><?=$ozellikFiltreParsel?>&oz[]=<?=$ozellikm['ozellik_id']?>'" ><?php foreach ($_GET['oz'] as $oze1) {?><?php if($oze1 == $ozellikm['ozellik_id']  ) {?><input type="checkbox" checked  class="custom-control-input" id="oz_b_<?=$ozellikm['ozellik_id']?>" onclick="javascript:window.location='<?=$browser_link?><?php if(!isset($_GET['s'])) { ?>?s=1<?php }else{?>?<?php } ?><?=$ozellikFiltreParsel?>'" ><?php }?><?php }?><label class="custom-control-label" <?php foreach ($_GET['oz'] as $oze2) {?> <?php if($oze2 == $ozellikm['ozellik_id']  ) {?>for="oz_b_<?=$ozellikm['ozellik_id']?>"<?php }}?> for="oz_a_<?=$ozellikm['ozellik_id']?>" ><?=$ozellikm['kisa_baslik']?></label><?php }else { ?><input type="checkbox"  class="custom-control-input" id="oz_a_<?=$ozellikm['ozellik_id']?>" onclick="javascript:window.location='<?=$browser_link?><?php if(!isset($_GET['s'])) { ?>?s=<?=$islemayar['siralama_secim']?><?php }else{?>?<?php } ?><?=$ozellikFiltreParsel?>&oz[]=<?=$ozellikm['ozellik_id']?>'" ><label class="custom-control-label" for="oz_a_<?=$ozellikm['ozellik_id']?>"><?=$ozellikm['kisa_baslik']?></label><?php }?></div></div><?php }?></div></div><!--  <========SON=========>>> Kategorinin Özellik Filtresi SON !--><?php }?><?php }?><?php } ?><?php }?></div></div></div></div></div><script> $(function () {$('#subcatAccordion').on('shown.bs.collapse', function (e) {$('html,body').animate({scrollTop: $('#subcatAccordion').offset().top - 80 }, 500);});$('#filterAccordion').on('shown.bs.collapse', function (e) {$('html,body').animate({scrollTop: $('#filterAccordion').offset().top - 80 }, 500);});});</script><!--  <========SON=========>>> Mobile Nav Bar SON !--><?php }else { ?> <div class="detail-none"> <div class="cat-left-main "><?php $altKatVarmi = $db->prepare("select * from urun_cat where dil=:dil and durum=:durum and ust_id=:ust_id order by sira asc ");$altKatVarmi->execute(array('dil' => $_SESSION['dil'], 'durum' => '1', 'ust_id' => $katMain['id'])); ?> <?php if($altKatVarmi->rowCount()>'0'  ) {?><div class="cat-left-box-main "><div class="cat-left-box-h"><?=$diller['kategori-detay-text19']?><div style="width: 30px; height: 3px; background-color: #<?= $islemayar['sol_nav_ayirac'] ?>; margin-top: 7px;  "></div></div><?php foreach ($altKatVarmi as $altkategori) {$altKatVarmi2 = $db->prepare("select * from urun_cat where dil=:dil and durum=:durum and ust_id=:ust_id order by sira asc ");$altKatVarmi2->execute(array('dil' => $_SESSION['dil'], 'durum' => '1', 'ust_id' => $altkategori['id'])); ?><div class="category-sub-design-box"><li><a href="<?=$altkategori['seo_url']?>/"><?php if($altkategori['icon'] == !null ) {?><i class="<?=$altkategori['icon']?>"></i><?php }?> <?=$altkategori['baslik']?> <?php if($altKatVarmi2->rowCount()>'0'  ) {?><div class="category-sub-design-box-arrow"><i class="fa fa-angle-right"></i></div><?php }?></a><?php if($altKatVarmi2->rowCount()>'0'  ) {?><div class="megadrop"><div class="cat-left-box-h"><?=$altkategori['baslik']?><div style="width: 30px; height: 3px; background-color: #<?= $islemayar['sol_nav_ayirac'] ?>; margin-top: 7px;  "></div></div><?php foreach ($altKatVarmi2 as $altkategori2) {?><a class="megadrop-cat-box" href="<?=$altkategori2['seo_url']?>/"><?=$altkategori2['baslik']?></a><?php }?></div><?php }?></li></div><?php }?></div><?php }?> <?php if ($islemayar['filtre_bedavakargo'] == '1' || $islemayar['filtre_yeniler'] == '1' || $islemayar['filtre_firsatlar'] == '1' || $islemayar['filtre_indirimler'] == '1' || $islemayar['filtre_taksitler'] == '1' || $islemayar['filtre_hizlikargo'] == '1') { ?><div class="cat-left-box-main"><div class="cat-left-box-h"><?=$diller['kategori-detay-text1']?><div style="width: 30px; height: 3px; background-color: #<?= $islemayar['sol_nav_ayirac'] ?>; margin-top: 7px;  "></div></div><div class="cat-left-box-out-first" id="cat-left-overflow"><?php if ($islemayar['filtre_bedavakargo'] == '1') { ?><div class="cat-left-box-t"><div class="custom-control custom-checkbox"><?php if($_GET['uk'] == '1'  ) {?><input type="checkbox" class="custom-control-input" id="uk" onclick="javascript:window.location='<?=$browser_link?>?<?=$ukParselMain?>'" checked ><?php }?> <?php if($_GET['uk'] == '0' || !isset($_GET['uk'])    ) {?><input type="checkbox" class="custom-control-input" id="uk" onclick="javascript:window.location='<?=$browser_link?><?php if(!isset($_GET['s'])) { ?>?s=<?=$islemayar['siralama_secim']?><?php }else{?>?<?php } ?><?=$ukParselMain?>&uk=1'" ><?php }?><label class="custom-control-label" for="uk"><?=$diller['kategori-detay-text2']?></label></div></div><?php } ?> <?php if ($islemayar['filtre_yeniler'] == '1') { ?><div class="cat-left-box-t"><div class="custom-control custom-checkbox"><?php if($_GET['new'] == '1'  ) {?><input type="checkbox" class="custom-control-input" id="new" onclick="javascript:window.location='<?=$browser_link?>?<?=$npParselMain?>'" checked ><?php }?> <?php if($_GET['new'] == '0' || !isset($_GET['new'])    ) {?><input type="checkbox" class="custom-control-input" id="new" onclick="javascript:window.location='<?=$browser_link?><?php if(!isset($_GET['s'])) { ?>?s=<?=$islemayar['siralama_secim']?><?php }else{?>?<?php } ?><?=$npParselMain?>&new=1'" ><?php }?><label class="custom-control-label" for="new"><?=$diller['kategori-detay-text3']?></label></div></div><?php } ?> <?php if ($islemayar['filtre_firsatlar'] == '1') { ?><div class="cat-left-box-t"><div class="custom-control custom-checkbox"><?php if($_GET['firsat'] == '1'  ) {?><input type="checkbox" class="custom-control-input" id="firsat" onclick="javascript:window.location='<?=$browser_link?>?<?=$opParselMain?>'" checked ><?php }?> <?php if($_GET['firsat'] == '0' || !isset($_GET['op'])    ) {?><input type="checkbox" class="custom-control-input" id="firsat" onclick="javascript:window.location='<?=$browser_link?><?php if(!isset($_GET['s'])) { ?>?s=<?=$islemayar['siralama_secim']?><?php }else{?>?<?php } ?><?=$opParselMain?>&firsat=1'" ><?php }?><label class="custom-control-label" for="firsat"><?=$diller['kategori-detay-text4']?></label></div></div><?php } ?> <?php if ($islemayar['filtre_indirimler'] == '1') { ?><div class="cat-left-box-t"><div class="custom-control custom-checkbox"><?php if($_GET['indirim'] == '1'  ) {?><input type="checkbox" class="custom-control-input" id="indirim" onclick="javascript:window.location='<?=$browser_link?>?<?=$indirimParselMain?>'" checked ><?php }?> <?php if($_GET['indirim'] == '0' || !isset($_GET['indirim'])    ) {?><input type="checkbox" class="custom-control-input" id="indirim" onclick="javascript:window.location='<?=$browser_link?><?php if(!isset($_GET['s'])) { ?>?s=<?=$islemayar['siralama_secim']?><?php }else{?>?<?php } ?><?=$indirimParselMain?>&indirim=1'" ><?php }?><label class="custom-control-label" for="indirim"><?=$diller['kategori-detay-text5']?></label></div></div><?php } ?> <?php if ($islemayar['filtre_taksitler'] == '1') { ?><div class="cat-left-box-t"><div class="custom-control custom-checkbox"><?php if($_GET['taksit'] == '1'  ) {?><input type="checkbox" class="custom-control-input" id="taksit" onclick="javascript:window.location='<?=$browser_link?>?<?=$taksitParselMain?>'" checked ><?php }?> <?php if($_GET['taksit'] == '0' || !isset($_GET['taksit'])    ) {?><input type="checkbox" class="custom-control-input" id="taksit" onclick="javascript:window.location='<?=$browser_link?><?php if(!isset($_GET['s'])) { ?>?s=<?=$islemayar['siralama_secim']?><?php }else{?>?<?php } ?><?=$taksitParselMain?>&taksit=1'" ><?php }?><label class="custom-control-label" for="taksit"><?=$diller['kategori-detay-text6']?></label></div></div><?php } ?> <?php if ($islemayar['filtre_hizlikargo'] == '1') { ?><div class="cat-left-box-t"><div class="custom-control custom-checkbox"><?php if($_GET['hizlikargo'] == '1'  ) {?><input type="checkbox" class="custom-control-input" id="hizlikargo" onclick="javascript:window.location='<?=$browser_link?>?<?=$hkParselMain?>'" checked ><?php }?> <?php if($_GET['hizlikargo'] == '0' || !isset($_GET['hizlikargo'])    ) {?><input type="checkbox" class="custom-control-input" id="hizlikargo" onclick="javascript:window.location='<?=$browser_link?><?php if(!isset($_GET['s'])) { ?>?s=<?=$islemayar['siralama_secim']?><?php }else{?>?<?php } ?><?=$hkParselMain?>&hizlikargo=1'" ><?php }?><label class="custom-control-label" for="hizlikargo"><?=$diller['kategori-detay-text7']?></label></div></div><?php } ?> <?php if ($islemayar['filtre_editor'] == '1') { ?><div class="cat-left-box-t"><div class="custom-control custom-checkbox"><?php if($_GET['editor'] == '1'  ) {?><input type="checkbox" class="custom-control-input" id="editorsecimi" onclick="javascript:window.location='<?=$browser_link?>?<?=$editorParselMain?>'" checked ><?php }?> <?php if($_GET['editor'] == '0' || !isset($_GET['editor'])    ) {?><input type="checkbox" class="custom-control-input" id="editorsecimi" onclick="javascript:window.location='<?=$browser_link?><?php if(!isset($_GET['s'])) { ?>?s=<?=$islemayar['siralama_secim']?><?php }else{?>?<?php } ?><?=$editorParselMain?>&editor=1'" ><?php }?><label class="custom-control-label" for="editorsecimi"><?=$diller['kategori-detay-text38']?></label></div></div><?php } ?></div></div><?php } ?> <?php if($katMain['fiyat_filtre'] == '1' ) {?><?php if($varsayilankur['kod'] == $secilikur['kod'] ) {?><?php if($maxPrice > '0' && $minPrice >= '0'  ) {?><div class="cat-left-box-main"><div class="cat-left-box-h"><?=$diller['kategori-detay-text25']?><div style="width: 30px; height: 3px; background-color: #<?= $islemayar['sol_nav_ayirac'] ?>; margin-top: 7px;  "></div></div><div class="cat-left-box-out-first"  ><fieldset class="filter-price"><div class="price-field"><?php $minPrice1 = number_format(kurhesapla($varsayilankur['deger'],$secilikur['deger'],$minPrice ), $secilikur['para_format']);$maxPrice2 = number_format(kurhesapla($varsayilankur['deger'],$secilikur['deger'],$maxPrice ), $secilikur['para_format']); ?><input type="range" min="<?=$minPrice?>" max="<?=$maxPrice?>" value="<?=$minPrice?>" id="lower" name="min"><input  type="range" min="<?=$minPrice?>" max="<?=$maxPrice?>" value="<?=$maxPrice?>" id="upper" name="max"></div><div class="price-wrap"><input id="one" type="hidden" ><input id="two" type="hidden" ><div class="price-wrap-outputbox"><?php if($secilikur['simge_gosterim'] == '0' ) {?> <?=$secilikur['sol_simge']?><?php }?> <?php if($secilikur['simge_gosterim'] == '1' ) {?> <?=$secilikur['sag_simge']?><?php }?><span class="output"><?php echo number_format(kurhesapla($varsayilankur['deger'],$secilikur['deger'],$minPrice ), $secilikur['para_format']); ?></span><?php if($secilikur['simge_gosterim'] == '2' ) {?> <?=$secilikur['sol_simge']?><?php }?> <?php if($secilikur['simge_gosterim'] == '3' ) {?> <?=$secilikur['sag_simge']?><?php }?></div><div class="price-wrap-outputbox" style="margin-right: 0;"><?php if($secilikur['simge_gosterim'] == '0' ) {?> <?=$secilikur['sol_simge']?><?php }?> <?php if($secilikur['simge_gosterim'] == '1' ) {?> <?=$secilikur['sag_simge']?><?php }?><span class="output2"><?php echo number_format(kurhesapla($varsayilankur['deger'],$secilikur['deger'],$maxPrice ), $secilikur['para_format']); ?></span><?php if($secilikur['simge_gosterim'] == '2' ) {?> <?=$secilikur['sol_simge']?><?php }?> <?php if($secilikur['simge_gosterim'] == '3' ) {?> <?=$secilikur['sag_simge']?><?php }?></div></div><div class="price-filter-range-button"><?php if(isset($_GET['max']) && isset($_GET['min'])  ) {?><button class="<?=$islemayar['fiyat_range_button']?> button-1x" style="width: 100%;  " id="submit" onclick="javascript:window.location='<?=$browser_link?><?php if(!isset($_GET['s'])) { ?>?s=<?=$islemayar['siralama_secim']?><?php }else{?>?<?php } ?><?=$PriceFilterParselMain?>&max='+document.getElementById('upper').value+'&min='+document.getElementById('lower').value"><?=$diller['kategori-detay-text26']?></button><?php }else { ?><button class="<?=$islemayar['fiyat_range_button']?> button-1x" style="width: 100%; " id="submit" onclick="javascript:window.location='<?=$browser_link?><?php if(!isset($_GET['s'])) { ?>?s=<?=$islemayar['siralama_secim']?><?php }else{?>?<?php } ?><?=$PriceFilterParselMain?>&max='+document.getElementById('upper').value+'&min='+document.getElementById('lower').value"><?=$diller['kategori-detay-text26']?></button><?php }?></div></fieldset></div></div> <!-- Fiyat Aralığı !--><script> var lowerSlider = document.querySelector('#lower');var upperSlider = document.querySelector('#upper');document.querySelector('#two').value = upperSlider.value;document.querySelector('#one').value = lowerSlider.value;var lowerVal = parseInt(lowerSlider.value);var upperVal = parseInt(upperSlider.value);/* Lover için span ///////////////////////////////////////////*/var input  = document.querySelector("[id=\"lower\"]"), output = document.querySelector(".output");function keydownHandler() {output.innerHTML = this.value;}input.addEventListener("input", keydownHandler);/* Lover için span SON ///////////////////////////////////////////*//* upper için span ///////////////////////////////////////////*/var input2  = document.querySelector("[id=\"upper\"]"), output2 = document.querySelector(".output2");function keydownHandler2() {output2.innerHTML = this.value;}input2.addEventListener("input", keydownHandler2);/* upper için span SON ///////////////////////////////////////////*/upperSlider.oninput = function () {lowerVal = parseInt(lowerSlider.value);upperVal = parseInt(upperSlider.value);if (upperVal < lowerVal + 4) {lowerSlider.value = upperVal - 4;if (lowerVal == lowerSlider.min) {upperSlider.value = 4;}}document.querySelector('#two').value = this.value;};lowerSlider.oninput = function () {lowerVal = parseInt(lowerSlider.value);upperVal = parseInt(upperSlider.value);if (lowerVal > upperVal - 4) {upperSlider.value = lowerVal + 4;if (upperVal == upperSlider.max) {lowerSlider.value = parseInt(upperSlider.max) - 4;}}document.querySelector('#one').value = this.value;};</script><!--  <========SON=========>>> Fiyat Aralığı SON !--><?php }?><?php }?><?php }?> <?php if($katMain['marka_filtre'] == '1' ) {?><?php if($MarkaFiltreListele->rowCount()>'0'  ) {?><!-- Kategorinin Marka Filtresi !--><div class="cat-left-box-main"><div class="cat-left-box-h"><?=$diller['kategori-detay-text8']?><div style="width: 30px; height: 3px; background-color: #<?= $islemayar['sol_nav_ayirac'] ?>; margin-top: 7px;  "></div></div><div class="cat-left-box-out" id="cat-left-overflow"><?php foreach ($MarkaFiltreListele as $markafiltre) {$markaSorgula = $db->prepare("select * from urun_marka where id=:id and durum=:durum");$markaSorgula->execute(array('id' => $markafiltre['marka'], 'durum' => '1'));$markaRow = $markaSorgula->fetch(PDO::FETCH_ASSOC); ?><?php if($markaSorgula->rowCount()>'0'  ) {/* Markalar Parseli */$MarkaParselMain  = $parseParts['query'];$oldMARKAParselMain   = '&marka[]='.$markaRow['id'].'';$newMARKAParselMain   = '';$MarkaParselMain = str_replace($oldMARKAParselMain, $newMARKAParselMain, $MarkaParselMain);/*  <========SON=========>>> Markalar Parseli SON */ ?><div class="cat-left-box-t"><div class="custom-control custom-checkbox"><?php if(isset($_GET['marka'])) {?><input type="checkbox" class="custom-control-input" id="a<?=$markaRow['id']?>" onclick="javascript:window.location='<?=$browser_link?><?php if(!isset($_GET['s'])) { ?>?s=<?=$islemayar['siralama_secim']?><?php }else{?>?<?php } ?><?=$MarkaParselMain?>&marka[]=<?=$markaRow['id']?>'" ><?php foreach ($_GET['marka'] as $mar1) {?><?php if($mar1 == $markaRow['id']  ) {?><input type="checkbox" checked  class="custom-control-input" id="b<?=$markaRow['id']?>" onclick="javascript:window.location='<?=$browser_link?><?php if(!isset($_GET['s'])) { ?>?s=1<?php }else{?>?<?php } ?><?=$MarkaParselMain?>'" ><?php }?><?php }?><label class="custom-control-label" <?php foreach ($_GET['marka'] as $mar2) {?> <?php if($mar2 == $markaRow['id']  ) {?>for="b<?=$markaRow['id']?>"<?php }}?> for="a<?=$markaRow['id']?>" ><?=$markaRow['baslik']?></label><?php }else { ?><input type="checkbox"  class="custom-control-input" id="a<?=$markaRow['id']?>" onclick="javascript:window.location='<?=$browser_link?><?php if(!isset($_GET['s'])) { ?>?s=<?=$islemayar['siralama_secim']?><?php }else{?>?<?php } ?><?=$MarkaParselMain?>&marka[]=<?=$markaRow['id']?>'" ><label class="custom-control-label" for="a<?=$markaRow['id']?>"><?=$markaRow['baslik']?></label><?php }?></div></div><?php }?><?php }?></div></div><?php }?><!--  <========SON=========>>> Kategorinin Marka Filtresi SON !--><?php }?> <?php if($katMain['ozellik_filtre'] == '1' ) {?><?php if($ozellikFiltreListele->rowCount()>'0'  ) {?><?php foreach ($ozellikFiltreListele as $ozellikGrup) {$ozellikCek = $db->prepare("select * from filtre_ozellik where kat_id like '%$katMain[id]%' and filtre='1' and kontrol=:kontrol group by baslik order by sira asc");$ozellikCek->execute(array('kontrol' => $ozellikGrup['kontrol'])); ?><?php if($ozellikCek->rowCount()>'0'  ) {?><!-- Kategorinin Özellik Filtresi !--><div class="cat-left-box-main"><div class="cat-left-box-h"><?=$ozellikGrup['baslik']?><div style="width: 30px; height: 3px; background-color: #<?= $islemayar['sol_nav_ayirac'] ?>; margin-top: 7px;  "></div></div><div class="cat-left-box-out" id="cat-left-overflow"><?php foreach ($ozellikCek as $ozellikm) {/* Özellik Filtreleri Parseli */$ozellikFiltreParsel  = $parseParts['query'];$oldOZELLIKParselMain   = '&oz[]='.$ozellikm['ozellik_id'].'';$newOZELLIKParselMain   = '';$ozellikFiltreParsel = str_replace($oldOZELLIKParselMain, $newOZELLIKParselMain, $ozellikFiltreParsel);/*  <========SON=========>>> Özellik Filtreleri Parseli SON */ ?><div class="cat-left-box-t"><div class="custom-control custom-checkbox"><?php if(isset($_GET['oz'])) {?><input type="checkbox" class="custom-control-input" id="oz_a_<?=$ozellikm['ozellik_id']?>" onclick="javascript:window.location='<?=$browser_link?><?php if(!isset($_GET['s'])) { ?>?s=<?=$islemayar['siralama_secim']?><?php }else{?>?<?php } ?><?=$ozellikFiltreParsel?>&oz[]=<?=$ozellikm['ozellik_id']?>'" ><?php foreach ($_GET['oz'] as $oze1) {?><?php if($oze1 == $ozellikm['ozellik_id']  ) {?><input type="checkbox" checked  class="custom-control-input" id="oz_b_<?=$ozellikm['ozellik_id']?>" onclick="javascript:window.location='<?=$browser_link?><?php if(!isset($_GET['s'])) { ?>?s=1<?php }else{?>?<?php } ?><?=$ozellikFiltreParsel?>'" ><?php }?><?php }?><label class="custom-control-label" <?php foreach ($_GET['oz'] as $oze2) {?> <?php if($oze2 == $ozellikm['ozellik_id']  ) {?>for="oz_b_<?=$ozellikm['ozellik_id']?>"<?php }}?> for="oz_a_<?=$ozellikm['ozellik_id']?>" ><?=$ozellikm['kisa_baslik']?></label><?php }else { ?><input type="checkbox"  class="custom-control-input" id="oz_a_<?=$ozellikm['ozellik_id']?>" onclick="javascript:window.location='<?=$browser_link?><?php if(!isset($_GET['s'])) { ?>?s=<?=$islemayar['siralama_secim']?><?php }else{?>?<?php } ?><?=$ozellikFiltreParsel?>&oz[]=<?=$ozellikm['ozellik_id']?>'" ><label class="custom-control-label" for="oz_a_<?=$ozellikm['ozellik_id']?>"><?=$ozellikm['kisa_baslik']?></label><?php }?></div></div><?php }?></div></div><!--  <========SON=========>>> Kategorinin Özellik Filtresi SON !--><?php }?><?php }?><?php } ?><?php }?></div> </div> <?php }?>