// This script can be used to redirect the user to a success or failure page based on the payment status.
// You should customize it to suit your needs.

// Get the payment status from the query parameters or your API response
const queryParams = new URLSearchParams(window.location.search);
const paymentStatus = queryParams.get('status'); // Replace 'status' with the actual query parameter name

// Define the URLs for success and failure pages
const successUrl = 'https://8e18.in/success'; // Replace with your success page URL
const failureUrl = 'https://be18/in/failure'; // Replace with your failure page URL

// Redirect the user based on the payment status
if (paymentStatus === 'success') {
  window.location.href = successUrl;
} else {
  window.location.href = failureUrl;
}
