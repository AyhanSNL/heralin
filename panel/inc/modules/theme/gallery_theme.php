<?php
$currentURL = $ayar['panel_url'].'pages.php?'.$_SERVER['QUERY_STRING'];
$_SESSION['current_url'] = $currentURL;
$currentMenu = 'gallery';
$fontlar = $db->prepare("select * from fontlar where durum='1' order by sira asc ");
$fontlar->execute();
$sayfaSorgu = $db->prepare("select * from galeri_ayar where id='1' ");
$sayfaSorgu->execute();
$detay = $sayfaSorgu->fetch(PDO::FETCH_ASSOC);
$albumler = $db->prepare("select * from galeri_kat where dil=:dil and durum=:durum order by sira asc ");
$albumler->execute(array(
        'dil' => $_SESSION['dil'],
    'durum' => '1'
));


?>
<title><?=$diller['adminpanel-menu-text-174']?> - <?=$panelayar['baslik']?></title>
<div class="wrapper" style="margin-top: 0;">
    <div class="container-fluid">
        <!-- Page-Title -->
        <div class="row mb-3">
            <div class="col-md-12 ">
                <div class="page-title-box  bg-white card mb-0 pl-3" >
                    <div class="row align-items-center d-flex justify-content-between" >
                        <div class="col-md-8" >
                            <div class="page-title-nav">
                                <a href="<?=$ayar['panel_url']?>"><i class="ion ion-md-home"></i> <?=$diller['adminpanel-text-341']?></a>
                                <a href="javascript:Void(0)"><i class="fa fa-angle-right"></i> <?=$diller['adminpanel-menu-text-98']?></a>
                                <a href="pages.php?page=theme_gallery"><i class="fa fa-angle-right"></i> <?=$diller['adminpanel-menu-text-174']?></a>
                            </div>
                        </div>
                        <div class="col-md-auto mr-3" >
                            <?php if($yetki['icerik_yonetim'] == '1' && $yetki['galeri'] == '1' ) {?>
                                <div class="mt-2 d-md-none d-sm-block"></div>
                                <a href="pages.php?page=photo_gallery"  class="btn btn-primary" style="font-size: 13px; font-weight: 400;"> <?=$diller['adminpanel-form-text-628']?></a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title end breadcrumb -->
        <?php if($yetki['tema_ayarlar'] == '1' ) {?>
            <div class="row">


                <div class="col-md-3 d-none d-md-inline-block" id="sidebarWrap" style="overflow: hidden; position: relative">
                    <div id="sidebar" class="mr-3">
                        <div class="btn-group w-100 d-flex flex-wrap" role="group">
                            <button class="btn btn-lg card btn-block text-left pt-3 pb-3 mb-0 mt-0  <?php if(isset($_SESSION['collepse_status'])   ) { ?><?php if($_SESSION['collepse_status'] == 'genelAcc'  ) { ?>active<?php }?><?php }else{ ?> active<?php } ?>" type="button" data-toggle="collapse" data-target="#genelAcc" aria-expanded="false" aria-controls="collapseForm">
                                <?=$diller['adminpanel-form-text-571']?>
                            </button>
                            <button class="btn btn-lg card btn-block text-left pt-3 pb-3 mb-0 mt-0  <?php if($_SESSION['collepse_status'] == 'otherAcc'  ) { ?>active<?php }?>" type="button" data-toggle="collapse" data-target="#otherAcc" aria-expanded="false" aria-controls="collapseForm">
                                <?=$diller['adminpanel-form-text-379']?>
                            </button>
                        </div>
                    </div>
                </div>


                <!-- Mobile !-->
                <div class="col-md-3 d-md-none d-sm-inline-block ">
                    <a class="btn btn-pink mo-mb-2 btn-block d-flex align-items-center justify-content-between" data-toggle="collapse" href="#navigasyon" aria-expanded="false" aria-controls="collapseExample">
                        <?=$diller['adminpanel-text-269']?> <i class="fa fa-plus"></i>
                    </a>
                    <div class="collapse mb-3" id="navigasyon">
                        <div class="btn-group w-100 d-flex flex-wrap" role="group">
                            <button class="btn btn-lg card btn-block text-left pt-3 pb-3 mb-0 mt-0  <?php if(isset($_SESSION['collepse_status'])   ) { ?><?php if($_SESSION['collepse_status'] == 'genelAcc'  ) { ?>active<?php }?><?php }else{ ?> active<?php } ?>" type="button" data-toggle="collapse" data-target="#genelAcc" aria-expanded="false" aria-controls="collapseForm">
                                <?=$diller['adminpanel-form-text-571']?>
                            </button>
                            <button class="btn btn-lg card btn-block text-left pt-3 pb-3 mb-0 mt-0  <?php if($_SESSION['collepse_status'] == 'otherAcc'  ) { ?>active<?php }?>" type="button" data-toggle="collapse" data-target="#otherAcc" aria-expanded="false" aria-controls="collapseForm">
                                <?=$diller['adminpanel-form-text-379']?>
                            </button>
                        </div>
                    </div>
                </div>
                <!--  <========SON=========>>> Mobile SON !-->

                <!-- Contents !-->
                <div class="col-md-6">
                    <div id="accordion" class="accordion">
                        <!-- Düzen Ayarları  !-->
                        <div class="card mb-2 " >
                            <div class="card-body">
                                <button class="btn btn-block text-left pl-0 " type="button" data-toggle="collapse" data-target="#genelAcc" aria-expanded="false" aria-controls="collapseForm" style="background-color: #fff; ">
                                    <div class="font-20 w-100 d-flex align-items-center justify-content-between font-weight-bold">
                                        <?=$diller['adminpanel-form-text-571']?>
                                        <i class="far fa-plus-square"></i>
                                    </div>
                                </button>
                                <div class="collapse in show" id="genelAcc" data-parent="#accordion">
                                    <div class="w-100 border-top pt-3">
                                        <form action="post.php?process=theme_gallery_post&status=main_update" method="post">
                                            <div class="row">
                                                <div class="form-group col-md-6 mb-4">
                                                    <label for="width"><?=$diller['adminpanel-form-text-629']?></label>
                                                    <select name="width" class="form-control" id="width" required>
                                                        <option value="0" <?php if($detay['width'] == '0'  ) { ?>selected<?php }?>><?=$diller['adminpanel-form-text-10']?></option>
                                                        <option value="1" <?php if($detay['width'] == '1'  ) { ?>selected<?php }?>><?=$diller['adminpanel-form-text-9']?></option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6 mb-4">
                                                    <label for="margin"> <?=$diller['adminpanel-form-text-243']?></label>
                                                    <input type="number" name="margin" value="<?=$detay['margin']?>" id="margin" required class="form-control">
                                                </div>
                                                <div class="form-group col-md-6 mb-4">
                                                    <label for="padding"> <?=$diller['adminpanel-form-text-130']?></label>
                                                    <input type="number" name="padding" value="<?=$detay['padding']?>" id="padding" required class="form-control">
                                                </div>
                                                <div class="form-group col-md-6 mb-4">
                                                    <label for="galeri_limit"> <?=$diller['adminpanel-form-text-631']?></label>
                                                    <input type="number" name="galeri_limit" value="<?=$detay['galeri_limit']?>" id="galeri_limit" required class="form-control">
                                                </div>
                                                <div class="form-group col-md-6 mb-4">
                                                    <label  for="baslik_font" class="w-100"> <?=$diller['adminpanel-form-text-77']?></label>
                                                    <select name="baslik_font" class="form-control" id="baslik_font" >
                                                        <?php foreach ($fontlar as $font) {?>
                                                            <option value="<?=$font['font_adi']?>" <?php if($font['font_adi'] == $detay['baslik_font'] ) { ?>selected<?php }?>><?=$font['font_adi']?></option>
                                                        <?php }?>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label  for="baslik_space" class="w-100 d-flex align-items-center justify-content-between"><?=$diller['adminpanel-form-text-632']?> <i class="ti-help-alt text-primary float-right" data-toggle="tooltip" data-placement="top" title="<?=$diller['adminpanel-form-text-638']?>"></i></label>
                                                    <select name="baslik_space" class="form-control" id="baslik_space" >
                                                        <option value="" <?php if($detay['baslik_space'] == ''  ) { ?>selected<?php }?>><?=$diller['adminpanel-form-text-401']?></option>
                                                        <option value="lspac" <?php if($detay['baslik_space'] == 'lspac'  ) { ?>selected<?php }?>><?=$diller['adminpanel-form-text-398']?></option>
                                                        <option value="lspacsmall" <?php if($detay['baslik_space'] == 'lspacsmall'  ) { ?>selected<?php }?>><?=$diller['adminpanel-form-text-399']?></option>
                                                        <option value="lspacsmall_2" <?php if($detay['baslik_space'] == 'lspacsmall_2'  ) { ?>selected<?php }?>><?=$diller['adminpanel-form-text-400']?></option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6 mb-4">
                                                    <label for="galeriayar_border"><?=$diller['adminpanel-form-text-384']?></label>
                                                    <div data-color-format="default" data-color="#<?=$detay['galeriayar_border']?>"  class="colorpicker-default input-group">
                                                        <input type="text" name="galeriayar_border"  value="" class="form-control">
                                                        <div class="input-group-append add-on">
                                                            <button class="btn btn-light border" type="button">
                                                                <i style="background-color: rgb(124, 66, 84);"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-6 mb-4">
                                                    <label for="detay_bg"><?=$diller['adminpanel-form-text-576']?></label>
                                                    <div data-color-format="default" data-color="#<?=$detay['detay_bg']?>"  class="colorpicker-default input-group">
                                                        <input type="text" name="detay_bg"  value="" class="form-control">
                                                        <div class="input-group-append add-on">
                                                            <button class="btn btn-light border" type="button">
                                                                <i style="background-color: rgb(124, 66, 84);"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-12">
                                                    <label  for="icon" class="w-100"><?=$diller['adminpanel-form-text-637']?></label>
                                                    <select class="icon_select2 form-control w-100" name="icon" id="icon" >
                                                        <option value="<?=$detay['icon']?>"> <?=$detay['icon']?></option>
                                                            <?php include 'inc/modules/_helper/icon.php'?>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label  for="galeri_tip" class="w-100"><?=$diller['adminpanel-form-text-633']?></label>
                                                    <select name="galeri_tip" class="form-control" id="galeri_tip" >
                                                        <option value="0" <?php if($detay['galeri_tip'] == '0'  ) { ?>selected<?php }?>><?=$diller['adminpanel-form-text-634']?></option>
                                                        <option value="1" <?php if($detay['galeri_tip'] == '1'  ) { ?>selected<?php }?>><?=$diller['adminpanel-form-text-635']?></option>
                                                    </select>
                                                </div>
                                                <div id="myself-choise" class="w-100" <?php if($detay['galeri_tip'] == '0'  ) { ?>style="display:none"<?php }?>>
                                                    <div class="form-group col-md-12 mt-n3 ">
                                                        <div class="bg-light p-3 border rounded">
                                                            <label  for="galeri_id" class="w-100"><?=$diller['adminpanel-form-text-636']?></label>
                                                            <select class="galeri_select2 form-control" name="galeri_id" id="galeri_id" style="width: 100%;  " >
                                                                <?php foreach ($albumler as $album) {?>
                                                                    <option <?php if($detay['galeri_id'] == $album['id'] ) { ?>selected<?php }?> value="<?=$album['id']?>"><?=$album['baslik']?></option>
                                                                <?php }?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="in-header-page-main mt-4" >
                                                <div class="in-header-page-text">
                                                    <?=$diller['adminpanel-text-311']?> <i class="ti-help-alt text-primary " data-toggle="tooltip" data-placement="top" title="<?=$diller['adminpanel-form-text-630']?>"></i>
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="form-group col-md-12">
                                                    <label  for="tags" class="w-100"><?=$diller['adminpanel-form-text-6']?> </label>
                                                    <input type="text" name="tags" value="<?=$detay['tags']?>" id="tags" data-role="tagsinput" placeholder="<?=$diller['adminpanel-form-text-7']?>" class="form-control" />
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label  for="meta_desc" class="w-100"><?=$diller['adminpanel-form-text-5']?> </label>
                                                    <textarea name="meta_desc" id="meta_desc" class="form-control" rows="2" ><?=$detay['meta_desc']?></textarea>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 form-group mb-0">
                                                    <button class="btn  btn-success btn-block" name="update"><?=$diller['adminpanel-form-text-53']?></button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--  <========SON=========>>> Düzen Ayarları  SON !-->

                        <!-- Arkaplan Ayarları  !-->
                        <div class="card mb-2 " >
                            <div class="card-body">
                                <button class="btn btn-block text-left pl-0 " type="button" data-toggle="collapse" data-target="#otherAcc" aria-expanded="false" aria-controls="collapseForm" style="background-color: #fff; ">
                                    <div class="font-20 w-100 d-flex align-items-center justify-content-between font-weight-bold">
                                        <?=$diller['adminpanel-form-text-379']?>
                                        <i class="far fa-plus-square"></i>
                                    </div>
                                </button>
                                <div class="collapse" id="otherAcc" data-parent="#accordion">
                                    <div class="w-100 border-top pt-3">
                                        <form action="post.php?process=theme_gallery_post&status=bg_update" method="post" enctype="multipart/form-data">
                                            <div class="row">
                                                <div class="form-group col-md-12 ">
                                                    <select name="bg_tip" class="form-control"  id="select_box" required>
                                                        <option value="0" <?php if($detay['bg_tip'] == '0' ) { ?>selected<?php }?>><?=$diller['adminpanel-form-text-251']?></option>
                                                        <option value="1" <?php if($detay['bg_tip'] == '1' ) { ?>selected<?php }?>><?=$diller['adminpanel-form-text-250']?></option>
                                                    </select>
                                                </div>
                                                <div  id="0" class="select_option form-group pl-3 pr-3 w-100">

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <label for="inputGroupFile01"><?=$diller['adminpanel-form-text-255']?></label>
                                                            <div class="w-100 bg-light   p-3 text-center mb-3 ">
                                                                <?php if($detay['bg_image'] == !null  ) {?>
                                                                    <small class="text-dark">
                                                                        <?=$diller['adminpanel-form-text-107']?>
                                                                    </small>
                                                                    <br><br>
                                                                    <img src="<?=$ayar['site_url']?>images/uploads/<?=$detay['bg_image']?>" class="img-fluid" >
                                                                    <small>
                                                                        <br><br>
                                                                        <?=$diller['adminpanel-form-text-89']?> : 1920x1080
                                                                    </small>
                                                                    <br><br>
                                                                    <a href="" data-href="post.php?process=theme_gallery_post&status=bg_delete"  data-toggle="modal" data-target="#confirm-delete"  class="btn btn-sm btn-danger"><i class="ti-trash"></i> <?=$diller['adminpanel-text-167']?></a>
                                                                <?php }else{ ?>
                                                                    <img src="assets/images/no-img.jpg" style="width: 90px" class="border"  >
                                                                    <small>
                                                                        <br><br>
                                                                        <?=$diller['adminpanel-form-text-89']?> : 1920x1080
                                                                    </small>
                                                                <?php }?>
                                                            </div>
                                                            <div class="w-100">
                                                                <input type="hidden" name="old_bg" value="<?=$detay['bg_image']?>" >
                                                                <div class="input-group mb-3">
                                                                    <div class="custom-file">
                                                                        <input type="file" class="custom-file-input" id="inputGroupFile01" name="bg_image" >
                                                                        <label class="custom-file-label" for="inputGroupFile01"><?=$diller['adminpanel-form-text-106']?></label>
                                                                    </div>
                                                                </div>
                                                                <div class="w-100 text-center bg-light rounded text-dark mt-1 ">
                                                                    <small>png,  jpg, jpeg</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="in-header-page-main">
                                                                <div class="in-header-page-text">
                                                                    <i class="fa fa-arrow-down"></i>
                                                                    <?=$diller['adminpanel-form-text-263']?>
                                                                </div>
                                                            </div>
                                                            <div class="form-group bg-light col-md-12 mb-4 border pb-3 pt-2">
                                                                <label  for="bg_durum" class="w-100" ><?=$diller['adminpanel-form-text-253']?></label>
                                                                <div class="custom-control custom-switch custom-switch-lg">
                                                                    <input type="hidden" name="bg_durum" value="0"">
                                                                    <input type="checkbox" class="custom-control-input" id="bg_durum" name="bg_durum" value="1"  <?php if($detay['bg_durum'] == '1'  ) { ?>checked<?php }?> ">
                                                                    <label class="custom-control-label" for="bg_durum"></label>
                                                                </div>
                                                            </div>
                                                            <div class="form-group bg-light col-md-12 mb-4 border pb-3 pt-2">
                                                                <label  for="bg_dark" class="w-100" ><?=$diller['adminpanel-form-text-252']?></label>
                                                                <div class="custom-control custom-switch custom-switch-lg">
                                                                    <input type="hidden" name="bg_dark" value="0"">
                                                                    <input type="checkbox" class="custom-control-input" id="bg_dark" name="bg_dark" value="1"  <?php if($detay['bg_dark'] == '1'  ) { ?>checked<?php }?> ">
                                                                    <label class="custom-control-label" for="bg_dark"></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div id="1" class="select_option w-100 ">
                                                    <div class="d-flex flex-wrap">
                                                        <div class="form-group col-md-12">
                                                            <label for="bg_color"><?=$diller['adminpanel-form-text-254']?></label>
                                                            <div data-color-format="default" data-color="#<?=$detay['bg_color']?>"  class="colorpicker-default input-group">
                                                                <input type="text" name="bg_color"  value="" class="form-control">
                                                                <div class="input-group-append add-on">
                                                                    <button class="btn btn-light border" type="button">
                                                                        <i style="background-color: rgb(124, 66, 84);"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 form-group mb-0">
                                                    <button class="btn  btn-success btn-block" name="update"><?=$diller['adminpanel-form-text-53']?></button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--  <========SON=========>>> Arkaplan Ayarları  SON !-->


                    </div>

                </div>
                <!--  <========SON=========>>> Contents SON !-->


                <?php include 'inc/modules/_helper/theme_all_links.php'; ?>


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
<script id="rendered-js" >
    $(function () {
        $('#genelAcc').on('shown.bs.collapse', function (e) {
            $('html,body').animate({
                    scrollTop: $('#genelAcc').offset().top - 80 },
                500);
        });
        $('#otherAcc').on('shown.bs.collapse', function (e) {
            $('html,body').animate({
                    scrollTop: $('#otherAcc').offset().top - 80 },
                500);
        });
    });

    $('#select_box').change(function () {
        var select = $(this).find(':selected').val();
        $(".select_option").hide();
        $('#' + select).show();
    }).change();
    $('#galeri_tip').on('change', function() {
        $('#myself-choise').css('display', 'none');
        if ( $(this).val() === '1' ) {
            $('#myself-choise').css('display', 'block');
        }
    });
    $(document).ready(function() {
        $('.galeri_select2').select2();
    });
    $(document).ready(function() {
        $('.icon_select2').select2();
    });
</script>
<script id="rendered-js" >
    function actionBox(selected)
    {
        if (selected)
        {
            document.getElementById("actionBox").style.display = "";
        } else

        {
            document.getElementById("actionBox").style.display = "none";
        }

    }
</script>
<?php if($_SESSION['collepse_status'] == 'genelAcc'  ) {?>
    <script>
        $('#genelAcc').addClass('show');
        $('html,body').animate({
                scrollTop: $('#genelAcc').offset().top - 80 },
            0);
    </script>
    <?php
    unset($_SESSION['collepse_status'])
    ?>
<?php }?>
<?php if($_SESSION['collepse_status'] == 'otherAcc'  ) {?>
    <script>
        $('#otherAcc').addClass('show');
        $('html,body').animate({
                scrollTop: $('#otherAcc').offset().top - 80 },
            0);
        $('#genelAcc').removeClass('show');
    </script>
    <?php
    unset($_SESSION['collepse_status'])
    ?>
<?php }?>

