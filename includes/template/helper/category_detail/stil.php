<?php Header ("Content-type: text/css; charset=utf-8");?>
<?php
ob_start();
error_reporting(0);
include "../../../config/config.php";
$islemlerAyar = $db->prepare("select * from urun_cat_ayar where id='1'");
$islemlerAyar->execute();
$islemayar = $islemlerAyar->fetch(PDO::FETCH_ASSOC);
$urunKutuAyar = $db->prepare("select * from urun_kutu where id='1'");
$urunKutuAyar->execute();
$urunKutuRow = $urunKutuAyar->fetch(PDO::FETCH_ASSOC);
?><?php if ($islemayar['sol_nav_tip'] == '0') { ?>.cat-left-main {border-right: 1px solid #<?=$islemayar['sol_nav_border']?>;padding-right: 10px;}.cat-left-box-t {border-bottom: 1px solid #<?=$islemayar['sol_nav_border']?>;}.cat-left-box-main {margin-bottom: 20px;}<?php } ?> <?php if ($islemayar['sol_nav_tip'] == '1') { ?>.cat-left-main {padding: 20px;border: 1px solid #<?=$islemayar['sol_nav_border']?>;background-color: #<?=$islemayar['sol_nav_bg']?>;}.cat-left-box-t {border-bottom: 1px solid #<?=$islemayar['sol_nav_border']?>;}.cat-left-box-main {margin-bottom: 30px;}<?php } ?> <?php if ($islemayar['sol_nav_tip'] == '2') { ?>.cat-left-box-t {border-bottom: 1px solid #<?=$islemayar['sol_nav_border']?>;}.cat-left-box-main {margin-bottom: 20px;padding: 20px;border: 1px solid #<?=$islemayar['sol_nav_border']?>;background-color: #<?=$islemayar['sol_nav_bg']?>;}<?php } ?>/* Genel */.cat-detail-main-div {font-family: '<?=$islemayar['detay_font']?>', Sans-serif;background-color: #<?=$islemayar['detay_arkaplan']?>;}.cat-left-main {color: #<?=$islemayar['sol_nav_text_color']?>;}#cat-left-overflow::-webkit-scrollbar-track {background-color: #<?=$islemayar['sol_nav_scroll_alt']?>;}#cat-left-overflow::-webkit-scrollbar {width: 7px;background-color: #fff;}#cat-left-overflow::-webkit-scrollbar-thumb {background-color: #<?=$islemayar['sol_nav_scroll']?>;}.cat-left-box-h {color: #<?=$islemayar['sol_nav_head_color']?>;}.cat-left-box-t .custom-control-label::after {border: 1px solid #<?=$islemayar['checkbox_border']?>;}.cat-left-box-t .custom-control-input:checked ~ .custom-control-label::before {background-color: #<?=$islemayar['checkbox_bg']?> !important;}.cat-right-elements {border: 1px solid #<?=$islemayar['sol_nav_border']?>;background-color: #<?=$islemayar['sol_nav_bg']?>;}/* kategori gösterim  linkleri */.cat-right-links a {color: #<?=$islemayar['cat_href_color']?>;}.cat-right-links i {color: #<?=$islemayar['cat_href_color']?>;}/* nice selct */.nice-select.open .list {width: 400px;}.nice-select .list {width: 400px;}/* Alt kategori */.category-sub-design-box {background-color: #<?=$islemayar['altkat_box_bg']?>;}.category-sub-design-box-active{background-color: #<?=$islemayar['altkat_box_bg_hover']?>;}.category-sub-design-box > li > a {padding: <?=$islemayar['altkat_padding']?>;}.category-sub-design-box a, .category-sub-design-box a:link, .category-sub-design-box a:visited, .category-sub-design-box a:focus, span {text-decoration: none;}.category-sub-design-box a{color:#<?=$islemayar['altkat_box_text']?>}.category-sub-design-box > li {border-bottom: 1px solid #<?=$islemayar['altkat_box_border']?>;}.category-sub-design-box > li:hover > a {color: #<?=$islemayar['altkat_box_text_hover']?>;}.category-sub-design-box > li:hover {background-color: #<?=$islemayar['altkat_box_bg_hover']?>;}.category-sub-design-box > li:hover > a i {color: #<?=$islemayar['altkat_box_text_hover']?>;}.category-sub-design-box > li > .megadrop {<?php if($islemayar['altkat_openbox_shadow'] == '1' ) {?>box-shadow: 0 0 8px rgba(0, 0, 0, 0.1);<?php }?>border:1px solid #<?=$islemayar['altkat_openbox_border']?>;background: #<?=$islemayar['sol_nav_bg']?>;/**/}.megadrop-cat-box{color: #<?=$islemayar['altkat_box_text']?> !important;padding: <?=$islemayar['altkat_padding']?>;background-color: #<?=$islemayar['altkat_box_bg']?>;border-bottom: 1px solid #<?=$islemayar['altkat_box_border']?>;}.megadrop-cat-box:hover{background-color: #<?=$islemayar['altkat_box_bg_hover']?>;/**/color: #<?=$islemayar['altkat_box_text_hover']?> !important;}/* Ürün Kutuları */.cat-detail-products-box {border: <?=$urunKutuRow['border_width']?> solid #<?=$urunKutuRow['kutu_border_renk']?>;background-color: #<?=$urunKutuRow['kutu_arkaplan']?>;border-radius: <?=$urunKutuRow['kutu_radius']?>;<?php if($urunKutuRow['kutu_shadow'] == '0'  ) {?> box-shadow: none !important;<?php }?>}.cat-detail-products-box-big {border: <?=$urunKutuRow['border_width']?> solid #<?=$urunKutuRow['kutu_border_renk']?>;background-color: #<?=$urunKutuRow['kutu_arkaplan']?>;border-radius: <?=$urunKutuRow['kutu_radius']?>;<?php if($urunKutuRow['kutu_shadow'] == '0'  ) {?> box-shadow: none !important;<?php }?>}.cat-detail-products-box-list {border: <?=$urunKutuRow['border_width']?> solid #<?=$urunKutuRow['kutu_border_renk']?>;background-color: #<?=$urunKutuRow['kutu_arkaplan']?>;border-radius: <?=$urunKutuRow['kutu_radius']?>;<?php if($urunKutuRow['kutu_shadow'] == '0'  ) {?> box-shadow: none !important;<?php }?>}.cat-detail-products-box-stars .aktif-span {color: #<?=$urunKutuRow['star_color']?>;}.cat-detail-products-box-stars .pasif-span {color: #<?=$urunKutuRow['star_pasif_color']?>;}.cat-detail-products-box-kargo {background-color: #<?=$urunKutuRow['kutu_arkaplan']?>;color: #<?=$urunKutuRow['kutu_kargo_renk']?>;}.cat-detail-products-box-cart-2 {border-top: 1px solid #<?=$urunKutuRow['kutu_border_renk']?>;}.tooltip {font-size: 12px;}.cat-detail-products-box-img-list {border: 1px solid #<?=$urunKutuRow['kutu_border_renk']?>;}.urun-box-special-area{border: 1px dashed #<?=$urunKutuRow['kutu_arkaplan']?>;background-color: #<?=$urunKutuRow['kutu_ozelfiyat_bg']?>;color: #<?=$urunKutuRow['kutu_ozelfiyat_text']?>;}.urun-box-special-area-list{border: 1px dashed #<?=$urunKutuRow['kutu_arkaplan']?>;background-color: #<?=$urunKutuRow['kutu_ozelfiyat_bg']?>;color: #<?=$urunKutuRow['kutu_ozelfiyat_text']?>;}/* Fiyat Range Style /////////////////////*/.price-wrap .price-wrap-outputbox{border: 1px solid #<?=$islemayar['fiyat_range_price_border']?>;background-color: #<?=$islemayar['fiyat_range_price_bg']?>;}.output,.output2,.price-wrap-outputbox{color: #<?=$islemayar['fiyat_range_price_text']?>;}.price-field input[type=range] {background-color: #<?=$islemayar['fiyat_range_bg']?>;}.price-field input[type=range]::-webkit-slider-thumb {background-color: #<?=$islemayar['fiyat_range_ball']?>;}
