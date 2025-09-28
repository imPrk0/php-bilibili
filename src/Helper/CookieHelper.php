<?php
/**
 * Cookie 解析器
 * @author Prk<code@imprk.me>
 */

declare(strict_types=1);

namespace Prk\PHPBilibili\Helper;

final class CookieHelper {
    /**
     * 解析响应头 Cookies
     * @author Prk<code@imprk.me>
     *
     * @param string $headers HTTP 响应头
     *
     * @return array Set-Cookies Array
     */
    public static function parseCookiesFromHeaders(string $headers): array {
        $cookies = [];
        $lines = explode("\r\n", $headers);

        foreach ($lines as $line) {
            if (0 == stripos($line, 'Set-Cookie:')) {
                $cookieValue = trim(substr($line, 11));
                $cookies[] = $cookieValue;
            }
        }

        return $cookies;
    }
}
