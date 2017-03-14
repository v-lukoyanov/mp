<?php
use yii\helpers\Html;
use frontend\assets\CalendarAsset;
use common\components\MiscHelpers;
  CalendarAsset::register($this);
  $start_day = time();
  $current_time = $start_day;
  $start_hour = 0;
  $numberOfDays=30;
  $current_hour = date('G');
  $days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday','Thursday','Friday', 'Saturday'];
  $zone =new \DateTimeZone('America/Los_Angeles');
  $todayStart = new \DateTime('today midnight', $zone);
  $midnight = $todayStart->getTimestamp();
?>
<div class="tz_success" id="tz_success">
  <div id="w4-tz-success" class="alert-success alert fade in">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <?= Yii::t('frontend','Your timezone has been updated successfully.') ?>
  </div>
</div>
<div class="tz_warning" id="tz_alert">
  <div id="w4-tz-info" class="alert-info alert fade in">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <?= Yii::t('frontend','Would you like us to change your timezone setting to <span id="tz_new"></span>?') ?>
  </div>
</div>
<div class="meeting-time-form">
<div class="calendarContainer">
    <div id="dialog-form" title="Select Dates and Times">
        <div class="calendarChooser">
        <table >
            <thead>
              <tr>
                <th></th> <!-- time column -->
                <?php
                  // create the header row
                  $dayStamp = $midnight;

                  for ($index_day=1; $index_day<$numberOfDays; $index_day++) {
                ?>
                  <th>
                    <div class="nameMonth"><?= date('M',$dayStamp);?></div>
                    <div class="dayOfMonth"><?= date('j',$dayStamp);?></div>
                    <?= $days[date('w',$dayStamp)];?>
                  </th>
                <?php
                  $dayStamp+=24*3600;
                }
                ?>
              </tr>
            </thead>
            <tbody>
            <?php
              for($hour_index=7;$hour_index<24;$hour_index++) {
                $hourStamp = $midnight+($hour_index*3600);
                $adjHourStamp=$hourStamp-9*3600;
                ?>
                <tr>
                  <td class="hourOfDay">
                    <?php
                      if ($hour_index>12) {
                        echo ($hour_index-12).' pm';
                      } else if ($hour_index==12) {
                        echo '12 pm';
                      } else {
                        echo ($hour_index).' am';
                      }
                     ?>
                  </td>
                  <?php
                  $cellStamp=$hourStamp;
                  for ($index_day=1; $index_day<$numberOfDays;$index_day++) {
                    ?>
                    <td>
                      <div id="c_<?= $cellStamp ?>" class="dayCell"></div> <!-- .'_'.$hour_index -->
                      <div id="c_<?= ($cellStamp+900) ?>" class="dayCell"></div>
                      <div id="c_<?= ($cellStamp+1800) ?>" class="dayCell"></div>
                      <div id="c_<?= ($cellStamp+2700) ?>" class="dayCell"></div>
                    </td>
                    <?php
                    $cellStamp+=24*3600;
                  }
                  ?>
              <?php
                }
              ?>
                </tr>
            </tbody>
          </table>
        </div> <!-- calendarChooser -->
            <!-- Allow form submission with keyboard without duplicating the dialog button -->
            <input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
        </div>

</div> <!-- calendarContainer -->
</div> <!-- end container -->
