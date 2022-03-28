import {$, T} from "../../common/drupal/drupal";
import Swiper, { Navigation, Autoplay } from 'swiper';
Swiper.use([Navigation, Autoplay]);
/**
 * Class exemple de gestion du footer
 */
class Footer {

    /**
     * init
     */
    init(){
      // template du slider partenaire :
      // web/modules/custom/cp22_saulnier_partners/templates/partners-slider.html.twig
      //
      // let largeur_ecran = document.body.clientWidth;
      // let numbre_element_swipe = 5;
      //
      // if(largeur_ecran < 719){
      //   numbre_element_swipe = 3;
      // }

      const swiper = new Swiper('.swiper', {
        loop: true,
        slidesPerView: 6,
        spaceBetween: 30,
        spaceAround: 50,
        keyboard: {
          enabled: true,
        },
        pagination: {
          el: ".swiper-pagination",
          clickable: true,
        },
        autoplay: {
          delay: 2500,
          disableOnInteraction: false,
        },
        breakpoints: {
          0: {
            slidesPerView: 3
          },
          500: {
            slidesPerView: 3,
            spaceBetween: 20,
          },
          700: {
            slidesPerView: 4,
            spaceBetween: 20,
          },
          900: {
            slidesPerView: 5,
            spaceBetween: 20,
          },
          1100: {
            slidesPerView: 6,
            spaceBetween: 20,
          },
          1300: {
            slidesPerView: 7,
            spaceBetween: 20,
          },
          1500: {
            slidesPerView: 8,
            spaceBetween: 20,
          },
          1900: {
            slidesPerView: 9,
            spaceBetween: 20,
          },
        },
        navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev',
        },
      });


    }

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

export let footer = new Footer();
