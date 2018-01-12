# OpenClassrooms-Projet6
[Développez de A à Z le site communautaire SnowTricks](https://openclassrooms.com/projects/developpez-de-a-a-z-le-site-communautaire-snowtricks)

# Snowtricks Application
The "SnowTricks Application" is a community site to share and discuss snowboard tricks with other people.

## Getting started
The application development is based on:
- [Symfony](http://symfony.com/) v3.4.3
- [Bootstrap](http://getbootstrap.com/) v4.0
- [Sass](http://sass-lang.com/)
- [Webpack Encore](http://symfony.com/doc/3.4/frontend.html)
- [MySQL](https://www.mysql.com/)

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes.

### Requirements
- PHP 7.0.0 or higher
- [Composer](https://getcomposer.org/)
- [Yarn](https://yarnpkg.com/lang/en/docs/install/) Package manager 

### Installation
#### 1. Install the project:
Copy the repository in your local server.

#### 2. Load vendors and webpack
Execute:
- `composer install`
- `yarn install`

#### 3. Set application parameters
Modify `parameters.yml` file in `app/config/` with your own parameters.

#### 4. Build the assets
Execute:
- `yarn run encore dev` to compile assets for development.
- `yarn run encore production` to compile assets and minify them for production.

#### 5. Load fixtures
Execute:
- `php bin/console hautelook:fixtures:load` to load a set of fixtures in the database.

### Author
- Daniel Thébault
