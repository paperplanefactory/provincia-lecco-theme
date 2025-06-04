/////////////////////////////////////////////
// lazy load
/////////////////////////////////////////////
var lazyLoadInstances = [];
var paperPlaneLazyLoad = new LazyLoad({
  elements_selector: ".lazy",
  class_loading: "lazy-loading",
  class_loaded: "lazy-loaded",
  callback_enter: function (el) {
    // console.log('entered');
    var oneLL = new LazyLoad({
      container: el
    });
    lazyLoadInstances.push(oneLL);
  },
  callback_reveal: (el) => {
    if (el.complete && el.naturalWidth !== 0) {
      el.classList.remove('lazy-loading');
      el.classList.add('lazy-loaded');
    }
  }
});

/////////////////////////////////////////////
// impaginazione forzata immagini e video in the_content()
/////////////////////////////////////////////

function manipulateContent(e) {
  // Wrappo i video player in una div per dimensionarli responsive
  $('.content-styled iframe').wrap('<div class="video_frame"></div>');
  // Controllo se l'immagine ha la didascalia e se manca la wrappo per allinearla
  if (!$('img.alignnone').closest('.wp-caption').length) {
    $('img.alignnone').wrap('<div class="wp-caption alignnone"></div>');
  }
  if (!$('img.aligncenter').closest('.wp-caption').length) {
    $('img.aligncenter').wrap('<div class="wp-caption aligncenter"></div>');
  }
  if ($('img.alignleft')) {
    $('img.alignleft').wrap('<div class="wp-caption alignleft"></div>');
  }
  if ($('img.alignright')) {
    $('img.alignright').wrap('<div class="wp-caption alignright"></div>');
  }
}
manipulateContent();

/////////////////////////////////////////////
// hamburger
/////////////////////////////////////////////

function hamburgerMenu(e) {
  $('.hambuger-element').toggleClass('open');

  if ($('.hambuger-element').hasClass('open')) {
    $('html').css('overflowY', 'hidden');
    $('html').addClass('occupy-scrollbar');
    $('#header-overlay').focus();
    $('.hambuger-element').attr('aria-expanded', true);
    $('#header').addClass('compact');
    $('#head-overlay').toggleClass('hidden');

    // Aggiungi focus trap per il menu hamburger
    setTimeout(() => {
      addHamburgerFocusTrap();
    }, 100);

  } else {
    $('html').css('overflowY', 'scroll');
    $('html').removeClass('occupy-scrollbar');
    $('#header').focus();
    $('.hambuger-element').attr('aria-expanded', false);
    $('.scroll-opportunity').scrollTop(0);
    $('#header').removeClass('compact');
    $('#head-overlay').toggleClass('hidden');

    // Rimuovi focus trap
    removeHamburgerFocusTrap();

    // Riporta focus al pulsante hamburger
    setTimeout(() => {
      $('.hambuger-element').focus();
    }, 100);
  }
}

function addHamburgerFocusTrap() {
  // Aggiungi listener per l'elemento focus trap del menu
  $('.hamburger-focus-trap-end').on('focus', function () {
    // Torna al pulsante hamburger con classe ham-activator
    $('.hambuger-element').focus();
  });

  // Aggiungi listener per il focus trap inverso (Shift+Tab sul primo elemento)
  $('.hambuger-element').on('keydown.hamburgerTrap', function (e) {
    if (e.key === 'Tab' && e.shiftKey) {
      e.preventDefault();
      // Trova l'ultimo elemento focusabile del menu prima del trap
      const focusableElements = $('#head-overlay').find('button:not([disabled]), [href], input:not([disabled]), select:not([disabled]), textarea:not([disabled]), [tabindex]:not([tabindex="-1"])').not('.hamburger-focus-trap-end');
      const lastElement = focusableElements.last();
      if (lastElement.length) {
        lastElement.focus();
      }
    }
  });

  // Gestisci il tasto Escape per chiudere il menu
  $(document).on('keydown.hamburgerMenu', function (e) {
    if (e.key === 'Escape') {
      if ($('.hambuger-element').hasClass('open')) {
        hamburgerMenu();
      }
    }
  });
}

function removeHamburgerFocusTrap() {
  $('.hamburger-focus-trap-end').off('focus');
  $('.hambuger-element').off('keydown.hamburgerTrap');
  $(document).off('keydown.hamburgerMenu');
}

/////////////////////////////////////////////
// gestione comportamenti su resize mobile > desktop < mobile
/////////////////////////////////////////////

function checkWidth() {
  var windowsize = $(window).width();
  if (windowsize > 1024) {
    // close overlay if open when resizing to desktop
    $('.hambuger-element').removeClass('open');
    $('html').css('overflowY', 'scroll');
    $('html').removeClass('occupy-scrollbar');
    $('#head-overlay').addClass('hidden');
    $('.hambuger-element').attr('aria-expanded', false);
  }
  if (windowsize < 1024) {
    $('.index-menu-expander-js').attr('aria-expanded', false);
    $('.index-menu-expander-js').find('span').addClass('icon-expand').removeClass('icon-collapse-1');
    $('.index-menu-expander-js').next('.index-menu-js').slideUp(150);
  }
}

$(window).resize(checkWidth);
checkWidth();



/////////////////////////////////////////////
// search overlay
/////////////////////////////////////////////

function openSearch(e) {
  $('#search-overlay').attr('aria-expanded', true).toggleClass('hidden');
  $('.activate-search-js').attr('aria-expanded', true);
  $('html').css('overflowY', 'hidden');
  $('html').addClass('occupy-scrollbar');

  // Aspetta che le transizioni CSS finiscano
  setTimeout(() => {
    $('.search-input-kw-js-ovarlay').focus();

    // Aggiungi il focus trap
    addFocusTrap();
  }, 100);
}

function closeSearch(e) {
  $('#search-overlay').attr('aria-expanded', false).toggleClass('hidden');
  $('.activate-search-js').attr('aria-expanded', false);
  $('html').css('overflowY', 'scroll');
  $('html').removeClass('occupy-scrollbar');
  $(this).attr('aria-expanded', false);
  $('.scroll-opportunity').scrollTop(0);

  // Rimuovi il focus trap
  removeFocusTrap();

  // Aspetta che le transizioni finiscano prima di fare focus
  setTimeout(() => {
    $('.activate-search-js').focus();
  }, 100);
}

function addFocusTrap() {
  // Aggiungi listener per l'elemento focus trap
  $('.focus-trap-end').on('focus', function () {
    $('.search-overlay-title-js').focus();
  });

  // Aggiungi listener per il primo elemento (focus trap inverso)
  $('.search-overlay-title-js').on('keydown', function (e) {
    if (e.key === 'Tab' && e.shiftKey) {
      e.preventDefault();
      // Trova l'ultimo elemento focusabile prima del trap
      const focusableElements = $('#search-overlay').find('button:not([disabled]), [href], input:not([disabled]), select:not([disabled]), textarea:not([disabled]), [tabindex]:not([tabindex="-1"])').not('.focus-trap-end');
      const lastElement = focusableElements.last();
      lastElement.focus();
    }
  });
}

function removeFocusTrap() {
  $('.focus-trap-end').off('focus');
  $('.search-overlay-title-js').off('keydown');
}

/////////////////////////////////////////////
// search input functions
/////////////////////////////////////////////

function searchErase(e) {
  $('.search-input-kw-js').val('');
  $('.search-erase-js').fadeOut(300);
}

$('.search-input-kw-js').on('input', function () {
  input_text = $(this).val();
  searchInputCheck(input_text);
});

function searchInputCheck(input_text) {
  if (input_text != '') {
    $('.search-erase-js').fadeIn(300);
  } else {
    $('.search-erase-js').fadeOut(300);
  }
}

$('.search-input-kw-js').each(function (index) {
  input_text = $(this).val();
});

searchInputCheck(input_text);

/////////////////////////////////////////////
// local storage
/////////////////////////////////////////////

function setAvvisoLocalStorage() {
  sessionStorage.setItem('mostra_avviso', 'no');
}

function checkAvvisoLocalStorage() {
  var mostra_avviso = sessionStorage.getItem('mostra_avviso');
  if (mostra_avviso != 'no') {
    $('#avviso-visibility-js').addClass('avviso-attivo');

  }
}

checkAvvisoLocalStorage();

function closeAvvisoMain(this_element) {
  setAvvisoLocalStorage();
  $('#avviso-visibility-js').removeClass('avviso-attivo');
}


/////////////////////////////////////////////
// menu scroll effect
/////////////////////////////////////////////

var lastScrollTop = 0;

function scrollDirectionMenu() {
  var checkWidth = $(window).width();
  var st = $(this).scrollTop();

  if (checkWidth > 1024) {
    if ((st > lastScrollTop) && (st > 230)) {
      // downscroll code
      $('#header').addClass('hidden');
      $('#header-compact').removeClass('hidden');
      $('.sticky-columns-js').addClass('sticky-element-compact').removeClass('sticky-element-expanded');
    } else {
      // upscroll code
      $('#header').removeClass('hidden');
      $('#header-compact').addClass('hidden');
      $('.sticky-columns-js').addClass('sticky-element-expanded').removeClass('sticky-element-compact');
    }
  } else {
    if ((st > lastScrollTop) && (st > 100)) {
      // downscroll code
      $('#header').addClass('compact');
      //$('.sticky-columns-js').addClass('sticky-element-compact').removeClass('sticky-element-expanded');
    } else {
      // upscroll code
      $('#header').removeClass('compact');
      //$('.sticky-columns-js').addClass('sticky-element-expanded').removeClass('sticky-element-compact');
    }
  }

  lastScrollTop = st;
}


$(window).scroll(function (event) {
  scrollDirectionMenu();
});

/////////////////////////////////////////////
// slick slideshow
/////////////////////////////////////////////


$('.slide-one').slick({
  dots: false,
  focusOnSelect: true,
  draggable: true,
  infinite: true,
  accessibility: true,
  //adaptiveHeight: true,
  //fade: true,
  lazyLoad: 'progressive',
  nextArrow: '<button class="slick-next"><i class="icon-right-arrow" aria-hidden="true"></i><span class="screen-reader-text">Contenuti successivi</span></button>',
  prevArrow: '<button class="slick-prev"><i class="icon-left-arrow" aria-hidden="true"></i><span class="screen-reader-text">Contenuti precedenti</span></button>',
});

$(document).on('keydown', function (e) {
  if (e.keyCode == 37) {
    $('.slide-one').slick('slickPrev');
  }
  if (e.keyCode == 39) {
    $('.slide-one').slick('slickNext');
  }
});


$('.slide-four').on('init reInit', function (event, slick) {
  // Trasforma dopo ogni inizializzazione
  setTimeout(() => {
    //transformSlickToList();
  }, 100);
});
$('.slide-four').slick({
  lazyLoad: 'ondemand',
  //dots: true,
  focusOnSelect: true,
  dots: false,
  draggable: true,
  infinite: false,
  accessibility: true,
  adaptiveHeight: false,
  slidesToShow: 4,
  slidesToScroll: 4,
  nextArrow: '<button class="slick-next"><i class="icon-right-arrow" aria-hidden="true"></i><span class="screen-reader-text">Contenuti successivi</span></button>',
  prevArrow: '<button class="slick-prev"><i class="icon-left-arrow" aria-hidden="true"></i><span class="screen-reader-text">Contenuti precedenti</span></button>',
  responsive: [{
    breakpoint: 1024,
    settings: {
      slidesToShow: 1,
      slidesToScroll: 1
    }
  }]
});
$(document).on('keydown', function (e) {
  if (e.keyCode == 37) {
    $('.single-item').slick('slickPrev');
  }
  if (e.keyCode == 39) {
    $('.single-item').slick('slickNext');
  }
});

function transformSlickToList() {
  const slickTrack = document.querySelector('.slick-track');

  if (slickTrack && slickTrack.tagName !== 'UL') {
    // Crea il nuovo elemento UL
    const ul = document.createElement('ul');
    ul.className = slickTrack.className;
    ul.setAttribute('role', 'list');

    // Copia tutti gli attributi
    Array.from(slickTrack.attributes).forEach(attr => {
      ul.setAttribute(attr.name, attr.value);
    });

    // Trasforma le slides in LI e rimuovi i div wrapper
    const slides = slickTrack.querySelectorAll('.slick-slide');
    slides.forEach(slide => {
      const li = document.createElement('li');
      li.className = slide.className;
      li.setAttribute('role', 'listitem');

      // Copia attributi della slide
      Array.from(slide.attributes).forEach(attr => {
        li.setAttribute(attr.name, attr.value);
      });

      // Gestisci il contenuto della slide
      const innerDiv = slide.querySelector(':scope > div:not([class*="slick-"])');

      if (innerDiv) {
        // Se c'è un div wrapper, usa il suo contenuto
        li.innerHTML = innerDiv.innerHTML;
      } else {
        // Altrimenti usa tutto il contenuto della slide
        li.innerHTML = slide.innerHTML;
      }

      ul.appendChild(li);
    });

    // Sostituisci nell'DOM
    slickTrack.parentNode.replaceChild(ul, slickTrack);
  }
}

/////////////////////////////////////////////
// expandables
/////////////////////////////////////////////

$('.expander').click(function (e) {
  if ($(this).hasClass('exp-close')) {
    $(this).addClass('exp-open').removeClass('exp-close').attr('aria-expanded', false).focus();
    $(this).find('span').addClass('exp-plus').removeClass('exp-minus');
    $(this).parent().next('.expandable-content').slideUp(150);
  } else {
    $(this).addClass('exp-close').removeClass('exp-open').attr('aria-expanded', true);
    $(this).find('span').removeClass('exp-plus').addClass('exp-minus');
    $(this).parent().next('.expandable-content').slideDown(150).focus();
  }
});

function pageListMenuControl(this_element) {
  if ($(this_element).find('.icon-js').hasClass('icon-expand')) {
    //$(this_element).attr('aria-expanded', true);
    $(this_element).find('.icon-js').removeClass('icon-expand').addClass('icon-collapse-1');
    //$(this_element).prev('.page-opening-menu-js').find('div').slideDown(150);
    $(this_element).find('.text-js').text('Nascondi');
    // Aggiungi classe agli li dal sesto in poi
    $(this_element).prev('ul').find('li:nth-child(n+6)').removeClass('hidden');

  } else {
    //$(this_element).attr('aria-expanded', false);
    $(this_element).find('.icon-js').addClass('icon-expand').removeClass('icon-collapse-1');
    //$(this_element).prev('.page-opening-menu-js').find('div').slideUp(150);
    $(this_element).find('.text-js').text('Espandi');
    // Rimuovi classe dagli li dal sesto in poi
    $(this_element).prev('ul').find('li:nth-child(n+6)').addClass('hidden');
  }
}

function pageSearchReultsControl(this_element) {
  event.preventDefault();
  if ($(this_element).find('.icon-js').hasClass('icon-expand')) {
    $(this_element).attr('aria-expanded', false);
    $(this_element).find('.icon-js').removeClass('icon-expand').addClass('icon-left-arrow-tip');
    $(this_element).next('.page-search-cats-listing-js').slideUp(150);

  } else {
    $(this_element).attr('aria-expanded', true);
    $(this_element).find('.icon-js').addClass('icon-expand').removeClass('icon-left-arrow-tip');
    $(this_element).next('.page-search-cats-listing-js').slideDown(150);
  }
}

function pageSearchElementChecker(this_element) {
  if ($(this_element).find('.icon-js').hasClass('checked')) {
    $(this_element).find('.icon-js').removeClass('checked icon-check');
    $(this_element).next('.hidden-input-set-js').prop('checked', false);
  } else {
    $(this_element).find('.icon-js').addClass('checked icon-check');
    $(this_element).next('.hidden-input-set-js').prop('checked', true);
  }
}

function shareMenuControls() {
  $('.share-menu-expander-js').parent().find('.actions-holder-js').toggleClass('hidden');
}

function printMenuControls() {
  $('.print-menu-expander-js').parent().find('.print-holder-js').toggleClass('hidden');
}

$('.actions-holder-js, .print-holder-js').mouseleave(function (e) {
  $(this).addClass('hidden');
  e.preventDefault();
});

function pageIndexMenuControls(this_element) {
  // Assicurati che il click sia proprio sul button, non su elementi figli
  if ($(this_element).hasClass('index-menu-expander-js')) {
    if ($(this_element).find('span').hasClass('icon-expand')) {
      $(this_element).find('span').removeClass('icon-expand').addClass('icon-collapse-1');
      $(this_element).next('.index-menu-js').slideDown(150).removeClass('hidden');
    } else {
      $(this_element).find('span').addClass('icon-expand').removeClass('icon-collapse-1');
      $(this_element).next('.index-menu-js').slideUp(150).addClass('hidden');
    }
  }
}

// Aggiungi questo codice per fermare la propagazione sui link dell'indice
$(document).on('click', '.index-listing a', function (e) {
  e.stopPropagation();
});

function pageIndexMenuControlsMobile(this_element) {
  if ($(this_element).find('span').hasClass('icon-expand')) {
    $(this_element).find('span').removeClass('icon-expand').addClass('icon-collapse-1');
    $(this_element).next('.index-menu-only-mobile-js').slideDown(150);

  } else {
    $(this_element).find('span').addClass('icon-expand').removeClass('icon-collapse-1');
    $(this_element).next('.index-menu-only-mobile-js').slideUp(150);
  }
}


$('.order-results-js').change(function () {
  //this.form.submit();
});

if ($('.sito-tematico-colors')[0]) {
  function random_color() {
    myArray = [
      "sito-tematico-grigio",
      "sito-tematico-arancio",
      "sito-tematico-viola",
      "sito-tematico-turchese",
      "sito-tematico-verde"
    ];
    randomItem = myArray[Math.floor(Math.random() * myArray.length)];
  }
  //$('.sito-tematico-colors').addClass(randomItem);
  $('.sito-tematico-colors').each(function () {
    random_color();
    $(this).addClass(randomItem);
  });
}








$('body').on('mousedown', '.header-menu', function (event) {
  $(this)
    .data('down', true)
    .data('x', event.clientX)
    .data('scrollLeft', this.scrollLeft)
    .addClass("dragging");

  return false;
});
$('body').on('mouseup', '.header-menu', function (event) {

  $(this)
    .data('down', false)
    .removeClass("dragging");
});
$('body').on('mousemove', '.header-menu', function (event) {
  if ($(this).data('down') == true) {
    this.scrollLeft = $(this).data('scrollLeft') + $(this).data('x') - event.clientX;
  }
});
$('body').on('mousewheel', '.header-menu', function (event, delta) {

  this.scrollLeft -= (delta * 30);
}).css({
  'overflow': 'hidden',
  'cursor': '-moz-grab'
});

$(window).mouseout(function (event) {
  if ($('.team-form-data').data('down')) {
    try {
      if (event.originalTarget.nodeName == 'BODY' || event.originalTarget.nodeName == 'HTML') {
        $('.team-form-data').data('down', false);
      }
    } catch (e) { }
  }
});

document.querySelectorAll('.remove-underline-js, .cta-holder a').forEach(function (element) {
  element.addEventListener('mouseenter', function () {
    this.parentElement.parentElement.parentElement.classList.add('no-underline');
  });

  element.addEventListener('mouseleave', function () {
    this.parentElement.parentElement.parentElement.classList.remove('no-underline');
  });
});

$('div.wp-pagenavi[role="navigation"]').each(function () {
  $(this).replaceWith(
    $('<nav>').addClass('wp-pagenavi')
      .attr('aria-label', 'Paginazione archivio dei contenuti')
      .html($(this).html())
  );
});

// Funzione per modificare i link che si aprono in una nuova finestra
function enhanceExternalLinks() {
  // Seleziona tutti i link con target="_blank"
  $('a[target="_blank"]').each(function () {
    // Verifica se non ha già la classe e la span (per evitare duplicati)
    if (!$(this).hasClass('new-window') &&
      $(this).find('.screen-reader-text').length === 0) {

      // Aggiungi la classe "new-window"
      $(this).addClass('new-window');

      // Aggiungi la span per screen reader alla fine del link
      $(this).append('<span class="screen-reader-text">(si apre in una nuova scheda)</span>');
    }
  });
}

// Esegui al caricamento del documento
$(document).ready(function () {
  enhanceExternalLinks();

  // Opzionale: applica la modifica anche a link aggiunti dinamicamente
  $(document).on('DOMNodeInserted', 'a', function () {
    if ($(this).attr('target') === '_blank') {
      enhanceExternalLinks();
    }
  });
});