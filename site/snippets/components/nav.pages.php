<nav class="c-nav --outline-bottom">
    <?php foreach($site->pages()->listed()->not('home') as $item): ?>

    <?php if($item->isActive()) {
        $state = ' --state-active';
    } else {
        $state = '';
    } ?>

    <?php echo Html::link($item->url(), $item->title(), ['class' => 'c-nav__item c-nav__breadcrumb'.$state]) ?>

    <?php endforeach ?>
</nav>