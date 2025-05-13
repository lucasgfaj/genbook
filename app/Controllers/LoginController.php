<?php

namespace App\Controllers;

class LoginController
{
    public function showLoginForm()
    {
        // Display the login form
        echo '<form method="POST" action="/login">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
                <button type="submit">Login</button>
              </form>';
    }

    public function handleLogin()
    {
        // Handle login logic
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';

            // Dummy authentication logic
            if ($username === 'admin' && $password === 'password') {
                echo 'Login successful!';
                // Redirect or start session here
            } else {
                echo 'Invalid credentials. Please try again.';
            }
        } else {
            echo 'Invalid request method.';
        }
    }
}