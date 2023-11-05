<?php
$currentURL = $ayar['panel_url'].'pages.php?'.$_SERVER['QUERY_STRING'];
$_SESSION['current_url'] = $currentURL;
$currentMenu = 'categories';
$altKatSorug = $db->prepare("select * from urun_cat where id=:id and dil=:dil ");
$altKatSorug->execute(array(
        'id' => trim(strip_tags($_GET['parent'])),
        'dil' => $_SESSION['dil'],
));
$ustkatRow = $altKatSorug->fetch(PDO::FETCH_ASSOC);
if($altKatSorug->rowCount()<='0'  ) {
    header('Location:'.$ayar['panel_url'].'pages.php?page=categories');
    exit();
}
$ustID = $_GET['parent'];

$pazarYeri = $db->prepare("select * from pazaryeri where id='1' ");
$pazarYeri->execute();
$pazar = $pazarYeri->fetch(PDO::FETCH_ASSOC);

if($ustkatRow['ust_id'] != '0' ) {
    $asilUstKat = $db->prepare("select * from urun_cat where id=:id ");
    $asilUstKat->execute(array(
        'id' => $ustkatRow['ust_id'],
 ));
 $asilRow = $asilUstKat->fetch(PDO::FETCH_ASSOC);
}
/*  <========SON=========>>> Alt üst kategori hesabu SON */

if(isset($_GET['search'])  ) {
    if(strip_tags(htmlspecialchars($_GET['search'])) <= '0'  ) {
        header('Location:'.$ayar['panel_url'].'pages.php?page=sub_categories&parent='.$_GET['parent'].'');
        exit();
    }
}

if(isset($_GET['search'])  ) {
    if($_GET['search'] == null  ) {
        header('Location:'.$ayar['panel_url'].'pages.php?page=sub_categories&parent='.$_GET['parent'].'');
        exit();
    }
}

if (isset($_GET['search']) && $_GET['search'] == !null) {
    $searchPage = "&search=$_GET[search]";
}

if(isset($_GET['p']) && $_GET['p'] == !null ) {
    $pageGet = '&p='.$_GET['p'].'';
}else{
    $pageGet = null;
}



if($_POST) {
    if ($yetki['demo'] != '1') {
        $position = $_POST['position'];
        $count = 1;
        foreach ($position as $idler) {
            $idler2 = htmlspecialchars(trim($idler));
            try {

                $query = $db->query("UPDATE urun_cat SET sira = '$count' WHERE id = '$idler2'");
            } catch (PDOException $ex) {
                echo "Hata İşlem Yapılamadı!";
                some_logging_function($ex->getMessage());
            }
            $count++;
        }
    }
}


if(isset($_GET['status_update'])  ) {
if ($yetki['demo'] != '1') {
    if ($_GET['status_update'] == !null) {

        $statusCek = $db->prepare("select * from urun_cat where id=:id ");
        $statusCek->execute(array(
            'id' => trim(strip_tags($_GET['status_update']))
        ));

        $stUp = trim(strip_tags($_GET['status_update']));
        if ($statusCek->rowCount() > '0') {
            $st = $statusCek->fetch(PDO::FETCH_ASSOC);


            if ($st['durum'] == '1') {
                $statusum = '0';
            }
            if ($st['durum'] == '0') {
                $statusum = '1';
            }

            $guncelle = $db->prepare("UPDATE urun_cat SET
                 durum=:durum
          WHERE id={$stUp}      
         ");
            $sonuc = $guncelle->execute(array(
                'durum' => $statusum
            ));
            if ($sonuc) {
                header('Location:' . $ayar['panel_url'] . 'pages.php?page=sub_categories&parent='.$_GET['parent'].'' . $searchPage . ''.$pageGet.'');
            } else {
                echo 'Veritabanı Hatası';
            }

        } else {
            header('Location:' . $ayar['panel_url'] . 'pages.php?page=sub_categories&parent='.$_GET['parent'].'');
        }

    } else {
        header('Location:' . $ayar['panel_url'] . 'pages.php?page=sub_categories&parent='.$_GET['parent'].'');
    }
}
}


if($ustkatRow['ust_id'] >'0' ) {
    $ustKatSorgu = $db->prepare("select * from urun_cat where dil=:dil and durum=:durum and id=:id ");
    $ustKatSorgu->execute(array(
        'dil' => $_SESSION['dil'],
        'durum' => '1',
        'id' => $ustkatRow['ust_id']
    ));
    $ustKatSorguSayi = $ustKatSorgu->rowCount();
    $ustKat = $ustKatSorgu->fetch(PDO::FETCH_ASSOC);


    /* Sonraki Üst Kategori */
    if($ustKat['ust_id'] > '0'  ) {
        $ustKatSorgu2 = $db->prepare("select * from urun_cat where dil=:dil and durum=:durum and id=:id ");
        $ustKatSorgu2->execute(array(
            'dil' => $_SESSION['dil'],
            'durum' => '1',
            'id' => $ustKat['ust_id']
        ));
        $ustKatSorguSayi2 = $ustKatSorgu2->rowCount();
        $ustKat2 = $ustKatSorgu2->fetch(PDO::FETCH_ASSOC);
        /* Sonraki Üst Kategori */
        if($ustKat2['ust_id'] > '0'  ) {
            $ustKatSorgu3 = $db->prepare("select * from urun_cat where dil=:dil and durum=:durum and id=:id ");
            $ustKatSorgu3->execute(array(
                'dil' => $_SESSION['dil'],
                'durum' => '1',
                'id' => $ustKat2['ust_id']
            ));
            $ustKatSorguSayi3 = $ustKatSorgu3->rowCount();
            $ustKat3 = $ustKatSorgu3->fetch(PDO::FETCH_ASSOC);
        }
        /*  <========SON=========>>> Sonraki Üst Kategori SON */
    }
    /*  <========SON=========>>> Sonraki Üst Kategori SON */
}
?>
<title><?=$diller['adminpanel-menu-text-4']?> - <?=$panelayar['baslik']?></title>
<style>
    .nav-link{
        color: #000;
        transition-duration: 0.1s; transition-timing-function: linear;
        font-weight: 500;
        font-size: 14px;
        padding: 15px 25px;

    }
    .nav-tabs li:first-child{
        margin-left: 10px;
    }
    .saas:hover{
        background-color: #fff;
        color: #000;
    }
    @media (max-width: 768px) {
        .nav-link{
            color: #000;
            transition-duration: 0.1s; transition-timing-function: linear;
            font-weight: 500;
            font-size: 14px;
            padding: 10px;
        }
        .nav-tabs{
            padding: 15px;
        }
        .nav-tabs li:first-child{
            margin-left: 0;
        }
        .nav-link.active{
            border-color: #dee2e6 #dee2e6 #dee2e6 !important;
            border-radius: 6px !important;
        }
    }
    .ssa:before{
        display: none;
    }
</style>
<div class="wrapper" style="margin-top: 0;">
    <div class="container-fluid">


        <!-- Page-Title -->
        <div class="row mb-3">
            <div class="col-md-12 ">
                <div class="page-title-box bg-white card mb-0 pl-3" >
                    <div class="row align-items-center" >
                        <div class="col-md-8" >
                            <div class="page-title-nav">
                                <a href="<?=$ayar['panel_url']?>"><i class="ion ion-md-home"></i> <?=$diller['adminpanel-text-341']?></a>
                                <a href="javascript:Void(0)"><i class="fa fa-angle-right"></i><?=$diller['adminpanel-menu-text-2']?></a>
                                <a href="pages.php?page=categories"><i class="fa fa-angle-right"></i><?=$diller['adminpanel-menu-text-4']?></a>
                                <?php if($ustkatRow['ust_id'] == '0' ) {?>
                                    <a href="javascript:Void(0)"><i class="fa fa-angle-right"></i>  <?=$ustkatRow['baslik']?></a>
                                <?php }else { ?>
                                    <?php if($ustkatRow['ust_id'] > '0' ) {?>
                                        <?php if($ustKatSorguSayi >'0') {?>
                                            <?php if($ustKatSorguSayi2 >'0') {?>
                                                <?php if($ustKatSorguSayi3 >'0') {?>
                                                    <a href="pages.php?page=sub_categories&parent=<?=$ustKat3['id']?>"><i class="fa fa-angle-right"></i>  <?=$ustKat3['baslik']?></a>
                                                <?php }?>
                                                <a href="pages.php?page=sub_categories&parent=<?=$ustKat2['id']?>"><i class="fa fa-angle-right"></i>  <?=$ustKat2['baslik']?></a>
                                            <?php }?>
                                            <a href="pages.php?page=sub_categories&parent=<?=$ustKat['id']?>"><i class="fa fa-angle-right"></i>  <?=$ustKat['baslik']?></a>
                                        <?php }?>
                                        <a href="pages.php?page=sub_categories&parent=<?=$ustkatRow['id']?>"><i class="fa fa-angle-right"></i>  <?=$ustkatRow['baslik']?></a>
                                    <?php }?>

                                <?php }?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title end breadcrumb -->


        <?php if($yetki['katalog'] == '1' && $yetki['kat'] == '1') {

            if(isset($_GET['search']) && $_GET['search']== !null  ) {
                $serc = trim(strip_tags(htmlspecialchars($_GET['search'])));
             $search = " (baslik like '%$serc%' or baslik_seo like '%$serc%' or spot like '%$serc%' or seo_url like '%$serc%') and ";
            }else{
                $search = null;
            }


            $Sayfa = @intval($_GET['p']); if(!$Sayfa) $Sayfa = 1;
            $Say = $db->query("select * from urun_cat where $search dil='$_SESSION[dil]' and ust_id='$ustID'  ");
            $ToplamVeri = $Say->rowCount();
            $Limit = 30;
            $Sayfa_Sayisi = ceil($ToplamVeri/$Limit); if($Sayfa > $Sayfa_Sayisi){$Sayfa = 1;}
            $Goster = $Sayfa * $Limit - $Limit;
            $GorunenSayfa = 5;
            $islemListele = $db->query("select * from urun_cat where $search dil='$_SESSION[dil]' and ust_id='$ustID'  order by sira ASC limit $Goster,$Limit");
            $categoriList = $islemListele->fetchAll(PDO::FETCH_ASSOC);

            ?>


            <div class="row">

                <?php include 'inc/modules/_helper/catalog_leftbar.php'; ?>

                <!-- Contents !-->
                <div class="col-md-12">
                    <div class="card p-3">
                        <div class="new-buttonu-main-top">
                            <div class="new-buttonu-main-left">
                                <?php if($ustkatRow['ust_id'] == '0' ) {?>
                                    <a href="pages.php?page=categories" class="btn btn-outline-dark btn-sm mb-2 d-inline-block"><i class="fas fa-arrow-left"></i> <?=$diller['adminpanel-text-164']?></a>
                                    <h5> <?=$ustkatRow['baslik']?> (<?=$diller['adminpanel-form-text-1868']?>)</h5>
                                <?php }else { ?>
                                    <a href="pages.php?page=sub_categories&parent=<?=$asilRow['id']?>" class="btn btn-outline-dark btn-sm mb-2 d-inline-block"><i class="fas fa-arrow-left"></i> <?=$diller['adminpanel-text-164']?></a>
                                    <h6>
                                        <?=$asilRow['baslik']?> <i class="fa fa-caret-right"></i>
                                        <?=$ustkatRow['baslik']?>
                                    </h6>
                                <?php }?>
                                <div>
                                    <?=$diller['adminpanel-form-text-1124']?> : <?=$ToplamVeri?>
                                </div>
                            </div>
                            <div class="new-buttonu-main">
                                <div class="new-buttonu-main">
                                    <a  class="btn btn-success text-white "  data-toggle="collapse" data-target="#genelAcc" aria-expanded="false" aria-controls="collapseForm"><i class="fas fa-plus-circle "></i> <?=$diller['adminpanel-form-text-1856']?></a>
                                </div>
                            </div>
                        </div>
                        <div id="accordion" class="accordion">
                            <div class="collapse" id="genelAcc" data-parent="#accordion">
                                <form action="post.php?process=catalog_post2&status=sub_category_add" method="post" class="border mb-5 " enctype="multipart/form-data">
                                    <input type="hidden" name="parent_id" value="<?=$ustkatRow['id']?>">
                                    <div class="text-center bg-white text-dark border-bottom ">
                                        <h5 style="margin-top: 0; padding-top: 10px;"> <?=$diller['adminpanel-form-text-1856']?></h5>
                                    </div>
                                    <div class=" border-bottom  ">
                                        <div class="form-group col-auto mb-3 pt-3 ">
                                            <a class=" p-2 border d-inline-block bg-white rounded pl-3 pr-3  ">
                                                <div class="d-flex align-items-center justify-content-start">
                                                    <div class="mr-2 flag-icon-<?=$mevcutdil['flag']?>" style="width:18px; height:13px; display: inline-block; vertical-align: middle"></div>
                                                    <?=$mevcutdil['baslik']?> <?=$diller['adminpanel-form-text-259']?>
                                                    <i class="ti-help-alt text-danger ml-2 " style="cursor: pointer" data-container="body" data-toggle="popover" data-placement="right" data-content="<?=$diller['adminpanel-form-text-722']?>"></i>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <!-- Tab Alanı !-->
                                    <ul class="nav nav-tabs bg-light pt-2" id="myTab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link saas active" id="one-tab" data-toggle="tab" href="#one" role="tab"  aria-selected="true">
                                                <?=$diller['adminpanel-form-text-981']?>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link saas" id="two-tab" data-toggle="tab" href="#two" role="tab"  aria-selected="true">
                                                <?=$diller['adminpanel-text-311']?>
                                            </a>
                                        </li>
                                    </ul>

                                    <div class="tab-content bg-white rounded-bottom">
                                        <div class="tab-pane active p-5" id="one" role="tabpanel" >
                                            <div class="row alert-warning border border-warning p-2 text-dark ">
                                                <div class="col-md-12" style="font-weight: 500; font-size: 15px ;">
                                                    <strong><?=$ustkatRow['baslik']?></strong> <?=$diller['adminpanel-form-text-1867']?>
                                                </div>
                                            </div>
                                            <div class="row border mb-3">
                                                <div class="form-group col-md-6 mt-2 mb-3">
                                                    <label  for="durum" class="w-100" ><?=$diller['adminpanel-form-text-843']?></label>
                                                    <div class="custom-control custom-switch custom-switch-lg">
                                                        <input type="hidden" name="durum" value="0">
                                                        <input type="checkbox" class="custom-control-input" id="durum" name="durum" value="1"  checked >
                                                        <label class="custom-control-label" for="durum"></label>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-6 mt-2  mb-3">
                                                    <label  for="anasayfa" class="w-100" ><?=$diller['adminpanel-text-376']?></label>
                                                    <div class="custom-control custom-switch custom-switch-lg">
                                                        <input type="hidden" name="anasayfa" value="0"">
                                                        <input type="checkbox" class="custom-control-input" id="anasayfa" name="anasayfa" value="1"  checked  >
                                                        <label class="custom-control-label" for="anasayfa"></label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row border-bottom mb-3">
                                                <div class="form-group col-md-4 mb-3">
                                                    <div class="kustom-checkbox">
                                                        <input type="hidden" name="ozellik_filtre" value="0">
                                                        <input type="checkbox" class="individual" id="marka_filtre" name='marka_filtre' value="1" checked>
                                                        <label for="marka_filtre"  class="d-flex align-items-center justify-content-start" style="font-weight: 200;font-size: 14px ; ">
                                                            <?=$diller['adminpanel-form-text-1850']?>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-4 mb-3">
                                                    <div class="kustom-checkbox">
                                                        <input type="hidden" name="ozellik_filtre" value="0">
                                                        <input type="checkbox" class="individual" id="ozellik_filtre" name='ozellik_filtre' value="1" checked>
                                                        <label for="ozellik_filtre"  class="d-flex align-items-center justify-content-start" style="font-weight: 200;font-size: 14px ; ">
                                                            <?=$diller['adminpanel-form-text-1851']?>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-4 mb-3">
                                                    <div class="kustom-checkbox">
                                                        <input type="hidden" name="fiyat_filtre" value="0">
                                                        <input type="checkbox" class="individual" id="fiyat_filtre" name='fiyat_filtre' value="1" checked>
                                                        <label for="fiyat_filtre"  class="d-flex align-items-center justify-content-start" style="font-weight: 200;font-size: 14px ; ">
                                                            <?=$diller['adminpanel-form-text-1852']?>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-2">
                                                    <label for="sira">* <?=$diller['adminpanel-form-text-55']?></label>
                                                    <input type="number" autocomplete="off"  name="sira" id="sira" required class="form-control">
                                                </div>
                                                <div class="form-group col-md-7">
                                                    <label for="baslik">* <?=$diller['adminpanel-form-text-1848']?></label>
                                                    <input type="text" autocomplete="off"  name="baslik" id="baslik" required class="form-control">
                                                </div>
                                                <div class="form-group col-md-12 mb-0">
                                                    <label for="spot"><?=$diller['adminpanel-form-text-1849']?></label>
                                                    <textarea name="spot" id="spot" class="form-control" rows="2" ></textarea>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="tab-pane fade p-5" id="two" role="tabpanel" >
                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <label for="seo_url" class="w-100 d-flex align-items-center justify-content-between"><?=$diller['adminpanel-form-text-1012']?> <i class="ti-help-alt text-primary float-right" data-toggle="tooltip" data-placement="top" title="<?=$diller['adminpanel-form-text-1014']?>"></i></label>
                                                    <input type="text" autocomplete="off"  name="seo_url" id="seo_url" placeholder="<?=$diller['adminpanel-form-text-1013']?>"  class="form-control">
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label for="seo_baslik" class="w-100 d-flex align-items-center justify-content-between"><?=$diller['adminpanel-form-text-1015']?> <i class="ti-help-alt text-primary float-right" data-toggle="tooltip" data-placement="top" title="<?=$diller['adminpanel-form-text-1016']?>"></i></label>
                                                    <input type="text" autocomplete="off"  name="seo_baslik" id="seo_baslik"  class="form-control">
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label  for="tags2" class="w-100"><?=$diller['adminpanel-form-text-6']?> </label>
                                                    <input type="text" name="tags"  id="tags2" data-role="tagsinput" placeholder="<?=$diller['adminpanel-form-text-7']?>" class="form-control" />
                                                </div>
                                                <div class="form-group col-md-12 mb-0">
                                                    <label  for="meta_desc" class="w-100"><?=$diller['adminpanel-form-text-5']?> </label>
                                                    <textarea name="meta_desc" id="meta_desc" class="form-control" rows="2" ></textarea>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <!--  <========SON=========>>> Tab Alanı SON !-->
                                    <div class=" border-top pt-3 bg-light pb-3">
                                        <div class="col-md-12 text-right">
                                            <button class="btn  btn-success " name="subcatAdd"><?=$diller['adminpanel-form-text-53']?></button>
                                            <a class="btn  btn-secondary text-white" data-toggle="collapse" data-target="#genelAcc" aria-expanded="false" aria-controls="collapseForm"><?=$diller['adminpanel-modal-text-17']?></a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- Search Form !-->
                        <div class="w-100 pt-2 pb-2  bg-white  mb-2 ">
                            <div class="row ">
                                <div class="col-md-7 ">
                                    <?php if(isset($_GET['search'])  && $_GET['search']==!null ) {?>
                                        <h6><?=$diller['adminpanel-text-161']?> : <?=$ToplamVeri?></h6>
                                        <a href="pages.php?page=sub_categories&parent=<?=$_GET['parent']?>" class="btn btn-sm btn-info shadow"><?=$_GET['search']?> <i class="fa fa-times"></i></a>
                                    <?php }?>
                                </div>
                                <div class="col-md-5 text-right">
                                    <form method="GET" action="pages.php">
                                        <div class="input-group ">
                                            <input type="hidden" name="page" value="sub_categories" id="" required class="form-control">
                                            <input type="hidden" name="parent" value="<?=$_GET['parent']?>" id="" required class="form-control">
                                            <input type="text" name="search" class="form-control" placeholder="<?=$diller['adminpanel-text-154']?>"  aria-describedby="button-addon2" required autocomplete="off">
                                            <div class="input-group-append">
                                                <button class="btn btn-dark rounded-0" type="submit" id="button-addon2"><i class="fa fa-search"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!--  <========SON=========>>> Search Form SON !-->
                        <div class="w-100">
                            <div class="w-100 p-2 bg-light mb-2 font-12">
                                <i class="fa fa-info-circle mr-1"></i> <?=$diller['adminpanel-text-171']?>
                            </div>
                            <div class="w-100  mb-2 ">
                                <form method="post" action="post.php?process=catalog_post2&status=subcategories_multidelete">
                                    <input type="hidden" name="parent" value="<?=$_GET['parent']?>">
                                <div class="table-responsive ">
                                    <table class="table table-hover mb-0 table-bordered  ">
                                        <thead class="thead-default">
                                        <tr>
                                            <th width="40" class="text-center">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" data-id="chec" class="custom-control-input selectall"  id="hepsiniSecCheckBox"   >
                                                    <label class="custom-control-label" for="hepsiniSecCheckBox"></label>
                                                </div>
                                            </th>
                                            <th></th>
                                            <th><?=$diller['adminpanel-form-text-1848']?></th>
                                            <?php if($ustKatSorguSayi3 < '0'  ) {?>
                                                <th></th>
                                            <?php }?>
                                            <?php if($pazar['n11_durum'] == '1'   || $pazar['ty_durum'] == '1' || $pazar['hb_durum'] == '1'  ) {?>
                                            <th><?=$diller['adminpanel-menu-text-86']?></th>
                                            <?php } ?>
                                            <th class="text-center"><?=$diller['adminpanel-form-text-1847']?></th>
                                            <th><?=$diller['adminpanel-form-text-62']?></th>
                                            <th  class="text-center" width="100"><?=$diller['adminpanel-text-157']?></th>
                                        </tr>
                                        </thead>
                                        <tbody  class="row_position">
                                        <?php foreach ($categoriList as $catRow) {

                                            $altmenuSayisi = $db->prepare("select id from urun_cat where ust_id=:ust_id ");
                                            $altmenuSayisi->execute(array(
                                                'ust_id' => $catRow['id'],
                                            ));

                                            ?>
                                            <tr id="<?php echo $catRow['id'] ?>" style="cursor: move">
                                                <td class="text-center">
                                                    <div class="custom-control custom-checkbox" >
                                                        <input type="checkbox" data-id="chec" class="custom-control-input individual"   id="checkSec-<?=$catRow['id']?>" name='sil[]' value="<?=$catRow['id']?>" >
                                                        <label class="custom-control-label" for="checkSec-<?=$catRow['id']?>" ></label>
                                                    </div>
                                                </td>
                                                <td style="min-width: 90px" width="90">
                                                    <a target="_blank" href="pages.php?page=products&limit=30&catID=<?=$catRow['id']?>&search=&stokCode=&barcode=&productStatus=&feature=&sort=1&date=&date_end=&min=&max=" class="btn btn-sm btn-light rounded d-flex align-items-center justify-content-center" style="font-size: 11px ;">
                                                        <?=$diller['adminpanel-form-text-1872']?>
                                                    </a>
                                                </td>
                                                <td style="font-weight: 500; min-width: 150px">
                                                    <a  target="_blank" href="<?=$ayar['site_url']?><?=$catRow['seo_url']?>/" data-toggle="tooltip" data-placement="top" title="<?=$diller['adminpanel-form-text-1690']?>"><i class="fa fa-external-link-alt"></i></a>
                                                    <?=$catRow['baslik']?>
                                                </td>
                                                <?php if($ustKatSorguSayi3 < '0'  ) {?>
                                                <td style="min-width: 165px" width="165">
                                                    <a href="pages.php?page=sub_categories&parent=<?=$catRow['id']?>" class="btn btn-sm btn-primary rounded d-flex align-items-center justify-content-center">
                                                        <?=$diller['adminpanel-form-text-1838']?> (<?=$altmenuSayisi->rowCount()?>)
                                                    </a>
                                                </td>
                                                <?php } ?>
                                                <?php if($pazar['n11_durum'] == '1'  || $pazar['ty_durum'] == '1' || $pazar['hb_durum'] == '1' ) {?>
                                                    <td width="50" class="text-center">
                                                        <?php if($catRow['n11_kat_id'] != '0' ) {?>
                                                            <a href="pages.php?page=n11_sync&catID=<?=$catRow['id']?>">
                                                                <img src="assets/images/n11_ok.png" alt="">
                                                            </a>
                                                        <?php }else { ?>
                                                            <a href="pages.php?page=n11_sync&catID=<?=$catRow['id']?>">
                                                                <img src="assets/images/n11.png" alt="">
                                                            </a>
                                                        <?php }?>

                                                        <!-- trendyol !-->
                                                        <?php if($catRow['ty_kat'] >'0' ) {?>
                                                            <a href="pages.php?page=ty_sync&catID=<?=$catRow['id']?>">
                                                                <img src="assets/images/ty_ok.png" alt="">
                                                            </a>
                                                        <?php }else { ?>
                                                            <a href="pages.php?page=ty_sync&catID=<?=$catRow['id']?>">
                                                                <img src="assets/images/ty.png" alt="">
                                                            </a>
                                                        <?php }?>
                                                        <!--  <========SON=========>>> trendyol SON !-->



                                                        <!-- Hepsiburada !-->
                                                        <?php if($catRow['hb_sync'] >'0' ) {?>
                                                            <a href="pages.php?page=hb_sync&catID=<?=$catRow['id']?>">
                                                                <img src="assets/images/hb_ok.png" alt="">
                                                            </a>
                                                        <?php }else { ?>
                                                            <a href="pages.php?page=hb_sync&catID=<?=$catRow['id']?>">
                                                                <img src="assets/images/hb.png" alt="">
                                                            </a>
                                                        <?php }?>
                                                        <!--  <========SON=========>>> Hepsiburada SON !-->

                                                    </td>
                                                <?php } ?>
                                                <td style="min-width: 135px" width="135">
                                                 <div class="d-flex align-items-center justify-content-center flex-wrap">

                                                     <?php if($catRow['fiyat_filtre'] == '1'  ) {?>
                                                         <a href="javascript:Void(0)" class="bg-warning text-white p-1 d-flex align-items-center justify-content-center" data-toggle="tooltip" data-placement="top" title="<?=$diller['adminpanel-form-text-1839']?>">
                                                             <?=$diller['adminpanel-form-text-1772']?>
                                                         </a>
                                                     <?php }else { ?>
                                                         <a href="javascript:Void(0)" class="bg-secondary text-light p-1 d-flex align-items-center justify-content-center" data-toggle="tooltip" data-placement="top" title="<?=$diller['adminpanel-form-text-1840']?>">
                                                            <i class="fa fa-times mr-1" style="font-size: 9px ;"></i> <?=$diller['adminpanel-form-text-1772']?>
                                                         </a>
                                                     <?php }?>

                                                     <?php if($catRow['marka_filtre'] == '1'  ) {?>
                                                         <a href="javascript:Void(0)" class="bg-warning text-white p-1 d-flex align-items-center justify-content-center" data-toggle="tooltip" data-placement="top" title="<?=$diller['adminpanel-form-text-1843']?>">
                                                             <?=$diller['adminpanel-form-text-1841']?>
                                                         </a>
                                                     <?php }else { ?>
                                                         <a href="javascript:Void(0)" class="bg-secondary text-light p-1 d-flex align-items-center justify-content-center" data-toggle="tooltip" data-placement="top" title="<?=$diller['adminpanel-form-text-1844']?>">
                                                             <i class="fa fa-times mr-1" style="font-size: 9px ;"></i> <?=$diller['adminpanel-form-text-1841']?>
                                                         </a>
                                                     <?php }?>

                                                     <?php if($catRow['ozellik_filtre'] == '1'  ) {?>
                                                         <a href="javascript:Void(0)" class="bg-warning text-white p-1 d-flex align-items-center justify-content-center" data-toggle="tooltip" data-placement="top" title="<?=$diller['adminpanel-form-text-1845']?>">
                                                             <?=$diller['adminpanel-form-text-1842']?>
                                                         </a>
                                                     <?php }else { ?>
                                                         <a href="javascript:Void(0)" class="bg-secondary text-light p-1 d-flex align-items-center justify-content-center" data-toggle="tooltip" data-placement="top" title="<?=$diller['adminpanel-form-text-1846']?>">
                                                             <i class="fa fa-times mr-1" style="font-size: 9px ;"></i> <?=$diller['adminpanel-form-text-1842']?>
                                                         </a>
                                                     <?php }?>

                                                 </div>
                                                </td>
                                                <td width="85">
                                                    <?php if($catRow['durum'] == '0' ) {?>
                                                        <a class="btn btn-sm btn-outline-danger " href="pages.php?page=sub_categories&parent=<?=$_GET['parent']?>&status_update=<?=$catRow['id']?><?=$searchPage?><?=$pageGet?>">
                                                            <div class="d-flex align-items-center">
                                                                <i class="fa fa-times mr-2"></i>
                                                                <?=$diller['adminpanel-form-text-68']?>
                                                            </div>
                                                        </a>
                                                    <?php }?>
                                                    <?php if($catRow['durum'] == '1' ) {?>
                                                        <a class="btn btn-sm btn-success " href="pages.php?page=sub_categories&parent=<?=$_GET['parent']?>&status_update=<?=$catRow['id']?><?=$searchPage?><?=$pageGet?>">
                                                            <div class="d-flex align-items-center">
                                                                <div class="spinner-grow text-white mr-2" role="status" style="width: 10px; height: 10px">
                                                                    <span class="sr-only">Loading...</span>
                                                                </div>
                                                                <?=$diller['adminpanel-form-text-67']?>
                                                            </div>
                                                        </a>
                                                    <?php }?>
                                                </td>
                                                <td class="text-right" style="min-width: 100px">
                                                    <a href="javascript:Void(0)" data-id="<?=$catRow['id']?>"  class="btn btn-sm btn-primary duzenleAjax " data-toggle="tooltip" data-placement="top" title="<?=$diller['adminpanel-text-159']?>"><i class="fa fa-eye" ></i></a>
                                                    <a href="" data-href="post.php?process=catalog_post2&status=sub_category_delete&no=<?=$catRow['id']?>&parent=<?=$_GET['parent']?>"  data-toggle="modal" data-target="#confirm-delete"  class="btn btn-sm btn-danger "><i class="fa fa-trash" ></i></a>
                                                </td>
                                            </tr>
                                        <?php }?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- Kaydırılabilir Alert !-->
                                <div class="d-md-none d-sm-block p-2 bg-light  text-center">
                                    <?=$diller['adminpanel-text-340']?> <i class="fas fa-hand-pointer"></i>
                                </div>
                                <!--  <========SON=========>>> Kaydırılabilir Alert SON !-->
                                    <?php if($ToplamVeri<='0' ) {?>
                                        <div class="w-100  p-3 ">
                                            <i class="fa fa-ban"></i> <?=$diller['adminpanel-text-162']?>
                                        </div>
                                    <?php }?>
                                <?php if($ToplamVeri > '0') {?>
                                    <div class="w-100 pt-3 pb-3 border-bottom   " >
                                        <button class="btn btn-danger btn-sm pl-4 pr-4 " disabled="disabled" name="deleteMulti" ><i class="fa fa-trash"></i> <?=$diller['adminpanel-text-158']?></button>
                                    </div>
                                </form>
                                <script>
                                    var checkboxes = $("input[data-id='chec']"),
                                        submitButt = $("button[name='deleteMulti']");

                                    checkboxes.click(function() {
                                        submitButt.attr("disabled", !checkboxes.is(":checked"));
                                    });
                                </script>
                                <?php }?>

                                <!---- Sayfalama Elementleri ================== !-->
                                <?php if($ToplamVeri > $Limit  ) {?>
                                    <div id="SayfalamaElementi" class="w-100 p-2  border-bottom bg-light  ">
                                        <?php if($Sayfa >= 1){?>
                                        <nav aria-label="Page navigation example " >
                                            <ul class="pagination pagination-sm justify-content-end mb-0 ">
                                                <?php } ?>
                                                <?php if($Sayfa > 1){  ?>
                                                    <li class="page-item "><a class="page-link " href="pages.php?page=sub_categories&parent=<?=$_GET['parent']?><?=$searchPage?>"><?=$diller['sayfalama-ilk']?></a></li>
                                                    <li class="page-item "><a class="page-link " href="pages.php?page=sub_categories&parent=<?=$_GET['parent']?><?=$searchPage?>&p=<?=$Sayfa - 1?>"><?=$diller['sayfalama-onceki']?></a></li>
                                                <?php } ?>
                                                <?php
                                                for($i = $Sayfa - $GorunenSayfa; $i < $Sayfa + $GorunenSayfa +1; $i++){ if($i > 0 and $i <= $Sayfa_Sayisi){
                                                    if($i == $Sayfa){
                                                        ?>
                                                        <li class="page-item active " aria-current="page">
                                                            <a class="page-link" href="pages.php?page=sub_categories&parent=<?=$_GET['parent']?><?=$searchPage?>&p=<?=$i?>"><?=$i?><span class="sr-only">(current)</span></a>
                                                        </li>
                                                        <?php
                                                    }else{
                                                        ?>
                                                        <li class="page-item "><a class="page-link" href="pages.php?page=sub_categories&parent=<?=$_GET['parent']?><?=$searchPage?>&p=<?=$i?>"><?=$i?></a></li>
                                                        <?php
                                                    }
                                                }
                                                }
                                                ?>

                                                <?php if($islemListele->rowCount() <=0) { } else { ?>
                                                    <?php if($Sayfa != $Sayfa_Sayisi){?>
                                                        <li class="page-item"><a class="page-link" href="pages.php?page=sub_categories&parent=<?=$_GET['parent']?><?=$searchPage?>&p=<?=$Sayfa + 1?>"><?=$diller['sayfalama-sonraki']?></a></li>
                                                        <li class="page-item"><a class="page-link" href="pages.php?page=sub_categories&parent=<?=$_GET['parent']?><?=$searchPage?>&p=<?=$Sayfa_Sayisi?>"><?=$diller['sayfalama-son']?></a></li>
                                                    <?php }} ?>
                                                <?php if($Sayfa >= 1){?>
                                            </ul>
                                        </nav>
                                    <?php } ?>
                                    </div>
                                <?php }?>
                                <!---- Sayfalama Elementleri ================== !-->



                            </div>
                        </div>
                    </div>
                </div>
                <!--  <========SON=========>>> Contents SON !-->


            </div>



        <?php }else { ?>
            <div class="card p-xl-5">
                <h3><?=$diller['adminpanel-text-136']?></h3>
                <h6><?=$diller['adminpanel-text-137']?></h6>
                <div  class="mt-3">
                    <a href="<?=$ayar['panel_url']?>" class="btn btn-primary"><?=$diller['adminpanel-text-138']?></a>
                </div>
            </div>
        <?php }?>
    </div>
</div>

<!-- Editable Modal !-->
<script type='text/javascript'>
    $(document).ready(function(){

        $('.duzenleAjax').click(function(){

            var postID = $(this).data('id');

            // AJAX request
            $.ajax({
                url: 'masterpiece.php?page=sub_category_edit',
                type: 'post',
                data: {postID: postID},
                success: function(response){
                    $('.modal-editable').html(response);
                    $('#duzenle').modal('show');
                }
            });
        });
    });
</script>
<!--  <========SON=========>>> Editable Modal SON !-->

<!-- Sıralama Kodu !-->
<script type="text/javascript">
    $( ".row_position" ).sortable({
        delay: 150,
        stop: function() {
            var selectedData = new Array();
            $('.row_position>tr').each(function() {
                selectedData.push($(this).attr("id"));
            });
            updateOrder(selectedData);
        }
    });


    function updateOrder(data) {
        $.ajax({
            url:"",
            type:'post',
            data:{position:data},
            success:function(){
                setTimeout(function(){// wait for 5 secs(2)
                    location.reload(); // then reload the page.(3)
                }, 1);
            }
        })
    }
</script>
<!-- Sıralama Kodu Son !-->


<script>
    $(function () {
        $('#genelAcc').on('shown.bs.collapse', function (e) {
            $('html,body').animate({
                    scrollTop: $('#genelAcc').offset().top - 80 },
                500);
        });
    });
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>

