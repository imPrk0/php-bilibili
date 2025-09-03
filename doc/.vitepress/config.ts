/**
 * VitePress 配置文件
 * @author Prk<code@imprk.me>
 *
 * https://vitepress.dev/reference/site-config
 */

import { defineConfig } from 'vitepress';

export default defineConfig({
    title: 'PHP Bilibili',
    titleTemplate: ':title - PHP Bilibili',
    description: '优雅的 Bilibili PHP 封装类库。',

    // https://vitepress.dev/reference/default-theme-config
    themeConfig: {
        nav: [
            { text: '首页', link: '/' },
            { text: '介绍', link: '/introduction' },
            { text: '快速开始', link: '/get-started' },
            {
                text: 'API',
                items: [
                    {
                        text: '用户',
                        items: [
                            { text: '用户信息', link: '/user/information' }
                        ]
                    }
                ]
            },
            { text: '关于', link: '/about' }
        ],

        sidebar: [
            {
                items: [
                    { text: '介绍', link: '/introduction' },
                    { text: '快速开始', link: '/get-started' }
                ]
            },
            {
                text: '用户',
                items: [
                    { text: '用户信息', link: '/user/information' }
                ]
            },
            { text: '关于我们', link: '/about' }
        ],

        socialLinks: [
            { icon: 'github', link: 'https://github.com/imPrk0/php-bilibili' }
        ]
    }
});
