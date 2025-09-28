<?php
/**
 * 配置 Hosts 重写规则
 * @author Prk<code@imprk.me>
 */

use Prk\PHPBilibili\Common\Config; // [!code highlight]
use Prk\PHPBilibili\BilibiliClient;

$config = new Config; // [!code highlight]
$config->setRewriteHost([ // [!code highlight]
    'api.bilibili.com' => ['http://', 'api.bili.example.com'] // [!code highlight]
]); // [!code highlight]

$client = new BilibiliClient($config);
