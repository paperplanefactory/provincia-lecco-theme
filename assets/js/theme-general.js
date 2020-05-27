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
  $('.search-input-kw-js').focus();
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

$('.avviso-local-storage-close-js').click(function(e) {
  setAvvisoLocalStorage();
  $('#avviso-visibility-js').removeClass('avviso-attivo');
});


/////////////////////////////////////////////
// menu scroll effect
/////////////////////////////////////////////

var lastScrollTop = 0;

function scrollDirectionMenu() {
  var checkWidth = $(window).width();
  var st = $(this).scrollTop();

  if (checkWidth > 1024) {
    if ((st > lastScrollTop) && (st > 100)) {
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
  adaptiveHeight: true,
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
// click header
/////////////////////////////////////////////

$('.ham-activator').click(function(e) {
  hamburgerMenu();
});

$('.activate-search-js').click(function(e) {
  openSearch();
});

$('.search-overlay-title-js').click(function(e) {
  closeSearch();
});

$('.search-erase-js').click(function(e) {
  searchErase();
  e.preventDefault();
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


$('.page-opening-menu-expander-js').click(function(e) {
  if ($(this).find('.icon-js').hasClass('icon-expand')) {
    $(this).attr('aria-expanded', true);
    $(this).find('.icon-js').removeClass('icon-expand').addClass('icon-collapse-1');
    $(this).prev('.page-opening-menu-js').find('div').slideDown(150);
    $(this).find('.text-js').text('Nascondi');

  } else {
    $(this).attr('aria-expanded', false);
    $(this).find('.icon-js').addClass('icon-expand').removeClass('icon-collapse-1');
    $(this).prev('.page-opening-menu-js').find('div').slideUp(150);
    $(this).find('.text-js').text('Espandi');
  }
  e.preventDefault();
});

$('.page-search-cats-expander-js').click(function(e) {
  if ($(this).find('.icon-js').hasClass('icon-expand')) {
    $(this).attr('aria-expanded', false);
    $(this).find('.icon-js').removeClass('icon-expand').addClass('icon-left-arrow-tip');
    $(this).next('.page-search-cats-listing-js').slideUp(150);

  } else {
    $(this).attr('aria-expanded', true);
    $(this).find('.icon-js').addClass('icon-expand').removeClass('icon-left-arrow-tip');
    $(this).next('.page-search-cats-listing-js').slideDown(150);
  }
  e.preventDefault();
});

$('.button-check-cat-js').click(function(e) {
  if ($(this).find('.icon-js').hasClass('checked')) {
    $(this).find('.icon-js').removeClass('checked icon-check');
    $(this).next('.hidden-input-set-js').prop('checked', false);

  } else {
    $(this).find('.icon-js').addClass('checked icon-check');
    $(this).next('.hidden-input-set-js').prop('checked', true);
  }
  e.preventDefault();
  $('#search-filters').submit();
});

$('.share-menu-expander-js').click(function(e) {
  $(this).parent().find('.actions-holder-js').toggleClass('hidden');
  e.preventDefault();
});

$('.print-menu-expander-js').click(function(e) {
  $(this).parent().find('.print-holder-js').toggleClass('hidden');
  e.preventDefault();
});


$('.actions-holder-js, .print-holder-js').mouseleave(function(e) {
  $(this).addClass('hidden');
  e.preventDefault();
});

$('.index-menu-expander-js').click(function(e) {
  if ($(this).find('span').hasClass('icon-expand')) {
    $(this).attr('aria-expanded', true);
    $(this).find('span').removeClass('icon-expand').addClass('icon-collapse-1');
    $(this).next('.index-menu-js').slideDown(150);

  } else {
    $(this).attr('aria-expanded', false);
    $(this).find('span').addClass('icon-expand').removeClass('icon-collapse-1');
    $(this).next('.index-menu-js').slideUp(150);
  }
  e.preventDefault();
});

$('.index-menu-expander-only-mobile-js').click(function(e) {
  if ($(this).find('span').hasClass('icon-expand')) {
    $(this).attr('aria-expanded', true);
    $(this).find('span').removeClass('icon-expand').addClass('icon-collapse-1');
    $(this).next('.index-menu-only-mobile-js').slideDown(150);

  } else {
    $(this).attr('aria-expanded', false);
    $(this).find('span').addClass('icon-expand').removeClass('icon-collapse-1');
    $(this).next('.index-menu-only-mobile-js').slideUp(150);
  }
  e.preventDefault();
});


$('.order-results-js').change(function() {
  this.form.submit();
});

/////////////////////////////////////////////
// sub menu mobile
/////////////////////////////////////////////

$('.overlay-menu-mobile-js > .menu-item-has-children').click(function(e) {
  $(this).find('.sub-menu').slideToggle(150);
  e.preventDefault();
});


/////////////////////////////////////////////
// preload
/////////////////////////////////////////////

function hidePreload() {
  $('.preload-container').addClass('hidden-preload');
  //alert('dfg');
}

//window.addEventListener('load', hidePreload);