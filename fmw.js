window.addEventListener('DOMContentLoaded', (event) => {
    let fmwaclose = document.querySelector('#fmwaclose');
    let fmwapr = document.querySelector('#fmwapr');
    let fmwaopen = document.querySelector('#fmwaopen');
    // when fmwaclose is clicked, add class inactive to fmwapr
    fmwaclose.addEventListener('click', (event) => {
        fmwapr.classList.add('inactive');
        // remove class active from fmwapr
        fmwapr.classList.remove('active');
        // add class inactive to this
        fmwaclose.classList.add('inactive');
        // add class active to fmwaopen
        fmwaopen.classList.remove('inactive');
        fmwaopen.classList.add('active');
    });

    // when fmwaopen is clicked, remove class inactive from fmwapr
    fmwaopen.addEventListener('click', (event) => {
        fmwapr.classList.remove('inactive');
        // add class active to fmwapr
        fmwapr.classList.add('active');
        // remove class inactive from this
        fmwaopen.classList.remove('inactive');
        // add class inactive to fmwaopen
        fmwaopen.classList.add('inactive');
        // add class active to fmwaclose
        fmwaclose.classList.remove('inactive');
        fmwaclose.classList.add('active');
    });


    jQuery(function () {
        callAction();
        whatsappAction();

        // call action
        function callAction() {
            jQuery('.fmcallbg').click(function () {
                let dataCall = 'tel:+' + jQuery(this).attr('data-call');
                window.open(dataCall);
            });
        }

        // whatsapp action
        function whatsappAction() {
            jQuery('.fmwabg').click(function () {
                let dataWhatsapp = 'https://wa.me/' + jQuery(this).attr('data-wa');
                window.open(dataWhatsapp);
            });
        }
















    });


});