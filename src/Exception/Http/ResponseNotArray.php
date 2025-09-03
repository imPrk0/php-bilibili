<?php
/**
 * 响应不能解析为数组 (不是对象) 异常
 * @author Prk<code@imprk.me>
 */

declare(strict_types=1);

namespace Prk\PHPBilibili\Exception\Http;

use Prk\PHPBilibili\Exception\ClientException;

final class ResponseNotArray extends ClientException {}
