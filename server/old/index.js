//express setup
const express = require('express');
const app = express();
const port = 3000;

//mariadb setup
const mariadb = require('mariadb');
const pool = mariadb.createPool({
    host: 'localhost',
    database: process.env.DATABASE,
});

//session API setup
import { generateSessionToken, createSession, validateSessionToken } from './session.js';

//functions for database queries
async function validatePassword(email, password) {
    let conn;
    try {
        conn = await pool.getConnection();
        const user = await conn.query('SELECT password FROM user WHERE email="?"', [email]);
        console.log(user); 
        //TODO: check that the user's hashed passowrd matches the one in the database
        //      return true if matches, false otherwise
        return false;
    } catch (err) {
        throw err;
    } finally {
        if (conn) conn.end();
    }
}

//routes for database queries
app.post('/login', (req, res) => {
    //check whether the user's credentials are valid
    if (validatePassword(req.body.email, req.body.password)) {
        console.log('success!');
        //TODO: if the login is successful, generate a session token and provide it to the client
    } else {
        res.send('invalid login!');
    }
});

