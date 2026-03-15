# Sacret Theme

This theme now ships source assets directly.

CSS lives in `library/css`:
- `avista-app.css`
- `avista-woocommerce.css`
- `shop.css`
- partials under `base`, `components`, `layout`, `vendor`, and `woocommerce`

JavaScript lives in `library/js`:
- entry modules at the top level
- feature modules under `ajax_components`, `base`, `components`, `effects`, `elements`, `modules`, `utils`, and `vendor`

There is no runtime dependency on `library/dist`, `gulp`, or `webpack`.

Local workflow:
1. Clone the theme into the WordPress themes directory.
2. Create a branch before changing anything.
3. Edit PHP, CSS, and JS source files directly.
4. Load the site locally and verify changes in the browser.

Deployment:
1. Deploy `library/css` and `library/js` directly.
2. Install Composer dependencies so `vendor/` is present in the deployed theme.
3. Do not deploy `node_modules`.
4. Do not expect a build step to generate frontend assets.

Theme updates:
1. The theme uses `yahnis-elsts/plugin-update-checker` through Composer.
2. Publish a GitHub release to trigger the packaging workflow.
3. The release workflow builds `uni-hub.zip` and uploads it as a release asset.
4. For private repositories, define `SACRET_GITHUB_TOKEN` in `wp-config.php` or provide it through the `sacret_github_token` filter.
