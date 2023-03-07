// import external dependencies
import "devbridge-autocomplete/dist/jquery.autocomplete.min";
import "jquery";
import "lightgallery/dist/js/lightgallery-all.min";
import "lightslider/dist/js/lightslider.min";
import "masonry-layout/dist/masonry.pkgd";
import "slick-carousel/slick/slick.js";
// import 'select2/dist/js/select2.min';
// import 'select2/dist/js/select2.full.min';
import "aos/dist/aos";
import "imagesloaded/imagesloaded.pkgd.min";
import "isotope-layout/dist/isotope.pkgd.min";
import "progressbar.js/dist/progressbar";
import "slideout/dist/slideout";

// Import everything from autoload
import "./autoload/**/*";

// import local dependencies
import aboutUs from "./routes/about";
import common from "./routes/common";
import home from "./routes/home";
import Router from "./util/Router";

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
