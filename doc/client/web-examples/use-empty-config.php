<?php
/**
 * 当不需要配置时，你也可以传一个空配置，虽然完全没必要
 * @author Prk<code@imprk.me>
 */

use Prk\PHPBilibili\Common\Config;
use Prk\PHPBilibili\BilibiliClient;

// 方法 1
$client = new BilibiliClient(new Config);

unset($client);

// 方法 2
$config = new Config;
$client = new BilibiliClient($config);
