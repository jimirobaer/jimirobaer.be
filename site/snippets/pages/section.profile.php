<?php if(page('home')->profile_picture()->isNotEmpty()): ?>
<?php $profile = page('home')->profile_picture()->toFile() ?>

<figure class="c-content__background --style-shaded">
    <img src="<?php echo $profile->crop(1280, 1280)->url() ?>" alt="Profielfoto van Jimi Robaer">
</figure>

<div class="c-content__contents c-content__overlay c-content__header">
    <p class="o-font --secondary u-font-large">Hey, ik ben Jimi</p>
    <h1 class="c-content__title o-font --primary">
        <?php echo page('home')->page_content()->kirbytextinline() ?></h1>
</div>

<?php endif ?>