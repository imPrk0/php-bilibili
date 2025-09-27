<?php
/**
 * 获取用户信息
 * @author Prk<code@imprk.me>
 */

require_once __DIR__ . '/../vendor/autoload.php';

// 模型化

//use Prk\PHPBilibili\User;
//echo json_encode(User::find(1));

// API 请求

use Prk\PHPBilibili\BilibiliClient;
use Prk\PHPBilibili\User\UserInfo;
use Prk\PHPBilibili\User\UserInfo\UserInfoRequest;

$request = new UserInfoRequest;
$request->setUserId(1);

$userInfo = (new UserInfo(new BilibiliClient, $request))->request();

echo $userInfo->getUserId() . PHP_EOL;
echo $userInfo->getUserName() . PHP_EOL;
