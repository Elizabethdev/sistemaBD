import axios from 'axios'

const client = axios.create({
  baseURL: 'http://sistemabd.local/api',
});

export default client;