import './bootstrap';
import Alpine from 'alpinejs';
import productSearch from './productSearch';

Alpine.data('productSearch', productSearch);
window.Alpine = Alpine;
Alpine.start();
