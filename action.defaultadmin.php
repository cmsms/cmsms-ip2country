<?php
/**
 * Date: 04/02/14
 * Time: 17:18
 * Author: Jean-Christophe Cuvelier <jcc@morris-chapman.com>
 */
/** @var $this IP2Country */
if (!cmsms()) {
    exit;
}
if (!$this->CheckAccess()) {
    exit;
}

$form = new CMSForm($this->GetName(), $id, 'defaultadmin', $returnid);
$form->setButtons(array('submit'));
$form->setLabel('submit', $this->Lang('import'));
$form->setWidget('csv', 'file', array('label' => $this->Lang('CSV to import'), 'tips' => $this->Lang('MaxMind_info')));

if ($form->isSent()) {
    $form->process();

    if ($form->isValid()) {
        $file = $form->getWidget('csv')->getWidget()->getUploadedFile();

        if ($file) {

            IPRange::deleteTable();
            IPRange::createTable();

            if (($handle = fopen($file['tmp_name'], "r")) !== false) {

                while (($data = fgetcsv($handle)) !== false) {
                    if (count($data) == 6 && $data[0] != 'beginIp') {
                        $range = new IPRange();
                        $range->setBeginIp($data[0]);
                        $range->setEndIp($data[1]);
                        $range->setBeginIpNum($data[2]);
                        $range->setEndIpNum($data[3]);
                        $range->setCountryCode($data[4]);
                        $range->setCountryName($data[5]);
                        $range->save();
                    }
                }

                fclose($handle);
                $this->Redirect($id, 'defaultadmin', $returnid);
            }
        }
    }
}
$IP = $_SERVER['REMOTE_ADDR'];

echo $this->Lang('you_come_from', IPRange::getCountryNameFromIP($IP), $IP);

echo '<hr />';

$count = IPRange::doCount(new MCFCriteria());

echo $this->Lang('ip_ranges_in_database', $count);
echo '<hr />' . $form->render();



