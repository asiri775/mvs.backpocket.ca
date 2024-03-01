
    $(document).ready(function () {

    $.blockUI.defaults = {

        message: '&lt;h1&gt;Please wait...&lt;/h1&gt;',

        title: null,

        draggable: true,

        theme: false,

        css: {
            padding: 0,
            margin: 0,
            width: '30%',
            top: '10%',
            left: '35%',
            textAlign: 'center',
            color: '#000',
            border: '3px solid #aaa',
            backgroundColor: '#fff'
            //cursor: 'wait'
        },

        themedCSS: {
            width: '30%',
            top: '40%',
            left: '35%'
        },

        overlayCSS: {
            backgroundColor: '#000',
            opacity: 0.6
            //cursor: 'wait'
        },

        cursorReset: 'default',

        growlCSS: {
            width: '350px',
            top: '10px',
            left: '',
            right: '10px',
            border: 'none',
            padding: '5px',
            opacity: 0.6,
            cursor: null,
            color: '#fff',
            backgroundColor: '#000',
            '-webkit-border-radius': '10px',
            '-moz-border-radius': '10px'
        },

        iframeSrc: /^https/i.test(window.location.href || '') ? 'javascript:false' : 'about:blank',

        forceIframe: false,

        baseZ: 1000,

        centerX: true,

        centerY: true,

        allowBodyStretch: true,

        bindEvents: true,

        constrainTabKey: true,

        fadeIn: 200,

        fadeOut: 400,

        timeout: 0,

        showOverlay: true,

        focusInput: true,

        onBlock: null,

        onUnblock: null,

        quirksmodeOffsetHack: 4,

        blockMsgClass: 'blockMsg',

        ignoreIfBlocked: false
    };

    $(document).on('click', '.js-invoice_to_email', function (e) {
    e.preventDefault();
    e.stopPropagation();

    $.blockUI({
    message: $('#emails_form')
});

    $('.blockOverlay').click($.unblockUI);
    //$('.close-box-button').click($.unblockUI);
});


});