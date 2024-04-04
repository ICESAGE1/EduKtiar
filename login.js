// Example of storing user credentials in-memory
const users = [
    { email: 'user1@example.com', password: 'password1' },
    { email: 'user2@example.com', password: 'password2' }
];

// Login endpoint
app.post('/login', (req, res) => {
    const { email, password } = req.body;
    // Check if user exists in the in-memory store
    const user = users.find(u => u.email === email && u.password === password);
    if (user) {
        // If user found, return success
        res.status(200).json({ message: 'Login successful' });
    } else {
        // If user not found, return error
        res.status(401).json({ message: 'Invalid email or password' });
    }
});
