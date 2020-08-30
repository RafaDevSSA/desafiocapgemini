import axios from 'axios';

export const API = axios.create({
  baseURL: 'http://localhost/cap/api/public/api/',
  headers: {
    'Accept': 'application/json',
    'Content-Type': 'text/plain',
    'Access-Control-Allow-Origin': '*',
  }
});
