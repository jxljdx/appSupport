# BlueMorrow Studio WordPress Site

Portable source for the BlueMorrow Studio multi-app website.

## Packages

- `theme/bluemorrow-studio/`: custom WordPress block theme.
- `plugin/bluemorrow-studio-site/`: product metadata and discovery behavior.
- `content/`: bilingual page and article source.
- `tools/`: validation and release packaging scripts.

Production credentials, WordPress exports containing user data, and domain
configuration do not belong in this directory.

## Commands

```bash
npm install
npm run generate:media
npm run validate
npm run package
```

Release archives are written to `release/` and are intentionally ignored by
Git.

Use `local-validation.blueprint.json` with WordPress Playground to install the
packaged theme, plugin, and WXR content into a temporary WordPress site. Then
run `npm run validate:site` while the site is available at
`http://127.0.0.1:9401`.

The complete upload bundle is
`release/bluemorrow-studio-wordpress-release-1.0.0.zip`. Follow the checklist in
`deployment/wordpress-com-launch-checklist.md`; production credentials and
exports must remain outside Git.
