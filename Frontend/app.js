document.getElementById('send-btn').addEventListener('click', function() {
    const userInput = document.getElementById('user-input').value;
    if (userInput.trim() === '') return;

    // Display the user message
    const chatLog = document.getElementById('chat-log');
    chatLog.innerHTML += `<div class="user-message">${userInput}</div>`;

   // Simulate bot response
    const botResponse = "This is a simulated response.";
    chatLog.innerHTML += `<div class="bot-message">${botResponse}</div>`;
});

   // Send the message to the Flask backend
//    fetch('/get_response', {
//     method: 'POST',
//     headers: {
//         'Content-Type': 'application/json',
//     },
//     body: JSON.stringify({ message: userInput }),
// })
// .then(response => response.json())
// .then(data => {
//     // Display the bot response
//     const botResponse = data.response;
//     chatLog.innerHTML += `<div class="bot-message">${botResponse}</div>`;

//     // Clear input
//     document.getElementById('user-input').value = '';
// })
// .catch(error => console.error('Error:', error));
// });

document.getElementById('proceed-to-payment').addEventListener('click', function() {
    // Hide ticket selection and show payment form
    
    document.getElementById('ticket-selection').style.display = 'none';
    document.getElementById('payment-form').style.display = 'block';
});

document.getElementById('museum-name').addEventListener('change', function() {
    // Display ticket selection form when a museum is selected
    document.getElementById('ticket-selection').style.display = 'block';
});



document.addEventListener('DOMContentLoaded', function() {
    updateNavbar();
});

function updateNavbar() {
    const loggedIn = localStorage.getItem('loggedIn') === 'true';

    const homeNav = document.getElementById('home-nav');
    const chatbotNav = document.getElementById('chatbot-nav');
    const logoutNav = document.getElementById('logout-nav');
    const signupNav = document.getElementById('signup-nav');
    const loginNav = document.getElementById('login-nav');

    if (loggedIn) {
        homeNav.style.display = 'none';
        chatbotNav.style.display = 'block';
        logoutNav.style.display = 'block';
        signupNav.style.display = 'none';
        loginNav.style.display = 'none';
    } else {
        homeNav.style.display = 'block';
        chatbotNav.style.display = 'none';
        logoutNav.style.display = 'none';
        signupNav.style.display = 'block';
        loginNav.style.display = 'block';
    }
}

function logout() {
    localStorage.removeItem('loggedIn');
    updateNavbar();
}






// Stripe payment processing logic
var stripe = Stripe('your-publishable-key-here');
var elements = stripe.elements();
var cardElement = elements.create('card');
cardElement.mount('#card-element');

document.getElementById('payment-form').addEventListener('submit', function(event) {
    event.preventDefault();

    stripe.createPaymentMethod({
        type: 'card',
        card: cardElement,
    }).then(function(result) {
        if (result.error) {
            document.getElementById('payment-result').textContent = result.error.message;
        } else {
            // Handle payment processing with your backend
            fetch('/create-payment-intent', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    payment_method: result.paymentMethod.id
                }),
            }).then(function(result) {
                return result.json();
            }).then(function(data) {
                if (data.error) {
                    document.getElementById('payment-result').textContent = data.error;
                } else {
                    document.getElementById('payment-result').textContent = 'Payment successful!';
                }
            });
        }
    });
});   