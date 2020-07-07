<?php snippet('pages/section.skills') ?>
<?php snippet('pages/section.achievements') ?>

<?php if(page('cases')->status() == 'listed'): ?>
<?php echo Html::link(page('cases')->url(), 'Uitgelicht werk bekijken', ['class' => 'o-link']) ?>
<?php endif ?>