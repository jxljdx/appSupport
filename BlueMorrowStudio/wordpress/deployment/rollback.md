# BlueMorrow Studio Website Rollback

## Before launch

Create a WordPress export and retain the active theme and plugin ZIPs. Store the
export and any production-only configuration outside Git.

## Roll back a failed release

1. Disable search-engine indexing while repairing the site.
2. Deactivate the `BlueMorrow Studio Site` plugin.
3. Activate the previously working theme.
4. Restore the pre-launch WordPress export if content or page relationships changed.
5. Clear WordPress.com caches and verify the support and privacy URLs.
6. Keep App Store Connect pointed at the existing GitHub Pages URLs until the new site is healthy.

For the first public release, the existing GitHub Pages site is the fallback.
Do not replace or redirect it until the independent-domain WordPress site has
passed the production checklist.
