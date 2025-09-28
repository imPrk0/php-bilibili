<?php
/**
 * Cookie 存储器接口实现
 * @author Prk<code@imprk.me>
 */

declare(strict_types=1);

namespace Prk\PHPBilibili\Contracts;

interface CookieStoreInterface {
    /**
     * 获取 Cookie
     * @author Prk<code@imprk.me>
     *
     * @return string | null 原始 Cookie 串 "a=1; b=2; c=3;"
     */
    public function get(): ?string;

    /**
     * 设置 Cookies
     * @author Prk<code@imprk.me>
     *
     * @param array $cookies 原始 Cookies
     *
     * @return void 毋需返回任何
     */
    public function set(array $cookies): void;

    /**
     * 清理本场景 Cookie
     * @author Prk<code@imprk.me>
     *
     * @param string | null $key Cookie 键名
     *
     * @return void 毋需返回任何
     */
    public function clear(?string $key = null): void;
}
