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
3. If you intend to serve web pages (it is likely), please install the page plugin from https://github.com/fabienInizan/pagePlugin. This is achieved through your administration interface (http://your.domain/admin/) by clicking the plugin entry from to top menu. Then simply browse to the page.zip file from the pagePlugin repository.
4. Other plugins may be found at https://github.com/fabienInizan. Feel free to develop your own !
  
Quick start
-----------

This section will explain how to setup your first website page. It requires the page plugin to get installed.

### Internals

The WebKernel framework extracts the page to display from the URL. A valid URL is built as follow:

http:// your.domain/**index.php**?module=**module**&action=**action**&param1=**param1**&param2=**param2**&...

  * **index.php** is the default page; it is not mandatory and may be dropped.
  * **module** is the category of the page to return, such as page, admin or user.
  * **action** is a command-like action which applies to the aformentionned module. The set of actions depends of the module, but some common examples are index, display, add, delete or displayEditForm.
  * **param1, param2, ...** parameters are optionnal. Some action require parameters to be executed and some does not. For example, when requiring the module page to execute a display action, the identifier of the page to display should be passed as parameter. To display a page with the identifier "mypage", the url suffix will be ?module=page&action=display=pageId=mypage.
  
### Setting my first page

If you attempt to go to http://your.domain after installing the page plugin, you may notice that an exception is thrown with the message "Cannot find required page". Don't worry, this is normal.
The WebKernel defines a default URL which applies when no suffix is given, which allows to access a website using the domain name. The default page depends on whether you are on the public interface (http://your.domain) or the administration interface (http://your.domain/admin/).
  * on the public interface the default URL suffix is **?module=page&action=display&pageId=index**
  * on the admin interface the default URL suffix is **?module=admin&action=index**
  
Plese note that is you only mention the module, the default action is always **index**.
  
So here is the behinds of the exception: the page with identifier "index" is not found, because it does not exist. Let's create it.

1. Go to the administration interface http://your.domain/admin/ and login.
2. You should have a "Pages" entry on the menu, click it. If you don't, please read the instructions from the "Installation" section on this README.
3. A message should inform you that no page have been created yet. Click on "Ajouter une page".
4. A form will show up. Please fill it like follows:
  * Identifiant: **index**
  * Titre: **My first page on WebKernel**
  * Contenu: **Hello World from WebKernel !**
5. Click the "Ajouter" button. You should have a confirmation with the following message "La page a été ajoutée avec succès !". Click the "Retour aux pages" link.
6. Your new page should appear on a table. You may eventually edit it by clicking the "Editer" link on the row.
7. Go back to your public default page http://your.domain. Your newly created page should be displayed.
  
### Error 404

As you may see from the previous section, on a page not found failure the WebKernel throws an Exception and displays it the the visitor. It may not be the desired behaviour; an other one should be to display a custom "404 error" page. 404 is the HTTP code wich stands for page not found.

It is possible to setup a custom 404 page on WebKernel. To do so, simply create a new page with the identifier **404**. Please follow the procedure from the "Setting my first page" section but fill the form with the following data:

  * Identifiant: **404**
  * Titre: **404 - Page not found**
  * Contenu: **The desired page could not be found on the server**
  
Now that your 404 page has been created, let's show it by asking for a non-existing page. Append the suffix below to your domain :
?module=page&action=display&pageId=fakePage. Your 404 error page should be displayed instead of displaying an exception.

### Navigation

The navigation between the pages is achieved by creating links between them. When editing a page, highlight a word/sentence to undimm the link button on the editor (the symbol is chain links). Using this button you can create links by filling the "Link URL" field with a correct URL as mentionned in the section "Internals". Please note that the link to a page can be copied/pasted as it is shown whren clicking the "Voir" button from the page list table, under the "Lien vers la page" field.

Going further with WebKernel
----------------------------

This file only show the very basics of the WebKernel framwork. A documentation is currently in progress, but it may take time to complete, so please be patient.

Contact : fabien dot inizan at gmail dot com.
