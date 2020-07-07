<!DOCTYPE html>
<html lang="<?php e($kirby->language(), $kirby->language(), 'nl_BE') ?>">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php snippet('helpers/tagmanager', ['type' => 'script']) ?>
    <?php snippet('helpers/seo') ?>
    <?php snippet('helpers/social') ?>
    <?php snippet('helpers/favicon') ?>

    <link rel="canonical" href="<?php echo $page->url() ?>">

    <?php snippet('helpers/cookie', ['type' => 'css']) ?>
    <?php snippet('helpers/assets', ['type' => 'css']) ?>

</head>
<body>

<?php snippet('helpers/tagmanager', ['type' => 'noscript']) ?>