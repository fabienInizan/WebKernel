WebKernel
=========

Welcome to WebKernel !

WebKernel is a PHP based website framework, mostly targeting beginners or small websites which do not require a "full-featured all-in-one" framework/CMS. It is licensed under the MIT licence.

WebKernel:
  * Embeds an administration backend for fast and easy setup
  * Only requires HTML/CSS/PHP knowledge; uses PHP as a template language for page rendering
  * Provides users and rights management
  * Is extensible through native plugin support; a CLI tool helps to fasten plugins development
  
Installation
------------

Please note that WebKernel has been designed to run over the Apache web server. These instructions may not work if an other http daemon is servicing the website.

At this time only french language is offered for the installer as well as the administration interface.

  1. Copy the files on your server. It must run PHP version >= 5.3.7. Your domain should have the www repository as entry point.
  2. Go to http://your.domain/setup/ and follow the steps.
  3. If you intend to serve web pages (it is likely), please install the page plugin from https://github.com/fabienInizan/pagePlugin.
  4. Other plugins may be found at https://github.com/fabienInizan. Feel free to develop your own !
