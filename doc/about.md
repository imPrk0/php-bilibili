<script setup lang="ts">
import { VPTeamMembers } from 'vitepress/theme';

const coreMembers = [
    {
        avatar: 'https://github.com/imPrk0.png',
        name: 'Prk',
        title: '开发者',
        org: '项目核心',
        orgLink: 'https://github.com/imPrk0',
        desc: '1123',
        links: [
            { icon: 'github', link: 'https://github.com/imPrk0' },
            { icon: 'x', link: 'https://x.com/imPrk_' },
            { icon: 'bluesky', link: 'https://bsky.app/profile/imprk.me' },
            { icon: 'instagram', link: 'https://www.instagram.com/imprk0/' },
            { icon: 'threads', link: 'https://www.threads.com/@imprk0' }
        ],
        actionText: '赞助',
        sponsor: 'https://sponsor.imprk.me'
    }
]
</script>

# 关于我们 {#title}

<VPTeamMembers :members="coreMembers" />
