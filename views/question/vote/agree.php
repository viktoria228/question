<?
use yii\helpers\Url;
?>

<a href="<?=Url::to(['question/agree', 'id' => 5])?>" >
    <div class="col-md-4">
        <div class="info-box bg-green">
            <span class="info-box-icon"><i class="fa fa-thumbs-o-up"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Погоджуюсь</span>
                <span class="info-box-number"><?=$count?></span>

                <div class="progress">
                    <div class="progress-bar" style="width: 70%"></div>
                </div>
                <span class="progress-description">
                                                                    70% погодилось
                                                                </span>
            </div>
            <!-- /.info-box-content -->
        </div>
    </div>
</a>