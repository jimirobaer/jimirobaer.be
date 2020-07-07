<?php if(page('resume')->page_skills_structure()->isNotEmpty()): ?>
<div id="skills" class="c-editor__group">
    <h2>Vaardigheden</h2>

    <ul class="c-list --style-table">
        <?php foreach(page('resume')->page_skills_structure()->toStructure() as $skill): ?>
        <li class="o-list__item --size-medium --style-table">
            <?php echo $skill->skill() ?>
        </li>
        <?php endforeach ?>
    </ul>
</div>
<?php endif ?>