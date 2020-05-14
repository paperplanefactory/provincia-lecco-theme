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
    $(this).attr('aria-expanded', true);
    $('#header').addClass('compact');
  } else {
    $('html').css('overflowY', 'scroll');
    $('html').removeClass('occupy-scrollbar');
    $('#header').focus();
    $(this).attr('aria-expanded', false);
    $('.scroll-opportunity').scrollTop(0);
    $('#header').removeClass('compact');
  }
  $('#head-overlay').toggleClass('hidden');
}

/////////////////////////////////////////////
// menu close mobile > desktop
/////////////////////////////////////////////

function checkWidth() {
  var windowsize = $(window).width();
  if (windowsize > 1024) {
    $('.hambuger-element').removeClass('open');
    $('html').css('overflowY', 'scroll');
    $('html').removeClass('occupy-scrollbar');
    $('#head-overlay').addClass('hidden');
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

function searchErase(e) {
  $('.search-input-kw-js').val('');
}


$(".search-input-kw-js").on("input", function() {
  if ($(this).val() != '') {
    $('.search-erase-js').fadeIn(300);
  } else {
    $('.search-erase-js').fadeOut(300);
  }
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
      //$('#header').addClass('compact');
      $('#header').addClass('hidden');
      $('#header-compact').removeClass('hidden');
      $('.sticky-columns-js').addClass('sticky-element-compact').removeClass('sticky-element-expanded');
    } else {
      // upscroll code
      //$('#header').removeClass('compact');
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
// go Below The Fold
/////////////////////////////////////////////

function goBelowTheFold() {
  $('html, body').animate({
    scrollTop: $('.below-the-fold').offset().top - 20
  }, 500)
}

// below the fold
$('#intro-scroll-js').click(function() {
  goBelowTheFold();
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
  fade: true,
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



$('.slide-four').on('init reInit afterChange', function(event, slick, currentSlide, nextSlide) {
  AOS.refresh();
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
  slidesToScroll: 1,
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
// click hamburger
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