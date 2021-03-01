<?php

add_filter('webpc_uploads_root', function($path) {
  return '/Users/koko/Sites/gf/photos';
});

add_filter('webpc_uploads_path', function($path) {
  return 'content/uploads';
});

add_filter('webpc_uploads_webp', function($path) {
  return 'content/uploads-webp';
});
