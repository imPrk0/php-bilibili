<?php
/**
 * 基本模型
 * @author Prk<code@imprk.me>
 */

namespace Prk\PHPBilibili\Common;

use JsonSerializable;

/**
 * @property array $attributes 模型参数
 * @property string $endpoint API 端点 (将弃用)
 * @property array $casts 参数类型转换
 */
abstract class BaseModel implements JsonSerializable {
    protected array $attributes = [];
    protected static string $endpoint = ''; // 将弃用
    protected array $casts = [];
    protected array $aliases = [];

    public function __construct(array $attributes = []) {
        $this->attributes = $attributes;
    }

    public function __get(string $key): mixed {
        return $this->attributes[$key] ?? null;
    }

    public function __isset(string $key): bool {
        return isset($this->attributes[$key]);
    }

    public function toArray(): array {
        return $this->attributes;
    }

    public function jsonSerialize(): array {
        return $this->toArray();
    }
}
