Social share
============

Plugin for Cotonti CMF. It adds «Share it» widget to pages of cite.

![Social share widget screenshot](http://macik.github.com/cot-social_share/images/social_share_00.png)

Description
-----------

Adds easy to use widget for social networks sharing to pages of your site.
You can setup list of allowed services choosing from more than 20 social sites.
Basicly all you need to enable it - is to install Extension. It will automatically adds
widget to bottom of you pages and news. Also you can finetune placement of widget 
with manually adding `{SOCIAL_SHARE}` tag in tpl files.

Features
--------

* Easy «one-click-install» (for basic use you don't need adding TPL tags)
* Highly configurable (widget style and list of services)
* I18n for widget based on users profile
* No external dependencies (working without jQuery use)
* Allowed to insert in any block of site with `{PHP.social_share}` tag

Requirements
------------

Developed for Cotonti Siena (0.9.x branch). 
Worked with/or without jQuery enabled.

Demo page
---------

Comming soon…

![Social share widget screenshot 2](http://macik.github.com/cot-social_share/images/social_share_01_tbn.png)
![Social share widget screenshot 3](http://macik.github.com/cot-social_share/images/social_share_02_tbn.png)


Version info
------------

Current version 1.3 tested with:
* [Cotonti](http://www.cotonti.com) Siena. Versions on 0.9.5 - 0.9.11 (actual).
* Skins: `HTML Kickstart`, `Nemesis`
* Admin skins: `standard`, `bootstrap`, `priori`


### How extension works

Simply generates widget code based on your Extension settings (widget style and services list).
Then auto insert widget code in bottom of pages or place specified with own tag in TPL files.


Install
-------

* Unpack, copy files to root folder of your site.
* Install via Admin → Extensions menu (`Administration panel → Extensions`)


### Comments

After install you must see widget block on bottom of articles and news pages 
(accordingly you had `page` and `news` modules installed).
You can choose used services, language and widget style in Extension config menu
(`Administration panel → Extensions → Social share → Configuration`).

If you want to change location of widget switch off «autoinsertion» mode in Extension config menu 
and manually add tag `{SOCIAL_SHARE}` in one of the templates: 

* `index.tpl`
* `news.tpl`
* `page.tpl`
* `page.list.tpl`
* `forum.posts.tpl`

If you suppose to insert widget in other templates — use `{PHP.social_share}` tag.
If you want to change default `url`, `title` or `description` of sharing page 
— use funciton style tag `{PHP|social_share('url','title','tag')}`.

References
----------

* [Cotonti.com](http://Cotonti.com/) -- Home of Cotonti CMF


