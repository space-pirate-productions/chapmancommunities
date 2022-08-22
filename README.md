<p align="center">
  <a href="https://chapmancommunities.com">
    <img alt="Chapman Communities Icon" src="https://raw.githubusercontent.com/space-pirate-productions/chapmancommunities/main/screenshot.png" height="200" width="200">
  </a>
</p>

<p align="center">
<img src="https://img.shields.io/badge/bootstrap-v5.2.0-gray?style=for-the-badge&logo=bootstrap&logoColor=white&labelColor=%23563D7C" alt="Bootstrap" />
<img src="https://img.shields.io/badge/github%20actions-%232671E5.svg?style=for-the-badge&logo=githubactions&logoColor=white" alt="GitHub Actions" />
<img src="https://img.shields.io/badge/html5-%23E34F26.svg?style=for-the-badge&logo=html5&logoColor=white" alt="HTML5" />
<img src="https://img.shields.io/badge/javascript-%23323330.svg?style=for-the-badge&logo=javascript&logoColor=%23F7DF1E" alt="JavaScript" />
<img src="https://img.shields.io/badge/jquery-%230769AD.svg?style=for-the-badge&logo=jquery&logoColor=white" alt="jQuery" />
<img src="https://img.shields.io/badge/laravel-%23FF2D20.svg?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel" />
<img src="https://img.shields.io/badge/node.js-v16.15.1-gray?style=for-the-badge&logo=node.js&logoColor=white&labelColor=6DA55F" alt="NodeJS" />
<img src="https://img.shields.io/badge/NPM-v8.11.0-gray?style=for-the-badge&logo=npm&logoColor=white&labelColor=%23000000" alt="NPM" />
<img src="https://img.shields.io/badge/php-v7.4-gray?style=for-the-badge&logo=php&logoColor=white&labelColor=%23777BB4" alt="PHP" />
<img src="https://img.shields.io/badge/SASS-hotpink.svg?style=for-the-badge&logo=SASS&logoColor=white" alt="SASS" />
<img src="https://img.shields.io/badge/WordPress-v6.0-gray?style=for-the-badge&logo=WordPress&logoColor=white&labelColor=%23117AC9" alt="WordPress" />
<img src="https://img.shields.io/badge/yarn-%232C8EBB.svg?style=for-the-badge&logo=yarn&logoColor=white" alt="Yarn" />
</p>

<p align="center">
  <strong>WordPress theme for the Chapman Foundation for Caring Communities website.</strong>
</p>

## Requirements

Make sure all dependencies have been installed before moving on:

- [WordPress](https://wordpress.org/) >= 5.9
- [PHP](https://secure.php.net/manual/en/install.php) >= 7.4.0 (with [`php-mbstring`](https://secure.php.net/manual/en/book.mbstring.php) enabled)
- [Composer](https://getcomposer.org/download/)
- [Node.js](http://nodejs.org/) >= 16
- [Yarn](https://yarnpkg.com/en/docs/install)

## Theme structure

```sh
themes/chapmancommunities/ # → Root
├── app/                   # → Theme PHP
│   ├── Providers/         # → Service providers
│   ├── View/              # → View models
│   ├── filters.php        # → Theme filters
│   └── setup.php          # → Theme setup
├── composer.json          # → Autoloading for `app/` files
├── public/                # → Built theme assets (never edit)
├── functions.php          # → Theme bootloader
├── index.php              # → Theme template wrapper
├── node_modules/          # → Node.js packages (never edit)
├── package.json           # → Node.js dependencies and scripts
├── resources/             # → Theme assets and templates
│   ├── fonts/             # → Theme fonts
│   ├── images/            # → Theme images
│   ├── scripts/           # → Theme javascript
│   ├── styles/            # → Theme stylesheets
│   └── views/             # → Theme templates
│       ├── components/    # → Component templates
│       ├── forms/         # → Form templates
│       ├── layouts/       # → Base templates
│       ├── partials/      # → Partial templates
        └── sections/      # → Section templates
├── screenshot.png         # → Theme screenshot for WP admin
├── style.css              # → Theme meta information
├── vendor/                # → Composer packages (never edit)
└── bud.config.js          # → Bud configuration
```

## Theme setup

Edit `app/setup.php` to enable or disable theme features, setup navigation menus, post thumbnail sizes, and sidebars.

## Theme development

- Run `composer install` from the theme directory
- Run `yarn` from the theme directory to install dependencies
- Update `bud.config.js` with your local dev URL

### Build commands

- `yarn dev` — Compile assets when file changes are made, start Browsersync session
- `yarn build` — Compile assets for production
