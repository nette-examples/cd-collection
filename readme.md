CD collection [DISCONTINUED]
============================

This project is a reinterpretation of the classic [Zend Framework Tutorial](http://akrabat.com/zend-framework-tutorial) but for the Nette Framework.

The example illustrates a notable feature of the Nette Framework: URLs are not directly referenced within the application, including templates. The router manages URLs, allowing for their modification at any time. Links always target a combination of "Presenter:action" or "Presenter:signal!".


What is [Nette Framework](https://nette.org)?
============================================

Nette Framework is a distinguished tool tailored for PHP web development. Designed with an emphasis on usability, it also prioritizes security and performance, making it one of the safest PHP frameworks out there. It provides an intuitive experience, assisting developers in creating top-notch websites.


Getting Started
===============

Follow these steps to set up the example:

```shell
git clone https://github.com/nette-examples/cd-collection
cd cd-collection
composer install
```

For a quick start, launch the built-in PHP server in the root directory:

```shell
php -S localhost:8000 -t www
```

Now, navigate to `http://localhost:8000` in your browser to see the welcome page.
