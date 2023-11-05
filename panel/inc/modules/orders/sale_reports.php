<?php
$currentURL = $ayar['panel_url'].'pages.php?'.$_SERVER['QUERY_STRING'];
$_SESSION['current_url'] = $currentURL;
$currentMenu = 'sale_reports';

?>
<title><?=$diller['adminpanel-menu-text-96']?> - <?=$panelayar['baslik']?></title>
<style>
    .nav-link{
        color: #000;
        transition-duration: 0.1s; transition-timing-function: linear;
        font-weight: 500;
        font-size: 14px;
        padding: 15px 25px;

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

    .ct-chart .ct-label.ct-horizontal.ct-end {
        justify-content: flex-end;
        text-align: left;
        transform-origin: 100% 0;
        transform: translate(-100%) rotate(-45deg);
        white-space:nowrap;
        height: 100px !important;
        position: relative;
    }

    .table-container {
        display: inline-block;
        vertical-align: top;
        width: 50%;
        border: 1px solid #ccc;
        padding-right: 25px;
        margin: 2px;
        border-radius: 25px;
    }
    svg.ct-chart-bar, svg.ct-chart-line{
        overflow: visible;
    }

    .ct-label.ct-vertical.ct-start{
        font-size: 12px ;
        font-weight: 600;

    }
    .ct-label.ct-vertical.ct-start:after{
        content: '<?=$Current_Money['sag_simge']?>';
        font-size: 12px ;
        margin-left: 3px;

    }
    .ct-chart .ct-series.ct-series-a .ct-bar, .ct-chart .ct-series.ct-series-a .ct-line, .ct-chart .ct-series.ct-series-a .ct-point, .ct-chart .ct-series.ct-series-a .ct-slice-donut {
        stroke: #2BB584;
    }
    .ct-series-a .ct-area, .ct-series-a .ct-slice-donut-solid, .ct-series-a .ct-slice-pie {
    fill: #2BB584 !important;
}
.ct-area {
    stroke: none;
    fill-opacity: .1 !important;
}
</style>
<link rel="stylesheet" href="plugins/chartist/css/chartist.min.css">
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
                                <a href="javascript:Void(0)"><i class="fa fa-angle-right"></i><?=$diller['adminpanel-menu-text-16']?></a>
                                    <a href="pages.php?page=sale_reports"><i class="fa fa-angle-right"></i><?=$diller['adminpanel-menu-text-96']?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title end breadcrumb -->
        <?php if($yetki['siparis'] == '1' && $yetki['siparis_diger'] == '1') {?>

            <div class="row">

                <?php include 'inc/modules/_helper/orders_leftbar.php'; ?>

                <!-- Contents !-->

                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body ">
                                    <div class="new-buttonu-main-top mb-0  pb-2 ">
                                        <div class="new-buttonu-main-left">
                                            <h4><?=$diller['adminpanel-menu-text-96']?></h4>
                                        </div>
                                    </div>
                                    <!-- Tab Alanı !-->
                                    <ul class="nav nav-tabs  pt-2" id="myTab" role="tablist">
                                        <li class="nav-item">
                                                <a class="nav-link saas active" href="pages.php?page=sale_reports">
                                                <i class="ion ion-md-stats"></i> <?=$diller['adminpanel-form-text-1717']?>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                                <a class="nav-link saas" href="pages.php?page=sale_reports_date">
                                               <i class="fa fa-calendar-check"></i> <?=$diller['adminpanel-form-text-1718']?>
                                            </a>
                                        </li>

                                    </ul>

                                    <div class="tab-content bg-white rounded-bottom border border-top-0">
                                        <div class="tab-pane active p-4" id="one" role="tabpanel" >
                                           <div class="w-100 alert-warning border border-warning p-2 mb-3 text-dark d-flex align-items-center">
                                               <i class="ti-help-alt text-primary mr-2 text-dark" ></i>
                                               <?=$diller['adminpanel-text-83']?>
                                               <div class="ml-2"><strong>[<?=$Current_Money['sag_simge']?>]</strong></div>
                                           </div>
                                            <div class="w-100 mb-3 position-relative">
                                                <div class="border">
                                                    <div class="card-body">

                                                        <div class="d-flex align-items-center justify-content-between flex-wrap">
                                                            <div>
                                                                <h4 class="mt-0 header-title">
                                                                    <?=$diller['adminpanel-text-352']?>
                                                                    <?php if(!isset($_GET['show']) && $_GET['show']==null  ) {?>
                                                                        30
                                                                    <?php }else { ?>
                                                                        <?php if(isset($_GET['show'])) {?>
                                                                            <?php if($_GET['show'] == '10day' || $_GET['show']=='7day'  ) {?>
                                                                                <?php if($_GET['show']=='10day'  ) {?>
                                                                                    10
                                                                                <?php }?>
                                                                                <?php if($_GET['show']=='7day'  ) {?>
                                                                                    7
                                                                                <?php }?>
                                                                            <?php }else { ?>
                                                                                <?php
                                                                                    header('Location:'.$ayar['panel_url'].'pages.php?page=sale_reports');
                                                                                exit();
                                                                                ?>
                                                                            <?php }?>
                                                                        <?php }?>
                                                                    <?php }?>
                                                                    <?=$diller['adminpanel-text-360']?>
                                                                </h4>
                                                            </div>
                                                            <div class="btn-group  " role="group" aria-label="Basic example">
                                                                    <a href="pages.php?page=sale_reports" class="<?php if(!isset($_GET['show']) && $_GET['show']==null  ) {?>btn btn-dark btn-sm <?php }else{ ?>btn btn-light border btn-sm<?php } ?>">30 <?=$diller['adminpanel-form-text-1420']?></a>
                                                                    <a href="pages.php?page=sale_reports&show=10day" class="<?php if($_GET['show']=='10day'  ) {?>btn btn-dark btn-sm<?php }else{ ?>btn btn-light border btn-sm<?php } ?>">10 <?=$diller['adminpanel-form-text-1420']?></a>
                                                                    <a href="pages.php?page=sale_reports&show=7day" class="<?php if($_GET['show']=='7day'  ) {?>btn btn-dark btn-sm<?php }else{ ?>btn btn-light border btn-sm<?php } ?>">7 <?=$diller['adminpanel-form-text-1420']?></a>
                                                            </div>
                                                        </div>
                                                        <div class="responsives position-relative pb-4 mt-3">
                                                            <div id="chart-with-area" class="ct-chart"></div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <!--  <========SON=========>>> Tab Alanı SON !-->


                                </div>
                            </div>
                        </div>

                <!--  <========SON=========>>> Contents SON !-->


            </div>

            <script src="plugins/chartist/js/chartist.min.js"></script>
            <script src="plugins/chartist/js/chartist-plugin-tooltip.min.js"></script>
            <script>
                //Line chart with area




                new Chartist.Line('#chart-with-area', {

                    <?php if(!isset($_GET['show']) && $_GET['show'] == null ) {?>
                    labels:
                        [
                            <?php
                            for($i = 29; $i >= 0; $i--)
                            {
                            ?>
                            '<?php $dateMer= date("Y-m-d", strtotime("-$i days")); ?>
                            <?php echo date_tr('j F', ''.$dateMer.''); ?>',
                            <?php
                            }
                            ?>
                        ],
                    series: [
                        [
                            <?php
                            for($i = 29; $i >= 0; $i--)
                            {
                            $dateMers= date("Y-m-d", strtotime("-$i days"));
                            $ziy = $db->prepare("select SUM(toplam_tutar) AS toplam from siparisler where onay='1' and sade_tarih='$dateMers' and parabirimi= '$Current_Money[kod]' ");
                            $ziy->execute();
                            $saleReportRow = $ziy->fetch(PDO::FETCH_ASSOC);
                            $ziyHavale = $db->prepare("select SUM(havale_toplamtutar) AS toplam from siparisler where onay='1' and sade_tarih='$dateMers' and parabirimi= '$Current_Money[kod]' ");
                            $ziyHavale->execute();
                            $saleReportHavaleRow = $ziyHavale->fetch(PDO::FETCH_ASSOC);
                            ?>
                            '<?=$saleReportRow['toplam']+$saleReportHavaleRow['toplam']?>',
                            <?php
                            }
                            ?>

                        ]
                    ],
                    <?php }else { ?>
                    <?php if($_GET['show']== '10day'  ) {?>
                    labels:
                        [
                            <?php
                            for($i = 9; $i >= 0; $i--)
                            {
                            ?>
                            '<?php $dateMer= date("Y-m-d", strtotime("-$i days")); ?>
                            <?php echo date_tr('j F', ''.$dateMer.''); ?>',
                            <?php
                            }
                            ?>
                        ],
                    series: [
                        [
                            <?php
                            for($i = 9; $i >= 0; $i--)
                            {
                            $dateMers= date("Y-m-d", strtotime("-$i days"));
                            $ziy = $db->prepare("select SUM(toplam_tutar) AS toplam from siparisler where onay='1' and sade_tarih='$dateMers' and parabirimi= '$Current_Money[kod]' ");
                            $ziy->execute();
                            $saleReportRow = $ziy->fetch(PDO::FETCH_ASSOC);
                            $ziyHavale = $db->prepare("select SUM(havale_toplamtutar) AS toplam from siparisler where onay='1' and sade_tarih='$dateMers' and parabirimi= '$Current_Money[kod]' ");
                            $ziyHavale->execute();
                            $saleReportHavaleRow = $ziyHavale->fetch(PDO::FETCH_ASSOC);
                            ?>
                             '<?=$saleReportRow['toplam']+$saleReportHavaleRow['toplam']?>',
                            <?php
                            }
                            ?>

                        ]
                    ],
                    <?php }?>
                    <?php if($_GET['show']== '7day'  ) {?>
                    labels:
                        [
                            <?php
                            for($i = 6; $i >= 0; $i--)
                            {
                            ?>
                            '<?php $dateMer= date("Y-m-d", strtotime("-$i days")); ?>
                            <?php echo date_tr('j F', ''.$dateMer.''); ?>',
                            <?php
                            }
                            ?>
                        ],
                    series: [
                        [
                            <?php
                            for($i = 6; $i >= 0; $i--)
                            {
                            $dateMers= date("Y-m-d", strtotime("-$i days"));
                            $ziy = $db->prepare("select SUM(toplam_tutar) AS toplam from siparisler where onay='1' and sade_tarih='$dateMers' and parabirimi= '$Current_Money[kod]' ");
                            $ziy->execute();
                            $saleReportRow = $ziy->fetch(PDO::FETCH_ASSOC);
                            $ziyHavale = $db->prepare("select SUM(havale_toplamtutar) AS toplam from siparisler where onay='1' and sade_tarih='$dateMers' and parabirimi= '$Current_Money[kod]' ");
                            $ziyHavale->execute();
                            $saleReportHavaleRow = $ziyHavale->fetch(PDO::FETCH_ASSOC);
                            ?>
                             '<?=$saleReportRow['toplam']+$saleReportHavaleRow['toplam']?>',
                            <?php
                            }
                            ?>

                        ]
                    ],
                    <?php }?>
                    <?php }?>




                }, {
                    low: 0,
                    showArea: true,
                    plugins: [
                        Chartist.plugins.tooltip(
                            {
                                items: [{
                                    content: '<h3>160<span class="small">mph</span></h3>'
                                }]
                            }
                        ),
                    ],

                });


            </script>

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
