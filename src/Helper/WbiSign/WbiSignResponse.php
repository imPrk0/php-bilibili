<?php
/**
 * Wbi 签名响应
 * @author Prk<code@imprk.me>
 */

declare(strict_types=1);

namespace Prk\PHPBilibili\Helper\WbiSign;

final class WbiSignResponse {
    protected string $imgUrl;
    protected string $subKey;
    protected string $mainKey;

    public function __construct(array $data = []) {
        $this->imgUrl = $data['img_url'] ?? '';
        $this->subKey = $data['sub_key'] ?? '';
        $this->mainKey = $data['main_key'] ?? '';
    }

    public function getImgUrl(): string {
        return $this->imgUrl;
    }

    public function getSubKey(): string {
        return $this->subKey;
    }

    public function getMainKey(): string {
        return $this->mainKey;
    }
}