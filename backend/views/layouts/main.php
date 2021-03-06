<?php
/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <link rel="shortcut icon" href="<?= yii::$app->homeUrl; ?>images/fav.png" type="image/png" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="description" content="Xenon Boostrap Admin Panel" />
        <meta name="author" content="" />
        <title>Al Khalejia</title>
        <script src="<?= Yii::$app->homeUrl; ?>js/jquery-1.11.1.min.js"></script>
        <script type="text/javascript">
            var homeUrl = '<?= Yii::$app->homeUrl; ?>';
        </script>

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
                <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
                <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <?= Html::csrfMetaTags() ?>
        <?php $this->head() ?>
        <style>
            /*            body{
                            text-transform: uppercase;
                        }*/
            input,textarea,select{
                text-transform: uppercase;
            }
        </style>
    </head>
    <body class="page-body">
        <?php $this->beginBody() ?>


        <div class="page-container">
            <div class="sidebar-menu toggle-others fixed collapsed">

                <div class="sidebar-menu-inner">
                    <header class="logo-env">
                        <!-- logo -->
                        <div class="logo">
                            <a href="" class="logo-expanded">
                                <img width="62" height="" src="<?= Yii::$app->homeUrl ?>images/logo.png"/>
                            </a>

                            <a href="" class="logo-collapsed">
                                <img width="40" height="" src="<?= Yii::$app->homeUrl ?>images/fav.png"/>
                            </a>
                        </div>
                        <!-- This will toggle the mobile menu and will be visible only on mobile devices -->
                        <div class="mobile-menu-toggle visible-xs">
                            <a href="" data-toggle="user-info-menu">
                                <i class="fa-bell-o"></i>
                                <span class="badge badge-success">7</span>
                            </a>

                            <a href="" data-toggle="mobile-menu">
                                <i class="fa-bars"></i>
                            </a>
                        </div>
                        <!-- This will open the popup with user profile settings, you can use for any purpose, just be creative -->



                    </header>

                    <ul id="main-menu" class="main-menu">
                        <?php
                        if (Yii::$app->session['post']['admin'] == 1) {
                            ?>
                            <li>
                                <a href="">
                                    <i class="fa fa-tachometer"></i>
                                    <span class="title">Administration</span>
                                </a>
                                <ul>
                                    <li>
                                        <?= Html::a('Access Powers', ['/admin/admin-post/index'], ['class' => 'title']) ?>
                                    </li>
                                    <li>
                                        <?= Html::a('Employees', ['/admin/employee/index'], ['class' => 'title']) ?>
                                    </li>
                                </ul>
                            </li>
                            <?php
                        }
                        ?>



                        <?php
                        if (Yii::$app->session['post']['daily_entry'] == 1) {
                            ?>
                            <li>
                                <a href="">
                                    <i class="fa fa-shopping-bag"></i>
                                    <span class="title">Purchase</span>
                                </a>
                                <ul>
                                    <li>
                                        <?= Html::a('Daily Entry', ['/purchase/daily-entry/index'], ['class' => 'title']) ?>
                                    </li>
                                    <li>
                                        <?= Html::a('Payments', ['/purchase/payment/index'], ['class' => 'title']) ?>
                                    </li>
                                </ul>
                            </li>
                            <?php
                        }
                        ?>

                        <?php
                        if (Yii::$app->session['post']['appointement'] == 1) {
                            ?>
                            <li>
                                <a href="">
                                    <i class="fa fa-file"></i>
                                    <span class="title">Voyage Details</span>
                                </a>
                                <ul>
                                    <li>
                                        <?= Html::a('Voyage Details', ['/appointment/appointment/index'], ['class' => 'title']) ?>
                                    </li>
                                </ul>
                            </li>
                            <?php
                        }
                        ?>

                        <?php
                        if (Yii::$app->session['post']['daily_entry'] == 1) {
                            ?>
                            <li>
                                <a href="">
                                    <i class="fa fa-shopping-cart"></i>
                                    <span class="title">Purchase Order</span>
                                </a>
                                <ul>
                                    <li>
                                        <?= Html::a('Purchase Order', ['/purchaseorder/purchase-order-mst/index'], ['class' => 'title']) ?>
                                    </li>
                                </ul>
                            </li>
                            <?php
                        }
                        ?>

                        <?php
                        if (Yii::$app->session['post']['admin'] == 1) {
                            ?>
                            <li>
                                <a href="">
                                    <i class="fa fa-building-o"></i>
                                    <span class="title">Stock</span>
                                </a>
                                <ul>
                                    <li>
                                        <?= Html::a('Stock Adjustment', ['/stock/stock-adj-dtl/index'], ['class' => 'title']) ?>
                                    </li>
                                    <li>
                                        <?= Html::a('Material Wise Report', ['/stock/material-wise-report/index'], ['class' => 'title']) ?>
                                    </li>
                                </ul>
                            </li>
                            <?php
                        }
                        ?>
                        <?php
                        if (Yii::$app->session['post']['admin'] == 1) {
                            ?>
                            <li>
                                <a href="">
                                    <i class="fa fa-file-o"></i>
                                    <span class="title">Reports</span>
                                </a>
                                <ul>
                                    <li>
                                        <?= Html::a('Daily Wise Report', ['/stock/daily-wise-report/index'], ['class' => 'title']) ?>
                                    </li>
                                    <li>
                                        <?= Html::a('Monthly Report', ['/stock/monthly-report/index'], ['class' => 'title']) ?>
                                    </li>
                                    <li>
                                        <?= Html::a('Transporter Report', ['/reports/transporter-report/index'], ['class' => 'title']) ?>
                                    </li>
                                    <li>
                                        <?= Html::a('Crusher Report', ['/reports/crusher-report/index'], ['class' => 'title']) ?>
                                    </li>
                                </ul>
                            </li>
                            <?php
                        }
                        ?>
                        <?php
                        if (Yii::$app->session['post']['masters'] == 1) {
                            ?>
                            <li>
                                <a href="">
                                    <i class="fa fa-object-group"></i>
                                    <span class="title">Masters</span>
                                </a>
                                <ul>
                                    <li>
                                        <?= Html::a('Service', ['/masters/services/index'], ['class' => 'title']) ?>
                                    </li>
                                    <li>
                                        <?= Html::a('Materials', ['/masters/materials/index'], ['class' => 'title']) ?>
                                    </li>
                                    <li>
                                        <?= Html::a('Ships', ['/masters/ships/index'], ['class' => 'title']) ?>
                                    </li>
                                    <li>
                                        <?= Html::a('Contacts', ['/masters/contacts/index'], ['class' => 'title']) ?>
                                    </li>
                                    <li>
                                        <?= Html::a('Ports', ['/masters/ports/index'], ['class' => 'title']) ?>
                                    </li>


                                    <li>
                                        <?= Html::a('Terminals', ['/masters/terminals/index'], ['class' => 'title']) ?>
                                    </li>
                                    <li>
                                        <?= Html::a('Yards', ['/masters/yard/index'], ['class' => 'title']) ?>
                                    </li>

                                    <li>
                                        <?= Html::a('Units', ['/masters/units/index'], ['class' => 'title']) ?>
                                    </li>
                                    <li>
                                        <?= Html::a('Tax', ['/masters/tax/index'], ['class' => 'title']) ?>
                                    </li>

                                    <!--                                    <li>
                                    <?php // Html::a('Service Category', ['/masters/service-category/index'], ['class' => 'title']) ?>
                                                                        </li>-->
                                    <li>
                                        <?= Html::a('Transaction Category', ['/masters/transaction-category/index'], ['class' => 'title']) ?>
                                    </li>
                                    <li>
                                        <?= Html::a('Financial Years', ['/masters/financial-years/index'], ['class' => 'title']) ?>
                                    </li>
                                    <li>
                                        <?= Html::a('Currency', ['/masters/currency/index'], ['class' => 'title']) ?>
                                    </li>
                                    <li>
                                        <?= Html::a('Serial Numbers', ['/masters/serial-numbers/index'], ['class' => 'title']) ?>
                                    </li>
                                </ul>
                            </li>
                            <?php
                        }
                        ?>
                        <?php
                        if (Yii::$app->session['post']['admin'] == 1) {
                            ?>
                            <li>
                                <a href="">
                                    <i class="fa fa-cogs"></i>
                                    <span class="title">Settings</span>
                                </a>
                                <ul>
                                    <li>
                                        <?= Html::a('Bank Details', ['/settings/bank-details/index'], ['class' => 'title']) ?>
                                    </li>
                                </ul>
                            </li>
                            <?php
                        }
                        ?>
                        <?php
                        if (Yii::$app->session['post']['admin'] == 1) {
                            ?>
                            <li>
                                <a href="">
                                    <i class="fa fa-outdent"></i>
                                    <span class="title">HR Management</span>
                                </a>
                                <ul>
                                    <li>
                                        <?= Html::a('Add Country', ['/hr/country/index'], ['class' => 'title']) ?>
                                    </li>
                                    <li>
                                        <?= Html::a('Certificate Type', ['/hr/certificate-type/index'], ['class' => 'title']) ?>
                                    </li>
                                    <li>
                                        <?= Html::a('Add Crew', ['/hr/crew-information/index'], ['class' => 'title']) ?>
                                    </li>
                                </ul>
                            </li>
                            <?php
                        }
                        ?>
                    </ul>

                </div>

            </div>

            <div class="main-content">

                <nav class="navbar user-info-navbar"  role="navigation"><!-- User Info, Notifications and Menu Bar -->

                    <!-- Left links for user info navbar -->
                    <ul class="user-info-menu left-links list-inline list-unstyled">

                        <li class="hidden-sm hidden-xs">
                            <a href="" data-toggle="sidebar">
                                <i class="fa-bars"></i>
                            </a>
                        </li>
                        <?php
                        $notifications = \common\models\Notifications::find()->where(['status' => 1])->orderBy(['sort_order' => SORT_DESC])->limit(10)->all();
                        $notification_count = \common\models\Notifications::find()->where(['status' => 1])->count();
                        ?>
                        <li class="dropdown hover-line hover-line-notify" style="min-height: 48px;">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" title="Notifications">
                                <i class="fa-bell-o"></i>
                                <!--<span class="badge badge-purple" id="notify-count"></span>-->
                                <span class="badge badge-purple" id="notify-count"><?= $notification_count ?></span>
                            </a>
                            <ul class="dropdown-menu notifications">
                                <li class="top">
                                    <p class="small">
                                        <!--                                        <a href="#" class="pull-right">Mark all Read</a>-->
                                        You have <strong id="notify-counts"><?= $notification_count ?></strong> new notifications.
                                    </p>
                                </li>
                                <li>
                                    <ul class="dropdown-menu-list list-unstyled ps-scrollbar ps-container">
                                        <?php
                                        foreach ($notifications as $value) {
                                            ?>
                                            <li class="active notification-success" id="notify-<?= $value->id ?>">
                                                <a href="#">
                                                    <i class="fa fa-envelope-o"></i>

                                                    <span class="line">
                                                        <strong style="line-height: 16px;"><?= $value->content ?></strong>
                                                    </span>
                                                    <input type="checkbox" checked="" class="iswitch iswitch-secondary disable-notification" data-id= "<?= $value->id ?>" style="margin-top: -25px;float: right;">
                                                </a>
                                            </li>
                                            <?php
                                        }
                                        ?>

                                        <div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 3px;"><div class="ps-scrollbar-x" style="left: 0px; width: 0px;"></div></div><div class="ps-scrollbar-y-rail" style="top: 0px; right: 2px;"><div class="ps-scrollbar-y" style="top: 0px; height: 0px;"></div></div></ul>
                                </li>

                                <li class="external">
                                    <?= Html::a('<span>View all notifications</span> <i class="fa-link-ext"></i>', ['/notification/notifications']) ?>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <!-- Right links for user info navbar -->
                    <ul class="user-info-menu right-links list-inline list-unstyled">

                        <li>
                            <a href="<?= Yii::$app->homeUrl; ?>site/home"><i class="fa-home"></i> Home</a>
                        </li>

                        <li class="dropdown user-profile">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="<?= yii::$app->homeUrl; ?>images/user-4.png" alt="user-image" class="img-circle img-inline userpic-32" width="28" />
                                <span>
                                    <?= Yii::$app->user->identity->user_name ?>
                                    <i class="fa-angle-down"></i>
                                </span>
                            </a>

                            <ul class="dropdown-menu user-profile-menu list-unstyled">
                                <li class="user-header">
                                    <img src="<?= yii::$app->homeUrl; ?>images/user-4.png" alt="user-image" class="img-circle" />
                                    <p>
                                        <?= Yii::$app->user->identity->name ?>
                                        <!--<small>Member since Nov. 2012</small>-->
                                    </p>
                                </li>
                                <li class="user-footer" style="background: #eeeeee;">
                                    <div class="row">
                                        <div class="pull-left">
                                            <?= Html::a('Profile', ['/admin/employee/update?id=' . Yii::$app->user->identity->id], ['class' => 'btn btn-white', 'style' => 'padding: 9px 20px;border: 1px solid #a09f9f;']) ?>
                                        </div>
                                        <div class="pull-right">
                                            <?php
                                            echo ''
                                            . Html::beginForm(['/site/logout'], 'post', ['style' => 'margin-bottom: 0px;']) . '<a>'
                                            . Html::submitButton(
                                                    'Sign out', ['class' => 'btn btn-white', 'style' => 'border: 1px solid #a09f9f;']
                                            ) . '</a>'
                                            . Html::endForm()
                                            . '';
                                            ?>
                                        </div>
                                    </div>
                                </li>
                                <!--                                <li>
                                <?php // Html::a('<i class="fa-wrench"></i>Change Password', ['/admin/admin-users/change-password'], ['class' => 'title']) ?>
                                                                </li>
                                                                <li>
                                <?php // Html::a('<i class="fa-pencil"></i>Edit Profile', ['/admin/admin-users/update?id=' . Yii::$app->user->identity->id], ['class' => 'title']) ?>
                                                                </li>-->

                                <?php
//                                echo '<li class="last">'
//                                . Html::beginForm(['/site/logout'], 'post') . '<a>'
//                                . Html::submitButton(
//                                        '<i class="fa-lock"></i> Logout', ['class' => 'btn logout_btn']
//                                ) . '</a>'
//                                . Html::endForm()
//                                . '</li>';
                                ?>


                            </ul>
                        </li>

                    </ul>

                </nav>
                <div class="row">


                    <?= $content; ?>


                </div>
                <footer class="main-footer sticky footer-type-1">

                    <div class="footer-inner">

                        <!-- Add your copyright text here -->
                        <div class="footer-text">
                            &copy; <?= Html::encode(date('Y')) ?>
                            <strong>Azryah</strong>
                            All rights reserved.
                        </div>


                        <!-- Go to Top Link, just add rel="go-top" to any link to add this functionality -->
                        <div class="go-up">

                            <a href="#" rel="go-top">
                                <i class="fa-angle-up"></i>
                            </a>

                        </div>

                    </div>

                </footer>
            </div>




        </div>

        <div class="footer-sticked-chat"><!-- Start: Footer Sticked Chat -->

            <script type="text/javascript">
                function toggleSampleChatWindow()
                {
                    var $chat_win = jQuery("#sample-chat-window");

                    $chat_win.toggleClass('open');

                    if ($chat_win.hasClass('open'))
                    {
                        var $messages = $chat_win.find('.ps-scrollbar');

                        if ($.isFunction($.fn.perfectScrollbar))
                        {
                            $messages.perfectScrollbar('destroy');

                            setTimeout(function () {
                                $messages.perfectScrollbar();
                                $chat_win.find('.form-control').focus();
                            }, 300);
                        }
                    }

                    jQuery("#sample-chat-window form").on('submit', function (ev)
                    {
                        ev.preventDefault();
                    });
                }

                jQuery(document).ready(function ($)
                {
                    $(".footer-sticked-chat .chat-user, .other-conversations-list a").on('click', function (ev)
                    {
                        ev.preventDefault();
                        toggleSampleChatWindow();
                    });

                    $(".mobile-chat-toggle").on('click', function (ev)
                    {
                        ev.preventDefault();

                        $(".footer-sticked-chat").toggleClass('mobile-is-visible');
                    });
//                    $(document).on('click', '.notification-line', function (e) {
//                        var idd = $(this).attr('id');
//                        window.location.href = '<?php // Yii::$app->homeUrl;             ?>appointment/appointment/view?id=' + idd;
//                    });
                });
            </script>



            <a href="#" class="mobile-chat-toggle">
                <i class="linecons-comment"></i>
                <span class="num">6</span>
                <span class="badge badge-purple">4</span>
            </a>

            <!-- End: Footer Sticked Chat -->
        </div>






        <!-- Imported styles on this page -->
        <link rel="stylesheet" href="<?= Yii::$app->homeUrl; ?>css/fonts/meteocons/css/meteocons.css">

        <!-- Bottom Scripts -->



        <!-- JavaScripts initializations and stuff -->
        <script src="<?= Yii::$app->homeUrl; ?>js/xenon-custom.js"></script>
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
<script>
                jQuery(document).ready(function ($) {
                    setInterval(Notifications, 12000);
//                    Notifications();
                    $(document).on('change', '.disable-notification', function (e) {
                        var idd = $(this).attr('data-id');
                        var count = $('#notify-count').text();
                        $.ajax({
                            type: 'POST',
                            cache: false,
                            async: false,
                            data: {id: idd},
                            url: '<?= Yii::$app->homeUrl; ?>ajax-notification/update-notification',
                            success: function (data) {
                                $(".hover-line-notify").addClass("open");
                                var res = $.parseJSON(data);
                                $('#notify-' + idd).fadeOut(750, function () {
                                    $(this).remove();
                                });
                                $('#notify-count').text(count - 1);
                                $('#notify-counts').text(count - 1);
                                if (data != 1) {
                                    var next_row = '<li class="active notification-success" id="notify-' + res.result["id"] + '" >\n\
                                <a href="#">\n\
                                                    <span class="line notification-line" style="width: 85%;padding-left: 0;cursor:pointer" id ="' + res.result["id"] + '" >\n\
                                                        <strong style="line-height: 20px;">' + res.result["content"] + '</strong>\n\
                                                    </span>\n\
                                                    <span class="line small time" style="padding-left: 0;">' + res.result["date"] + '\n\
                                                    </span>\n\
                                                    <input type="checkbox" checked="" class="iswitch iswitch-secondary disable-notification" data-id= "' + res.result["id"] + '" style="margin-top: -35px;float: right;" title="Ignore">\n\
                                                </a>\n\
                                </li>';
                                    $(".dropdown-menu-list-notify").append(next_row);
                                }
                                e.preventDefault();
                            }
                        });
                    });
                });
                function Notifications() {
                    $.ajax({
                        type: 'POST',
                        cache: false,
                        async: false,
                        data: {},
                        url: '<?= Yii::$app->homeUrl; ?>ajax-notification/notifications',
                        success: function (data) {
                            e.preventDefault();
                        }
                    });
                }
</script>