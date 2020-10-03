import axios from 'axios'

const client = axios.create({
  baseURL: 'http://localhost/sistemaBD/public/api',
});

export default client;