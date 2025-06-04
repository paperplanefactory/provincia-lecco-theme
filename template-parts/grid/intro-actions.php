<div class="flex-hold flex-hold-2 still-two-mobile margins-thin">
	<div class="flex-hold-child">
		<button onclick="shareMenuControls()"
			class="alternate-h6 share-menu-expander share-menu-expander-js button-appearance-normalizer button-typo-normalizer"
			data-collapsed="Apri il menu di condivisione" data-expanded="Chiudi il menu di condivisione"
			aria-controls="share-menu"><span class="icon-share"></span>Condividi</button>
		<div class="actions-holder actions-holder-js hidden" id="share-menu">
			<div class="padder">
				<ul class="share-actions grey-links">
					<li>
						<a href="https://api.whatsapp.com/send?text=<?php the_title(); ?> <?php the_permalink(); ?>"
							rel="nofollow">
							<span class="icon-whatsapp"></span>WhatsApp
						</a>
					</li>
					<li>
						<a href="https://telegram.me/share/url?url=<?php the_permalink(); ?>&text=<?php the_title(); ?>"
							rel="nofollow">
							<span class="icon-telegram"></span>Telegram
						</a>
					</li>
					<li>
						<a href="https://www.facebook.com/sharer/sharer.php?u=?php the_permalink(); ?>" rel="nofollow">
							<span class="icon-logo-facebook"></span>Facebook
						</a>
					</li>
					<li>
						<a href="https://twitter.com/intent/tweet?url=<?php the_permalink(); ?>&amp;text=<?php the_title(); ?>"
							rel="nofollow">
							<span class="icon-logo-twitter"></span>Twitter
						</a>
					</li>
					<li>
						<a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php the_permalink(); ?>"
							rel="nofollow">
							<span class="icon-logo-linkedin"></span>LinkedIn
						</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
	<div class="flex-hold-child">
		<button onclick="printMenuControls()"
			class="alternate-h6 print-menu-expander print-menu-expander-js button-appearance-normalizer button-typo-normalizer"
			data-collapsed="Apri il menu delle azioni" data-expanded="Chiudi il menu delle azioni"
			aria-controls="utility-menu"><span class="icon-action"></span>Vedi azioni</button>
		<div class="actions-holder print-holder-js hidden" id="utility-menu">
			<div class="padder">
				<ul class="share-actions grey-links">
					<li>
						<a href="javascript:window.print()" rel="nofollow">
							<span class="icon-print"></span>Stampa
						</a>
					</li>
					<li>
						<a href="mailto:?subject=<?php echo get_the_title(); ?> - <?php echo get_permalink(); ?>"
							rel="nofollow">
							<span class="icon-email"></span>Invia
						</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>