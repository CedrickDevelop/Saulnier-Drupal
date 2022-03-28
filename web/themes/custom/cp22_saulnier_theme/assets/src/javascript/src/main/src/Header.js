import {$, T} from "../../common/drupal/drupal";
/**
 * Class de gestion du header mobile
 */
class Header {

    /**
     * init
     */
    init(){
      let btnBurger = document.querySelector('.Header-hamburger');
      let main_menu = document.querySelector('.Header-mobileMenu');
      let btnLienMenu = document.querySelector('.btn-liens-menu');
      let mainMenuSecondOpen = document.querySelector('.Header-menuMain-secondLevel');


      btnBurger.addEventListener("click", function() {
        main_menu.classList.toggle('display_block');
        btnBurger.classList.toggle('js-mobile-menu-open')
      })

      btnLienMenu.addEventListener("click", function() {
        mainMenuSecondOpen.style.position = "static";
        console.log('static')
      })

      // déclaration de la variable qui contient du li de premier niveau du menu principal
      this.$MainMenuFirstLevelLinks = $('.Header-menuMain-firstLevel > .Header-menuMain-itemList');
      // declaration du body pour etre à l'ecoute des evenement sur toute la page
      this.$body = $('body');
      // this.$header = $('.Header');
      // this.$hamburger = $('.Header-hamburger');


      // Lorsque l'on click n'importe ou sur la page on supprime la classe
      this.$MainMenuFirstLevelLinks.on('click', event => {this.manageClickOnFirstLevelMainMenuLinks(event)});

      // this.$hamburger.on('click', event => {this.manageClickOnHamburger(event)});

      this.$body.on('click', event => {this.manageClickOnBody(event)});

      // let resizeTimeout;
      // $(window).resize(function(){
      //   if(!!resizeTimeout){ clearTimeout(resizeTimeout); }
      //   resizeTimeout = setTimeout(function(){
      //     let windowSize = T.viewport();
      //     if (windowSize.width > 1279) {
      //       $('.Header').removeClass('js-mobile-menu-open');
      //     }
      //   },200);
      // });
    }

      // Creation d'un event listener au click sur un element
      manageClickOnFirstLevelMainMenuLinks (event) {
        let $currentTarget = $(event.currentTarget);
        if ($currentTarget.hasClass('js-open')) {
          $currentTarget.removeClass('js-open');
        }
        else {
          this.$MainMenuFirstLevelLinks.removeClass('js-open');
          $currentTarget.addClass('js-open');
        }
        event.stopPropagation();
      }

      manageClickOnBody(event) {
        this.$MainMenuFirstLevelLinks.removeClass('js-open');
      }

      // manageClickOnHamburger(event) {
      //   this.$header.toggleClass('js-mobile-menu-open');
      // }



    /**
     * Attach.
     * @param context
     */
    attach(context) {
        if (T.contextIsRoot(context)) {
            this.init();
        }
    }
}

export let header = new Header();
