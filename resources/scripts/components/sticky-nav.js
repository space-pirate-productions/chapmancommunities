const stickyNav = {
  init() {
    const el = document.querySelector("#main > #intersection-checker");
    const banner = document.querySelector("#cc-banner");
    const observer = new IntersectionObserver(
      ([e]) =>
        banner.classList.toggle("cc-banner--stuck", e.intersectionRatio < 1),
      { threshold: [1] }
    );

    observer.observe(el);
  },
};

export default stickyNav;
