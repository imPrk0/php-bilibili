<?php
/**
 * 核心配置
 * @author Prk<code@imprk.me>
 */

namespace Prk\PHPBilibili\Common;

use Prk\PHPBilibili\Contracts\CookieStoreInterface;

final class Config {
    /**
     * 核心配置构造器
     * @author Prk<code@imprk.me>
     *
     * @param CookieStoreInterface $cookieStore Cookie 存储接口实现
     * @param NetworkProxy | null $defaultProxy 默认网络代理
     * @param string | null $scope Cookie 存储作用域
     * @param integer $timeoutMs 网络请求超时时间，单位毫秒
     * @param string $userAgent 自定义 User-Agent
     */
    public function __construct(
        public CookieStoreInterface $cookieStore,
        public ?NetworkProxy $defaultProxy = null,
        public ?string $scope = 'default',
        public int $timeoutMs = 10000,
        public string $userAgent = ''
    ) {}
}
