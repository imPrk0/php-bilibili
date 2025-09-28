<?php
/**
 * 配置超时时间
 * @author Prk<code@imprk.me>
 */

use Prk\PHPBilibili\Common\Config; // [!code highlight]
use Prk\PHPBilibili\BilibiliClient;

$config = new Config; // [!code highlight]
$config->setTimeout(15000); // [!code highlight]

$client = new BilibiliClient($config);
