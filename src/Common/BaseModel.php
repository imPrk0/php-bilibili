<?php
/**
 * 基本模型
 * @author Prk<code@imprk.me>
 */

namespace Prk\PHPBilibili\Common;

abstract class BaseModel {
    protected array $attributes = [];
    protected static string $endpoint = '';

    public function __construct(array $data = []) {
        $this->attributes = $data;
    }

    public static function find(int | string $id): ?self {
        $id = intval($id);
    }
}
