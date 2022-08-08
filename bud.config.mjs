// @ts-check

/**
 * Build configuration
 *
 * @see {@link https://bud.js.org/guides/getting-started/configure}
 * @param {import('@roots/bud').Bud} app
 */
export default async (app) => {
  app
    /**
     * Application entrypoints
     */
    .entry({
      app: ["@scripts/app", "@styles/app.scss"],
      editor: ["@scripts/editor", "@styles/editor"],
      admin: ["@scripts/admin", "@styles/admin"],
    })

    /**
     * Directory contents to be included in the compilation
     */
    .assets(["images", "fonts"])

    /**
     * Matched files trigger a page reload when modified
     */
    .watch(["resources/views/**/*", "app/**/*"])

    /**
     * Proxy origin (`WP_HOME`)
     */
    .proxy("http://chapmancommunities.local")

    /**
     * Development origin
     */
    .serve("http://localhost:3000")

    /**
     * URI of the `public` directory
     */
    // .setPublicPath("/app/themes/sage/public/");
    .setPublicPath("/wp-content/themes/chapmancommunities/public/");
};
