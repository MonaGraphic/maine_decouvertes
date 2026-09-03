(function () {
  "use strict";

  if (
    typeof window === "undefined" ||
    !window.wp ||
    !window.wp.blocks ||
    !window.wp.blockEditor ||
    !window.wp.components ||
    !window.wp.data ||
    !window.wp.i18n ||
    !window.wp.element
  ) {
    return;
  }

  const { registerBlockType } = window.wp.blocks;
  const { __ } = window.wp.i18n;
  const { InspectorControls, useBlockProps } = window.wp.blockEditor;
  const { PanelBody, CheckboxControl, Button } = window.wp.components;
  const { useSelect } = window.wp.data;
  const { createElement, Fragment } = window.wp.element;

  registerBlockType("mona-faq/faq", {
    edit: function Edit(props) {
      const { attributes, setAttributes } = props;
      const selectedFaqs = attributes.selectedFaqs || [];

      const faqPosts = useSelect(function (select) {
        const core = select("core");
        if (!core || typeof core.getEntityRecords !== "function") {
          return [];
        }

        return (
          core.getEntityRecords("postType", "faq", {
            per_page: -1,
            status: "publish",
            order: "asc",
            orderby: "menu_order",
          }) || []
        );
      }, []);

      const availableFaqs = (faqPosts || []).map(function (post) {
        const title =
          post.title && post.title.rendered
            ? post.title.rendered
            : post.title || post.slug || __("FAQ sans titre", "mona-faq");
        return {
          id: Number(post.id),
          label: title,
        };
      });

      function toggleFaq(faq) {
        const faqId = Number(faq.id);
        const alreadySelected = selectedFaqs.some(function (item) {
          return Number(item.id) === faqId;
        });

        const nextFaqs = alreadySelected
          ? selectedFaqs.filter(function (item) {
              return Number(item.id) !== faqId;
            })
          : selectedFaqs.concat([
              {
                id: faqId,
                title: faq.label,
              },
            ]);

        setAttributes({ selectedFaqs: nextFaqs });
      }

      function moveFaq(index, direction) {
        const nextIndex = index + direction;
        if (nextIndex < 0 || nextIndex >= selectedFaqs.length) {
          return;
        }

        const reordered = selectedFaqs.slice();
        const item = reordered.splice(index, 1)[0];
        reordered.splice(nextIndex, 0, item);
        setAttributes({ selectedFaqs: reordered });
      }

      const blockProps = useBlockProps();

      return createElement(
        Fragment,
        null,
        createElement(
          InspectorControls,
          null,
          createElement(
            PanelBody,
            { title: __("FAQ", "mona-faq") },
            availableFaqs.length === 0 &&
              createElement(
                "p",
                null,
                __("Aucune FAQ disponible pour le moment.", "mona-faq"),
              ),
            availableFaqs.length > 0 &&
              availableFaqs.map(function (faq) {
                const isChecked = selectedFaqs.some(function (item) {
                  return Number(item.id) === faq.id;
                });

                return createElement(CheckboxControl, {
                  key: faq.id,
                  label: faq.label,
                  checked: isChecked,
                  onChange: function () {
                    toggleFaq(faq);
                  },
                });
              }),
          ),
        ),
        createElement(
          "div",
          blockProps,
          createElement(
            "div",
            { style: { padding: "12px 0" } },
            createElement("strong", null, __("FAQ", "mona-faq")),
          ),
          selectedFaqs.length === 0 &&
            createElement(
              "p",
              null,
              __("Aucune FAQ sélectionnée.", "mona-faq"),
            ),
          selectedFaqs.length > 0 &&
            selectedFaqs.map(function (faq, index) {
              const faqDetails = availableFaqs.find(function (item) {
                return Number(item.id) === Number(faq.id);
              });
              const label = faqDetails
                ? faqDetails.label
                : faq.title || __("FAQ supprimée", "mona-faq");

              return createElement(
                "div",
                {
                  key: faq.id + "-" + index,
                  style: {
                    display: "flex",
                    alignItems: "center",
                    justifyContent: "space-between",
                    gap: "8px",
                    marginBottom: "8px",
                  },
                },
                createElement("span", null, label),
                createElement(
                  "span",
                  null,
                  createElement(
                    Button,
                    {
                      variant: "secondary",
                      onClick: function () {
                        moveFaq(index, -1);
                      },
                      disabled: index === 0,
                      "aria-label": __(
                        "Déplacer la FAQ vers le haut",
                        "mona-faq",
                      ),
                    },
                    "↑",
                  ),
                  createElement(
                    Button,
                    {
                      variant: "secondary",
                      onClick: function () {
                        moveFaq(index, 1);
                      },
                      disabled: index === selectedFaqs.length - 1,
                      "aria-label": __(
                        "Déplacer la FAQ vers le bas",
                        "mona-faq",
                      ),
                    },
                    "↓",
                  ),
                  createElement(
                    Button,
                    {
                      variant: "tertiary",
                      isDestructive: true,
                      onClick: function () {
                        toggleFaq({ id: faq.id, label: label });
                      },
                      "aria-label": __("Supprimer la FAQ", "mona-faq"),
                    },
                    __("Supprimer", "mona-faq"),
                  ),
                ),
              );
            }),
        ),
      );
    },
    save: function save() {
      return null;
    },
  });
})();
