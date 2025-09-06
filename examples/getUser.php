<?php
/**
 * 获取用户信息
 * @author Prk<code@imprk.me>
 */

require_once __DIR__ . '/../vendor/autoload.php';

use Prk\PHPBilibili\User;

echo json_encode(User::find(1));
