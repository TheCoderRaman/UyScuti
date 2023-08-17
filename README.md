# 🌐 UyScuti
<p align="center">
  <a title="license" href="./LICENSE"><img src="https://img.shields.io/github/license/TheCoderRaman/UyScuti" alt="license"></a>
  <a title="laravel" href="https://laravel.com"><img src="https://img.shields.io/badge/logo-laravel-blue?logo=laravel" alt="laravel"></a>
  <a title="react" href="https://react.dev"><img src="https://img.shields.io/badge/logo-react-blue?logo=react" alt="react"></a>
  <a title="tailwindcss" href="https://tailwindcss.com"><img src="https://img.shields.io/badge/logo-tailwindcss-blue?logo=tailwindcss" alt="tailwindcss"></a>
  <a title="vite" href="https://vitejs.dev"><img src="https://img.shields.io/badge/logo-vite-blue?logo=vite" alt="vite"></a>
</p>

<p align="center">
  <img width="200" height="200" src="./public/logo512.png?raw=true" alt="logo" />
</p>

## 🦸‍♂️ About
Introducing **UyScuti**, the ultimate open-source search engine application that empowers privacy, without trade-offs. It lets you search the web anonymously and securely, without compromising on speed or quality. UyScuti does not track, store, or sell your personal data or search history. It also protects you from malicious ads, trackers, and malware. UyScuti is open source and easy to use.

**Search the web with confidence and peace of mind with UyScuti, the ultimate search engine for privacy lovers.**

###### 👊 UyScuti is fast, reliable, and open source. Try it today and experience the difference.

<p align="center">
  <picture>
    <source media="(prefers-color-scheme: dark)" srcset="./public/assets/images/uyscuti-dark.png?raw=true">
      <img alt="UyScuti" src="./public/assets/images/uyscuti-light.png?raw=true">
  </picture>
</p>

## Major Technologies
- react
- laravel
- tailwindcss

## Structure
```sh
├───app
│   ├───Console
│   │   └───Commands
│   ├───Exceptions
│   ├───Http
│   │   ├───Controllers
│   │   │   └───Api
│   │   │       └───V1
│   │   │           ├───Auth
│   │   │           ├───Bot
│   │   │           ├───Contact
│   │   │           ├───NewsLetter
│   │   │           └───Search
│   │   └───Middleware
│   ├───Models
│   ├───Providers
│   └───Utility
│       ├───Api
│       ├───Crawler
│       │   ├───Observers
│       │   ├───Queues
│       │   └───Sniffer
│       │       └───Types
│       └───Urls
├───config
│   └───laravolt
├───database
│   ├───factories
│   ├───migrations
│   └───seeders
├───lang
│   ├───en
│   └───hi
├───public
│   └───assets
│       └───images
│           ├───about
│           ├───contact
│           └───errors
├───resources
│   ├───css
│   ├───js
│   │   └───Frontend
│   │       ├───Components
│   │       │   ├───Alerts
│   │       │   ├───Footer
│   │       │   ├───Header
│   │       │   │   └───Boxes
│   │       │   ├───Icons
│   │       │   ├───Layouts
│   │       │   ├───Logos
│   │       │   ├───Preloaders
│   │       │   └───Utils
│   │       ├───Data
│   │       ├───Hooks
│   │       ├───Modules
│   │       ├───Pages
│   │       │   ├───About
│   │       │   │   └───Components
│   │       │   │       └───Sections
│   │       │   ├───Contact
│   │       │   │   └───Components
│   │       │   │       └───Sections
│   │       │   │           ├───Left
│   │       │   │           └───Right
│   │       │   ├───Error
│   │       │   │   └───Components
│   │       │   │       ├───Logos
│   │       │   │       └───Statuses
│   │       │   ├───Home
│   │       │   │   └───Components
│   │       │   │       └───Sections
│   │       │   │           ├───Bottom
│   │       │   │           ├───Middle
│   │       │   │           │   ├───Boxes
│   │       │   │           │   └───Utils
│   │       │   │           └───Top
│   │       │   ├───Profile
│   │       │   ├───Search
│   │       │   │   └───Components
│   │       │   │       ├───Errors
│   │       │   │       ├───Footer
│   │       │   │       └───Labels
│   │       │   ├───SignIn
│   │       │   └───SignUp
│   │       ├───Providers
│   │       │   └───Handlers
│   │       ├───Redux
│   │       │   ├───features
│   │       │   │   ├───authentications
│   │       │   │   ├───searches
│   │       │   │   ├───settings
│   │       │   │   ├───themes
│   │       │   │   └───translations
│   │       │   └───stores
│   │       ├───Router
│   │       │   └───Web
│   │       └───Utils
│   │           └───func
│   ├───sass
│   └───views
├───routes
└───tests
    ├───Feature
    │   └───App
    │       └───Utility
    │           └───Queues
    └───Unit
```
## Getting Started 🎉
These instructions will get you a copy of the project up and running on your local machine for development and testing purposes.

#### 💡 Prerequisites
Before diving into Laravel and React, there are a few things you should be familiar with:
* Basic knowledge of PHP programming
* Basic knowledge of JavaScript programming
* Experience with HTML, CSS (optional but helpful)
* Familiarity with CLI/Terminal (Command Line Interface)
* Understanding of the MVC (Model-View-Controller) architectural pattern

> **Warning**
> Make sure that you follow each step carefully!.

###### System Requirements
Ensure your system meets the following requirements:

PACKAGE  | WHY REQUIRED?              | SITE
---------|----------------------------|-----------------------------
PHP      | Running Laravel            | [LINK](https://www.php.net/)
NPM      | Installing npm packages    | [LINK](https://nodejs.org/en/)
NODE     | Running React              | [LINK](https://nodejs.org/en/)
MYSQL    | Storing databases          | [LINK](https://www.mysql.com/)
COMPOSER | Installing php packages    | [LINK](https://getcomposer.org/)

###### Hardware requirements
Minimal (dependent on PHP, Composer and NodeJs)

#### 💽 Installation
Here you learn, how you can make development or production environment:

###### Clone this repository
```bash
$ git clone https://github.com/TheCoderRaman/UyScuti.git
$ cd UyScuti
```

##### 👨‍💻 Production Environment

> **Danger**
> To make is secure and performant!.
> Make sure that you update env file as below:

```bash
# To turn off debugging and prevent sensitive
# information from being leaked to the end user.
APP_DEBUG=false
# Set the environment to production to ensure
# that the application is optimized for production use
APP_ENV="production"
```

###### Install Laravel (Backend)
```bash
# After this configure your env file
# All required information is provided in env file
$ cp .env.example .env

# Install PHP dependencies
composer install --optimize-autoloader --no-dev

# Generate key
php artisan key:generate
## Prepare for production
php artisan optimize
# Run migration
php artisan migrate
# Run seeders
php artisan db:seed
# Run server
php artisan serve
```

###### Install React (Frontend)
```bash
# Install React dependencies
$ npm install

## Prepare for production
$ npm run build
```

###### 🛠️ Development Environment

> **Danger**
> Make sure that you update env file as below:

```bash
# To turn on debugging
APP_DEBUG=true
# Set the environment to local
APP_ENV="local"
```

###### Install Laravel (Backend)
```bash
# After this configure your env file
# All required information is provided in env file
$ cp .env.example .env

# Install PHP dependencies
composer install

# Generate key
php artisan key:generate
# Run migration
php artisan migrate
# Run seeders
php artisan db:seed
# Run server
php artisan serve
```

###### Install React (Frontend)
```bash
# Install React dependencies
$ npm install

## Prepare for production
$ npm run dev
```

## Repository Branches
- **master** -> any pull request of changes this branch
- **main** -> don´t modify, this is what is running in production
## Contributions

Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.
Please make sure to update tests as appropriate.
###### Pull Requests
1. Fork the repo and create your branch:
   `#[type]/PR description`
1. Ensure to describe your pull request:
   Edit the PR title by adding a semantic prefix like `Added`, `Updated:`, `Fixed:` etc.
   **Title:**
   `#[issue] PR title -> #90 Fixed styles the button`
## Authors
* [Raman Verma](https://github.com/TheCoderRaman)

## Code of Conduct
In order to ensure that the UyScuti community is welcoming to all, please review and abide by the [Code of Conduct](./CODE_OF_CONDUCT.md).

## Security Vulnerabilities
If you discover a security vulnerability within UyScuti, please send an e-mail to Raman Verma via [e-mail](mailto:devramanverma@gmail.com).
All security vulnerabilities will be promptly addressed.

## License
The UyScuti is open-sourced software licensed under the [MIT License](./LICENSE)