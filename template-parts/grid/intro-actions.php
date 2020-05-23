<div class="flex-hold flex-hold-2 still-two-mobile margins-thin">
  <div class="flex-hold-child">
    <button class="share-menu-expander share-menu-expander-js button-appearance-normalizer button-typo-normalizer" aria-expanded="false" aria-label="Apri il menu di condivisione" data-collapsed="Apri il menu di condivisione" data-expanded="Chiudi il menu di condivisione"><span class="icon-share"></span>Condividi</button>
    <div class="actions-holder actions-holder-js hidden">
      <div class="padder">
        <ul class="share-actions grey-links">
          <li class="mobile-only">
            <a href="whatsapp://send?text=<?php the_permalink(); ?>" data-action="share/whatsapp/share" onClick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" target="_blank" rel="nofollow" title="Condividi <?php the_title(); ?> su WhatsApp" aria-label="Condividi <?php the_title(); ?> su WhatsApp"><span class="icon-whatsapp"></span>WhatsApp</a>
          </li>
          <li class="mobile-only">
            <a href="https://telegram.me/share/url?url=<?php the_permalink(); ?>&text=<?php the_title(); ?>" target="_blank" rel="nofollow" title="Condividi <?php the_title(); ?> su Telegram" aria-label="Condividi <?php the_title(); ?> su Telegram"><span class="icon-telegram"></span>Telegram</a>
          </li>
          <li>
            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" target="_blank" rel="nofollow" title="Condividi <?php the_title(); ?> su Facebook" aria-label="Condividi <?php the_title(); ?> su Facebook"><span class="icon-logo-facebook"></span>Facebook</a>
          </li>
          <li>
            <a href="https://twitter.com/intent/tweet?url=<?php the_permalink(); ?>&amp;text=<?php the_title(); ?>" target="_blank" rel="nofollow" title="Condividi <?php the_title(); ?> su Twitter" aria-label="Condividi <?php the_title(); ?> su Twitter"><span class="icon-logo-twitter"></span>Twitter</a>
          </li>
          <li>
            <a href="https://www.linkedin.com/shareArticle?url=<?php the_permalink(); ?>&title=<?php the_title(); ?>" target="_blank" rel="nofollow" title="Condividi <?php the_title(); ?> su LinkedIn" aria-label="Condividi <?php the_title(); ?> su LinkedIn"><span class="icon-logo-linkedin"></span>LinkedIn</a>
          </li>
        </ul>
      </div>
    </div>
  </div>
  <div class="flex-hold-child">
    <button class="print-menu-expander print-menu-expander-js button-appearance-normalizer button-typo-normalizer" aria-expanded="false" aria-label="Apri il menu delle azioni" data-collapsed="Apri il menu delle azioni" data-expanded="Chiudi il menu delle azioni"><span class="icon-action"></span>Vedi azioni</button>
    <div class="actions-holder print-holder-js hidden">
      <div class="padder">
        <ul class="share-actions grey-links">
          <li>
            <a href="javascript:window.print()" title="Stampa <?php the_title(); ?>" aria-label="Stampa <?php the_title(); ?>"><span class="icon-print"></span>Stampa</a>
          </li>
          <li>
            <a href="mailto:?subject=<?php the_title(); ?>" title="Invia <?php the_title(); ?> via email" aria-label="Invia <?php the_title(); ?> via email"><span class="icon-email"></span>Invia</a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>
