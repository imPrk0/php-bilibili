<?php
/**
 * 配置 Referrer
 * @author Prk<code@imprk.me>
 */

use Prk\PHPBilibili\Common\Config; // [!code highlight]
use Prk\PHPBilibili\BilibiliClient;

$config = new Config; // [!code highlight]
$config->setReferer('https://bilibili.tv/'); // [!code highlight]

$client = new BilibiliClient($config);
