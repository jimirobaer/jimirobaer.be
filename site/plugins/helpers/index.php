<?php

/*
 *  Kirby 3 Boilerplate Helpers
 */

// Check if indexed & return state
function isIndexed($site) {
    $site_url = $site->site_url();
    $host_url = $_SERVER['HTTP_HOST'];
    $status = $site->site_index();

    // Return false is site does not match host
    if($site_url != $host_url) {
        return false;
    }

    // Return false if status is noindex
    if($status != 'index') {
        return false;
    } else {
        return true;
    }

}

/**
 * Returns correct SEO values
 *
 * @param object $object Context of needed object (eg. Page, Site)
 * @param string $type Type (field name, eg. title, image, description)
 */
function getSeoMeta($object, $type, string $mode = 'return') {

    $kirby = kirby();

    // Construct SEO field name
    $seo_prefix = "seo_";
    $seo_type = $seo_prefix.$type;

    if($mode == 'return') {
        if($object->$seo_type()->isNotEmpty()) {
            return $object->$seo_type();
        } else {
            return $object->$type();
        }
    }

    if($mode == 'compare') {

        $page = page();
        $site = site();

        if($page->$seo_type()->isNotEmpty()) {
            return $page->$seo_type();
        } else {
            return $site->$seo_type();
        }

    }

}