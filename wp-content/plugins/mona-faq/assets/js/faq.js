const initFaq = () => {
  const faqInstances = document.querySelectorAll(".faq");

  if (!faqInstances.length) {
    return;
  }

  faqInstances.forEach((faq) => {
    const buttons = faq.querySelectorAll(".faq__button");

    buttons.forEach((button) => {
      button.addEventListener("click", () => {
        const isExpanded = button.getAttribute("aria-expanded") === "true";
        const answerId = button.getAttribute("aria-controls");
        const answer = document.getElementById(answerId);

        if (!answer) {
          return;
        }

        button.setAttribute("aria-expanded", String(!isExpanded));
        answer.hidden = isExpanded;
      });
    });
  });
};

document.addEventListener("DOMContentLoaded", initFaq);
