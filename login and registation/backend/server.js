// server.js
const express = require('express');
const mongoose = require('mongoose');
const dotenv = require('dotenv');
const connectDB = require('./config/db'); // Correct import of connectDB function

// Initialize the app
const app = express();

// Load environment variables
dotenv.config();

// Log the MONGO_URI to check if it's being loaded
console.log('Mongo URI:', process.env.MONGO_URI);

// Connect to MongoDB
connectDB(); // Call the function to connect to the database

// Basic route
app.get('/', (req, res) => {
    res.send('Hello, World!');
});

// Start the server
const PORT = process.env.PORT || 5000;
app.listen(PORT, () => {
    console.log(`Server running on http://localhost:${PORT}`);
});
