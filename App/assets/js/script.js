document.addEventListener("DOMContentLoaded", () => {
  "use strict";
  var swiper = new Swiper(".hero-slider", {
    speed: 800,
    loop: true,
    grabCursor: true,
    autoplay: {
      delay: 5000,
      disableOnInteraction: false,
    },
    effect: "flip",
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
  });

  const select = (el, all = false) => {
    el = el.trim();
    if (all) {
      return [...document.querySelectorAll(el)];
    } else {
      return document.querySelector(el);
    }
  };
  let heroCarouselIndicators = select("#hero-carousel-indicators");
  let heroCarouselItems = select("#heroCarousel .carousel-item", true);

  heroCarouselItems.forEach((item, index) => {
    index === 0
      ? (heroCarouselIndicators.innerHTML +=
          "<li data-bs-target='#heroCarousel' data-bs-slide-to='" +
          index +
          "' class='active'></li>")
      : (heroCarouselIndicators.innerHTML +=
          "<li data-bs-target='#heroCarousel' data-bs-slide-to='" +
          index +
          "'></li>");
  });

  /* ***** Slideanim  ***** */
  $(window).scroll(function () {
    $(".slideanim").each(function () {
      var pos = $(this).offset().top;

      var winTop = $(window).scrollTop();
      if (pos < winTop + 600) {
        $(this).addClass("slide");
      }
    });
  });

  const scrollTop = document.querySelector(".scroll-top");
  if (scrollTop) {
    const togglescrollTop = function () {
      window.scrollY > 100
        ? scrollTop.classList.add("active")
        : scrollTop.classList.remove("active");
    };
    window.addEventListener("load", togglescrollTop);
    document.addEventListener("scroll", togglescrollTop);
    scrollTop.addEventListener(
      "click",
      window.scrollTo({
        top: 0,
        behavior: "smooth",
      })
    );
  }

  new PureCounter();

  function aos_init() {
    AOS.init({
      duration: 1000,
      easing: "ease-in-out",
      once: true,
      mirror: false,
    });
  }
  window.addEventListener("load", () => {
    aos_init();
  });

  const eyeIcons = document.querySelectorAll(".show-hide");

  eyeIcons.forEach((eyeIcon) => {
    eyeIcon.addEventListener("click", () => {
      const pInput = eyeIcon.closest(".input-field").querySelector("input");
      if (pInput.type === "password") {
        eyeIcon.classList.replace("bx-hide", "bx-show");
        return (pInput.type = "text");
      }
      eyeIcon.classList.replace("bx-show", "bx-hide");
      pInput.type = "password";
    });
  });

  $(document).ready(function () {
    $(".modal").on("show.bs.modal", function () {
      if ($(document).height() > $(window).height()) {
        $("body").addClass("modal-open-noscroll");
      } else {
        $("body").removeClass("modal-open-noscroll");
      }
    });
    $(".modal").on("hide.bs.modal", function () {
      $("body").removeClass("modal-open-noscroll");
    });
  });
});

(() => {
  "use strict";
  const forms = document.querySelectorAll(".needs-validation");

  Array.from(forms).forEach((form) => {
    form.addEventListener(
      "submit",
      (event) => {
        if (!form.checkValidity()) {
          event.preventDefault();
          event.stopPropagation();
        }

        form.classList.add("was-validated");
      },
      false
    );
  });

  const profileForm = document.getElementById("profile-form");
  if (!profileForm) return;

  const inputs = profileForm.querySelectorAll(".profil-change");
  const initialValues = {};

  inputs.forEach((input) => {
    initialValues[input.name] = input.value;
  });

  function hasFormChanged() {
    return Array.from(inputs).some(
      (input) => initialValues[input.name] !== input.value
    );
  }

  profileForm.addEventListener("submit", function (event) {
    if (!hasFormChanged()) {
      event.preventDefault();
      Swal.fire({
        icon: "warning",
        title: "Nincs változás az adatokban!",
        showConfirmButton: false,
        showCloseButton: true,
        closeButtonAriaLabel: "Bezárás",
      });
    }
  });
})();

/* **** Menü keresés **** */
const items = document.querySelectorAll(".blokkok");
const checkboxes = document.querySelectorAll(".category-checkbox");
const input = document.querySelector(".searchbox-input");
const loadMoreButton = document.getElementById("loadMoreButton");
const noResultsMsg = document.getElementById("no-results-msg");

const foodCardBlocks = document.querySelectorAll(".blokkok");
const itemsPerLoad = 18;
let startIndex = 0;
function filterItems() {
  const checkedCategories = Array.from(checkboxes)
    .filter((checkbox) => checkbox.checked)
    .map((checkbox) => checkbox.value);

  const filter = input.value.toUpperCase();
  let visibleCount = 0;
  items.forEach((item, index) => {
    const itemCategory = item.querySelector(".food-card_author").textContent;
    const itemTitle = item
      .querySelector(".food-card_content")
      .innerText.toUpperCase();
    if (
      (checkedCategories.length === 0 ||
        checkedCategories.includes(itemCategory)) &&
      itemTitle.indexOf(filter) > -1
    ) {
      item.style.display = "block";
      if (index >= startIndex && index < startIndex + itemsPerLoad) {
        visibleCount++;
      }
    } else {
      item.style.display = "none";
    }
  });

  if (visibleCount === 0) {
    loadMoreButton.style.display = "none";
    noResultsMsg.style.display = "block";
  } else {
    noResultsMsg.style.display = "none";
    if (startIndex + itemsPerLoad >= visibleCount) {
      loadMoreButton.style.display = "none";
    } else {
      loadMoreButton.style.display = "block";
    }
  }
}

checkboxes.forEach((checkbox) =>
  checkbox.addEventListener("click", function () {
    startIndex = 0;
    filterItems();
  })
);

input.addEventListener("keyup", function () {
  startIndex = 0;
  filterItems();
});

foodCardBlocks.forEach(function (block) {
  block.style.display = "none";
});

for (let i = 0; i < itemsPerLoad; i++) {
  if (foodCardBlocks[startIndex + i]) {
    foodCardBlocks[startIndex + i].style.display = "block";
  }
}

loadMoreButton.addEventListener("click", function () {
  startIndex += itemsPerLoad;
  for (let i = 0; i < itemsPerLoad; i++) {
    if (foodCardBlocks[startIndex + i]) {
      foodCardBlocks[startIndex + i].style.display = "block";
    }
  }

  if (startIndex + itemsPerload >= foodCardBlocks.length) {
    loadMoreButton.style.display = "none";
  }
});

function buttonUp() {
  var inputVal = $(".searchbox-input").val();
  inputVal = $.trim(inputVal).length;
  if (inputVal !== 0) {
    $(".searchbox-icon").css("display", "none");
  } else {
    $(".searchbox-input").val("");
    $(".searchbox-icon").css("display", "block");
    startIndex = 0;
    filterItems();
  }
}

/// Jelszó ellenőrzés ///
const form = document.querySelector("#registration-form");
const passwordInput = form.querySelector("#password");
const password2Input = form.querySelector("#password2");
const passwordError = form.querySelector("#password-error-message");
const password2Error = form.querySelector("#password2-error-message");

form.addEventListener("submit", function (event) {
  event.preventDefault();

  if (passwordInput.value !== password2Input.value) {
    passwordError.textContent = "A két jelszó nem egyezik meg!";
    password2Error.textContent = "A két jelszó nem egyezik meg!";
  } else {
    passwordError.textContent = "";
    password2Error.textContent = "";
    form.submit();
  }
});
