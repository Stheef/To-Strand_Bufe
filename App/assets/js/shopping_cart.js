class Cart {
  constructor() {
    this.items = JSON.parse(sessionStorage.getItem("cart")) || [];
    this.updateCartBadge();
    this.displayCartItems();
  }

  addItem(item) {
    const index = this.items.findIndex((cartItem) => cartItem.id === item.id);
    if (index !== -1) {
      this.items[index].quantity += 1;
    } else {
      this.items.push({
        ...item,
        quantity: 1,
      });
    }
    this.updateSessionStorage();
    this.updateCartBadge();
    this.displayCartItems();
  }

  removeItem(itemId) {
    this.items = this.items.filter((item) => item.id !== itemId);
    this.updateSessionStorage();
    this.updateCartBadge();
    this.displayCartItems();
    this.displayCartPageItems();

    const cartPageItem = document.querySelector(
      `#cart-items .row[data-id="${itemId}"]`
    );
    if (cartPageItem) {
      cartPageItem.remove();
    }

    const dropdownItem = document.getElementById(`cart-item-${itemId}`);
    if (dropdownItem) {
      dropdownItem.remove();
    }

    this.displayCartItems();
    this.displayCartPageItems();
    updateCartTotalPrice();
    updateCartPageTotalPrice();
  }

  updateSessionStorage() {
    sessionStorage.setItem("cart", JSON.stringify(this.items));
  }

  updateCartBadge() {
    const itemCount = this.items.reduce(
      (count, item) => count + item.quantity,
      0
    );
    document.getElementById("cart-count").innerText = itemCount;
  }

  displayCartItems() {
    const cartItemsContainer = document.getElementById("cart-item");
    cartItemsContainer.innerHTML = "";

    let total = 0;

    this.items.forEach((item) => {
      total += item.unit_price * item.quantity;

      const itemElem = document.createElement("div");
      itemElem.classList.add("cart-item");
      itemElem.setAttribute("data-price", item.unit_price * item.quantity);
      itemElem.setAttribute("id", `cart-item-${item.id}`);
      itemElem.innerHTML = `
    <div class="d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center">
            <img src="/App/assets/product_images/${
              item.image || "no_image.png"
            }" alt="Termék képe" class="rounded-circle cart_image"/>
            <div class="product_data ms-3">
                <h6 class="product_name">${item.name}</h6>
                <span class="product_quantity">${item.quantity} x </span>
                <span class="product_price">${item.unit_price} Ft</span>
            </div>
        </div>
        <button title="Termék eltávolítása" class="btn btn-danger btn-delete" onclick="shoppingCart.removeItem(${
          item.id
        })">
            <i class="fa-solid fa-trash"></i>
        </button>
    </div>
    <hr class="my-2 line">`;
      cartItemsContainer.appendChild(itemElem);
    });

    if (this.items.length === 0) {
      cartItemsContainer.innerHTML =
        '<div class="text-center cart_empty fw-bold"><p>A kosár üres</p></div>';
    } else {
      document.getElementById("cart-total").innerText = `${total} Ft`;
    }
    updateCartTotalPrice();
  }

  updateItemQuantity(itemId, newQuantity) {
    const item = this.items.find((cartItem) => cartItem.id === itemId);
    if (item) {
      item.quantity = newQuantity;
      this.updateSessionStorage();
      this.updateCartBadge();
      this.displayCartItems();
      this.displayCartPageItems();
      updateCartTotalPrice();

      const cartPageItem = document.querySelector(
        `#cart-items .row[data-id="${itemId}"]`
      );
      if (cartPageItem) {
        cartPageItem.setAttribute("data-price", item.unit_price * newQuantity);
      }
    }
  }

  displayCartPageItems() {
    let cartItemsContainer = document.querySelector("#cart-items");
    cartItemsContainer.innerHTML = "";
    let totalPrice = 0;
    if (this.items.length === 0) {
      cartItemsContainer.innerHTML =
        '<div class="text-center cart_empty fw-bold"><p>A kosár üres</p></div>';
      return;
    }

    this.items.forEach((item) => {
      totalPrice += item.unit_price * item.quantity;
      const cartItemElement = document.createElement("div");

      cartItemElement.classList.add("row");
      cartItemElement.setAttribute("data-id", item.id);
      cartItemElement.setAttribute(
        "data-price",
        item.unit_price * item.quantity
      );

      cartItemElement.innerHTML = `
            <div class="col-lg-3 col-md-12 mb-4 mb-lg-0">
                <div class="bg-image hover-overlay hover-zoom ripple rounded" data-mdb-ripple-color="light">
                    <img src="/App/assets/product_images/${
                      item.image || "no_image.png"
                    }" class="w-100 cart-product-img" alt="${item.name}"/>
                </div>
            </div>
            <div class="col-lg-5 col-md-6 mb-4 mb-lg-0">
                <p class="fs-3" name="name"><strong>Termék név: </strong>${
                  item.name
                }</p>
                <p class="fs-3" name="unit_price"><strong>Termék ára: </strong>${
                  item.unit_price
                } Ft </p>
            </div>
            <div class="col-lg-4 col-md-6 mb-4 mb-lg-0 quantity">
              <div class="d-flex justify-content-between w-100">
                <div class="d-flex mb-4">
                  <button class="btn btn-primary px-3 me-2" onclick="updateItemQuantityOnClick(this, -1)">
                    <i class="fas fa-minus"></i>
                  </button>
                  <div class="form">
                    <input data-id="${
                      item.id
                    }" min="1" max="15" name="quantity" value="${
        item.quantity
      }" type="number" class="form-control fs-5 item-quantity"/>
                  </div>
                  <button class="btn btn-primary px-3 ms-2" onclick="updateItemQuantityOnClick(this, 1)">
                    <i class="fas fa-plus"></i>
                  </button>
                </div>
                <button type="button" class="btn btn-danger btn-sm me-1 mb-2" data-mdb-toggle="tooltip" title="Termék eltávolítása">
                  <i class="fas fa-trash"></i>
                </button>
              </div>
            </div>
            <input type="hidden" name="products_id[]" value="${item.id}">
            <hr class="my-5 line">`;
      cartItemsContainer.appendChild(cartItemElement);

      cartItemElement
        .querySelector(".btn-danger")
        .addEventListener("click", () => {
          shoppingCart.removeItem(item.id);
          shoppingCart.displayCartPageItems();
        });
    });

    document.getElementById("cart-total-price").innerText = `${totalPrice} Ft`;
    updateCartPageTotalPrice();
  }
}

const shoppingCart = new Cart();

document.querySelector(".btn-success").addEventListener("click", (e) => {
  e.preventDefault();
  window.location.href = "/kosar";
});

document.getElementById("cart-btn").addEventListener("click", () => {
  shoppingCart.displayCartItems();
});

document.querySelectorAll(".food-card_cart").forEach((button) => {
  button.onclick = () => {
    const itemElement = button.closest(".blokkok");
    const item = {
      id: parseInt(itemElement.getAttribute("data-id")),
      name: itemElement.querySelector(".food-card_title").textContent.trim(),
      unit_price: parseInt(
        itemElement
          .querySelector(".food-card_price")
          .textContent.replace(/\D/g, "")
      ),
      image: itemElement
        .querySelector(".food-card_img img")
        .getAttribute("src")
        .split("/")
        .pop(),
    };
    shoppingCart.addItem(item);
  };
});

function addItemToCart(button) {
  const itemElement =
    button.closest(".blokkok") || button.closest(".product-info");

  if (!itemElement) {
    console.error("Nincs ilyen termék.");
    return;
  }

  const item = {
    id: parseInt(itemElement.getAttribute("data-id")),
    name: itemElement
      .querySelector(".food-card_title, .product-name")
      .textContent.trim(),
    unit_price: parseInt(
      itemElement
        .querySelector(".food-card_price, .product-price")
        .textContent.replace(/\D/g, "")
    ),
    image: itemElement
      .querySelector(".food-card_img img, .product-image")
      .getAttribute("src")
      .split("/")
      .pop(),
  };
  shoppingCart.addItem(item);
}

document.querySelectorAll(".food-card_cart").forEach((button) => {
  button.onclick = () => {
    addItemToCart(button);
  };
});

document.querySelectorAll(".add-to-cart").forEach((button) => {
  button.onclick = () => {
    addItemToCart(button);
  };
});

window.addEventListener("load", () => {
  shoppingCart.displayCartItems();
});

function formatPrice(price) {
  return price.toFixed(2);
}

function updateCartTotalPrice() {
  let cartItems = document.querySelectorAll(".cart-item");
  let total = 0;

  cartItems.forEach((item) => {
    let price = parseFloat(item.getAttribute("data-price"));
    total += price;
  });

  let cartTotalPrice = document.getElementById("cart-total");
  cartTotalPrice.innerHTML = `${formatPrice(total)} Ft`;
}

function updateCartPageTotalPrice() {
  let cartItems = document.querySelectorAll("#cart-items .row");
  let total = 0;

  cartItems.forEach((item) => {
    let price = parseFloat(item.getAttribute("data-price"));
    total += price;
  });

  let cartTotalPrice = document.getElementById("cart-total-price");
  cartTotalPrice.innerHTML = `${formatPrice(total)} Ft`;
}

function removeItemFromCart(e) {
  let item = e.target.closest(".cart-item");
  item.parentElement.removeChild(item);
  updateCartTotalPrice();
}

document.querySelector(".shopping-cart").addEventListener("click", (e) => {
  e.stopPropagation();
});

if (window.location.pathname === "/kosar") {
  shoppingCart.displayCartPageItems();
}

function displayCheckoutPage() {
  document.getElementById("main-content").style.display = "none";
  document.getElementById("checkout-content").style.display = "block";
  shoppingCart.displayCartPageItems();
}

document.querySelector(".tovabb").addEventListener("click", (e) => {
  e.preventDefault();
  window.location.href = "/kosar";
});

document.addEventListener("change", (e) => {
  if (e.target.matches(".item-quantity")) {
    const itemId = parseInt(e.target.getAttribute("data-id"));
    const newQuantity = parseInt(e.target.value);
    shoppingCart.updateItemQuantity(itemId, newQuantity);
  }
});

function updateItemQuantityOnClick(button, change) {
  const inputElement = button.parentNode.querySelector("input[type=number]");
  const itemId = parseInt(inputElement.getAttribute("data-id"));
  const newQuantity = parseInt(inputElement.value) + change;

  if (newQuantity >= 1 && newQuantity <= 15) {
    inputElement.value = newQuantity;
    shoppingCart.updateItemQuantity(itemId, newQuantity);
  }
}

function displayCheckoutItems() {
  const checkoutItemsContainer = document.querySelector(".list-group");
  let totalItemsPrice = 0;
  let itemsText = "";

  shoppingCart.items.forEach((item) => {
    totalItemsPrice += item.unit_price * item.quantity;
    itemsText += `${item.name}(${item.quantity} db), `;
  });

  itemsText = itemsText.slice(0, -2);

  checkoutItemsContainer.querySelector("li:nth-child(1) span").innerText =
    itemsText;
  checkoutItemsContainer.querySelector(
    "li:nth-child(2) span"
  ).innerText = `${totalItemsPrice} Ft`;
  checkoutItemsContainer.querySelector(
    "li:nth-child(4) span strong"
  ).innerText = `${totalItemsPrice} Ft`;
}

if (window.location.pathname === "/penztar") {
  displayCheckoutItems();
}

document.addEventListener("DOMContentLoaded", function () {
  const townDataElement = document.getElementById("townData");
  const townData = JSON.parse(townDataElement.value);

  const townNameElement = document.getElementById("town_name");
  if (townNameElement) {
    townNameElement.addEventListener("change", function () {
      const townName = this.value;
      const town = townData.find((t) => t.name === townName);
      if (town) {
        document.querySelector(".delivery-fee").innerText =
          town.deliveryFee + " Ft";
        document.querySelector("#postalCode").value = town.postalCode;
        updateTotalPrice(town.deliveryFee);
      }
    });
  } else {
    console.error("Hiba");
  }
});

function updateTotalPrice(deliveryFee) {
  const productsPrice = parseInt(
    document.querySelector("#productsPrice").innerText
  );
  const totalPrice = productsPrice + deliveryFee;
  document.querySelector("#totalPrice").innerText = totalPrice + " Ft";
  document.querySelector("#amount").value = totalPrice;
}

async function submitForm() {
  const formData = new FormData(document.getElementById("frm-order"));

  try {
    const response = await fetch("/checkout-save", {
      method: "POST",
      body: formData,
    });

    if (response.ok) {
      sessionStorage.clear();
      window.location.href = "/sikeres-rendeles";
    } else {
      console.error("Form submission failed:", response.statusText);
    }
  } catch (error) {
    console.error("Form submission failed:", error);
  }
}

window.addEventListener("storage", function (event) {
  if (event.key === null && event.newValue === null) {
    shoppingCart.displayCartItems();
  }
});

window.onload = function () {
  const form = document.getElementById("frm-order");
  const townSelect = document.getElementById("town_name");
  const addressInput = document.getElementById("address");
  const paymentSelect = document.querySelector(
    'select[name="payment_method_id"]'
  );
  const orderButton = document.getElementById("order-button");
  const productsPriceListItem =
    document.getElementById("productsPrice").parentNode;
  const errorMsgDiv = document.createElement("div");
  errorMsgDiv.classList.add("alert", "alert-danger", "mt-3", "d-none");
  errorMsgDiv.style.fontWeight = "bold";
  errorMsgDiv.style.fontSize = "1.5rem";
  errorMsgDiv.textContent = "Csak 1000 Ft felett lehet rendelni";
  productsPriceListItem.parentNode.insertBefore(
    errorMsgDiv,
    productsPriceListItem.nextSibling
  );

  function checkValidity() {
    const townValid = townSelect.value !== "Válasszon várost";
    const addressValid = addressInput.value.trim() !== "";
    const paymentValid = paymentSelect.value !== "";

    if (parseInt(productsPrice.textContent) < 1000) {
      errorMsgDiv.classList.remove("d-none");
    } else {
      errorMsgDiv.classList.add("d-none");
    }

    orderButton.disabled = !(
      townValid &&
      addressValid &&
      paymentValid &&
      parseInt(productsPrice.textContent) >= 1000
    );
  }

  checkValidity();

  townSelect.addEventListener("change", checkValidity);
  addressInput.addEventListener("input", checkValidity);
  paymentSelect.addEventListener("change", checkValidity);

  function order(event) {
    event.preventDefault();
    var order_items = "";
    shoppingCart.items.forEach((item) => {
      order_items +=
        item.id + "#" + item.quantity + "#" + item.unit_price + "|";
    });
    document.getElementById("order_items").value = order_items;
    document.getElementById("town_id").value =
      document.getElementById("postalCode").value;

    if (!orderButton.disabled) {
      submitForm();
    }
  }
  orderButton.onclick = order;
};
