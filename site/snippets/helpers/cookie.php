<?php if($site->cookie_status()->isTrue()): ?>

<?php if($type == 'css'): ?>
<?php echo css('https://cdn.jsdelivr.net/npm/cookieconsent@3/build/cookieconsent.min.css'); ?>
<?php endif ?>

<?php if($type == 'js'): ?>
<?php echo js('https://cdn.jsdelivr.net/npm/cookieconsent@3/build/cookieconsent.min.js'); ?>

<?php

/* Constants */
$cookie_message = t('cookie_message', "This website uses cookies. By clicking 'Accept', you give your permission for cookies to be set.");
$cookie_allow = t('cookie_allow', 'Allow');
$cookie_deny = t('cookie_deny', 'Deny');
$cookie_text_info = t('cookie_text_info', 'More info');

?>

<script>
    window.cookieconsent.initialise({
        "palette": {
            "popup": {
                "background": "<?php e($site->cookie_style_background()->isNotEmpty(), $site->cookie_style_background(), "#252e39") ?>"
            },
            "button": {
                "background": "<?php e($site->cookie_style_button()->isNotEmpty(), $site->cookie_style_button(), "#14a7d0") ?>"
            }
        },
        "theme": "classic",
        "type": "opt-in",
        "content": {
            "message": "<?php e($site->cookie_text()->isNotEmpty(), $site->cookie_text(), $cookie_message) ?>",
            "allow": "<?php e($site->cookie_text_consent()->isNotEmpty(), $site->cookie_text_consent(), $cookie_allow) ?>",
            "deny": "<?php e($site->cookie_text_no_consent()->isNotEmpty(), $site->cookie_text_no_consent(), $cookie_deny) ?>",

            <?php if($site->cookie_policy()->isNotEmpty()): ?>
            "link": "<?php e($site->cookie_text_info()->isNotEmpty(), $site->cookie_text_info(), $cookie_text_info) ?>",
            "href": "<?php echo $site->cookie_policy()->toPage()->url(); ?>"
            <?php endif ?>

        },

        <?php if($site->cookie_policy()->isEmpty()): ?>
        "showLink": false,
        <?php endif ?>
        
        onStatusChange: function (status, chosenBefore) {
            var type = this.options.type;
            var didConsent = this.hasConsented();
            if (type == 'opt-in' && didConsent) {
                location.reload();
            }
        }

    });
</script>

<?php endif ?>

<?php endif ?>