<?php
/**
 * 请求接口
 * @author Prk<code@imprk.me>
 */

namespace Prk\PHPBilibili\Common;

use Prk\PHPBilibili\Enums\RequestMethod;

interface RequestInterface {
    /**
     * 获取请求的方法
     * @author Prk<code@imprk.me>
     *
     * @return RequestMethod 请求的方法
     */
    public function getMethod(): RequestMethod;

    /**
     * 获取请求的 URL
     * @author Prk<code@imprk.me>
     *
     * @return array 请求的 URL
     */
    public function getURL(): array;

    /**
     * 获取请求的 Query 参数
     * @author Prk<code@imprk.me>
     *
     * @return array | null 请求的 Query 参数
     */
    public function getQuery(): ?array;

    /**
     * 获取请求的 Body 参数 (GET 请求无效)
     * @author Prk<code@imprk.me>
     *
     * @return array | string | null 请求的 Body 参数
     */
    public function getBody(): array | string | null;

    /**
     * 需要 Wbi 签名
     * @author Prk<code@imprk.me>
     *
     * @return boolean 是否需要 Wbi 签名验证
     */
    public function wbiSign(): bool;

    /**
     * 获取 Referrer
     * @author Prk<code@imprk.me>
     *
     * @return string | null Referrer
     */
    public function getReferrer(): ?string;
}
