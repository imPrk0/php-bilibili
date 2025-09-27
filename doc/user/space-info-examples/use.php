<?php

use Prk\PHPBilibili\Common\Config;
use Prk\PHPBilibili\BilibiliClient;
use Prk\PHPBilibili\User\UserInfo;
use Prk\PHPBilibili\User\UserInfo\UserInfoRequest;

$client = new BilibiliClient(new Config);

$request = new UserInfoRequest;
$request->setUserId(1);

$userInfo = (new UserInfo($client, $request))->request();

echo $userInfo->getUserId() . PHP_EOL;
echo $userInfo->getUserName() . PHP_EOL;
