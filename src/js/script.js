/*------------------------------------------------------------------
[Master Script]

Author:     Lonely Alien (Jimi Robaer)
Version:	1.0.0
-------------------------------------------------------------------*/

window.onload = (event) => {
    Site.init();
};

var Site = {

    init: function init() {
        Site.webfont_loader();
    },

    webfont_loader: function webfont_loader() {

        /**
         * Web Font Loader gives you added control when using linked fonts via @font-face.
         * Use modules: https://github.com/typekit/webfontloader#modules 
         */

        WebFont.load({
            typekit: {
                id: 'mkc3lun'
            },
            google: {
                families: ['Inter:regular']
            },
            active: function () {
                Site.init_viewport();
            },
        });
    },

    init_viewport: function init_viewport() {
        const viewportClass = document.querySelector('body');
        viewportClass.classList.add('--state-loaded');
    }

}
