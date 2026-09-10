# Batchora WordPress.com Launch Checklist

## Before creating the public site

- Purchase or connect the final independent domain.
- Activate a paid WordPress.com plan that supports custom theme and plugin uploads.
- Keep the existing GitHub Pages support and privacy URLs unchanged until the new site passes production checks.
- Download `batchora-wordpress-release-1.0.0.zip` and verify the files against `SHA256SUMS`.

## Install the release

1. Connect the final domain and set it as the WordPress.com primary address.
2. Keep search-engine indexing disabled while importing and checking the site. Do not share the temporary WordPress.com address.
3. Upload and activate `batchora-site-1.0.0.zip`.
4. Upload and activate `batchora-theme-1.0.0.zip`.
5. Use **Tools → Import → WordPress** to import `batchora-content-1.0.0.xml`.
6. Publish the 36 imported pages after reviewing their parent relationships.
7. Set permalinks to **Post name**.
8. Leave **Your homepage displays** set to **Your latest posts**. The site plugin redirects `/` to `/en/`; assigning the English page as a static homepage would remove its `/en/` URL.
9. Upload `app-icon-512.png` from the media package as the Site Icon.
10. Create the primary navigation with links to the English and Chinese home, feature, guide, support, privacy, and terms pages.

## Configure production services

1. In **Settings → Reading**, enter the Cloudflare Web Analytics token only after the final domain is active.
2. Confirm the final HTTPS URL is the WordPress.com primary address.
3. Enable search-engine indexing.
4. Add the domain to Google Search Console and Bing Webmaster Tools.
5. Submit `/wp-sitemap.xml` to both search platforms.
6. Configure IndexNow in Bing Webmaster Tools if it is available for the final site.

## Production verification

- `/` redirects to `/en/`.
- `/en/` and `/zh-hans/` return HTTP 200 and display the correct language.
- Every page has one canonical URL and `en-US`, `zh-Hans`, and `x-default` alternates.
- `/robots.txt`, `/wp-sitemap.xml`, and `/llms.txt` return HTTP 200.
- App Store buttons open App Store ID `6810283756`.
- The App Preview is not requested until the visitor activates its play button.
- English pages show English screenshots and Preview; Chinese pages show Chinese assets.
- The site remains usable with JavaScript disabled, except for click-to-load video playback.
- Mobile and desktop layouts have no clipped headings, horizontal scrolling, or overlapping controls.
- Cloudflare Web Analytics does not set advertising cookies.

## Public launch

1. Export a complete WordPress content backup immediately before launch.
2. Save the active theme and plugin ZIPs with the backup.
3. Enable public indexing only after all production checks pass.
4. Update App Store Connect Support and Privacy Policy URLs to the final domain.
5. Update the old GitHub Pages support pages only after the new URLs are stable.
