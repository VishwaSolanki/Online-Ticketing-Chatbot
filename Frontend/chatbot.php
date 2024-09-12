<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chatbot - Multi-Museum Ticketing System</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://www.gstatic.com/dialogflow-console/fast/messenger/bootstrap.js?v=1"></script>
    <df-messenger
      chat-icon="https:&#x2F;&#x2F;img.freepik.com&#x2F;free-vector&#x2F;graident-ai-robot-vectorart_78370-4114.jpg?size=338&ampext=jpg&ampga=GA1.1.2008272138.1725840000&ampsemt=ais_hybrid"
      intent="WELCOME"
      chat-title="ticketing-chatbot"
      agent-id="84f828c6-8f10-4fd6-9b9f-a61cd04b4d9e"
      language-code="en"
    ></df-messenger>
    <script src="https://www.gstatic.com/dialogflow-console/fast/messenger/bootstrap.js?v=1"></script>
    <df-messenger
      chat-icon="https:&#x2F;&#x2F;www.pikpng.com&#x2F;pngl&#x2F;m&#x2F;490-4906657_emma-mobile-screen-chatbot-image-transparent-clipart.png"
      intent="WELCOME"
      chat-title="ticketing-chatbot"
      agent-id="84f828c6-8f10-4fd6-9b9f-a61cd04b4d9e"
      language-code="en"
    ></df-messenger>
    <style>
        /* General styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #333;
            color: white;
            padding: 10px 0;
            text-align: center;
        }

        .navbar {
    list-style-type: none;
    padding: 0;
    display: flex;
    justify-content: center;
}

.navbar li {
    font-size: 18px;
    display: inline;
    transition: transform 0.6s ease, color 0.3s ease;
}

.navbar a {
    color: white;
    text-decoration: none;
    display: inline-block;
    padding: 0.5em 1em;
}

.navbar a:hover {
    color: #f4f4f4;
    transform: scale(1.1);
    background-color: #555;
    border-radius: 4px;
}


        main {
            padding: 20px;
        }

        footer {
            text-align: center;
            padding: 10px;
            background-color: #333;
            color: white;
        }

        /* Slider styles */
        .slider {
            position: relative;
            width: 100%;
            max-width: 800px;
            margin: 20px auto;
            overflow: hidden;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            background: white;
        }

        .slides {
            display: flex;
            transition: transform 0.5s ease-in-out;
        }

        .slides img {
            width: 100%;
            max-height: 100vh; /* Adjust this as needed */
            object-fit: contain; /* Ensures the image fits the container */
            border-radius: 10px 10px 0 0;
        }

        .slider-nav {
            position: absolute;
            width: 96%;
            display: flex;
            justify-content: space-between;
            top: 50%;
            transform: translateY(-50%);
        }

        .slider-nav button {
            background-color: rgba(255, 255, 255, 0.7);
            border: none;
            padding: 10px;
            cursor: pointer;
            border-radius: 50%;
            outline: none;
        }

        .info {
            padding: 10px;
            text-align: center;
            background: #333;
            color: white;
            border-radius: 0 0 10px 10px;
        }

        /* Museum list styles */
        /* Museum list styles */
/* Museum list styles */
#museum-container {
    margin: 20px auto;
    max-width: 800px;
    max-height: 500px; /* Adjust the height as needed */
    overflow-y: auto; /* Adds vertical scrollbar if content exceeds max-height */
    border: 1px solid #ddd; /* Optional: Adds a border around the container */
    padding: 10px; /* Optional: Adds padding inside the container */
    background-color: #fff; /* Optional: Sets a background color */
    scroll-behavior: smooth; /* Enables smooth scrolling */
}


.museum-item {
    color: black;
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 5px;
    padding: 10px;
    margin-bottom: 10px;
    cursor: pointer;
}

.museum-item:hover {
    background-color: #f4f4f4;
}


        .museum-details {
            color: black;
            display: none;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            max-width: 800px;
            margin: 20px auto;
        }

        .museum-details h2 {
            color : black;
            margin-top: 0;
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <ul class="navbar">
                <li id="home-nav" style="display:none;"><a href="index.html">Home</a></li>
                <li id="chatbot-nav"><a href="chatbot.php">Chatbot</a></li>
                <li id="logout-nav"><a href="logout.php">Logout</a></li>
                <li id="signup-nav" style="display:none;"><a href="signup.html">Sign Up</a></li>
                <li id="login-nav" style="display:none;"><a href="login.html">Login</a></li>
            </ul>
        </nav>
        <h1>Chatbot Assistance</h1>
    </header>

    <main>
        <section class="slider">
            <div class="slides">
                <img src="image/image1.png" alt="National Museum, New Delhi">
                <img src="image/image5.jpg" alt="Chhatrapati Shivaji Maharaj Vastu Sangrahalaya, Mumbai">
                <img src="image/image6.png" alt="Indian Museum, Kolkata">
            </div>
            <div class="slider-nav">
                <button onclick="prevSlide()">&#10094;</button>
                <button onclick="nextSlide()">&#10095;</button>
            </div>
            <div class="info">
                <p id="slide-info">National Museum, New Delhi - One of the largest museums in India, showcasing artifacts from ancient to modern times, including the Harappan Civilization, Buddhist art, and more.</p>
            </div>
        </section>

        <section id="museum-list">
            <h2>City and State Wise Museum List</h2>
            <div id="museum-container"></div>
            <div id="museum-details" class="museum-details">
                <h2 id="museum-name"></h2>
                <p id="museum-description"></p>
            </div>
        </section>

        <section id="chatbot" style="display:none;">
            <div id="chat-container">
                <div id="chat-log" style="display:none;"></div>
                <iframe width="100%" height="430" allow="microphone;" src="https://console.dialogflow.com/api-client/demo/embedded/84f828c6-8f10-4fd6-9b9f-a61cd04b4d9e"></iframe>
                <button id="send-btn" style="display:none;">Send</button>
            </div>
        </section>

    </main>

    <footer>
        <p>&copy; 2024 Multi-Museum Ticketing System</p>
    </footer>

    <script>
        let currentSlide = 0;
        const slides = document.querySelectorAll('.slides img');
        const slideInfo = document.getElementById('slide-info');
        const slideInfoTexts = [
            'National Museum, New Delhi - One of the largest museums in India, showcasing artifacts from ancient to modern times, including the Harappan Civilization, Buddhist art, and more.',
            'Chhatrapati Shivaji Maharaj Vastu Sangrahalaya, Mumbai - A premier cultural institution in Mumbai, featuring art, archaeology, and natural history exhibits, housed in a heritage building.',
            'Indian Museum, Kolkata - The largest and oldest museum in India, with extensive collections of artifacts ranging from ancient fossils, Mughal paintings, to Egyptian mummies.'
        ];

        function showSlide(index) {
            if (index >= slides.length) {
                currentSlide = 0;
            } else if (index < 0) {
                currentSlide = slides.length - 1;
            } else {
                currentSlide = index;
            }

            const offset = -currentSlide * 100;
            document.querySelector('.slides').style.transform = `translateX(${offset}%)`;
            slideInfo.textContent = slideInfoTexts[currentSlide];
        }

        function nextSlide() {
            showSlide(currentSlide + 1);
        }

        function prevSlide() {
            showSlide(currentSlide - 1);
        }

        // Auto-slide every 5 seconds
        setInterval(nextSlide, 5000);
// Fetch Indian museum data from JSON file
async function fetchMuseumData() {
    try {
        const response = await fetch('museum_dataset.json');
        const data = await response.json();
        return data;
    } catch (error) {
        console.error("Error fetching museum data:", error);
        return [];
    }
}

// Populate museum list
fetchMuseumData().then(museums => {
    const museumContainer = document.getElementById('museum-container');
    museumContainer.innerHTML = ''; // Clear previous content
    museums.forEach(museum => {
        const div = document.createElement('div');
        div.className = 'museum-item';
        div.textContent = `${museum.name} (${museum.city}, ${museum.state})`;
        div.addEventListener('click', () => {
        
        showMuseumDetails(museum.name)
        document.getElementById('museum-details').scrollIntoView({ behavior: 'smooth' });
        });
        
        museumContainer.appendChild(div);
    });
});

// Function to show museum details
function showMuseumDetails(museumName) {
    fetchMuseumInfo(museumName).then(museum => {
        document.getElementById('museum-name').textContent = museum.name;
        document.getElementById('museum-description').innerHTML = museum.info;
        document.getElementById('museum-details').style.display = 'block';
    });
}

// Function to fetch museum information from Wikimedia API
async function fetchMuseumInfo(museumName) {
    const apiUrl = `https://en.wikipedia.org/w/api.php?action=query&format=json&prop=extracts&titles=${encodeURIComponent(museumName)}&exintro=1&origin=*`;
    
    try {
        const response = await fetch(apiUrl);
        const data = await response.json();
        const page = Object.values(data.query.pages)[0];
        const content = page.extract || "No information available.";
        
        return {
            name: museumName,
            info: content
        };
    } catch (error) {
        console.error("Error fetching museum information:", error);
        return {
            name: museumName,
            info: "Error fetching information."
        };
    }
}

    </script>
    <script src="app.js"></script>
</body>
</html>
