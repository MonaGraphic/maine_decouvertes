<?php
declare(strict_types=1);

if ( ! have_rows( 'onglets' ) ) {
	return;
}

$tabs_id = 'page-builder-tabs-' . wp_unique_id();
$tabs = [];

while ( have_rows( 'onglets' ) ) {
	the_row();

	$tabs[] = [
		'titre'   => get_sub_field( 'titre' ),
		'contenu' => get_sub_field( 'contenu' ),
	];
}

if ( empty( $tabs ) ) {
	return;
}
?>
<section class="page-builder__tabs">
	<div
		class="page-builder__tabs-list"
		role="tablist"
		aria-label="<?php echo esc_attr__( 'Onglets', 'mona-page-builder' ); ?>"
	>
		<?php foreach ( $tabs as $index => $tab ) : ?>
			<?php
			$tab_id = $tabs_id . '-tab-' . $index;
			$panel_id = $tabs_id . '-panel-' . $index;
			$active = 0 === $index;
			?>
			<button
				type="button"
				class="page-builder__tabs-tab<?php echo $active ? ' active' : ''; ?>"
				id="<?php echo esc_attr( $tab_id ); ?>"
				role="tab"
				aria-selected="<?php echo $active ? 'true' : 'false'; ?>"
				aria-controls="<?php echo esc_attr( $panel_id ); ?>"
				tabindex="<?php echo $active ? '0' : '-1'; ?>"
			>
				<?php echo esc_html( $tab['titre'] ); ?>
			</button>
		<?php endforeach; ?>
	</div>

	<?php foreach ( $tabs as $index => $tab ) : ?>
		<?php
		$tab_id = $tabs_id . '-tab-' . $index;
		$panel_id = $tabs_id . '-panel-' . $index;
		$active = 0 === $index;
		?>
		<div
			class="page-builder__tabs-panel"
			id="<?php echo esc_attr( $panel_id ); ?>"
			role="tabpanel"
			aria-labelledby="<?php echo esc_attr( $tab_id ); ?>"
			<?php if ( ! $active ) : ?>
				hidden
			<?php endif; ?>
		>
			<?php echo wp_kses_post( $tab['contenu'] ); ?>
		</div>
	<?php endforeach; ?>
</section>
