/////////////////////////////////////////////
// lazy load
/////////////////////////////////////////////
var lazyLoadInstances = [];
var paperPlaneLazyLoad = new LazyLoad({
  elements_selector: ".lazy",
  class_loading: "lazy-loading",
  class_loaded: "lazy-loaded",
  callback_enter: function(el) {
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
  } else {
    $('html').css('overflowY', 'scroll');
    $('html').removeClass('occupy-scrollbar');
    $('#header').focus();
    $('.hambuger-element').attr('aria-expanded', false);
    $('.scroll-opportunity').scrollTop(0);
    $('#header').removeClass('compact');
  }
  $('#head-overlay').toggleClass('hidden');
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
  $('html').css('overflowY', 'hidden');
  $('html').addClass('occupy-scrollbar');
  $('.search-input-kw-js-ovarlay').focus();
}

function closeSearch(e) {
  $('#search-overlay').attr('aria-expanded', false).toggleClass('hidden');
  $('html').css('overflowY', 'scroll');
  $('html').removeClass('occupy-scrollbar');
  $('#header').focus();
  $(this).attr('aria-expanded', false);
  $('.scroll-opportunity').scrollTop(0);
}

/////////////////////////////////////////////
// search input functions
/////////////////////////////////////////////

function searchErase(e) {
  $('.search-input-kw-js').val('');
  $('.search-erase-js').fadeOut(300);
}

$('.search-input-kw-js').on('input', function() {
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

$('.search-input-kw-js').each(function(index) {
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
      $('.sticky-columns-js').addClass('sticky-element-compact').removeClass('sticky-element-expanded');
    } else {
      // upscroll code
      $('#header').removeClass('compact');
      $('.sticky-columns-js').addClass('sticky-element-expanded').removeClass('sticky-element-compact');
    }
  }

  lastScrollTop = st;
}


$(window).scroll(function(event) {
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
  nextArrow: '<div class="slick-next"><i class="icon-right-arrow" aria-label="next"></i></div>',
  prevArrow: '<div class="slick-prev"><i class="icon-left-arrow" aria-label="previous"></i></div>',
});

$(document).on('keydown', function(e) {
  if (e.keyCode == 37) {
    $('.slide-one').slick('slickPrev');
  }
  if (e.keyCode == 39) {
    $('.slide-one').slick('slickNext');
  }
});


$('.slide-four').slick({
  lazyLoad: 'ondemand',
  dots: true,
  focusOnSelect: true,
  draggable: true,
  infinite: false,
  accessibility: true,
  adaptiveHeight: false,
  slidesToShow: 4,
  slidesToScroll: 4,
  nextArrow: '<div class="slick-next"><i class="icon-right-arrow" aria-label="next"></i></div>',
  prevArrow: '<div class="slick-prev"><i class="icon-left-arrow" aria-label="previous"></i></div>',
  responsive: [{
    breakpoint: 1024,
    settings: {
      slidesToShow: 1,
      slidesToScroll: 1
    }
  }]
});
$(document).on('keydown', function(e) {
  if (e.keyCode == 37) {
    $('.single-item').slick('slickPrev');
  }
  if (e.keyCode == 39) {
    $('.single-item').slick('slickNext');
  }
});

/////////////////////////////////////////////
// expandables
/////////////////////////////////////////////

$('.expander').click(function(e) {
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
    $(this_element).attr('aria-expanded', true);
    $(this_element).find('.icon-js').removeClass('icon-expand').addClass('icon-collapse-1');
    $(this_element).prev('.page-opening-menu-js').find('div').slideDown(150);
    $(this_element).find('.text-js').text('Nascondi');

  } else {
    $(this_element).attr('aria-expanded', false);
    $(this_element).find('.icon-js').addClass('icon-expand').removeClass('icon-collapse-1');
    $(this_element).prev('.page-opening-menu-js').find('div').slideUp(150);
    $(this_element).find('.text-js').text('Espandi');
  }
}

function pageSearchReultsControl(this_element) {
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
  $('#search-filters').submit();
}

function shareMenuControls() {
  $('.share-menu-expander-js').parent().find('.actions-holder-js').toggleClass('hidden');
}

function printMenuControls() {
  $('.print-menu-expander-js').parent().find('.print-holder-js').toggleClass('hidden');
}

$('.actions-holder-js, .print-holder-js').mouseleave(function(e) {
  $(this).addClass('hidden');
  e.preventDefault();
});

function pageIndexMenuControls(this_element) {
  if ($(this_element).find('span').hasClass('icon-expand')) {
    $(this_element).attr('aria-expanded', true);
    $(this_element).find('span').removeClass('icon-expand').addClass('icon-collapse-1');
    $(this_element).next('.index-menu-js').slideDown(150);

  } else {
    $(this_element).attr('aria-expanded', false);
    $(this_element).find('span').addClass('icon-expand').removeClass('icon-collapse-1');
    $(this_element).next('.index-menu-js').slideUp(150);
  }
}

function pageIndexMenuControlsMobile(this_element) {
  if ($(this_element).find('span').hasClass('icon-expand')) {
    $(this_element).attr('aria-expanded', true);
    $(this_element).find('span').removeClass('icon-expand').addClass('icon-collapse-1');
    $(this_element).next('.index-menu-only-mobile-js').slideDown(150);

  } else {
    $(this_element).attr('aria-expanded', false);
    $(this_element).find('span').addClass('icon-expand').removeClass('icon-collapse-1');
    $(this_element).next('.index-menu-only-mobile-js').slideUp(150);
  }
}


$('.order-results-js').change(function() {
  this.form.submit();
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
  $('.sito-tematico-colors').each(function() {
    random_color();
    $(this).addClass(randomItem);
  });
}








$('body').on('mousedown', '.header-menu', function(event) {
  $(this)
    .data('down', true)
    .data('x', event.clientX)
    .data('scrollLeft', this.scrollLeft)
    .addClass("dragging");

  return false;
});
$('body').on('mouseup', '.header-menu', function(event) {

  $(this)
    .data('down', false)
    .removeClass("dragging");
});
$('body').on('mousemove', '.header-menu', function(event) {
  if ($(this).data('down') == true) {
    this.scrollLeft = $(this).data('scrollLeft') + $(this).data('x') - event.clientX;
  }
});
$('body').on('mousewheel', '.header-menu', function(event, delta) {

  this.scrollLeft -= (delta * 30);
}).css({
  'overflow': 'hidden',
  'cursor': '-moz-grab'
});

$(window).mouseout(function(event) {
  if ($('.team-form-data').data('down')) {
    try {
      if (event.originalTarget.nodeName == 'BODY' || event.originalTarget.nodeName == 'HTML') {
        $('.team-form-data').data('down', false);
      }
    } catch (e) {}
  }
});