    function showPopup() {
      
        document
            .getElementById('login')
            .style.display = 'block';
    }

    document
        .getElementById('popupclick')
        .addEventListener('click', showPopup(), false);
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

    document
        .getElementById('popuponclick')
        .addEventListener('click', showPopup(), false);
         function closePopup1(){
       document
            .getElementById('register')
            .style.display = 'none';
    }


function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
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
    
})(jQuery);

   