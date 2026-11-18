# HMS - Homeschool Site

WordPress site for a homeschooling-focused content/affiliate site (English, US/EU audience). This repo tracks only the **custom theme** and **custom plugin** — WordPress core, third-party plugins, and uploads are not versioned here.

## Stack

- WordPress (self-hosted)
- Custom theme: `wp-content/themes/hms-theme`
- Custom plugin: `wp-content/plugins/hms-affiliate` (affiliate link shortcode + disclosure helper)
- Recommended companion plugins (install via wp-admin, not in this repo): an SEO plugin (Yoast SEO or Rank Math), a caching plugin, Google Site Kit (AdSense/Analytics)

## Local development setup

1. Install [Local](https://localwp.com/) (or any local WP stack — XAMPP, Docker, etc.)
2. Create a new local WordPress site.
3. Clone this repo and symlink/copy its contents into the site's `wp-content` folder, keeping only:
   - `wp-content/themes/hms-theme`
   - `wp-content/plugins/hms-affiliate`
4. Activate "HMS Theme" in Appearance > Themes. On activation it auto-creates the required pages (Privacy Policy, Affiliate Disclosure, About, Contact) as drafts — review and publish them.
5. Activate the "HMS Affiliate" plugin in Plugins.
6. Write content in wp-admin as usual (Posts). Only code changes (theme/plugin files) go through git.

## Deploying to production

Push theme/plugin changes to your host via SFTP/Git deploy hook, or use a Git-to-WP deploy plugin (e.g. WP Pusher) pointed at this repo's `wp-content/themes/hms-theme` and `wp-content/plugins/hms-affiliate` folders.

## Using the affiliate shortcode

```
[aff_link url="https://www.amazon.com/dp/XXXXX" text="Check Price on Amazon"]
```

Automatically adds `rel="sponsored nofollow noopener"` and `target="_blank"`, and styles as a button via the theme's `.btn` class.

## Compliance checklist before going live

- [ ] Replace placeholder site name/logo in `hms-theme`
- [ ] Publish the auto-created Privacy Policy, Affiliate Disclosure, About, Contact pages with real content
- [ ] Add real `ads.txt` with your AdSense publisher ID (via a plugin like "Ads.txt Manager" or host root file)
- [ ] Add a cookie consent banner plugin (required for EU/GDPR and California/CCPA visitors) before enabling AdSense/Analytics
- [ ] Set up Google Search Console + submit sitemap (via SEO plugin)
