<?php
/**
 * 不支持的网络代理异常
 * @author Prk<code@imprk.me>
 */

declare(strict_types=1);

namespace Prk\PHPBilibili\Exception\Http;

use Prk\PHPBilibili\Exception\ClientException;

final class InvalidProxyException extends ClientException {}
