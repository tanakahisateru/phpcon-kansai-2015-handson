## Requirements

- PHP >= 5.4
- Git
- (Node.js + NPM)

## Usage

Install PHP and Bower libraries.

```
curl -sS https://getcomposer.org/installer | php
php composer.phar install
```

Install Node tools and build assets. (optional)

```
npm install
node_modules/.bin/gulp
```

Setup the database.

```
sqlite3 var/data.sqlite < schema.sql
```

Run the server.

```
php -S 0.0.0.0:8080 -t public
```
