# php-bilibili

<p align="center">
  <img src="./logo.svg" alt="PHP Bilibili Logo" width="120" height="120">
</p>

<p align="center">
  <strong>優雅的哔哩哔哩（Bilibili）PHP SDK</strong><br>
  以一致的模型與客戶端封裝，讓你更高效且可維護地對接 Bilibili 服務。
</p>

<p align="center">
    <a href="https://biliphp.dev">📚&nbsp;网站</a> ·
    <a href="https://github.com/imPrk0/php-bilibili">🧭&nbsp;仓库</a> ·
    <a href="#-功能亮點">✨ 功能亮點</a> ·
    <a href="#-快速開始">🚀 快速開始</a> ·
    <a href="#-使用範例">🧩 使用範例</a>
</p>

---

## 🧭 專案介紹

**php-bilibili** 是面向 Bilibili 生態的 PHP 封裝，提供：
- **一致的資料模型（Modeling）**：將 B 站回傳欄位規範化，例：`face → avatar`、`sign → bio`，以降低上游欄位命名變動帶來的破壞性影響。:contentReference[oaicite:1]{index=1}
- **多端客戶端（Clients）**：針對 **Web / PC / 手機 App / 云视听小电视** 等場景提供對應客戶端與請求流程簡化。:contentReference[oaicite:2]{index=2}
- **精簡的請求與代理支援**：內建以 cURL 驅動的請求流程，可配置代理（HTTP/SOCKS），並輔助處理如 Wbi 簽名等細節。:contentReference[oaicite:3]{index=3}

> 本專案在 **MIT License** 下開源。:contentReference[oaicite:4]{index=4}

---

## ✅ 環境需求

- **PHP ≥ 8.0**（作者明確僅支援 8.0+，鼓勵擁抱新版 PHP）:contentReference[oaicite:5]{index=5}
- cURL 擴展（HTTP 請求）
- 建議：Composer（依賴管理）

---

## 📦 安裝

使用 Composer 安裝套件（包已發布於 Packagist）：:contentReference[oaicite:6]{index=6}

```bash
composer require prk/php-bilibili
