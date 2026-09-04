/**
 * Auto-resize an embedded (e.g. Pardot) form iframe.
 *
 * A cross-origin iframe can't be measured from the parent, so the form page
 * inside the iframe must postMessage its height. This listener applies it to
 * any iframe inside a `.js-form-embed` wrapper (Events "Meet us there" and
 * Webinar registration). Pair with the snippet in the form's Layout Template.
 */
(function () {
    'use strict';

    function applyHeight(px) {
        px = parseInt(px, 10);
        if (!px || px < 100) {
            return;
        }
        var iframes = document.querySelectorAll('.js-form-embed iframe');
        for (var i = 0; i < iframes.length; i++) {
            iframes[i].style.height = px + 'px';
        }
    }

    window.addEventListener('message', function (e) {
        // Only trust messages from our own domains.
        if (typeof e.origin !== 'string' || e.origin.indexOf('okaloneworker.com') === -1) {
            return;
        }
        var data = e.data;
        if (data && typeof data === 'object' && data.cbFormHeight) {
            applyHeight(data.cbFormHeight);
        }
    });
})();
