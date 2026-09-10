# Batchora WordPress Site

Portable source for the Batchora marketing website.

## Packages

- `theme/batchora/`: custom WordPress block theme.
- `plugin/batchora-site/`: product metadata and discovery behavior.
- `content/`: bilingual page and article source.
- `tools/`: validation and release packaging scripts.

Production credentials, WordPress exports containing user data, and domain
configuration do not belong in this directory.

## Commands

```bash
npm run validate
npm run package
```

Release archives are written to `release/` and are intentionally ignored by
Git.

