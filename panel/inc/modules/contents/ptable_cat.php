<?php
$currentURL = $ayar['panel_url'].'pages.php?'.$_SERVER['QUERY_STRING'];
$_SESSION['current_url'] = $currentURL;
$currentMenu = 'ptable';


if($_POST) {
if ($yetki['demo'] != '1') {
    $position = $_POST['position'];
    $count = 1;
    foreach ($position as $idler) {
        $idler2 = htmlspecialchars(trim($idler));
        try {

            $query = $db->query("UPDATE pricing_kat SET sira = '$count' WHERE id = '$idler2'");
        } catch (PDOException $ex) {
            echo "Hata İşlem Yapılamadı!";
            some_logging_function($ex->getMessage());
        }
        $count++;
    }
}
}
if (isset($_GET['search']) && $_GET['search'] == !null) {
    $searchPage = "&search=$_GET[search]";
}
if(isset($_GET['p']) && $_GET['p'] == !null ) {
    $sayfa = '&p='.$_GET['p'].'';
}else{
    $sayfa = null;
}
if(isset($_GET['status_update'])  ) {
if ($yetki['demo'] != '1') {
    if ($_GET['status_update'] == !null) {

        $statusCek = $db->prepare("select * from pricing_kat where id=:id ");
        $statusCek->execute(array(
            'id' => $_GET['status_update']
        ));

        if ($statusCek->rowCount() > '0') {
            $st = $statusCek->fetch(PDO::FETCH_ASSOC);


            if ($st['durum'] == '1') {
                $statusum = '0';
            }
            if ($st['durum'] == '0') {
                $statusum = '1';
            }

            $guncelle = $db->prepare("UPDATE pricing_kat SET
                 durum=:durum
          WHERE id={$_GET['status_update']}      
         ");
            $sonuc = $guncelle->execute(array(
                'durum' => $statusum
            ));
            if ($sonuc) {
                header('Location:' . $ayar['panel_url'] . 'pages.php?page=pricing_table' . $searchPage . ''.$sayfa.'');
            } else {
                echo 'Veritabanı Hatası';
            }

        } else {
            header('Location:' . $ayar['panel_url'] . 'pages.php?page=pricing_table');
        }

    } else {
        header('Location:' . $ayar['panel_url'] . 'pages.php?page=pricing_table');
    }
}else{
    header('Location:' . $ayar['panel_url'] . 'pages.php?page=pricing_table');
}
}

if(isset($_GET['tab_update'])  ) {
    if ($yetki['demo'] != '1') {
        if ($_GET['tab_update'] == !null) {

            $statusCek = $db->prepare("select * from pricing_kat where id=:id ");
            $statusCek->execute(array(
                'id' => $_GET['tab_update']
            ));

            if ($statusCek->rowCount() > '0') {
                $st = $statusCek->fetch(PDO::FETCH_ASSOC);


                if ($st['tab_durum'] == '1') {
                    $tabSta = '0';
                }
                if ($st['tab_durum'] == '0') {
                    $tabSta = '1';
                }

                $guncelle = $db->prepare("UPDATE pricing_kat SET
                 tab_durum=:tab_durum
          WHERE id={$_GET['tab_update']}      
         ");
                $sonuc = $guncelle->execute(array(
                    'tab_durum' => $tabSta
                ));
                if ($sonuc) {
                    header('Location:' . $ayar['panel_url'] . 'pages.php?page=pricing_table' . $searchPage . ''.$sayfa.'');
                } else {
                    echo 'Veritabanı Hatası';
                }

            } else {
                header('Location:' . $ayar['panel_url'] . 'pages.php?page=pricing_table');
            }

        } else {
            header('Location:' . $ayar['panel_url'] . 'pages.php?page=pricing_table');
        }
    }else{
        header('Location:' . $ayar['panel_url'] . 'pages.php?page=pricing_table');
    }
}
?>
<title><?=$diller['adminpanel-menu-text-51']?> - <?=$panelayar['baslik']?></title>

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
                                <a href="javascript:Void(0)"><i class="fa fa-angle-right"></i> <?=$diller['adminpanel-menu-text-41']?></a>
                                <a href="pages.php?page=pricing_table"><i class="fa fa-angle-right"></i> <?=$diller['adminpanel-menu-text-51']?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title end breadcrumb -->

        <?php if($yetki['icerik_yonetim'] == '1' && $yetki['ptable'] == '1') {

            if(isset($_GET['search']) && $_GET['search']== !null  ) {
                $search = " baslik like '%$_GET[search]%' and ";
            }else{
                $search = null;
            }

            $Sayfa = @intval($_GET['p']); if(!$Sayfa) $Sayfa = 1;
            $Say = $db->query("select * from pricing_kat where $search dil='$_SESSION[dil]'  ");
            $ToplamVeri = $Say->rowCount();
            $Limit = 25;
            $Sayfa_Sayisi = ceil($ToplamVeri/$Limit); if($Sayfa > $Sayfa_Sayisi){$Sayfa = 1;}
            $Goster = $Sayfa * $Limit - $Limit;
            $GorunenSayfa = 5;
            $islemListele = $db->query("select * from pricing_kat where $search dil='$_SESSION[dil]'  order by sira ASC limit $Goster,$Limit");
            $islemCek = $islemListele->fetchAll(PDO::FETCH_ASSOC);


            ?>


            <div class="row">

                    <?php include 'inc/modules/_helper/contents_leftbar.php'; ?>

                <!-- Contents !-->
                <div class="<?php if($panelayar['panel_nav'] == '1'   ) { ?>col-md-9<?php }else{?>col-md-12<?php } ?>">
                    <div class="card p-3">
                        <div class="new-buttonu-main-top">
                            <div class="new-buttonu-main-left">
                                <h4> <?=$diller['adminpanel-menu-text-51']?></h4>
                            </div>
                            <div class="new-buttonu-main">
                                <a  class="btn btn-info text-white  " href="pages.php?page=theme_pricing"><?=$diller['adminpanel-form-text-838']?></a>
                                <a  class="btn btn-success text-white "  data-toggle="collapse" data-target="#genelAcc" aria-expanded="false" aria-controls="collapseForm"><i class="fas fa-plus-circle "></i> <?=$diller['adminpanel-form-text-1033']?></a>
                            </div>
                        </div>
                        <div id="accordion" class="accordion">
                            <div class="collapse " id="genelAcc" data-parent="#accordion">
                                <div class="w-100 border pl-3 pr-3 mb-3">
                                    <form action="post.php?process=ptable_post&status=catadd" method="post" >
                                        <div class="row ">
                                            <div class="form-group col-md-12 text-center bg-white text-dark border-bottom mb-0 ">
                                                <h5> <?=$diller['adminpanel-form-text-1033']?></h5>
                                            </div>
                                        </div>
                                        <div class="row bg-light border-bottom mb-3  ">
                                            <div class="form-group col-auto mb-3 mt-3 ">
                                                <a class=" p-2 border d-inline-block bg-white rounded pl-3 pr-3  ">
                                                    <div class="d-flex align-items-center justify-content-start">
                                                        <div class="mr-2 flag-icon-<?=$mevcutdil['flag']?>" style="width:18px; height:13px; display: inline-block; vertical-align: middle"></div>
                                                        <?=$mevcutdil['baslik']?> <?=$diller['adminpanel-form-text-259']?>
                                                        <i class="ti-help-alt text-danger ml-2 " style="cursor: pointer" data-container="body" data-toggle="popover" data-placement="right" data-content="<?=$diller['adminpanel-form-text-722']?>"></i>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="row p-2">
                                            <div class="form-group col-md-4 ">
                                                <label  for="durum" class="w-100" ><?=$diller['adminpanel-form-text-843']?></label>
                                                <div class="custom-control custom-switch custom-switch-lg">
                                                    <input type="hidden" name="durum" value="0"">
                                                    <input type="checkbox" class="custom-control-input" id="durum" name="durum" value="1"  checked >
                                                    <label class="custom-control-label" for="durum"></label>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-4 ">
                                                <label  for="tab_durum" class="w-100" ><?=$diller['adminpanel-form-text-1034']?></label>
                                                <div class="custom-control custom-switch custom-switch-lg">
                                                    <input type="hidden" name="tab_durum" value="0"">
                                                    <input type="checkbox" class="custom-control-input" id="tab_durum" name="tab_durum" value="1"   >
                                                    <label class="custom-control-label" for="tab_durum"></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row p-2 ">
                                            <div class="form-group col-md-8">
                                                <label for="baslik">* <?=$diller['adminpanel-form-text-885']?></label>
                                                <input type="text" autocomplete="off"  name="baslik" id="baslik" required class="form-control">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="sira">* <?=$diller['adminpanel-form-text-55']?></label>
                                                <input type="number" autocomplete="off" min="1"  name="sira" id="sira" required class="form-control">
                                            </div>
                                        </div>

                                        <div class="in-header-page-main mt-2" >
                                            <div class="in-header-page-text">
                                                <i class="fa fa-arrow-down"></i>
                                                <?=$diller['adminpanel-text-311']?>
                                            </div>
                                        </div>
                                        <div class="row p-2">
                                            <div class="form-group col-md-12">
                                                <label for="seo_url" class="w-100 d-flex align-items-center justify-content-between"><?=$diller['adminpanel-form-text-1012']?> <i class="ti-help-alt text-primary float-right" data-toggle="tooltip" data-placement="top" title="<?=$diller['adminpanel-form-text-1014']?>"></i></label>
                                                <input type="text" autocomplete="off"  name="seo_url" id="seo_url"  class="form-control">
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label for="seo_baslik" class="w-100 d-flex align-items-center justify-content-between"><?=$diller['adminpanel-form-text-1015']?> <i class="ti-help-alt text-primary float-right" data-toggle="tooltip" data-placement="top" title="<?=$diller['adminpanel-form-text-1016']?>"></i></label>
                                                <input type="text" autocomplete="off"  name="seo_baslik" id="seo_baslik"  class="form-control">
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label  for="tags" class="w-100"><?=$diller['adminpanel-form-text-6']?> </label>
                                                <input type="text" name="tags" value="<?=$detay['tags']?>" id="tags" data-role="tagsinput" placeholder="<?=$diller['adminpanel-form-text-7']?>" class="form-control" />
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label  for="meta_desc" class="w-100"><?=$diller['adminpanel-form-text-5']?> </label>
                                                <textarea name="meta_desc" id="meta_desc" class="form-control" rows="2" ><?=$detay['meta_desc']?></textarea>
                                            </div>
                                        </div>
                                        <div class="row border-top pt-3 bg-light pb-3 mt-3">
                                            <div class="col-md-12 text-right">
                                                <button class="btn  btn-success " name="insert"><?=$diller['adminpanel-form-text-53']?></button>
                                                <a class="btn  btn-secondary text-white" data-toggle="collapse" data-target="#genelAcc" aria-expanded="false" aria-controls="collapseForm"><?=$diller['adminpanel-modal-text-17']?></a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Search Form !-->
                        <div class="w-100 pt-2 pb-2  bg-white  mb-2 ">
                            <div class="row ">
                                <div class="col-md-7 ">
                                    <?php if(isset($_GET['search'])  && $_GET['search']==!null ) {?>
                                        <h6><?=$diller['adminpanel-text-161']?> : <?=$ToplamVeri?></h6>
                                        <a href="pages.php?page=pricing_table" class="btn btn-sm btn-info shadow"><?=$_GET['search']?> <i class="fa fa-times"></i></a>
                                    <?php }?>
                                </div>
                                <div class="col-md-5 text-right">
                                    <form method="GET" action="pages.php">
                                        <div class="input-group ">
                                            <input type="hidden" name="page" value="pricing_table" >
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
                                <form method="post" action="post.php?process=ptable_post&status=cat_multidelete">
                                <div class="table-responsive ">
                                    <table class="table table-hover mb-0  ">
                                        <thead class="thead-default">
                                        <tr>
                                            <th width="25">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input selectall"  id="hepsiniSecCheckBox" >
                                                    <label class="custom-control-label" for="hepsiniSecCheckBox"></label>
                                                </div>
                                            </th>
                                            <th><?=$diller['adminpanel-text-170']?></th>
                                            <th></th>
                                            <th><?=$diller['adminpanel-form-text-885']?></th>
                                            <th></th>
                                            <th style="text-align: center;">
                                                <?=$diller['adminpanel-form-text-1034']?>
                                            </th>
                                            <th><?=$diller['adminpanel-form-text-62']?></th>
                                            <th  class="text-center" width="100"><?=$diller['adminpanel-text-157']?></th>
                                        </tr>
                                        </thead>
                                        <tbody  class="row_position">
                                        <?php foreach ($islemCek as $row) {


                                            $tabloSay = $db->prepare("select * from pricing where kat_id=:kat_id  ");
                                            $tabloSay->execute(array(
                                                    'kat_id' => $row['id'],
                                            ));
                                            

                                            ?>
                                            <tr id="<?php echo $row['id'] ?>" style="cursor: move">
                                                <td>
                                                    <div class="custom-control custom-checkbox" >
                                                        <input type="checkbox" class="custom-control-input individual"   id="checkSec-<?=$row['id']?>" name='sil[]' value="<?=$row['id']?>" >
                                                        <label class="custom-control-label" for="checkSec-<?=$row['id']?>" ></label>
                                                    </div>
                                                </td>
                                                <td width="40">
                                                    <div class="btn btn-outline-pink btn-sm">
                                                        <?=$row['sira']?>
                                                    </div>
                                                </td>
                                                <td width="150" style="min-width: 150px">
                                                    <a href="pages.php?page=pricing_table_list&parent=<?=$row['id']?>" class="btn btn-sm btn-primary rounded">
                                                        <i class="mdi mdi-table"></i>   <?=$diller['adminpanel-form-text-1035']?> (<?=$tabloSay->rowCount()?>)
                                                    </a>
                                                </td>
                                                <td style="font-weight: 500; min-width: 200px" >
                                                    <?=$row['baslik']?>
                                                </td>
                                                <td width="128" style="min-width: 128px">
                                                    <a href="<?=$ayar['site_url']?>paket/<?=$row['seo_url']?>/" target="_blank" class="btn btn-sm btn-outline-dark rounded">
                                                        <i class="fa fa-external-link-alt"></i>  <?=$diller['adminpanel-form-text-1049']?>
                                                    </a>
                                                </td>
                                                <td width="120" style="text-align: center;">
                                                    <?php if($row['durum'] == '1' ) {?>
                                                    <?php if($row['tab_durum'] == '0' ) {?>
                                                        <a class="btn btn-sm btn-outline-danger " href="pages.php?page=pricing_table&tab_update=<?=$row['id']?><?=$searchPage?><?=$sayfa?>">
                                                            <div class="d-flex align-items-center">
                                                                <i class="fa fa-times mr-2"></i>
                                                                <?=$diller['adminpanel-form-text-68']?>
                                                            </div>
                                                        </a>
                                                    <?php }?>
                                                    <?php if($row['tab_durum'] == '1' ) {?>
                                                        <a class="btn btn-sm btn-outline-success " href="pages.php?page=pricing_table&tab_update=<?=$row['id']?><?=$searchPage?><?=$sayfa?>">
                                                            <div class="d-flex align-items-center">
                                                                <div class="spinner-grow text-success mr-2" role="status" style="width: 10px; height: 10px">
                                                                    <span class="sr-only">Loading...</span>
                                                                </div>
                                                                <?=$diller['adminpanel-form-text-67']?>
                                                            </div>
                                                        </a>
                                                    <?php }?>
                                                    <?php } ?>
                                                </td>
                                                <td width="85">
                                                    <?php if($row['durum'] == '0' ) {?>
                                                        <a class="btn btn-sm btn-outline-danger " href="pages.php?page=pricing_table&status_update=<?=$row['id']?><?=$searchPage?><?=$sayfa?>">
                                                            <div class="d-flex align-items-center">
                                                                <i class="fa fa-times mr-2"></i>
                                                                <?=$diller['adminpanel-form-text-68']?>
                                                            </div>
                                                        </a>
                                                    <?php }?>
                                                    <?php if($row['durum'] == '1' ) {?>
                                                        <a class="btn btn-sm btn-success " href="pages.php?page=pricing_table&status_update=<?=$row['id']?><?=$searchPage?><?=$sayfa?>">
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
                                                    <a href="javascript:Void(0)" data-id="<?=$row['id']?>" class="btn btn-sm btn-primary duzenleAjax" data-toggle="tooltip" data-placement="top" title="<?=$diller['adminpanel-text-159']?>"><i class="fa fa-eye" ></i></a>
                                                    <a href="" data-href="post.php?process=ptable_post&status=cat_delete&no=<?=$row['id']?>"  data-toggle="modal" data-target="#confirm-delete"  class="btn btn-sm btn-danger "><i class="fa fa-trash" ></i></a>
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
                                <div class="border-top"> </div>


                                <?php if($ToplamVeri > '0') {?>
                                    <div class="w-100 pt-3 pb-3 border-bottom border-top  " >
                                        <button class="btn btn-danger btn-sm rounded-0 shadow-lg pl-4 pr-4 " type="submit" ><i class="fa fa-trash"></i> <?=$diller['adminpanel-text-158']?></button>
                                    </div>
                                    </form>
                                <?php }?>


                                <!---- Sayfalama Elementleri ================== !-->
                                <?php if($ToplamVeri > $Limit  ) {?>
                                    <div id="SayfalamaElementi" class="w-100 p-2  border-bottom bg-light  ">
                                        <?php if($Sayfa >= 1){?>
                                        <nav aria-label="Page navigation example " >
                                            <ul class="pagination pagination-sm justify-content-end mb-0 ">
                                                <?php } ?>
                                                <?php if($Sayfa > 1){  ?>
                                                    <li class="page-item "><a class="page-link " href="pages.php?page=pricing_table<?=$searchPage?>"><?=$diller['sayfalama-ilk']?></a></li>
                                                    <li class="page-item "><a class="page-link " href="pages.php?page=pricing_table<?=$searchPage?>&p=<?=$Sayfa - 1?>"><?=$diller['sayfalama-onceki']?></a></li>
                                                <?php } ?>
                                                <?php
                                                for($i = $Sayfa - $GorunenSayfa; $i < $Sayfa + $GorunenSayfa +1; $i++){ if($i > 0 and $i <= $Sayfa_Sayisi){
                                                    if($i == $Sayfa){
                                                        ?>
                                                        <li class="page-item active " aria-current="page">
                                                            <a class="page-link" href="pages.php?page=pricing_table<?=$searchPage?>&p=<?=$i?>"><?=$i?><span class="sr-only">(current)</span></a>
                                                        </li>
                                                        <?php
                                                    }else{
                                                        ?>
                                                        <li class="page-item "><a class="page-link" href="pages.php?page=pricing_table<?=$searchPage?>&p=<?=$i?>"><?=$i?></a></li>
                                                        <?php
                                                    }
                                                }
                                                }
                                                ?>

                                                <?php if($islemListele->rowCount() <=0) { } else { ?>
                                                    <?php if($Sayfa != $Sayfa_Sayisi){?>
                                                        <li class="page-item"><a class="page-link" href="pages.php?page=pricing_table<?=$searchPage?>&p=<?=$Sayfa + 1?>"><?=$diller['sayfalama-sonraki']?></a></li>
                                                        <li class="page-item"><a class="page-link" href="pages.php?page=pricing_table<?=$searchPage?>&p=<?=$Sayfa_Sayisi?>"><?=$diller['sayfalama-son']?></a></li>
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
                url: 'masterpiece.php?page=ptable_edit',
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
</script>