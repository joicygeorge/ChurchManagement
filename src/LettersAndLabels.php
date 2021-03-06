<?php
/*******************************************************************************
 *
 *  filename    : LettersAndLabels.php
 *  website     : http://www.churchcrm.io
 *
 *  Contributors:
 *  2006 Ed Davis
 *
 *
 *  Copyright 2006 Contributors
 *
 *  ChurchCRM is free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  This file best viewed in a text editor with tabs stops set to 4 characters
 *
 ******************************************************************************/

// Include the function library
require 'Include/Config.php';
require 'Include/Functions.php';
require 'Include/LabelFunctions.php';

use ChurchCRM\Utils\InputUtils;

// Set the page title and include HTML header
$sPageTitle = gettext('Letters and Mailing Labels');
require 'Include/Header.php';

// Is this the second pass?
if (isset($_POST['SubmitNewsLetter']) || isset($_POST['SubmitConfirmReport']) || isset($_POST['SubmitConfirmLabels']) || isset($_POST['SubmitConfirmReportEmail'])) {
    $sLabelFormat = InputUtils::LegacyFilterInput($_POST['labeltype']);
    $sFontInfo = $_POST['labelfont'];
    $sFontSize = $_POST['labelfontsize'];
    $sLabelInfo = '&labelfont='.urlencode($sFontInfo).'&labelfontsize='.$sFontSize;

    if (isset($_POST['SubmitNewsLetter'])) {
        Redirect('Reports/NewsLetterLabels.php?labeltype='.$sLabelFormat.$sLabelInfo);
    } elseif (isset($_POST['SubmitConfirmReport'])) {
        Redirect('Reports/ConfirmReport.php');
    } elseif (isset($_POST['SubmitConfirmReportEmail'])) {
        Redirect('Reports/ConfirmReportEmail.php');
    } elseif (isset($_POST['SubmitConfirmLabels'])) {
        Redirect('Reports/ConfirmLabels.php?labeltype='.$sLabelFormat.$sLabelInfo);
    }
} else {
    $sLabelFormat = 'Tractor';
}
?>
<div class="row">
  <div class="col-lg-12">
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title"><?= gettext('Member Reports')?></h3>
      </div>
      <div class="box-body">
        <form method="post" action="LettersAndLabels.php">
            <div class="table-responsive">

          <table class="table" cellpadding="3" align="left">
<?php
LabelSelect('labeltype');
FontSelect('labelfont');
FontSizeSelect('labelfontsize');
?>

          </table>
            </div>
            <div>
              <input type="submit" class="btn" name="SubmitNewsLetter" value="<?= gettext('Newsletter labels') ?>">
              <input type="submit" class="btn" name="SubmitConfirmReport" value="<?= gettext('Confirm data letter') ?>">
              <input type="submit" class="btn" name="SubmitConfirmReportEmail" value="<?= gettext('Confirm data Email') ?>">
              <input type="submit" class="btn" name="SubmitConfirmLabels" value="<?= gettext('Confirm data labels') ?>">
              <input type="button" class="btn" name="Cancel" value="<?= gettext('Cancel') ?>" onclick="javascript:document.location = 'Menu.php';">
            </div>



        </form>
      </div>
    </div>
  </div>
</div>

<?php require 'Include/Footer.php' ?>
