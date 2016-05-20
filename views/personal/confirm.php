<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Peribadi */
/* @var $form yii\widgets\ActiveForm */

if(isset($status)) {
    switch($status) {
        case 0:
            echo "Tiada dalam rekod";
            break;
        case 1:
            echo "Pengesahan pendaftaran berjaya.";
            break;
        case 2:
            echo "<h4>Pengesahan sudah dilakukan.</h4>";
            break;
    }
}
else {
?>

<div class="peribadi-form">

    <?= Html::beginForm(['personal/confirm'], 'get') ?>
    
    <div class="form-group">
        <?= Html::label('Kod Pengesahan', 'code'); ?>
        <?= Html::textInput('code','', ['class' => 'form-control']) ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Sahkan pendaftaran', ['class' => 'btn btn-primary']) ?>
    </div>

    <?= Html::endForm(); ?>

</div>
<?php } ?>