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

    load_website: function load_website() {
        Site.init_viewport();
        Site.create_external_links();
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
                Site.load_website();
            },
        });
    },

    init_viewport: function init_viewport() {
        const viewportClass = document.querySelector('body');
        viewportClass.classList.add('--state-loaded');
    },

    create_external_links: function create_external_links() {

        const host = window.location.hostname;
        const internalLinks = document.querySelectorAll('a');

        function check_url(url) {
            if (/^https?:\/\//.test(url)) { // Absolute URL.
                // The easy way to parse an URL, is to create <a> element.
                // @see: https://gist.github.com/jlong/2428561
                var parser = document.createElement('a');
                parser.href = url;
                return parser.hostname;
            } else { // Relative URL.
                return window.location.hostname;
            }
        }

        internalLinks.forEach(function (link) {

            var link_type = check_url(link);

            if (link_type != host) {
                link.setAttribute('target', '_blank');
            }

        });

    }

}
