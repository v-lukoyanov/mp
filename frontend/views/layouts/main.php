<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use frontend\widgets\Alert;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
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
                'brandLabel' => Yii::t('frontend','MeetingPlanner.io'), //
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            if (Yii::$app->user->isGuest) {
                $menuItems[] = ['label' => Yii::t('frontend','Signup'), 'url' => ['/site/signup']];
                $menuItems[] = ['label' => Yii::t('frontend','Login'), 'url' => ['/site/login']];
            } else {
	            $menuItems = [
                  ['label' => Yii::t('frontend','Meetings'), 'url' => ['/meeting']],
	                ['label' => Yii::t('frontend','Places'), 'url' => ['/place/yours']],
	            ];
            }
      			if (Yii::$app->user->isGuest) {
              $menuItems[]=['label' => Yii::t('frontend','Help'),
                'items' => [
                  ['label' => Yii::t('frontend','Support'), 'url' => 'http://support.meetingplanner.io'],
                  ['label' => Yii::t('frontend','About'), 'url' => ['/site/about']],
                ],
              ];
              echo Nav::widget([
                  'options' => ['class' => 'navbar-nav navbar-right'],
                  'items' => $menuItems,
              ]);
            } else {

      				$menuItems[] = [
      				            'label' => 'Account',
      				            'items' => [
    				                 [
    				                    'label' => Yii::t('frontend','Friends'),
    				                    'url' => ['/friend'],
    				                ],
      				                 [
                                 'label' => Yii::t('frontend','Profile'),
                                 'url' => ['/user-profile'],
                             ],
                             [
                                'label' => Yii::t('frontend','Contact information'),
                                'url' => ['/user-contact'],
                            ],
                            [
                               'label' => Yii::t('frontend','Settings'),
                               'url' => ['/user-setting'],
                           ],
                           [
                              'label' => Yii::t('frontend','Reminders'),
                              'url' => ['/reminder'],
                          ],
      				                 [
      				                    'label' => Yii::t('frontend','Logout').' (' . Yii::$app->user->identity->username . ')',
      				                    'url' => ['/site/logout'],
      				                    'linkOptions' => ['data-method' => 'post']
      				                ],
      				            ],
      				        ];
                      echo Nav::widget([
                          'options' => ['class' => 'navbar-nav navbar-right'],
                          'items' => $menuItems,
                      ]);
      			}
            NavBar::end();
        ?>

        <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
          <p class="pull-left">
          <?php
          if (!Yii::$app->user->isGuest) {
            echo Html::a(Yii::t('frontend','Support'),Url::to('http://support.meetingplanner.io')).' | ';
            echo Html::a(Yii::t('frontend','About'),Url::to(['/site/about']));
          }
           ?>
        <p class="pull-right">
        <?= Html::a(Yii::t('frontend','Follow').' @meetingio','https://twitter.com/intent/user?screen_name=meetingio') ?><?php
        if (!Yii::$app->user->isGuest) {
          echo '&nbsp;|&nbsp;'.Html::a('&copy; Lookahead '.date('Y'),'http://lookahead.io').'';
        }
        ?>
        </p>
        </div>
    </footer>

    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
