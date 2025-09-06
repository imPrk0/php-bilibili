<?php
/**
 * 核心
 * @author Prk<code@imprk.me>
 */

namespace Prk\PHPBilibili\Common;

use Prk\PHPBilibili\Exception\KernelException;

final class Kernel {
    protected static ?Config $config = null;

    /**
     * 初始化时配置
     * @author Prk<code@imprk.me>
     *
     * @param Config $config 配置
     *
     * @return void 毋需返回任何
     */
    public static function configure(Config $config): void {
        self::$config = $config;
    }

    /**
     * 获取配置
     * @author Prk<code@imprk.me>
     *
     * @return Config 配置
     */
    public static function config(): Config {
        if (!self::$config) throw new KernelException('请先创建配置');
        return self::$config;
    }
}
