<nav class="c-nav --outline-bottom">
    <?php foreach($site->pages()->listed()->not('home') as $item): ?>

    <?php if($item->isActive()) {
        $state = ' --state-active';
    } else {
        $state = '';
    } ?>

    <?php if($item->intendedTemplate() == 'external' ) {
        $url = $item->external_url();
    } else {
        $url = $item->url();
    } ?>

    <?php echo Html::link($url, $item->title(), ['class' => 'c-nav__item c-nav__breadcrumb'.$state]) ?>

    <?php endforeach ?>
</nav>