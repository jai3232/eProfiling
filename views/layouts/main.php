<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'eProfiling',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            [
             'label' => Yii::t('app','Home'), 'url' => ['/site/index'],
             'visible' => Yii::$app->user->isGuest 
            ],
            [
             'label' => Yii::t('app','Home'), 'url' => ['/site/login'],
             'visible' => !Yii::$app->user->isGuest 
            ],
            //['label' => 'Agensi', 'url' => ['/agensi/index']],
            [
            'label' => 'Agensi',
            'visible' => !Yii::$app->user->isGuest,
            'items' => [
                 ['label' => 'Senarai', 'url' => ['/agensi/index']],
                 '<li class="divider"></li>',
                 //'<li class="dropdown-header">Dropdown Header</li>',
                 ['label' => 'Bidang', 'url' => ['/bidang/index']],
            ],
            ],
            //['label' => 'About', 'url' => ['/site/about']],
            //['label' => 'Contact', 'url' => ['/site/contact']],
            ['label' => 'Pengajar',
             'visible' => !Yii::$app->user->isGuest,
             'items' => [
                //['label' => 'Personal', 'url' => ['/personal/info']],
                ['label' => 'Admin', 'url' => ['/personal/index'/*, 'sort' => '-id_personal'*/], 'visible' => !Yii::$app->user->isGuest? Yii::$app->user->identity->accessLevel([0, 1, 2, 3]) : false],
                ['label' => 'Personal', 'url' => ['/personal/info']],
             ],
            ],
            [
                'label' => 'Penilaian',
                'visible' => !Yii::$app->user->isGuest,
                'items' => [
                    ['label' => 'Profail', 'url' => ['penilaian-profil/index']],
                    ['label' => 'Penyelia', 'url' => '#']
                ]
            ],
            [
                'label' => 'Laporan',
                'visible' => !Yii::$app->user->isGuest,
                'items' => [
                    ['label' => 'Abiliy Map Pengajar', 'url' => ['/laporan/pengajar-h-o-d']]
                ]
            ],
            [
                'label' => 'Muat Turun',
                'url' => 'downloads',
            ],
            Yii::$app->user->isGuest ? (
                ['label' => 'Login', 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->nama . ')',
                    ['class' => 'btn btn-link']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            'homeLink' => false,
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; CIAST <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
