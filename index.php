<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Custom Theme</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.min.css">
    <?php wp_head(); ?>
</head>

<body>
    <main>
        <form id="order-form">
            <section class="form-section">
                <h2>Registration & Booking at GoStudent</h2>
                <p>The leading platform for online tutoring</p>

                <div class="field-container">
                    <label for="stuPhone">Login Phone Number <span>(preferably the student's)</span></label>
                    <input type="tel" id="stuPhone" class="phone-number" name="stuPhone" maxlength="15">
                </div>

                <div class="field-container">
                    <label for="parePhone">Contact Phone Number <span>(preferably the parent's)</span></label>
                    <input type="tel" id="parePhone" class="phone-number" name="parePhone" maxlength="15">
                </div>

                <div class="field-container">
                    <label for="email">Contact Email Address <span>(preferably the parent's)</span></label>
                    <input type="email" id="email" name="email">
                </div>

                <div class="field-container">
                    <label for="name">Contact Name</label>
                    <input type="text" id="name" name="name" maxlength="50">
                </div>

                <div class="field-container">
                    <label for="address">Billing Address</label>
                    <div class="billing-address">
                        <div class="address">
                            <input type="text" id="address" name="address" placeholder="Address" maxlength="100"
                                required>
                            <input type="text" id="Nr" name="nr" placeholder="Nr" maxlength="10" required>
                        </div>
                        <div class="city-country">
                            <input type="text" id="postalCode" name="postalCode" placeholder="Postal Code"
                                maxlength="10" required>
                            <input type="text" id="city" name="city" placeholder="City" maxlength="50" required>
                            <select name="country" id="country">
                                <option value="" disabled selected hidden>Country</option>
                                <option value="Eg">Egypt</option>
                                <option value="Sa">Saudi Arabia</option>
                                <option value="Usa">United States</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="field-container">
                    <label for="sessions">Monthly Sessions</label>
                    <select name="sessions" id="sessions">
                        <option value="8">8 Sessions</option>
                        <option value="12">12 Sessions</option>
                        <option value="16">16 Sessions</option>
                    </select>
                </div>

                <div class="field-container">
                    <label>Select Payment Method</label>
                    <div class="payment-methods">
                        <div class="payment-method">
                            <label for="sepa">
                                <input type="radio" id="sepa" name="payment" value="sepa">
                                SEPA</label>
                        </div>
                        <div class="payment-method">
                            <label for="creditCard">
                                <input type="radio" id="creditCard" name="payment" value="creditCard"> Credit Card
                                <input type="text" id="cardHolder" name="CardHolder" placeholder="Card Holder"
                                    maxlength="50">
                                <input type="text" id="cardNumber" name="cardNumber" placeholder="Card Number"
                                    pattern="\d{16}" title="Enter a 16-digit card number">
                            </label>
                        </div>
                    </div>
                </div>

                <span>100% secure payment. All data encrypted.</span>
            </section>

            <section class="order-summary">
                <h3>ORDER OVERVIEW</h3>

                <div class="duration-container">

                </div>

                <div class="payment-advance">
                    <div class="toggle-container">
                        <label class="switch">
                            <input type="checkbox" id="discount">
                            <span class="slider round"></span>
                        </label>
                        <label for="discount" class="toggle-label">
                            <span>Pay in advance</span> - Extra 5% DISCOUNT
                        </label>
                    </div>
                </div>

                <div class="order-overview">
                    <p class="sessions-number">Number of sessions p.m. <span>8</span></p>
                    <p class="regular-price">Regular price <span>29.60$</span></p>
                    <p class="your-price">Your price <span>28.42$</span></p>
                    <p class="discount">Discount 4% <span>-1.18$</span></p>

                    <hr />

                    <p>Setup fee <span>0.00$</span></p>
                    <p class="total-price">Total p.m. <span>30.78$</span></p>
                </div>

                <div class="terms">
                    <input type="checkbox" name="terms" id="terms">
                    <label for="terms">
                        I accept the <a href="#">Terms & Conditions</a> and understand my <a href="#">right of
                            withdrawal</a> as well as the circumstances that lead to repeal of the same.
                    </label>
                </div>


                <input type="submit" value="Order Now" />

                <p class="satisfaction">95% satisfaction rate!</p>
            </section>
        </form>
    </main>

    <?php wp_footer(); ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
    <script>
    document.addEventListener("DOMContentLoaded", () => {
        const phoneInputs = document.querySelectorAll(".phone-number");
        phoneInputs.forEach((input) => {
            input.style.paddingLeft = '48px'
        })

        phoneInputs.forEach((phoneInput) => {
            intlTelInput(phoneInput, {
                initialCountry: "auto",
                geoIpLookup: (callback) => {
                    fetch("https://ipinfo.io/json?token=your_token")
                        .then((resp) => resp.json())
                        .then((data) => callback(data.country))
                        .catch(() => callback("eg"));
                },
                utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
            });
            phoneInput.parentElement.style.width = '100%';
            const itiDropdown = document.querySelector('.iti--container');


        });
    });
    </script>
</body>

</html>