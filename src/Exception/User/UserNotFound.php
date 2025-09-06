<?php
/**
 * 用户不存在
 * @author Prk<code@imprk.me>
 */

declare(strict_types=1);

namespace Prk\PHPBilibili\Exception\User;

use Prk\PHPBilibili\Exception\ClientException;

final class UserNotFound extends ClientException { }
