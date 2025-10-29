import 'popper.js';
import 'bootstrap';
import 'jquery.easing';
import './sb-admin-2';

import axios from 'axios';
window.axios = axios;

axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';