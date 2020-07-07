<?php

$seo_title = getSeoMeta($page, 'title')." - ".getSeoMeta($site, 'title');
$seo_text = getSeoMeta($page, 'description', 'compare');
$seo_image = getSeoMeta($page, 'cover', 'compare')->toFile();

?>

<?php /* OpenGraph Meta */ ?>
<meta property="og:title" content="<?php echo $seo_title ?>" />
<meta property="og:site_name" content="<?php echo $site->title()->value() ?>" />
<meta property="og:url" content="<?php echo $page->url() ?>" />
<meta property="og:description" content="<?php echo $seo_text ?>" />

<?php if($seo_image != ''): ?>
<meta property="og:image" content="<?php echo $seo_image->crop('1200','630')->url() ?>" />
<meta property="og:image:width" content="1200" />
<meta property="og:image:height" content="630" />
<meta name="image_src" content="<?php echo $seo_image->url() ?>" />
<?php endif ?>

<?php /* Twitter meta */ ?>
<?php if($site->site_social_twitter_user()->isNotEmpty()): ?>
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="<?php echo $seo_title ?>">
<meta name="twitter:description" content="<?php echo $seo_text ?>">
<?php endif ?>

<?php if($seo_image != ''): ?>
<meta name="twitter:image" content="<?php echo $seo_image->crop('1200','600')->url() ?>">
<?php endif ?>