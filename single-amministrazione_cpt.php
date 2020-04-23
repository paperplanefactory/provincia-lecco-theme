<?php
// Paperplane _blankTheme - template per single amministrazione_cpt.
get_header();
?>

<?php while ( have_posts() ) : the_post(); ?>
  <div class="wrapper">
    <div class="wrapper-padded">
      <div class="wrapper-padded-intro">
        <div class="single-content-opening-padder">
          <div class="breadcrumbs-holder grey-links undelinked-links" typeof="BreadcrumbList" vocab="http://schema.org/">
            <?php bcn_display(); ?>
          </div>

          <div class="flex-hold flex-hold-page-opening">
            <div class="page-opening-left printable">
              <h1><?php the_title(); ?></h1>
              <p class="paragraph-variant">
                Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam
              </p>
              <!-- card singoli contenuti -->
              <div class="card warning">
                <div class="card_inner warning-card">
                  <span class="icon icon-warning"></span>
                  <h5 class="allupper">Attenzione</h5>
                  <p>
                    Gli uffici saranno chiusi per ristrutturazione fino al 10 aprile 2020. Per comunicazioni urgenti contattare l'ufficio centrale dal Lunedì al Venerdì dalle 9.30 alle 16.
                  </p>
                </div>
              </div>
              <!-- card singoli contenuti -->
            </div>
            <div class="page-opening-right no-print">
              <div class="padder">
                <div class="flex-hold flex-hold-2 margins-thin">
                  <div class="flex-hold-child">
                    <button class="share-menu-expander share-menu-expander-js button-appearance-normalizer" aria-expanded="false"><span class="icon-share"></span>Condividi</button>
                    <div class="actions-holder actions-holder-js hidden">
                      <div class="padder">
                        <ul class="share-actions grey-links">
                          <li>
                            <a href="#"><span class="icon-logo-facebook"></span>Facebook</a>
                          </li>
                          <li>
                            <a href="#"><span class="icon-logo-twitter"></span>Twitter</a>
                          </li>
                          <li>
                            <a href="#"><span class="icon-logo-linkedin"></span>LinkedIn</a>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                  <div class="flex-hold-child">
                    <button class="print-menu-expander print-menu-expander-js button-appearance-normalizer" aria-expanded="false"><span class="icon-action"></span>Vedi azioni</button>
                    <div class="actions-holder print-holder-js hidden">
                      <div class="padder">
                        <ul class="share-actions grey-links">
                          <li>
                            <a href="javascript:window.print()"><span class="icon-print"></span>Stampa</a>
                          </li>
                          <li>
                            <a href="#"><span class="icon-email"></span>Invia</a>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>

                <h5 class="light">Argomenti</h5>
                <div class="tags-holder">
                  <a href="#" class="tag-button filled-button">Tag</a> <a href="#" class="tag-button filled-button">Tag</a> <a href="#" class="tag-button filled-button">Tag</a> <a href="#" class="tag-button filled-button">Tag</a>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>



  <div class="wrapper">
    <div class="wrapper-padded">
      <div class="wrapper-padded-more">
        <div class="flex-hold flex-hold-page-index">
          <div class="page-index-left no-print">
            <div class="sticky-element sticky-columns-js">
              <button class="index-menu-expander index-menu-expander-js button-appearance-normalizer" aria-expanded="true">
                Indice della pagina<span class="icon-collapse-1"></span>
              </button>
              <div class="index-menu-js">
                <ul class="index-listing">
                  <li>
                    <a href="">Cosa fa</a>
                  </li>
                  <li>
                    <a href="">Lorem ipsum dolor sit amet, consectetur adipiscing elit</a>
                  </li>
                  <li>
                    <a href="">Cosa fa</a>
                  </li>
                  <li>
                    <a href="">Cosa fa</a>
                  </li>
                </ul>
              </div>
            </div>

          </div>
          <div class="page-index-right">
            <div class="padder">
              <!-- modulo testo -->
              <div class="text-module">
                <div class="module-separator">
                  <div class="content-styled last-child-no-margin">
                    <h2>H2</h2>
                    <h3>H3</h3>
                    <h4>H4</h4>
                    <h5>H5</h5>
                    <h6>h6</h6>
                    <p>
                      Pagina content e listing<br />
                      p - paragrafo testo<br />
                      Lora Regular - 18 pt - interlinea 28pt - spazio dopo 16<br />
                      <a href="#">link underline e azzurro chiaro</a>
                    </p>
                    <ul>
                      <li>
                        test
                      </li>
                      <li>
                        test
                      </li>
                    </ul>
                    <p>
                      Pagina content e listing<br />
                      p - paragrafo testo<br />
                      Lora Regular - 18 pt - interlinea 28pt - spazio dopo 16<br />
                      <a href="#">link underline e azzurro chiaro</a>
                    </p>
                    <ol>
                      <li>
                        test
                      </li>
                      <li>
                        test
                      </li>
                    </ol>
                  </div>
                </div>

              </div>
              <!-- modulo testo -->

              <!-- modulo listing -->
              <div class="text-module">
                <div class="module-separator">
                  <h2>Uffici</h2>
                  <div class="flex-hold flex-hold-2 margins-wide">
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
              <!-- modulo listing -->
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>













<?php endwhile; ?>
<?php get_footer(); ?>
