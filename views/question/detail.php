<?
use app\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;
?>

<div class="col-md-1"></div>
<div class="col-md-10 center-block">
    <section class="content">

        <div class="row">
            <div class="col-md-3">

                <!-- Profile Image -->
                <div class="box box-primary">
                    <div class="box-body box-profile">
                        <img class="profile-user-img img-responsive img-circle" src="/img/user4-128x128.jpg" alt="User profile picture">

                        <h3 class="profile-username text-center"><?=User::findIdentity($question->userId)->username?></h3>

                        <p class="text-muted text-center">Software Engineer</p>

                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b>Проголосувало</b> <a class="pull-right"><?=$question->countUser?></a>
                            </li>
                            <li class="list-group-item">
                                <b>За</b> <a class="pull-right"><?=$question->agree?></a>
                            </li>
                            <li class="list-group-item">
                                <b>Байдуже</b> <a class="pull-right"><?=$question->stop?></a>
                            </li>
                            <li class="list-group-item">
                                <b>Проти</b> <a class="pull-right"><?=$question->against?></a>
                            </li>
                        </ul>
                        <?= Html::a('На головну', Url::to('index'), ['class' => 'btn btn-primary btn-block']); ?>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="nav-tabs-custom">
                    <div class="tab-content">
                        <div class="tab-pane active" id="activity">
                            <!-- Post -->
                            <div class="post">
                                <div class="user-block">
                                    <img class="img-circle img-bordered-sm" src="/img/user1-128x128.jpg" alt="user image">
                                    <span class="username">
                                        <a href="#">Адміністратор</a>
                                    </span>
                                    <span class="description">Віддай свій голос за найкращого.</span>
                                </div>
                                <!-- /.user-block -->
                                <p>
                                    <?=$question->title ?>
                                </p>
                                <div class="box box-default color-palette-box">
                                    <div class="box-header with-border">

                                    </div>
                                    <div class="box-body">
                                        <div class="row">
                                            <a href="<?=Url::to(['question/vote', 'id' => $question->hash, 'status' => 'agree'])?>" >
                                                <div class="col-md-4">
                                                    <div class="info-box bg-green">
                                                        <span class="info-box-icon"><i class="fa fa-thumbs-o-up"></i></span>

                                                        <div class="info-box-content">
                                                            <span class="info-box-text">Погоджуюсь</span>
                                                            <span class="info-box-number"><?=$question->agree?></span>

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
                                            <a href="<?=Url::to(['question/vote', 'id' => $question->hash, 'status' => 'stop'])?>" >
                                                <div class="col-md-4 col-sm-6 col-xs-12" >
                                                    <div class="info-box bg-yellow">
                                                        <span class="info-box-icon"><i class="fa fa-hand-paper-o    "></i></span>

                                                        <div class="info-box-content">
                                                            <span class="info-box-text">Утримуюсь</span>
                                                            <span class="info-box-number"><?=$question->stop?></span>

                                                            <div class="progress">
                                                                <div class="progress-bar" style="width: 70%"></div>
                                                            </div>
                                                            <span class="progress-description">
                                                                70% утрималось
                                                            </span>
                                                        </div>
                                                        <!-- /.info-box-content -->
                                                    </div>
                                                    <!-- /.info-box -->
                                                </div>
                                            </a>
                                            <a href="<?=Url::to(['question/vote', 'id' => $question->hash, 'status' => 'against'])?>" >
                                                <div class="col-md-4 col-sm-6 col-xs-12">
                                                    <div class="info-box bg-red">
                                                        <span class="info-box-icon"><i class="fa  fa-thumbs-o-down"></i></span>

                                                        <div class="info-box-content">
                                                            <span class="info-box-text">Проти</span>
                                                            <span class="info-box-number"><?=$question->against?></span>

                                                            <div class="progress">
                                                                <div class="progress-bar" style="width: 70%"></div>
                                                            </div>
                                                            <span class="progress-description">
                                                                70% проти
                                                            </span>
                                                        </div>
                                                        <!-- /.info-box-content -->
                                                    </div>
                                                    <!-- /.info-box -->
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>


                                <ul class="list-inline">
                                    <li><a href="#" class="link-black text-sm"><i class="fa fa-share margin-r-5"></i> Дізлайк</a></li>
                                    <li><a href="#" class="link-black text-sm"><i class="fa fa-thumbs-o-up margin-r-5"></i> Лайк</a>
                                    </li>
                                </ul>
                            </div>
                            <!-- /.post -->

                        </div>
                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

    </section>
</div>
<div class="col-md-1"></div>