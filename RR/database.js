const { Client } = require('pg');

const client = new Client({
  user: 'default',         
  host: "ep-divine-forest-a4gxgzpg-pooler.us-east-1.aws.neon.tech",
  database: 'verceldb',   
  password: '8PQgLa5TYjKi', 
  port: 5432,               
});

client.connect()
  .then(() => console.log('Connected to PostgreSQL'))
  .catch(err => console.error('Connection error', err.stack));

module.exports = client;