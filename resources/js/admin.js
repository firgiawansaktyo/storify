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

window.albumStoreRoute = "{{ route('albums.store') }}";
window.albumUpdateRoute = "{{ route('albums.update', ['album' => '__ALBUM_ID__']) }}";
window.bankStoreRoute = "{{ route('banks.store') }}";
window.bankUpdateRoute = "{{ route('banks.update', ['bank' => '__BANK_ID__']) }}";
window.coupleStoreRoute = "{{ route('couples.store') }}";
window.coupleUpdateRoute = "{{ route('couples.update', ['couple' => '__COUPLE_ID__']) }}";
window.giftStoreRoute = "{{ route('gifts.store') }}";
window.giftUpdateRoute = "{{ route('gifts.update', ['gift' => '__GIFT_ID__']) }}";
window.throwbackStoreRoute = "{{ route('throwbacks.store') }}";
window.throwbackUpdateRoute = "{{ route('throwbacks.update', ['throwback' => '__THROWBACK_ID__']) }}";
window.timelineStoreRoute = "{{ route('timelines.store') }}";
window.timelineUpdateRoute = "{{ route('timelines.update', ['timeline' => '__TIMELINE_ID__']) }}";
window.weddingStoreRoute = "{{ route('weddings.store') }}";
window.weddingUpdateRoute = "{{ route('weddings.update', ['wedding' => '__WEDDING_ID__']) }}";