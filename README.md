Smarty Hyperlink Detection
==========================

This is a simple modifier for [Smarty](http://www.smarty.net/)  which automatically detects a hyperlink and replaces it appropriately (images and youtube currently supported).

##Usage

Simply place `modifier.autolink.php` in your Smarty plugins folder (`smarty/libs/plugins`) and then you can use it like this:
```
{$text|autolink}
```

##Sources
* [Stackoverflow - for the logic behind it](http://stackoverflow.com/questions/8027023/regex-php-auto-detect-youtube-image-and-regular-links)
* [golen.net - for how Smarty modifiers work](http://www.golen.net/blog/smarty-plugin-autolink-urls/)