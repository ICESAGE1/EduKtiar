const express = require('express');
const bodyParser = require('body-parser');

const app = express();
app.use(bodyParser.json());

// In-memory storage for user credentials
const users = [];

// Signup endpoint
app.post('/signup', (req, res) => {
    const { email, password } = req.body;
    // Check if user already exists
    const existingUser = users.find(user => user.email === email);
    if (existingUser) {
        return res.status(400).json({ message: 'Email already exists' });
    }
    // Create new user
    users.push({ email, password });
    res.status(201).json({ message: 'Signup successful' });
});

// Login endpoint
app.post('/login', (req, res) => {
    const { email, password } = req.body;
    // Find user by email
    const user = users.find(user => user.email === email);
    if (!user || user.password !== password) {
        return res.status(401).json({ message: 'Invalid email or password' });
    }
    // If user found and password matches, return success
    res.status(200).json({ message: 'Login successful' });
});

// Start the server
const PORT = process.env.PORT || 3000;
app.listen(PORT, () => console.log(`Server started on port ${PORT}`));
