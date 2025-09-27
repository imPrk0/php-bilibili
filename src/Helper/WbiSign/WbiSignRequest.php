<?php
/**
 * Wbi 签名请求
 * @author Prk<code@imprk.me>
 */

declare(strict_types=1);

namespace Prk\PHPBilibili\Helper\WbiSign;

use Prk\PHPBilibili\Enums\RequestMethod;
use Prk\PHPBilibili\Common\RequestInterface;

final class WbiSignRequest implements RequestInterface {
    /**
     * 获取请求的方法
     * @author Prk<code@imprk.me>
     *
     * @return RequestMethod 请求的方法
     */
    public function getMethod(): RequestMethod {
        return RequestMethod::GET;
    }

    /**
     * 获取请求的 URL
     * @author Prk<code@imprk.me>
     *
     * @return array 请求的 URL
     */
    public function getURL(): array {
        return [
            'https://',
            'api.bilibili.com',
            '/x/web-interface/nav'
        ];
    }

    /**
     * 获取请求的 Query 参数
     * @author Prk<code@imprk.me>
     *
     * @return array | null 请求的 Query 参数
     */
    public function getQuery(): ?array {
        return null;
    }

    /**
     * 获取请求的 Body 参数 (GET 请求无效)
     * @author Prk<code@imprk.me>
     *
     * @return array | string | null 请求的 Body 参数
     */
    public function getBody(): array | string | null {
        return null;
    }

    /**
     * 需要 Wbi 签名
     * @author Prk<code@imprk.me>
     *
     * @return boolean 是否需要 Wbi 签名验证
     */
    public function wbiSign(): bool {
        return false;
    }

    /**
     * 获取 Referrer
     * @author Prk<code@imprk.me>
     *
     * @return string | null Referrer
     */
    public function getReferrer(): ?string {
        return 'https://www.bilibili.com/';
    }
}
