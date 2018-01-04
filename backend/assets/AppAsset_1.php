<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle {

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'http://fonts.googleapis.com/css?family=Arimo:400,700,400italic',
        'css/fonts/linecons/css/linecons.css',
        'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css',
        'css/bootstrap.css',
        'css/xenon-core.css',
        'css/xenon-forms.css',
        'css/xenon-components.css',
        'css/xenon-skins.css',
        'css/custom.css',
    ];
    public $js = [
        'js/bootstrap.min.js',
        'js/TweenMax.min.js',
        'js/resizeable.js',
        'js/joinable.js',
        'js/xenon-api.js',
        'js/xenon-toggles.js',
        'js/xenon-widgets.js',
        'js/devexpress-web-14.1/js/globalize.min.js',
        'js/devexpress-web-14.1/js/dx.chartjs.js',
        'js/toastr/toastr.min.js',
        'js/xenon-custom.js',
        'js/script.js',
        'js/enquiry.js',
        'js/staff.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

}
