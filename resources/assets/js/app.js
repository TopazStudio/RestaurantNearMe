//JQUERY AND BOOTSTRAP
try {
    window.$ = window.jQuery = require('jquery');
    require('jquery.easing');
    require('./jquery.mixitup.min');
    require('bootstrap-sass');
} catch (e) {}

//AXIOS
window.axios = require('axios');

//TODO: remove to allow adding of headers when need
function addAxiosHeaders() {
    window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
    let token = document.head.querySelector('meta[name="csrf-token"]');
    if (token) {
        window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
    } else {
        console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
    }
}

//CUSTOM JS
function showPopup() {

    document
        .getElementById('login')
        .style.display = 'block';
}

/*document
    .getElementById('popupclick')
    .addEventListener('click', showPopup(), false);*/
function closePopup(){
    document
        .getElementById('login')
        .style.display = 'none';
}

function showPopup1() {

    document
        .getElementById('register')
        .style.display = 'block';
}

/*document
    .getElementById('popuponclick')
    .addEventListener('click', showPopup(), false);*/
function closePopup1(){
    document
        .getElementById('register')
        .style.display = 'none';
}


(function ($) {
    // Instantiate MixItUp:
    $('#Container').mixItUp();

    // Add smooth scrolling to all links in navbar + footer link
    $(".sidenav a").on('click', function(event) {
        var hash = this.hash;
        if( hash ) {
            event.preventDefault();
            $('html, body').animate({
                scrollTop: $(hash).offset().top
            }, 900, function(){
                window.location.hash = hash;
            });
        }

    });

    $(".menu-icon").on('click',function (event) {
        document.getElementById("mySidenav").style.width = "250px";
    });

    $(".closebtn").on('click',function (event) {
        document.getElementById("mySidenav").style.width = "0";
    });

    $("#mainSearch").on('keydown',function (event) {
        if (event.keyCode === 13){
            addAxiosHeaders();
            axios.post('http://restaurantnearme.dev/api/search/cuisine/complex',{
                "body":{
                    "query":{
                        "match":{
                            "Name":$("#mainSearch").val()
                        }
                    }
                }

            }).then((response)=>{
                let hits = response.data.hits;
                console.log(hits);
            });
        }
    })

})(jQuery);




