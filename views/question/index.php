<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\widgets\LinkPager;


$this->title = 'Опитування';
?>



<div class="row">
    <div class="col-md-10"></div>
    <div class="col-md-2 right">
        <div class="form-group">
            <select class="form-control">
                <option>останні</option>
                <option>популярні</option>
                <option>мої</option>
            </select>
        </div>
    </div>
</div>

<div class="row">
    <? foreach ($param['models'] as $one): ?>
        <?= $this->render('template', [
            'one' => $one,
        ]) ?>
    <? endforeach; ?>

    <?= LinkPager::widget([
        'pagination' => $param['pages'],
    ]);
    ?>
</div>



<div class="modal fade" id="addQuestion">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Створити опитування</h4>
            </div>

            <?php $form = ActiveForm::begin(); ?>
                <div class="modal-body">
                    <?= $form
                        ->field($model, 'title')
                        ->label(false)
                        ->textArea(['placeholder' => 'Заголовок опитування']) ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Відмінити</button>
                    <?= Html::submitButton('Зберегти', ['class' => 'btn btn-primary']) ?>
                </div>
            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>
