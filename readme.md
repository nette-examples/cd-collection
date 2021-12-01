CD collection (Nette Framework example)
---------------------------------------

Classic Zend Framework [Tutorial](http://akrabat.com/zend-framework-tutorial)
rewritten for Nette Framework.

The example shows an important feature of the Nette Framework: the URLs are
not used inside the application including the templates. The URLs are in
responsibility of the router and can be changed anytime. The target of a link
is always a combination "Presenter:action" or "Presenter:signal!".


What is [Nette Framework](https://nette.org)?
--------------------------------------------

Nette Framework is a popular tool for PHP web development. It is designed to be
the most usable and friendliest as possible. It focuses on security and
performance and is definitely one of the safest PHP frameworks.

Nette Framework speaks your language and helps you to easily build better websites.


Installation
------------

```shell
git clone https://github.com/nette-examples/cd-collection
cd cd-collection
composer install
```

The simplest way to get started is to start the built-in PHP server in the root directory of your project:

```shell
php -S localhost:8000 -t www
```

Then visit `http://localhost:8000` in your browser to see the welcome page.

It requires PHP version 7.2 or newer.
