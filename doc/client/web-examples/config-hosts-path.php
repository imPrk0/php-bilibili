<?php
/**
 * 配置 Hosts 重写规则
 * @author Prk<code@imprk.me>
 */

use Prk\PHPBilibili\Common\Config; // [!code highlight]
use Prk\PHPBilibili\BilibiliClient;

$config = new Config; // [!code highlight]
$config->setRewriteHost([ // [!code highlight]
    'api.bilibili.com' => ['http://', 'bili.example.com/api'], // [!code highlight]
    'www.bilibili.com' => ['https://', 'bili.example.com/www'] // [!code highlight]
]); // [!code highlight]

$client = new BilibiliClient($config);
