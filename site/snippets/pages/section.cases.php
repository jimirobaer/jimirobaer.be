<ul class="c-list --size-large">

    <?php foreach(page('cases')->children()->listed() as $case): ?>

    <li class="o-list__item --size-large --style-reset">
        <a class="c-nav__item --size-inherit" href="<?php echo $case->url() ?>">
            <?php if($case->case_cover()->isNotEmpty()): ?>
            <?php $cover = $case->case_cover()->toFile(); ?>
            <figure class="o-figure --style-no-top-margin --style-medium-bottom-margin">
                <img src="<?php echo $cover->crop(1280, 640)->url() ?>" alt="">
            </figure>
            <?php endif ?>
            <?php echo $case->title() ?>
        </a>
    </li>
    <?php endforeach ?>

</ul>