<title><?php echo (getSeoMeta($page, 'title')." - ".getSeoMeta($site, 'title')) ?> </title>
<meta name="description" content="<?php echo getSeoMeta($page, 'description', 'compare') ?>">
<meta name="robots" content="<?php e(isIndexed($site) == true, 'index,follow', 'noindex') ?>">
<?php if($site->seo_author()->isNotEmpty()): ?>
<meta name="author" content="<?php echo $site->seo_author() ?>">
<?php endif ?>
<?php if($site->advanced_google_search()->isNotEmpty()): ?>
<meta name="google-site-verification" content="<?php echo $site->advanced_google_search()->value() ?>">
<?php endif ?>