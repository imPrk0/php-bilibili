/// <reference types="vite/client" />

interface ViteTypeOptions { }

interface ImportMetaEnv {
    readonly VITE_ALGOLIA_APP_ID: string;
    readonly VITE_ALGOLIA_API_KEY: string;
}

interface ImportMeta {
    readonly env: ImportMetaEnv;
}
