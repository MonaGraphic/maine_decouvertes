<?php

declare(strict_types=1);


/**
 * Whether the current admin post type uses the Mona Page Builder.
 */
function mona_page_builder_is_supported_post_type(): bool {
	$post_type = get_current_screen()?->post_type ?? '';

	return in_array( $post_type, mona_page_builder_post_types(), true );
}


/**
 * Synchronise le texte du bouton avec le titre du champ Lien ACF.
 */
add_action(
	'acf/input/admin_footer',
	static function (): void {
		?>
		<style>
		.layout[data-mona-button-title] .acf-fc-layout-title {
			font-size: 0;
		}

		.layout[data-mona-button-title] .acf-fc-layout-title::after {
			content: var(--mona-button-title);
			font-size: 13px;
			font-weight: 600;
		}
		</style>
		<script>
		(function ($) {
			const getFields = ($field) => {
				const $layout = $field.closest('.layout');

				if (!$layout.length) {
					return null;
				}

				const linkField = acf.getField(
					$layout.find('[data-key="field_pb_lien"]').first()
				);
				const textField = acf.getField(
					$layout.find('[data-key="field_pb_texte_lien"]').first()
				);

				if (!linkField || !textField) {
					return null;
				}

				return { linkField, textField, $layout };
			};

			const updateButtonLayoutTitle = ($field) => {
				const $layout = $field.closest('.layout');

				if (!$layout.length) {
					return;
				}

				const text = String(
					acf.getField($layout.find('[data-key="field_pb_texte_lien"]').first())?.val() || ''
				).trim();

				if (text) {
					$layout.attr('data-mona-button-title', '').css('--mona-button-title', JSON.stringify(`Bouton : ${text}`));
				} else {
					$layout.removeAttr('data-mona-button-title').css('--mona-button-title', '');
				}
			};

			let syncing = false;

			const syncTextFromLink = (linkField) => {
				if (syncing) {
					return;
				}

				const fields = getFields(linkField.$el);

				if (!fields) {
					return;
				}

				const value = fields.linkField.val() || {};
				const title = value.title || '';

				syncing = true;
				fields.textField.val(title);
				syncing = false;

				updateButtonLayoutTitle(fields.textField.$el);
			};

			const syncLinkFromText = (textField) => {
				if (syncing) {
					return;
				}

				const fields = getFields(textField.$el);

				if (!fields) {
					return;
				}

				const value = fields.linkField.val() || {};
				const title = textField.val() || '';

				if (value.title === title) {
					updateButtonLayoutTitle(textField.$el);
					return;
				}

				syncing = true;
				fields.linkField.val({
					url: value.url || '',
					title: title,
					target: value.target || '',
				});
				syncing = false;

				updateButtonLayoutTitle(textField.$el);
			};

			const initialise = (field) => {
				const fields = getFields(field.$el);

				if (!fields) {
					return;
				}

				const linkValue = fields.linkField.val() || {};
				const textValue = fields.textField.val() || '';

				if (textValue) {
					syncLinkFromText(fields.textField);
				} else if (linkValue.title) {
					syncTextFromLink(fields.linkField);
				} else {
					updateButtonLayoutTitle(fields.textField.$el);
				}
			};

			const bindLinkField = (field) => {
				field.on('change', '.link-node', function () {
					syncTextFromLink(field);
				});

				syncTextFromLink(field);
			};

			acf.addAction('ready_field/key=field_pb_lien', bindLinkField);
			acf.addAction('append_field/key=field_pb_lien', bindLinkField);
			acf.addAction('ready_field/key=field_pb_texte_lien', initialise);
			acf.addAction('append_field/key=field_pb_texte_lien', initialise);

			$(document).on(
				'input change',
				'[data-key="field_pb_texte_lien"] input',
				function () {
					const field = acf.getField(
						$(this).closest('[data-key="field_pb_texte_lien"]')
					);

					if (field) {
						syncLinkFromText(field);
					}
				}
			);
		})(jQuery);
		</script>
		<?php
	}
);
