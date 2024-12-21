<?php
// Example for registration and search features in a single PHP file.
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Business Information Application</title>

    <!-- Internal CSS -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        input, select, button {
            margin: 10px 0;
            padding: 10px;
            font-size: 16px;
            width: 100%;
        }

        button {
            cursor: pointer;
            background-color: #4CAF50;
            color: white;
            border: none;
        }

        button:hover {
            background-color: #45a049;
        }

        .search-container {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        #results {
            margin-top: 20px;
        }

        .business-item {
            background-color: white;
            padding: 15px;
            margin: 10px 0;
            border-radius: 5px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }

        /* Media Query for mobile devices */
        @media (max-width: 600px) {
            .container {
                width: 90%;
            }
        }
    </style>
</head>
<body>

    <!-- Registration Form -->
    <div class="container">
        <h2>Register</h2>
        <form action="src/register.php" method="POST" id="registerForm">
            <input type="text" name="username" placeholder="Username" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Register</button>
        </form>
    </div>

    <!-- Business Search Form -->
    <div class="search-container">
        <h2>Search Businesses</h2>
        <form id="searchForm">
            <select name="category" id="category">
                <option value="food">Food</option>
                <option value="healthcare">Healthcare</option>
                <option value="hotels">Hotels</option>
                <option value="education">Education</option>
            </select>

            <input type="text" name="location" id="location" placeholder="Location">
            <input type="number" name="min_price" id="min_price" placeholder="Min Price">
            <input type="number" name="max_price" id="max_price" placeholder="Max Price">
            <button type="submit">Search</button>
        </form>
        <div id="results"></div>
    </div>

    <!-- Internal JavaScript -->
    <script>
        // Handle the registration form submission
        document.getElementById('registerForm').addEventListener('submit', function (e) {
            e.preventDefault();
            
            let username = document.querySelector('input[name="username"]').value;
            let email = document.querySelector('input[name="email"]').value;
            let password = document.querySelector('input[name="password"]').value;

            // Perform simple validation before submission
            if (!username || !email || !password) {
                alert("All fields are required!");
                return;
            }

            // For simplicity, you can directly redirect or send data via AJAX
            alert("Registration successful!");

            // Submit the form (for real use case, an AJAX request would be more common)
            // This part should handle the form submission to the PHP backend
            // Example: Use fetch or XMLHttpRequest for AJAX request (not shown here for brevity)
        });

        // Handle search form submission
        document.getElementById('searchForm').addEventListener('submit', function (e) {
            e.preventDefault();

            let category = document.getElementById('category').value;
            let location = document.getElementById('location').value;
            let minPrice = document.getElementById('min_price').value;
            let maxPrice = document.getElementById('max_price').value;

            let queryString = `category=${category}&location=${location}&min_price=${minPrice}&max_price=${maxPrice}`;

            // Use AJAX to fetch results from the backend (PHP script)
            fetch(`src/search.php?${queryString}`)
                .then(response => response.json())
                .then(data => {
                    let resultsDiv = document.getElementById('results');
                    resultsDiv.innerHTML = '';

                    data.forEach(business => {
                        let businessElement = document.createElement('div');
                        businessElement.classList.add('business-item');
                        businessElement.innerHTML = `
                            <h3>${business.name}</h3>
                            <p>Category: ${business.category}</p>
                            <p>Location: ${business.location}</p>
                            <p>Price Range: $${business.min_price} - $${business.max_price}</p>
                            <p>Rating: ${business.rating}</p>
                        `;
                        resultsDiv.appendChild(businessElement);
                    });
                });
        });
    </script>

</body>
</html>
