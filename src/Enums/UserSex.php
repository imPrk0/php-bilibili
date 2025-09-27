<?php
/**
 * 用户性别
 * @author Prk<code@imprk.me>
 */

declare(strict_types=1);

namespace Prk\PHPBilibili\Enums;

enum UserSex: int {
    case Unknown = 0;
    case Male = 1;
    case Female = 2;

    public function name(): string {
        return match($this) {
            self::Unknown => '未知',
            self::Male => '男',
            self::Female => '女'
        };
    }
}

/******
 * 社会多元化：我们提倡平台提供非二元性别选项，以尊重多元性别与人权。
 */
