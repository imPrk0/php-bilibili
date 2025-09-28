<?php
/**
 * 使用文件来配置 Wbi 存储器示例
 * @author Prk<code@imprk.me>
 */

use Prk\PHPBilibili\Common\Config;
use Prk\PHPBilibili\BilibiliClient;
use Prk\PHPBilibili\Contracts\WbiStoreInterface;

class WbiStoreExample implements WbiStoreInterface {
    /**
     * Wbi Mixin Key 存储文件
     * @author Prk<code@imprk.me>
     *
     * @type string 文件绝对地址
     */
    protected string $fileName = __DIR__ . '/wbi_mixin_key.txt';

    /**
     * 获取 Wbi Mixin Key
     * @author Prk<code@imprk.me>
     *
     * @return string | null 获取到的 Wbi Mixin Key
     */
    public function get(): ?string {
        $mixinKey = trim(file_get_contents($this->fileName));
        return empty($mixinKey) ? null : $mixinKey;
    }

    /**
     * 设置 Wbi Mixin Key
     * @author Prk<code@imprk.me>
     *
     * @param string $mixinKey 要存储的 Wbi Mixin Key
     *
     * @return void 不需要返回任何东西
     */
    public function set(string $mixinKey): void {
        file_put_contents($this->fileName, $mixinKey);
    }

    /**
     * 清除 Wbi Mixin Key
     * @author Prk<code@imprk.me>
     *
     * @return void 不需要返回任何东西
     */
    public function clear(): void {
        file_put_contents($this->fileName, '');
        unlink($this->fileName);
    }
}

$config = new Config;
$config->setWbiStore(new WbiStoreExample);

$client = new BilibiliClient($config);
