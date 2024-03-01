 $(document).ready(function() {

    $.blockUI.defaults = {

        message: '&lt;h1&gt;Please wait...&lt;/h1&gt;',

        title: null,

        draggable: true,

        theme: false,

        css: {
            padding: 0,
            margin: 0,
            width: '45%',
            top: '10%',
            left: '30%',
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



    $('#next_btn_1').click(function() {
    $('.step-pane.step1').hide();
    $('.step-pane.step2').removeClass("hide");
});

    $('#prev_btn_1').click(function() {
    $('.step-pane.step2').addClass("hide");
    $('.step-pane.step1').show();
});

    $('#next_btn_2').click(function() {
    $('.step-pane.step2').hide();
    $('.step-pane.step3').removeClass("hide");
});

    $('#prev_btn_2').click(function() {
    $('.step-pane.step3').addClass("hide");
    $('.step-pane.step2').show();
});

    $('.js-select_button').click(function() {
    var next_step = $(this).data('next');
    if (next_step == "step2") {
    $('.step-pane.step1').hide();
    $("li[data-target='step1']").removeClass('active');
    $('.step-pane.step2').show();
    $("li[data-target='step2']").addClass('active');
}
});

    $('.btn-prev').click(function() {
    var prev_step = $(this).data('prev');
    if (prev_step == "step1") {
    $('.step-pane.step2').hide();
    $("li[data-target='step2']").removeClass('active');
    $('.step-pane.step1').show();
    $("li[data-target='step1']").addClass('active');
}
});

    $(".close-box-button").click(function() {
    $.unblockUI();
});

});