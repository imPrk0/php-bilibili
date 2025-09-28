/**
 * VitePress 配置文件
 * @author Prk<code@imprk.me>
 *
 * https://vitepress.dev/reference/site-config
 */

import { defineConfig } from 'vitepress';

export default defineConfig({
    lang: 'zh-CN',

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
                activeMatch: '^/(client|user)/',
                items: [
                    {
                        text: '客户端',
                        items: [
                            { text: '介绍', link: '/client/' },
                            { text: 'Web 客户端', link: '/client/web' },
                            { text: 'PC 客户端', link: '/client/electron' },
                            { text: '手机 APP', link: '/client/app' },
                            { text: '云视听小电视', link: '/client/tv' }
                        ]
                    },
                    {
                        text: '用户',
                        items: [
                            { text: '用户模型', link: '/user/model' },
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
                    { text: '快速开始', link: '/get-started' },
                    { text: '模型化', link: '/model' }
                ]
            },
            {
                text: '客户端',
                collapsed: true,
                items: [
                    { text: '介绍', link: '/client/' },
                    { text: '🌍 Web 客户端', link: '/client/web' },
                    { text: '💻 PC 客户端', link: '/client/electron' },
                    { text: '📱 手机 APP', link: '/client/app' },
                    { text: '📺 云视听小电视', link: '/client/tv' }
                ]
            },
            {
                text: '用户',
                collapsed: true,
                items: [
                    { text: '用户模型', link: '/user/model' },
                    {
                        text: '获取用户信息',
                        collapsed: true,
                        items: [
                            { text: '模型化', link: '/user/information' },
                            { text: '空间接口', link: '/user/space-info' }
                        ]
                    }
                ]
            },
            { text: '关于我们', link: '/about' }
        ],

        socialLinks: [
            { icon: 'github', link: 'https://github.com/imPrk0/php-bilibili' },
            { icon: 'telegram', link: '/telegram.html' }
        ],

        footer: {
            message: 'Released under the MIT License.',
            copyright: `Copyright © 2025-${(new Date()).getFullYear()} Prk All Rights Reserved.`
        },

        search: {
            provider: 'algolia',
            options: {
                appId: process.env.VP_ALGOLIA_APP_ID,
                apiKey: process.env.VP_ALGOLIA_API_KEY,
                indexName: 'php-bilibili'
            }
        }
    },

    markdown: {
        theme: {
            light: 'vitesse-light',
            dark: 'vitesse-dark'
        }
    }
});
