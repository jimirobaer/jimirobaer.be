<?php snippet('header') ?>

<main class="--template-<?php echo $page->intendedTemplate() ?>">

    <div class="c-grid --split">

        <div class="c-grid__item --outline-right">

            <div class="c-grid__wrapper --type-sticky">

                <?php snippet('components/nav.contact') ?>

                <div class="c-content">
                    <div class="c-content__wrapper --type-preview jsPreview">
                        <?php if($page->intendedTemplate() == 'case'): ?>
                        <?php snippet('pages/case.cover') ?>
                        <?php else: ?>
                        <?php snippet('pages/section.profile') ?>
                        <?php endif ?>
                    </div>
                </div>

                <div class="o-credits --type-site c-content__contents c-editor__output --style-half-height">
                    <div class="o-font --secondary u-font-tiny">
                        <?php echo page('home')->page_credits()->kirbytextinline() ?>
                    </div>
                </div>

            </div>

        </div>

        <div class="c-grid__item --highlight">

            <div class="c-grid__wrapper">
                <?php snippet('components/nav.pages') ?>

                <article class="c-content">
                    <?php snippet('pages/section.content') ?>
                </article>
            </div>

        </div>

    </div>

</main>

<?php snippet('footer') ?>