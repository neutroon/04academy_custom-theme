
README
=======

Description:
This JavaScript code handles the logic for a dynamic pricing and form validation system for a session-based order form. It includes features for:
- Dynamically updating pricing details based on session duration and discount.
- Form validation for phone numbers, email, payment methods, and terms acceptance.
- Interactive session selection with real-time updates to pricing and discounts.

Key Features:
1. **Dynamic Pricing:**
   - Updates session pricing and discount dynamically based on user selection.
   - Includes a 5% extra discount for advance payment.

2. **Form Validation:**
   - Validates phone numbers (10-15 digits).
   - Checks for a valid email format.
   - Ensures a payment method is selected.
   - Requires the user to accept the terms and conditions.

3. **Interactive Session Selection:**
   - Allows users to select session durations and highlights the selected option.
   - Automatically recalculates pricing based on the selected duration.

How to Use:
1. Include this script in your HTML file.
2. Ensure the DOM structure includes the required elements with corresponding class and ID names.
3. Customize the `sessions` array to update session details like duration, price, and discounts.
4. Ensure CSS styles are in place to visually differentiate selected items and display error messages.


