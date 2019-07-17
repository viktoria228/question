<?
use app\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
?>

<div class="col-md-6">
    <!-- Box Comment -->
    <div class="box box-widget">
        <div class="box-header with-border">
            <div class="user-block">
                <img class="img-circle" src="/img/user1-128x128.jpg" alt="User Image">
                <span class="username"><a href="#"><?=User::findIdentity($one->userId)->username?></a></span>
                <span class="description">Створив опитування - 10/15/2202 о 7:30 </span>
            </div>
            <!-- /.user-block -->
            <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="Mark as read">
                    <i class="fa fa-circle-o"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
            <!-- /.box-tools -->
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <!-- post text -->
            <p><?=$one->title?></p>

            <!-- Social sharing buttons -->
            <button type="button" class="btn btn-default btn-xs"><i class="fa fa-share"></i> Дізлайк</button>
            <button type="button" class="btn btn-default btn-xs"><i class="fa fa-thumbs-o-up"></i> Лайк</button>
            <span class="pull-right text-muted"><?=$one->likes?> Лайків - <?=$one->dislikes?> Дізлайків</span>
            <?= Html::a('Прийняти участь в опитуванні', Url::to(['question/detail', 'id' => $one->id]), ['class' => 'btn btn-success btn-xs']); ?>
        </div>
    </div>
</div>