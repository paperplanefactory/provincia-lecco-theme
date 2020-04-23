<?php
/**
*  Paperplane _blankTheme
 * Template Name: Pagina primo livello / amministrazione
*/
get_header();
// questa sarà una pagina template dalla quale:
// - se di primo livello vengono listate le sotto pagine (o singoli contenuti del CPT Amministrazione) in evidenza e a seguire tutte le sotto pagine
// - se è di secondo livello viene associata a una voce della tassonomia "Categorie amministrazione", vengono listati i singoli contenuti del CPT Amministrazione in evidenza e a seguire tutti i singoli contenuti del CPT Amministrazione con la voce di tassonomia "Categorie amministrazione" specificata
?>
<div class="wrapper">
  <div class="wrapper-padded">
    <div class="wrapper-padded-intro">
      <div class="page-opening-padder">
        <div class="breadcrumbs-holder grey-links undelinked-links" typeof="BreadcrumbList" vocab="http://schema.org/">
          <?php bcn_display(); ?>
        </div>

        <div class="flex-hold flex-hold-page-opening">
          <div class="page-opening-left">
            <h1>Amministrazione</h1>
            <p class="paragraph-variant">
              Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam
            </p>
            <form class="banner-form">
              <input type="text" placeholder='Cerca in "Amministrazione"' />
              <button><span class="icon-search"></span></button>
            </form>
          </div>
          <div class="page-opening-right">
            <div class="padder">
              <h5 class="allupper">Tutta l’amministrazione</h5>
              <ul class="page-opening-menu page-opening-menu-js compact">
                <li>
                  <a href="#">Organi di governo</a>
                </li>
                <li>
                  <a href="#">Aree amministrative</a>
                </li>
                <li>
                  <a href="#">Uffici</a>
                </li>
                <li>
                  <a href="#">Enti e fondazioni</a>
                </li>
                <li>
                  <a href="#">Politici</a>
                </li>
                <div>
                  <li>
                    <a href="#">Test</a>
                  </li>
                  <li>
                    <a href="#">Test</a>
                  </li>
                  <li>
                    <a href="#">Test</a>
                  </li>
                </div>

              </ul>
              <button class="page-opening-menu-expander page-opening-menu-expander-js button-appearance-normalizer" aria-expanded="false"><span class="icon-js icon-expand"></span><span class="text-js">Espandi</span></button>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>









<div class="wrapper bg-9">
  <div class="wrapper-padded">
    <div class="wrapper-padded-more">
      <div class="listing-box">
        <h2>In evidenza</h2>
        <div class="flex-hold flex-hold-3 margins-wide grid-separator-2">
          <!-- card singoli contenuti -->
          <div class="flex-hold-child card insite">
            <div class="card_inner regular-card">
              <div class="cover-image">
                <a href="#" title="Lorem ipsum dolor sit amen consectetur" aria-label="Lorem ipsum dolor sit amen consectetur">
                  <div class="no-the-100">
                    <img src="http://provincia-di-lecco.local/pr-lecco-media/2019/06/stw-02.jpg" />
                  </div>
                </a>
              </div>
              <div class="category-holder cat-fill-b">
                <h6 class="allupper"><a href="#" title="Archivio Notizie" aria-label="Archivio Notizie">Notizie</a></h6>
              </div>
              <div class="texts-holder">
                <h2 class="h2-variant"><a href="#" title="Lorem ipsum dolor sit amen consectetur" aria-label="Lorem ipsum dolor sit amen consectetur">Lorem ipsum dolor sit amen consectetur</a></h2>
                <p>
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                </p>
              </div>
            </div>
            <div class="cta-holder">
              <a href="#" class="arrow-button" title="xxxx" aria-label="xxxx">Leggi di più</a>
            </div>
          </div>
          <!-- card singoli contenuti -->
          <!-- card singoli contenuti -->
          <div class="flex-hold-child card insite">
            <div class="card_inner regular-card">
              <div class="category-holder cat-fill-a">
                <h6 class="allupper"><a href="#" title="Archivio Notizie" aria-label="Archivio Uffici">Uffici</a></h6>
              </div>
              <div class="texts-holder">
                <h2 class="h2-variant"><a href="#" title="Lorem ipsum dolor sit amen consectetur" aria-label="Lorem ipsum dolor sit amen consectetur">Lorem ipsum dolor sit amen consectetur</a></h2>
                <p>
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                </p>
              </div>

            </div>
            <div class="cta-holder">
              <a href="#" class="arrow-button" title="xxxx" aria-label="xxxx">Leggi di più</a>
            </div>
          </div>
          <!-- card singoli contenuti -->
          <!-- card singoli contenuti -->
          <div class="flex-hold-child card insite">
            <div class="card_inner regular-card">
              <div class="category-holder cat-fill-a">
                <h6 class="allupper"><a href="#" title="Archivio Notizie" aria-label="Archivio Uffici">Uffici</a></h6>
              </div>
              <div class="texts-holder">
                <h2 class="h2-variant"><a href="#" title="Lorem ipsum dolor sit amen consectetur" aria-label="Lorem ipsum dolor sit amen consectetur">Lorem ipsum dolor sit amen consectetur</a></h2>
                <p>
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                </p>
              </div>

            </div>
            <div class="cta-holder">
              <a href="#" class="arrow-button" title="xxxx" aria-label="xxxx">Leggi di più</a>
            </div>
          </div>
          <!-- card singoli contenuti -->
        </div>
      </div>
    </div>
  </div>
</div>



<div class="wrapper">
  <div class="wrapper-padded">
    <div class="wrapper-padded-more">
      <div class="listing-box">
        <h2>Tutta l’amministrazione</h2>
        <div class="flex-hold flex-hold-3 margins-wide grid-separator-2">
          <!-- card singoli contenuti -->
          <div class="flex-hold-child card insite">
            <div class="card_inner regular-card">
              <div class="texts-holder">
                <h3><a href="#" title="Lorem ipsum dolor sit amen consectetur" aria-label="Lorem ipsum dolor sit amen consectetur">Lorem ipsum dolor sit amen consectetur</a></h3>
                <p>
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                </p>
              </div>
            </div>
            <div class="cta-holder">
              <a href="#" class="arrow-button" title="xxxx" aria-label="xxxx">Leggi di più</a>
            </div>
          </div>
          <!-- card singoli contenuti -->
          <!-- card singoli contenuti -->
          <div class="flex-hold-child card insite">
            <div class="card_inner regular-card">
              <div class="texts-holder">
                <h3><a href="#" title="Lorem ipsum dolor sit amen consectetur" aria-label="Lorem ipsum dolor sit amen consectetur">Lorem ipsum dolor sit amen consectetur</a></h3>
                <p>
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                </p>
              </div>
            </div>
            <div class="cta-holder">
              <a href="#" class="arrow-button" title="xxxx" aria-label="xxxx">Leggi di più</a>
            </div>
          </div>
          <!-- card singoli contenuti -->
          <!-- card singoli contenuti -->
          <div class="flex-hold-child card insite">
            <div class="card_inner regular-card">
              <div class="texts-holder">
                <h3><a href="#" title="Lorem ipsum dolor sit amen consectetur" aria-label="Lorem ipsum dolor sit amen consectetur">Lorem ipsum dolor sit amen consectetur</a></h3>
                <p>
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                </p>
              </div>
            </div>
            <div class="cta-holder">
              <a href="#" class="arrow-button" title="xxxx" aria-label="xxxx">Leggi di più</a>
            </div>
          </div>
          <!-- card singoli contenuti -->
          <!-- card singoli contenuti -->
          <div class="flex-hold-child card insite">
            <div class="card_inner regular-card">
              <div class="texts-holder">
                <h3><a href="#" title="Lorem ipsum dolor sit amen consectetur" aria-label="Lorem ipsum dolor sit amen consectetur">Lorem ipsum dolor sit amen consectetur</a></h3>
                <p>
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                </p>
              </div>
            </div>
            <div class="cta-holder">
              <a href="#" class="arrow-button" title="xxxx" aria-label="xxxx">Leggi di più</a>
            </div>
          </div>
          <!-- card singoli contenuti -->
          <!-- card singoli contenuti -->
          <div class="flex-hold-child card insite">
            <div class="card_inner regular-card">
              <div class="texts-holder">
                <h3><a href="#" title="Lorem ipsum dolor sit amen consectetur" aria-label="Lorem ipsum dolor sit amen consectetur">Lorem ipsum dolor sit amen consectetur</a></h3>
                <p>
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                </p>
              </div>
            </div>
            <div class="cta-holder">
              <a href="#" class="arrow-button" title="xxxx" aria-label="xxxx">Leggi di più</a>
            </div>
          </div>
          <!-- card singoli contenuti -->
          <!-- card singoli contenuti -->
          <div class="flex-hold-child card insite">
            <div class="card_inner regular-card">
              <div class="texts-holder">
                <h3><a href="#" title="Lorem ipsum dolor sit amen consectetur" aria-label="Lorem ipsum dolor sit amen consectetur">Lorem ipsum dolor sit amen consectetur</a></h3>
                <p>
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                </p>
              </div>
            </div>
            <div class="cta-holder">
              <a href="#" class="arrow-button" title="xxxx" aria-label="xxxx">Leggi di più</a>
            </div>
          </div>
          <!-- card singoli contenuti -->
          <!-- card singoli contenuti -->
          <div class="flex-hold-child card insite">
            <div class="card_inner regular-card">
              <div class="texts-holder">
                <h3><a href="#" title="Lorem ipsum dolor sit amen consectetur" aria-label="Lorem ipsum dolor sit amen consectetur">Lorem ipsum dolor sit amen consectetur</a></h3>
                <p>
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                </p>
              </div>
            </div>
            <div class="cta-holder">
              <a href="#" class="arrow-button" title="xxxx" aria-label="xxxx">Leggi di più</a>
            </div>
          </div>
          <!-- card singoli contenuti -->
        </div>
      </div>
    </div>
  </div>
</div>






<div class="wrapper">
  <div class="wrapper-padded">
    <div class="wrapper-padded-more">
      <div class="tag-box">
        <div class="aligncenter">
          <h6 class="txt-1 allupper">Altri argomenti</h6>
          <div class="tags-holder">
            <a href="#" class="tag-button filled-button">Tag</a> <a href="#" class="tag-button filled-button">Tag</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>







<?php get_footer(); ?>
