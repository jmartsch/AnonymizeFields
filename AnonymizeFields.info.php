<?php namespace ProcessWire;

/**
 * Module info file that tells ProcessWire about this module.
 *
 * If you prefer to keep everything in the main module file, you can move this
 * to a static getModuleInfo() method in the Helloworld.module.php file, which
 * would return the same array as below. However, an external file like this
 * is often preferable because it enables ProcessWire to determine the module
 * requirements before attempting to load the .module.php file.
 *
 * Note: When updating this info for an already-installed module, you’ll need
 * to do a Modules > Refresh before you see your updated info.
 *
 * Required properties: title, version, summary. All others are optional.
 *
 */

$info = array(

  // title: Module title, typically a little more descriptive than the class name
  'title' => 'Anonymize fields (DSGVO, GDPR)',

  // version: The version number, either integer or '1.2.3' string
  'version' => '1.0.1',

  // summary: A brief description of what this module is
  'summary' => __('Clears or anonymizes fields with user identifiable data and additionally deletes all files if you selected a file field'),

  // author: Name of the person (or people) that authored this module
  'author' => 'Jens Martsch, dotnetic',

  // Optional URL to more information about the module
  'href' => 'https://processwire.com/talk/topic/26404-anonymizefields-gdpr-dsgvo/',

  // singular=true: Indicates that only one instance of the module is allowed.
  // This is usually what you want for modules that attach hooks.
  'singular' => true,

  // autoload=true: Indicates the module should be loaded automatically at boot.
  // This is necessary for any modules that attach runtime hooks, otherwise those
  // hooks won’t get attached unless some other code calls the module on its own.
  // Note that autoload modules are almost always also 'singular' (seen above).
  // Autoload modules take up memory so only use it when you need it!
  'autoload' => true,

  // Optional font-awesome icon name, minus the 'fa-' part
  'icon' => 'smile-o',

  // Optionally describe versions of ProcessWire, PHP or modules that are required.
  // To specify more modules, separate each with a comma (CSV) or use PHP array.
  'requires' => 'ProcessWire>=3.0.0, PHP>=7.4.0',

  'installs' => array('LazyCron'),
  // for more properties that you can include in your module info, see comments
  // the file: /wire/core/Module.php
);
