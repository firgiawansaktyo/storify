import 'popper.js';
import 'bootstrap';
import 'jquery.easing';
import './sb-admin-2';
import './albumCreate';
import './albumUpdate';
import './bankCreate';
import './bankUpdate';
import './coupleCreate';
import './coupleUpdate';
import './giftCreate';
import './giftUpdate';
import './throwbackCreate';
import './throwbackUpdate';
import './timelineCreate';
import './timelineUpdate';
import './weddingCreate';
import './weddingUpdate';

import axios from 'axios';
window.axios = axios;

axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';