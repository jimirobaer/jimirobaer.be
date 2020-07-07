<nav class="c-nav --outline-bottom --justify-between">
    <?php echo Html::link($site->url(), $site->title(), ['class' => 'c-nav__item']) ?>
    <?php echo Html::email($site->site_email(), null, ['class' => 'c-nav__item --state-active jsCopyEmail']) ?>
</nav>