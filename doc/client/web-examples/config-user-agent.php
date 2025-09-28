<?php
/**
 * 配置 User-Agent
 * @author Prk<code@imprk.me>
 */

use Prk\PHPBilibili\Common\Config; // [!code highlight]
use Prk\PHPBilibili\BilibiliClient;

$config = new Config; // [!code highlight]
$config->setUserAgent('Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.3'); // [!code highlight]

$client = new BilibiliClient($config);
