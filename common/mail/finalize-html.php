<?php
use yii\helpers\Html;
use yii\helpers\Url;
use common\components\MiscHelpers;
use frontend\models\Meeting;
use frontend\models\MeetingNote;
use frontend\models\MeetingPlace;
use frontend\models\MeetingTime;
/* @var $this \yii\web\View view component instance */
/* @var $message \yii\mail\BaseMessage instance of newly created mail message */
?>
<table  cellpadding="0" cellspacing="10" border="0" align="center" width="600">
  <tr>
    <td colspan="2">
      <p><em>Hi, <?php echo $owner; ?> is inviting you to an event using a new service called <?php echo HTML::a(Yii::t('frontend','Meeting Planner'),MiscHelpers::buildCommand($meeting_id,Meeting::COMMAND_HOME,0,$user_id,$auth_key)); ?>. The service makes it easy to plan meetings without the exhausting threads of repetitive emails. Please try it out below.</em></p>
      <p><?php echo $intro; ?></p>
      <p> <?php echo HTML::a(Yii::t('frontend','Visit the Meeting page'),$links['view']); ?>
        | <?php echo HTML::a(Yii::t('frontend','Cancel meeting'),$links['cancel']); ?></p>      
    </td>
  </tr>
  <?php
  if (!$noPlaces) {
  ?>
    <tr style="border-bottom:1px solid #ccc;">
      <td width="300"><strong>Where</strong></td>
      <td width="300" >
      </td>
    </tr>
      <tr>
        <td colspan="2">
          <p>
          <?php echo $chosenPlace->place->name; ?>
          <br/ >
          <span style="font-size:75%;"><?php echo $chosenPlace->place->vicinity; ?> <?php echo HTML::a(Yii::t('frontend','view map'),
          MiscHelpers::buildCommand($meeting_id,Meeting::COMMAND_VIEW_MAP,$chosenPlace->id,$user_id,$auth_key)); ?></span>
        </p>
      </td>
      </tr>
    <tr>
      <td width="300"><br /></td><td width="300"></td>
    </tr>
    <?php
      }
      ?>
  <tr style="border-bottom:1px solid #ccc;">
    <td width="300">
      <strong>When</strong><br />
    </td>
      <td width="300" >

      </td>
  </tr>
    <tr>
      <td colspan="2">
        <p><?php echo Meeting::friendlyDateFromTimestamp($chosenTime->start); ?></p>
      </td>
      </tr>
  <tr>
    <td width="300"><br /></td><td width="300"></td>
  </tr>
<?php
  if (count($notes)>0) {
    ?>
      <tr style="border-bottom:1px solid #ccc;">
        <td width="300" ><strong>Notes</strong></td>
        <td width="300" >
            <?php echo HTML::a(Yii::t('frontend','add a note'),$links['addnote']); ?>
        </td>
      </tr>
<?php
  foreach($notes as $n) {
    ?>
    <tr>
      <td colspan="2">
        <p><em><?php echo $n->postedBy->email; ?> says: </em>
        "<?php echo $n->note; ?>"
      </p><br/ >
      </td>
    </tr>
        <?php
      }
  ?>
</table>
  <?php
  }
  ?>
<table  cellpadding="0" cellspacing="10" border="0" align="center" width="600">
  <tr><td width="300" style="text-align:center;margin:10px;">
<p>
  <?php echo Html::a(Yii::t('frontend','Visit Meeting Planner'), MiscHelpers::buildCommand($meeting_id,Meeting::COMMAND_HOME,0,$user_id,$auth_key)); ?>
</p>
</td></tr>
<tr><td width="300" style="text-align:center;font-size:75%;margin:10px;">
  <em>
    <?php echo HTML::a(Yii::t('frontend','Review your email settings'),MiscHelpers::buildCommand($meeting_id,Meeting::COMMAND_FOOTER_EMAIL,0,$user_id,$auth_key)); ?>
    | <?php echo HTML::a(Yii::t('frontend','Block this person'),MiscHelpers::buildCommand($meeting_id,Meeting::COMMAND_FOOTER_BLOCK,$sender_id,$user_id,$auth_key)); ?>
    | <?php echo HTML::a(Yii::t('frontend','Block all emails'),MiscHelpers::buildCommand($meeting_id,Meeting::COMMAND_FOOTER_BLOCK_ALL,0,$user_id,$auth_key)); ?>
  </em>
</td></tr>
</table>
