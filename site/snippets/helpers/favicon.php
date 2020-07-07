<?php if($site->seo_favicon()->isNotEmpty()): ?>
<?php $favicon = $site->seo_favicon()->toFile(); ?>
<link rel="icon" sizes="192x192" href="<?php echo $favicon->resize(192,192)->url(); ?>">
<link rel="apple-touch-icon" href="<?php echo $favicon->resize(192,192)->url(); ?>">
<?php endif ?>
