<?php if(page('resume')->page_achievements_structure()->isNotEmpty()): ?>
<div id="achievements" class="c-editor__group">
    <h2>Realisaties</h2>

    <ol class="c-list --size-medium --style-table">
        <?php foreach(page('resume')->page_achievements_structure()->toStructure() as $achievement): ?>
        <li class="o-list__item --size-medium">
            <span class="o-list__preheader"><?php echo $achievement->year() ?></span>
            <?php echo $achievement->achievement()->kirbytextinline() ?>
        </li>
        <?php endforeach ?>
    </ol>
</div>
<?php endif ?>