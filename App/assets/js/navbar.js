(function () {
  "use strict";

  const select = (el, all = false) => {
    el = el.trim();
    if (all) {
      return [...document.querySelectorAll(el)];
    } else {
      return document.querySelector(el);
    }
  };

  const on = (type, el, listener, all = false) => {
    let selectEl = select(el, all);
    if (selectEl) {
      if (all) {
        selectEl.forEach((e) => e.addEventListener(type, listener));
      } else {
        selectEl.addEventListener(type, listener);
      }
    }
  };

  const onscroll = (el, listener) => {
    el.addEventListener("scroll", listener);
  };

  let selectHeader = select("#header");
  if (selectHeader) {
    const headerScrolled = () => {
      let scrollThreshold = 250;
      if (window.location.pathname === "/kapcsolat") {
        scrollThreshold = 70;
      }
      if (window.location.pathname === "/etlap") {
        scrollThreshold = 70;
      }
      if (
        window.location.pathname.startsWith("/etlap/") ||
        window.location.pathname.startsWith("/profil/") ||
        window.location.pathname.startsWith("/kosar") ||
        window.location.pathname.startsWith("/penztar")
      ) {
        selectHeader.classList.add("header-scrolled");
        return;
      }
      if (window.scrollY > scrollThreshold) {
        selectHeader.classList.add("header-scrolled");
      } else {
        selectHeader.classList.remove("header-scrolled");
      }
    };
    window.addEventListener("load", headerScrolled);
    onscroll(document, headerScrolled);
  }

  const mobileNavShow = document.querySelector(".mobile-nav-show");
  const mobileNavHide = document.querySelector(".mobile-nav-hide");

  document.querySelectorAll(".mobile-nav-toggle").forEach((el) => {
    el.addEventListener("click", function (event) {
      event.preventDefault();
      mobileNavToogle();
    });
  });

  function mobileNavToogle() {
    document.querySelector("body").classList.toggle("mobile-nav-active");
    mobileNavShow.classList.toggle("d-none");
    mobileNavHide.classList.toggle("d-none");
  }

  on(
    "click",
    ".navbar .dropdown > a",
    function (e) {
      if (select("#navbar").classList.contains("navbar-mobile")) {
        e.preventDefault();
        this.nextElementSibling.classList.toggle("dropdown-active");
      }
    },
    true
  );
})();

$(".dropdown").hover(function () {
  $(".dropdown-toggle", this).trigger("click");
});
