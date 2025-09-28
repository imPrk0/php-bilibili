<?php
/**
 * Wbi 签名存储接口
 * @author Prk<code@imprk.me>
 */

declare(strict_types=1);

namespace Prk\PHPBilibili\Contracts;

interface WbiStoreInterface {
    /**
     * 获取 Wbi 签名 Mixin Key
     * @author Prk<code@imprk.me>
     *
     * @return string | null Mixin Key
     */
    public function get(): ?string;

    /**
     * 设置 Wbi 签名 Mixin Key
     * @author Prk<code@imprk.me>
     *
     * @param string $mixinKey Mixin Key
     *
     * @return void 毋需返回任何
     */
    public function set(string $mixinKey): void;

    /**
     * 清理 Wbi 签名 Mixin Key
     * @author Prk<code@imprk.me>
     *
     * @return void 毋需返回任何
     */
    public function clear(): void;
}
