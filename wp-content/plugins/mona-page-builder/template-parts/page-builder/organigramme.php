<?php
declare(strict_types=1);

if ( ! have_rows( 'organigramme' ) ) {
	return;
}
?>
<section class="pagebuilder__organigramme">
	<div class="pagebuilder__organigramme__grid">
		<?php while ( have_rows( 'organigramme' ) ) : the_row(); ?>
			<?php
			$photo = get_sub_field( 'photo' );
			$prenom = get_sub_field( 'prenom' );
			$nom = get_sub_field( 'nom' );
			$description = get_sub_field( 'description' );
			?>
			<article class="pagebuilder__organigramme__card">
				<?php if ( $photo ) : ?>
					<div class="pagebuilder__organigramme__image">
						<?php
						echo wp_get_attachment_image(
							(int) $photo,
							'medium',
							false,
							[
								'class'   => 'pagebuilder__organigramme__photo',
								'loading' => 'lazy',
								'alt'     => trim( $prenom . ' ' . $nom ),
							]
						);
						?>
					</div>
				<?php endif; ?>

				<div class="pagebuilder__organigramme__content">
					<?php if ( $prenom || $nom ) : ?>
						<h3 class="pagebuilder__organigramme__name">
							<?php echo esc_html( trim( $prenom . ' ' . $nom ) ); ?>
						</h3>
					<?php endif; ?>

					<?php if ( $description ) : ?>
						<div class="pagebuilder__organigramme__description">
							<?php echo wp_kses_post( $description ); ?>
						</div>
					<?php endif; ?>
				</div>
			</article>
		<?php endwhile; ?>
	</div>
</section>
