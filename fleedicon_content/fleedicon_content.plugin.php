<?php

/*
  @name Fleedicon_content
  @author Simounet <contact@simounet.net>
  @author gavrochelegnou (plugin's creator) <gavroche-leg.nou+test@tr+ash_mail.net>
  @licence CC by nc sa http://creativecommons.org/licenses/by-nc-sa/2.0/fr/
  @version 2.0.0
  @description Add the site's favicon on the left of each feed (setup can take a while if you have many feeds)
 */


require( 'classes/Fleedicon.php' );

define('FLEEDICON_PATH', Plugin::path());

function fleedicon_content_plugin_addFavicon(&$event) {
    $fleedicon = new Fleedicon($event->getFeed(), FLEEDICON_PATH);
    $event->favicon = $fleedicon->action();
}

function fleedicon_aside_plugin_addFavicon(&$feed) {
    $fleedicon = new Fleedicon($feed['id'], FLEEDICON_PATH);
    $feed['favicon'] = $fleedicon->action();
}

function fleedicon_save_favicon(&$feed) {
    $fleedicon = new Fleedicon($feed->getId(), FLEEDICON_PATH);
    $fleedicon->setFavicon(false);
}

function fleedicon_remove_favicon($id) {
    $fleedicon = new Fleedicon($id, FLEEDICON_PATH);
    $fleedicon->removeFavicon();
}

Plugin::addHook("event_pre_title", "fleedicon_content_plugin_addFavicon");
Plugin::addHook("menu_pre_feed_link", "fleedicon_aside_plugin_addFavicon");
Plugin::addHook("action_after_addFeed", "fleedicon_save_favicon");
Plugin::addHook("action_after_removeFeed", "fleedicon_remove_favicon");
