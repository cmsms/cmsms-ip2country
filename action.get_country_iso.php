<?php
/**
 * Date: 05/02/14
 * Time: 12:30
 * Author: Jean-Christophe Cuvelier <jcc@morris-chapman.com>
 */

if(!cmsms()) exit;

$IP = $_SERVER['REMOTE_ADDR'];

echo IPRange::getCountryISOFromIP($IP);