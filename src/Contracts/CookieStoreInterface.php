<?php
/**
 * Cookie 存储器接口实现
 * @author Prk<code@imprk.me>
 */

namespace Prk\PHPBilibili\Contracts;

interface CookieStoreInterface {
    /**
     * 获取 Cookie
     * @author Prk<code@imprk.me>
     *
     * @param string $scope 场景区分，默认为 default
     *
     * @return string | null 原始 Cookie 串 "a=1; b=2; c=3;"
     */
    public function get(string $scope): ?string;

    /**
     * 设置 Cookie
     * @author Prk<code@imprk.me>
     *
     * @param string $scope 场景区分，默认为 default
     * @param string $cookie 原始 Cookie
     * @param integer $ttl 过期时间，单位秒，0 为不过期
     *
     * @return void 毋需返回任何
     */
    public function set(string $scope, string $cookie, int $ttl = 0): void;

    /**
     * 清理本场景 Cookie
     * @author Prk<code@imprk.me>
     *
     * @param string $scope 场景区分，默认为 default
     *
     * @return void 毋需返回任何
     */
    public function clear(string $scope): void;
}
