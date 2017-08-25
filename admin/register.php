<?php
/**
 *
 * User: suyin
 * Date: 2017/8/25 9:01
 *
 */
require '../setting.php';
require DOCUMENT_ROOT .'lib/Tpl.class.php';

$tpl = new Tpl();

$tpl->display('admin/register.html');