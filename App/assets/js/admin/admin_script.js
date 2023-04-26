$(document).ready(function () {
  var url = window.location.pathname;
  if (
    url.startsWith("/admin-felhasznalok") ||
    url.startsWith("/admin-adminok")
  ) {
    $('.sidebar .nav-link[data-target="#collapseUsers"]')
      .closest(".nav-item")
      .addClass("active");
  } else {
    $.each($(".sidebar").find("li"), function () {
      var href = $(this).find("a").attr("href");
      if (url.startsWith(href) || url === href) {
        $(this).addClass("active");
      }
    });
  }

  $(".sidebar .nav-link").on("click", function () {
    $(".sidebar .nav-item").removeClass("active");
    $(this).closest(".nav-item").addClass("active");
  });

  $(".sidebar .collapse").on("show.bs.collapse", function () {
    $(this).closest(".nav-item").addClass("active");
  });

  $(".sidebar .collapse").on("hide.bs.collapse", function () {
    $(this).closest(".nav-item").removeClass("active");
  });
});

/****************** CRUD ******************/
function showAlert(type, message) {
  var alertHtml = `<div class="alert alert-${type} text-center alert-dismissible fade show text-dark fw-bold" role="alert" id="alert-${type}">
                     ${message}
                     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                   </div>`;
  $("#alert-container").html(alertHtml);

  setTimeout(function () {
    $("#alert-" + type).alert("close");
  }, 2000);
}

var myModal = null;
var myModalDel = null;

function termekTipusFrissit() {
  var id = $("#itemType").val();
  $(".kategoriak").removeClass("latszik").addClass("nemlatszik");
  $(".c_" + id)
    .removeClass("nemlatszik")
    .addClass("latszik");
  $("#itemCategory").val("");
}

function termekTorolModal(id) {
  $("#delete_termek_id").val(id);
  var sor_id = "termekid_" + id;
  var sor = $("#" + sor_id);
  var nev = sor.children("td").next().html();
  $("#termek_torol").html(nev);
  if (myModalDel == null)
    myModalDel = new bootstrap.Modal(document.getElementById("deleteModal"));
  myModalDel.show();
}

function termekSzerkesztModal(id) {
  $("#termek_id").val(id);
  var nev = "";
  var tipus = "";
  var kategoria = "";
  var leiras = "";
  var ar = "";
  if (id == 0) {
    // új
    $("#termek_cim").html("Új termék");
    $("#kep_feltoltese").html("Kép feltöltése");
    $("#kep_feltoltott").html("");
    $("#kep_feltoltott").css("display", "none");
  } else {
    // módosítás
    $("#termek_cim").html("Termék módosítása");
    var sor_id = "termekid_" + id;
    var sor = $("#" + sor_id);
    $("#kep_feltoltese").html("Kép cseréje (Ha üres, nincs kép csere)");
    $("#kep_feltoltott").html(sor.children("td").first().html());
    $("#kep_feltoltott").css("display", "flex");

    nev = sor.children("td").next().html();
    tipus = sor.children("td").next().next().attr("id");
    kategoria = sor.children("td").next().next().next().attr("id");
    leiras = sor.children("td").next().next().next().next().html();
    ar = sor.children("td").next().next().next().next().next().attr("id");
  }
  $("#termek_nev").val(nev);
  $("#itemType").val(tipus);
  $("#itemCategory").val(kategoria);
  $("#leiras").val(leiras);
  $("#ar").val(ar);

  if (myModal == null)
    myModal = new bootstrap.Modal(document.getElementById("productDataModal"));
  myModal.show();
}

function termekMentes() {
  var frm = $("#product_form");
  var id = $("#termek_id").val();
  var sor_id = "termekid_" + id;
  var sor = $("#" + sor_id);

  var nev = $("#termek_nev").val();
  var tipus = $("#itemType").val();
  var tipus_nev = tipus == 0 ? "Ital" : "Étel";
  var kategoria = $("#itemCategory").val();
  var kategoria_nev = $("#itemCategory option:selected").text();
  var leiras = $("#leiras").val();
  var ar = $("#ar").val();
  if (id == 0 && $("#formFile").val() == "") {
    alert("Nem választott képet");
  }

  // ajax... mentés
  $.ajax({
    type: "POST",
    url: "/product-save",
    async: true,
    data: new FormData(document.getElementById("product_form")),
    contentType: false,
    cache: false,
    processData: false,
    error: function () {
      alert("Az adatokat nem sikerült eltárolni!");
    },
    success: function (data, statusz) {
      if (statusz == "success") {
        //var resp = JSON.parse(data);
        sor.children("td").next().first().html(nev);
        sor.children("td").next().next().first().html(tipus_nev);
        sor.children("td").next().next().first().attr("id", tipus);
        sor.children("td").next().next().next().first().html(kategoria_nev);
        sor.children("td").next().next().next().first().attr("id", kategoria);
        sor.children("td").next().next().next().next().first().html(leiras);
        sor
          .children("td")
          .next()
          .next()
          .next()
          .next()
          .next()
          .first()
          .attr("id", ar);
        sor.children("td").next().next().next().next().next().first().html(ar);

        myModal.hide();
        showAlert("success", "Termék sikeresen mentésre került!");
      } else {
        alert("Az adatokat nem sikerült eltárolni!");
      }
    },
  });
  // ajax mentés lefutott:
  return false;
}

function termekTorles() {
  var frm = $("#delete_form");
  var id = $("#delete_termek_id").val();

  // ajax törlés...
  $.ajax({
    type: "POST",
    url: "/product-delete",
    async: true,
    data: new FormData(document.getElementById("delete_form")),
    contentType: false,
    cache: false,
    processData: false,
    error: function () {
      alert("Az adatokat nem sikerült eltárolni!");
    },
    success: function (data, statusz) {
      if (statusz == "success") {
        //var resp = JSON.parse(data);
        // ajax törlés lefutot:
        var sor_id = "termekid_" + id;
        $("#" + sor_id).hide();

        myModalDel.hide();
        showAlert("success", "Termék sikeresen törölve lett!");
      } else {
        alert("Az adatokat nem sikerült eltárolni!");
      }
    },
  });
}

function adminTorolModal(id) {
  $("#delete_admin_id").val(id);
  var sor_id = "adminid_" + id;
  var sor = $("#" + sor_id);
  var user_name = sor.children("td").next().html();
  $("#admin_torol").html(user_name);
  if (myModalDel == null)
    myModalDel = new bootstrap.Modal(document.getElementById("deleteModal"));

  myModalDel.show();
}

function adminSzerkesztModal(id) {
  $("#admin_id").val(id);
  var fhnev = "";
  var jelszo = "";
  if (id == 0) {
    // új
    $("#admin_cim").html("Új admin");
    document.getElementById("jelszo").required = true;
  } else {
    // módosítás
    $("#admin_cim").html("Admin módosítása");
    document.getElementById("jelszo").required = false;
    var sor_id = "adminid_" + id;
    var sor = $("#" + sor_id);

    fhnev = sor.children("td").next().html();
  }
  $("#admin_nev").val(fhnev);

  if (myModal == null)
    myModal = new bootstrap.Modal(document.getElementById("adminDataModal"));
  myModal.show();
}

function adminMentes() {
  var frm = $("#admin_form");
  var id = $("#admin_id").val();
  var sor_id = "adminid_" + id;
  var sor = $("#" + sor_id);

  var fhnev = $("#admin_nev").val();

  // ajax... mentés
  $.ajax({
    type: "POST",
    url: "/admin-save",
    async: true,
    data: new FormData(document.getElementById("admin_form")),
    contentType: false,
    cache: false,
    processData: false,
    error: function () {
      alert("Az adatokat nem sikerült eltárolni!");
    },
    success: function (data, statusz) {
      if (statusz == "success") {
        if (data.error_message) {
          $("#error-message").html(data.error_message);
        } else {
          //var resp = JSON.parse(data);
          sor.children("td").next().first().html(fhnev);

          showAlert("success", "Admin sikeresen mentésre került!");
          myModal.hide();
        }
      } else {
        alert("Az adatokat nem sikerült eltárolni!");
      }
    },
  });
  // ajax mentés lefutott:
  return false;
}

function adminTorles() {
  var frm = $("#delete_form");
  var id = $("#delete_admin_id").val();

  // ajax törlés...
  $.ajax({
    type: "POST",
    url: "/admin-delete",
    async: true,
    data: new FormData(document.getElementById("delete_form")),
    contentType: false,
    cache: false,
    processData: false,
    error: function () {
      alert("Az adatokat nem sikerült eltárolni!");
    },
    success: function (data, statusz) {
      if (statusz == "success") {
        // var resp = JSON.parse(data);
        // ajax törlés lefutot:
        var sor_id = "adminid_" + id;
        $("#" + sor_id).hide();

        showAlert("success", "Admin sikeresen törölve lett!");
        myModalDel.hide();
      } else {
        alert("Az adatokat nem sikerült eltárolni!");
      }
    },
  });
}

function allapotSzerkesztModal(orderId, orderStatusId) {
  $("#allapot_id").val(orderId);
  $("#orderCategory").val(orderStatusId);
  $("#statusDataModal").modal("show");
}

function allapotMentes() {
  var frm = $("#status_form");
  var id = $("#allapot_id").val();
  var statusId = $("#orderCategory").val();

  $.ajax({
    type: "POST",
    url: "/update-order-status",
    async: true,
    data: {
      id: id,
      status_id: statusId,
    },
    dataType: "json",
    error: function (jqXHR, textStatus, errorThrown) {
      console.log(jqXHR.responseText);
      alert("Az adatokat nem sikerült eltárolni!");
      console.error("AJAX error: " + textStatus + " - " + errorThrown);
    },

    success: function (data, statusz) {
      if (data.result === "success") {
        $("#rendelesid_" + id)
          .find("td span")
          .html($("#orderCategory option:selected").text());
        showAlert("success", "Állapot sikeresen mentésre került!");
        $("#statusDataModal").modal("hide");
      } else {
        alert("Az adatokat nem sikerült eltárolni!");
        console.error("Error details:", data.details);
      }
    },
  });

  return false;
}

const eyeIcons = document.querySelectorAll(".show-hide");

eyeIcons.forEach((eyeIcon) => {
  eyeIcon.addEventListener("click", () => {
    const pInput = eyeIcon.parentElement.querySelector("input");
    if (pInput.type === "password") {
      eyeIcon.classList.replace("bx-hide", "bx-show");
      return (pInput.type = "text");
    }
    eyeIcon.classList.replace("bx-show", "bx-hide");
    pInput.type = "password";
  });
});

document
  .querySelector('label[for="button-action"]')
  .addEventListener("click", function () {
    document.getElementById("button-action").click();
  });
