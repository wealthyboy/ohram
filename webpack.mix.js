const mix = require('laravel-mix');



mix.js('resources/js/app.js', 'public/js')
.sass('resources/sass/app.scss', 'public/css');

mix.styles([
   'resources/css/admin/bootstrap.min.css',
   'resources/css/admin/dashboard.css',
   'public/backend/css/custom.css',
   'public/backend/css/slick.css'
], 'public/css/admin.css');

mix.styles([
  'public/css/bootstrap.css',
  'public/css/theme.css',
  'public/css/skins/skin-default.css',
  'public/css/custom.css',
], 'public/css/all.css');



mix.js([
  'resources/js/checkout.js',
],
  'public/js/checkout.js'
);




mix.scripts([
  'public/backend/js/bootstrap.min.js',
  'public/backend/js/material.min.js',
  'public/backend/js/jquery.validate.min.js',
  'public/backend/js/material-dashboard-v=1.3.0.js',
  'public/backend/js/jquery.bootstrap-wizard.js',
  'public/backend/js/scripts.js',
],
  'public/js/dashboard.js'
);












   