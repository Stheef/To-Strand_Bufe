function fadeOut() {
  setInterval(loader, 2000);
}

window.onload = fadeOut;

document.querySelectorAll('input[type="number"]').forEach((numberInput) => {
  numberInput.oninput = () => {
    if (numberInput.value.length > numberInput.maxLength)
      numberInput.value = numberInput.value.slice(0, numberInput.maxLength);
  };
});

var swiper = new Swiper(".hero-slider", {
  loop: true,
  grabCursor: true,
  effect: "flip",
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },
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

/* ***** Smooth Scrolling  ***** */
$(document).ready(function () {
  $(".navbar a, #service a").on("click", function (event) {
    if (this.hash !== "") {
      event.preventDefault();
      var hash = this.hash;

      $("html, body").animate(
        {
          scrollTop: $(hash).offset().top,
        },
        900,
        function () {
          window.location.hash = hash;
        }
      );
    }
  });

  /* ***** Scroll to Top ***** */
  $(window).scroll(function () {
    if ($(this).scrollTop() >= 300) {
      $(".to-top").fadeIn(200);
    } else {
      $(".to-top").fadeOut(200);
    }
  });
  $(".to-top").click(function () {
    $(".body,html").animate(
      {
        scrollTop: 0,
      },
      500
    );
  });
});

new PureCounter();

/* **** Menu search **** */
var buttonUp = () => {
  const input = document.querySelector(".searchbox-input");
  const cards = document.getElementsByClassName("blokkok");
  let filter = input.value.toUpperCase();
  for (let i = 0; i < cards.length; i++) {
    let title = cards[i].querySelector(".food-card_content");
    if (title.innerText.toUpperCase().indexOf(filter) > -1) {
      cards[i].classList.remove("d-none");
    } else {
      cards[i].classList.add("d-none");
    }
  }
};
$("#filters :checkbox").click(function () {
  $("blokkok").hide();
  $("#filters :checkbox:checked").each(function () {
    $("." + $(this).val()).show();
  });
});
