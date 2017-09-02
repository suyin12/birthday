<?php
/**
 *
 * User: suyin
 * Date: 2017/8/11 10:31
 *
 */

include 'setting.php';
require 'lib/Tpl.class.php';

$tpl = new Tpl();

$tpl->assign('projectName',PROJECT_NAME);
$tpl->display('admin/login.html');