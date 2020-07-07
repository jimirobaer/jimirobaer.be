<div class="c-content__contents">

    <article class="c-editor__output --style-<?php echo $page->intendedTemplate() ?>">
        <h1 class="c-editor__title o-font --primary"><?php echo $page->title() ?></h1>

        <?php if($page->case_introduction()->isNotEmpty()): ?>
        <div class="c-content__description">
            <?php echo $page->case_introduction()->kirbytextinline() ?>
        </div>
        <?php endif ?>

        <?php if($page->intendedTemplate() == 'case'): ?>
        <div id="tasks" class="c-editor__group">
            <h2>Verantwoordelijkheden</h2>
            <ul class="c-list --style-table">
                <?php foreach($page->page_tasks_structure()->toStructure() as $task): ?>
                <li class="o-list__item --size-medium --style-table">
                    <?php echo $task->task() ?>
                </li>
                <?php endforeach ?>
            </ul>
        </div>
        <?php endif ?>

        <div class="c-editor__body">

            <div id="content" class="c-editor__group">
                <?php echo $page->page_content()->kt() ?>
            </div>

            <?php if($page->intendedTemplate() == 'resume'): ?>
            <?php snippet('pages/section.resume') ?>
            <?php endif ?>

            <div class="c-credits">
                <div class="o-font --secondary u-font-tiny">
                    <?php echo $page->case_credits()->kirbytextinline() ?>
                </div>
            </div>

        </div>

        <?php if($page->intendedTemplate() == 'cases'): ?>
            <?php snippet('pages/section.cases') ?>
        <?php endif ?>

    </article>

</div>