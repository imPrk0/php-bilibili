<?php
/**
 * Wbi 签名存储接口
 * @author Prk<code@imprk.me>
 */

declare(strict_types=1);

namespace Prk\PHPBilibili\Contracts;

interface WbiStoreInterface {
    /**
     * 获取 Wbi 签名 Token
     * @author Prk<code@imprk.me>
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
