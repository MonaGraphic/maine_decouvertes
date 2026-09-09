const initPageBuilderAccordions = () => {
	document.querySelectorAll('.page-builder__accordion').forEach((accordion) => {
		if (accordion.dataset.pageBuilderAccordionReady === 'true') {
			return;
		}

		accordion.dataset.pageBuilderAccordionReady = 'true';

		const buttons = Array.from(
			accordion.querySelectorAll('.page-builder__accordion-button')
		);

		const setState = (button, expanded) => {
			const answerId = button.getAttribute('aria-controls');
			const answer = answerId ? document.getElementById(answerId) : null;

			button.setAttribute('aria-expanded', expanded ? 'true' : 'false');

			if (answer) {
				answer.hidden = !expanded;
				answer.setAttribute('aria-hidden', expanded ? 'false' : 'true');
			}

			const icon = button.querySelector('.page-builder__accordion-icon');
			if (icon) {
				icon.textContent = expanded ? '×' : '+';
			}
		};

		buttons.forEach((button) => {
			const initiallyExpanded = button.getAttribute('aria-expanded') === 'true';
			setState(button, initiallyExpanded);

			button.addEventListener('click', () => {
				const isExpanded = button.getAttribute('aria-expanded') === 'true';

				buttons.forEach((otherButton) => {
					if (otherButton !== button) {
						setState(otherButton, false);
					}
				});

				setState(button, !isExpanded);
			});
		});
	});
};

const initPageBuilderTabs = () => {
	document.querySelectorAll('.page-builder__tabs').forEach((tabs) => {
		if (tabs.dataset.pageBuilderTabsReady === 'true') {
			return;
		}

		tabs.dataset.pageBuilderTabsReady = 'true';

		const buttons = Array.from(
			tabs.querySelectorAll('.page-builder__tabs-tab[role="tab"]')
		);

		if (!buttons.length) {
			return;
		}

		const activate = (button) => {
			buttons.forEach((tab) => {
				const active = tab === button;
				const panelId = tab.getAttribute('aria-controls');
				const panel = panelId ? tabs.querySelector(`#${CSS.escape(panelId)}`) : null;

				tab.classList.toggle('active', active);
				tab.setAttribute('aria-selected', active ? 'true' : 'false');
				tab.setAttribute('tabindex', active ? '0' : '-1');

				if (panel) {
					panel.hidden = !active;
				}
			});
		};

		const initialButton = buttons[0];
		activate(initialButton);

		buttons.forEach((button, index) => {
			button.addEventListener('click', () => activate(button));

			button.addEventListener('keydown', (event) => {
				let nextIndex = null;

				if (event.key === 'ArrowRight' || event.key === 'ArrowDown') {
					nextIndex = (index + 1) % buttons.length;
				} else if (event.key === 'ArrowLeft' || event.key === 'ArrowUp') {
					nextIndex = (index - 1 + buttons.length) % buttons.length;
				} else if (event.key === 'Home') {
					nextIndex = 0;
				} else if (event.key === 'End') {
					nextIndex = buttons.length - 1;
				}

				if (nextIndex !== null) {
					event.preventDefault();
					activate(buttons[nextIndex]);
					buttons[nextIndex].focus();
				}
			});
		});
	});
};

const initPageBuilderGalleries = () => {
	document.querySelectorAll('[data-page-builder-gallery]').forEach((gallery) => {
		if (gallery.dataset.pageBuilderGalleryReady === 'true') {
			return;
		}

		gallery.dataset.pageBuilderGalleryReady = 'true';

		const triggers = Array.from(gallery.querySelectorAll('[data-gallery-index]'));
		const lightbox = gallery.querySelector('[data-page-builder-lightbox]');
		const image = gallery.querySelector('[data-lightbox-image]');
		const caption = gallery.querySelector('[data-lightbox-caption]');
		const closeButton = gallery.querySelector('[data-lightbox-close]');
		const previousButton = gallery.querySelector('[data-lightbox-prev]');
		const nextButton = gallery.querySelector('[data-lightbox-next]');
		const dataElement = gallery.querySelector('[data-page-builder-gallery-data]');

		if (!lightbox || !image || !closeButton || !previousButton || !nextButton || !dataElement) {
			return;
		}

		let items = [];

		try {
			items = JSON.parse(dataElement.textContent.trim());
		} catch (error) {
			return;
		}

		if (!Array.isArray(items) || !items.length) {
			return;
		}

		let currentIndex = 0;
		let lastTrigger = null;

		const update = () => {
			const item = items[currentIndex];

			if (!item) {
				return;
			}

			image.src = item.full || '';
			image.alt = item.alt || '';

			if (caption) {
				caption.textContent = item.caption || '';
				caption.hidden = !item.caption;
			}

			previousButton.hidden = items.length < 2;
			nextButton.hidden = items.length < 2;
		};

		const open = (index, trigger) => {
			currentIndex = Math.max(0, Math.min(index, items.length - 1));
			lastTrigger = trigger || null;
			update();
			lightbox.hidden = false;
			lightbox.setAttribute('aria-hidden', 'false');
			document.documentElement.classList.add('page-builder-lightbox-open');
			closeButton.focus();
		};

		const close = () => {
			lightbox.hidden = true;
			lightbox.setAttribute('aria-hidden', 'true');
			document.documentElement.classList.remove('page-builder-lightbox-open');
			image.removeAttribute('src');

			if (lastTrigger) {
				lastTrigger.focus();
			}
		};

		const previous = () => {
			currentIndex = (currentIndex - 1 + items.length) % items.length;
			update();
		};

		const next = () => {
			currentIndex = (currentIndex + 1) % items.length;
			update();
		};

		triggers.forEach((trigger) => {
			trigger.addEventListener('click', () => {
				open(Number(trigger.dataset.galleryIndex) || 0, trigger);
			});
		});

		closeButton.addEventListener('click', close);
		previousButton.addEventListener('click', previous);
		nextButton.addEventListener('click', next);

		lightbox.addEventListener('click', (event) => {
			if (event.target === lightbox) {
				close();
			}
		});

		document.addEventListener('keydown', (event) => {
			if (lightbox.hidden) {
				return;
			}

			if (event.key === 'Escape') {
				close();
			} else if (event.key === 'ArrowLeft') {
				event.preventDefault();
				previous();
			} else if (event.key === 'ArrowRight') {
				event.preventDefault();
				next();
			}
		});
	});
};

const initPageBuilder = () => {
	initPageBuilderAccordions();
	initPageBuilderTabs();
	initPageBuilderGalleries();
};

if (document.readyState === 'loading') {
	document.addEventListener('DOMContentLoaded', initPageBuilder);
} else {
	initPageBuilder();
}
