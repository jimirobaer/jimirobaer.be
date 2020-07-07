<?php if($page->case_cover()->isNotEmpty()): ?>
<?php $cover = $page->case_cover()->toFile() ?>

<figure class="c-content__background --style-shaded">
    <img src="<?php echo $cover->crop(1280, 1280)->url() ?>" alt="<?php echo $cover->alt() ?>">
</figure>

<?php endif ?>