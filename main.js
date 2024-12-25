document.addEventListener("DOMContentLoaded", () => {
  // Selectors
  const selectors = {
    sessionsNumber: document.querySelector(".sessions-number span"),
    regularPrice: document.querySelector(".regular-price span"),
    yourPrice: document.querySelector(".your-price span"),
    discount: document.querySelector(".discount"),
    totalPrice: document.querySelector(".total-price span"),
    paymentAdvance: document.querySelector(".payment-advance input"),
    sessionsContainer: document.querySelector(".duration-container"),
    form: document.getElementById("order-form"),
    paymentMethods: document.querySelector(".payment-methods"),
  };

  const sessions = [
    { duration: "6 months", sessions: 8, price: 29.6, discount: 0.04 },
    { duration: "9 months", sessions: 12, price: 44.4, discount: 0.06 },
    { duration: "12 month", sessions: 16, price: 59.2, discount: 0.08 },
    { duration: "18 months", sessions: 24, price: 88.8, discount: 0.12 },
    { duration: "24 months", sessions: 32, price: 118.4, discount: 0.16 },
    { duration: "36 month", sessions: 48, price: 177.6, discount: 0.24 },
  ];

  const calculatePrice = (session, isAdvance) => {
    const baseDiscount = session.discount;
    const advanceDiscount = isAdvance ? 0.05 : 0;
    const totalDiscount = baseDiscount + advanceDiscount;
    const discountAmount = session.price * totalDiscount;
    const finalPrice = session.price - discountAmount;
    return { discountPercent: totalDiscount * 100, discountAmount, finalPrice };
  };

  const updatePrice = (index) => {
    const session = sessions[index];
    const isAdvance = selectors.paymentAdvance.checked;
    const { discountPercent, discountAmount, finalPrice } = calculatePrice(
      session,
      isAdvance
    );

    selectors.sessionsNumber.textContent = session.sessions;
    selectors.regularPrice.textContent = `${session.price.toFixed(2)}$`;
    selectors.yourPrice.textContent = `${finalPrice.toFixed(2)}$`;
    selectors.discount.innerHTML = `Discount ${discountPercent.toFixed()}% <span>-${discountAmount.toFixed(
      2
    )}$</span>`;
    selectors.totalPrice.textContent = `${finalPrice.toFixed(2)}$`;
  };

  const initializeSessions = () => {
    sessions.forEach((session, index) => {
      const sessionDuration = document.createElement("span");
      sessionDuration.classList.add("duration-item");
      if (index === 0) sessionDuration.classList.add("selected");
      sessionDuration.textContent = session.duration;
      sessionDuration.dataset.index = index;
      selectors.sessionsContainer.appendChild(sessionDuration);
    });

    const sessionItems = document.querySelectorAll(".duration-item");
    sessionItems.forEach((sessionItem) => {
      sessionItem.addEventListener("click", () => {
        sessionItems.forEach((item) => item.classList.remove("selected"));
        sessionItem.classList.add("selected");
        updatePrice(sessionItem.dataset.index);
      });
    });
  };

  const validateForm = () => {
    let isValid = true;

    const addAlert = (element, message) => {
      if (!element.parentElement.querySelector(".alert")) {
        const alert = document.createElement("p");
        alert.textContent = message;
        alert.style.color = "red";
        alert.style.fontSize = "12px";
        alert.style.marginTop = "5px";
        alert.style.textAlign = "start";
        alert.classList.add("alert");
        if (element.classList.contains("phone-number")) {
          element.parentElement.parentElement.appendChild(alert);
        } else {
          element.parentElement.appendChild(alert);
        }
      }
      isValid = false;
    };

    document.querySelectorAll(".alert").forEach((alert) => alert.remove());

    // Validate Phone Numbers
    ["stuPhone", "parePhone"].forEach((id) => {
      const field = document.getElementById(id);
      if (!/^\+?\d{10,15}$/.test(field.value)) {
        addAlert(
          field,
          "Please provide a valid phone number. Must be between 10-15 digits."
        );
      }
    });

    // Validate Email
    const emailField = document.getElementById("email");
    if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(emailField.value)) {
      addAlert(emailField, "Please provide a valid email address.");
    }

    // Validate Payment Method
    const paymentMethod = document.querySelector(
      'input[name="payment"]:checked'
    );
    if (!paymentMethod) {
      addAlert(selectors.paymentMethods, "Please select a payment method.");
    }

    // Validate Terms
    const termsCheckbox = document.getElementById("terms");
    if (!termsCheckbox.checked) {
      addAlert(
        termsCheckbox,
        "You must accept the Terms & Conditions before proceeding."
      );
    }

    return isValid;
  };

  selectors.form.addEventListener("submit", (event) => {
    event.preventDefault();

    if (!validateForm()) {
      return;
    }
    event.preventDefault();
    Swal.fire({
      position: "top-end",
      icon: "success",
      title: "Your order has been placed successfully!",
      showConfirmButton: false,
      timer: 2500,
    }).then(() => {
      selectors.form.reset();
      selectors.paymentAdvance.checked = false;
      updatePrice(0);
    });
  });

  selectors.paymentAdvance.addEventListener("change", () => {
    const selectedSession = document.querySelector(".duration-item.selected");
    updatePrice(selectedSession.dataset.index);
  });

  // Initialize
  initializeSessions();
  updatePrice(0);
});
