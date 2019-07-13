// import external dependencies
import 'jquery';
import 'slick-carousel/slick/slick.js';
import 'devbridge-autocomplete/dist/jquery.autocomplete.min';
import 'masonry-layout/dist/masonry.pkgd';
import 'lightgallery/dist/js/lightgallery-all.min';
import 'lightslider/dist/js/lightslider.min';
import 'jquery-ui_1.12/jquery-ui';
import 'select2/dist/js/select2.min';
import 'select2/dist/js/select2.full.min';

// Import everything from autoload
import './autoload/**/*'

// import local dependencies
import Router from './util/Router';
import common from './routes/common';
import home from './routes/home';
import aboutUs from './routes/about';

/** Populate Router instance with DOM routes */
const routes = new Router({
  // All pages
  common,
  // Home page
  home,
  // About Us page, note the change from about-us to aboutUs.
  aboutUs,
});

// Load Events
jQuery(document).ready(() => routes.loadEvents());
