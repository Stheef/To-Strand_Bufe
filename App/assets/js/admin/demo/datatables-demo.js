// Call the dataTables jQuery plugin
$(document).ready(function () {
  $("#dataTableProduct").DataTable({
    language: {
      decimal: "",
      emptyTable: "Nincs adat a táblában",
      info: "Összesen _TOTAL_ darab termék",
      infoEmpty: "nincs találat",
      infoFiltered: "(_MAX_ termékből szűrve)",
      infoPostFix: "",
      thousands: ",",
      lengthMenu: " _MENU_ db termék",
      loadingRecords: "Töltődik...",
      processing: "",
      search: "Keresés:",
      zeroRecords: "Nem talált termékeket",
      paginate: {
        first: "Első",
        last: "Utolsó",
        next: "Következő",
        previous: "Előző",
      },
      aria: {
        sortAscending: ": növekvő sorrendbe rendezve",
        sortDescending: ": csökkenő sorrendbe rendezve",
      },
    },
  });
});


$(document).ready(function () {
  $("#dataTableOrder").DataTable({
    "order": [[ 0, "desc" ]],
    language: {
      decimal: "",
      emptyTable: "Nincs adat a táblában",
      info: "Összesen _TOTAL_ darab rendelés",
      infoEmpty: "nincs találat",
      infoFiltered: "(_MAX_ rendelésből szűrve)",
      infoPostFix: "",
      thousands: ",",
      lengthMenu: " _MENU_ db rendelés",
      loadingRecords: "Töltődik...",
      processing: "",
      search: "Keresés:",
      zeroRecords: "Nem talált rendelést",
      paginate: {
        first: "Első",
        last: "Utolsó",
        next: "Következő",
        previous: "Előző",
      },
      aria: {
        sortAscending: ": növekvő sorrendbe rendezve",
        sortDescending: ": csökkenő sorrendbe rendezve",
      },
    },
  });
});



$(document).ready(function () {
  $("#dataTableUser").DataTable({
    language: {
      decimal: "",
      emptyTable: "Nincs adat a táblában",
      info: "Összesen _TOTAL_ darab felhasználó",
      infoEmpty: "nincs találat",
      infoFiltered: "(_MAX_ felhasználóból szűrve)",
      infoPostFix: "",
      thousands: ",",
      lengthMenu: " _MENU_ db felhasználó",
      loadingRecords: "Töltődik...",
      processing: "",
      search: "Keresés:",
      zeroRecords: "Nem talált ilyen nevű felhasználót",
      paginate: {
        first: "Első",
        last: "Utolsó",
        next: "Következő",
        previous: "Előző",
      },
      aria: {
        sortAscending: ": növekvő sorrendbe rendezve",
        sortDescending: ": csökkenő sorrendbe rendezve",
      },
    },
  });
});


$(document).ready(function () {
  $("#dataTableAdmin").DataTable({
    language: {
      decimal: "",
      emptyTable: "Nincs adat a táblában",
      info: "Összesen _TOTAL_ darab admin",
      infoEmpty: "Nincs találat",
      infoFiltered: "(_MAX_ admin felhasználóból szűrve)",
      infoPostFix: "",
      thousands: ",",
      lengthMenu: " _MENU_ db admin",
      loadingRecords: "Töltődik...",
      processing: "",
      search: "Keresés:",
      zeroRecords: "Nem talált ilyen nevű admint",
      paginate: {
        first: "Első",
        last: "Utolsó",
        next: "Következő",
        previous: "Előző",
      },
      aria: {
        sortAscending: ": növekvő sorrendbe rendezve",
        sortDescending: ": csökkenő sorrendbe rendezve",
      },
    },
  });
});


$(document).ready(function () {
  $("#dataTableUsersOrder").DataTable({
    language: {
      decimal: "",
      emptyTable: "Nem rendelt még!",
      info: "Összesen _TOTAL_ darab rendelés",
      infoEmpty: "Nem talált ilyen rendelést",
      infoFiltered: "(_MAX_ rendelésből szűrve)",
      infoPostFix: "",
      thousands: ",",
      lengthMenu: " _MENU_ db rendelés",
      loadingRecords: "Töltődik...",
      processing: "",
      search: "Keresés:",
      zeroRecords: "Nem talált ilyen rendelést",
      paginate: {
        first: "Első",
        last: "Utolsó",
        next: "Következő",
        previous: "Előző",
      },
      aria: {
        sortAscending: ": növekvő sorrendbe rendezve",
        sortDescending: ": csökkenő sorrendbe rendezve",
      },
    },
  });
});



