<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8" />
        <title>{{ Config('app.name') }} </title>
        <meta name="author" content="AchuWorld">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="description" content="{{ isset($page_meta_description) ? $page_meta_description : '' }}">
        <meta name="keywords" content="{{ isset($settings->meta_tag_keywords) ? $settings->meta_tag_keywords : '' }}" />
        <meta name="generator" content="Social Likes: http://social-likes.js.org/">

          <!-- Favicone Icon -->
        <link rel="shortcut icon" type="image/x-icon" href="/img/favicon.ico">
        <link rel="icon" href="/img/favicon.ico" type="image/x-icon">
        <link rel="icon" type="image/png" href="/img/favicon-96x96.png">
        <link rel="apple-touch-icon" href="/img/favicon-96x96.png">

        

        <!-- CSS -->
        <link href="/css/bootstrap.css" rel="stylesheet" type="text/css" />
        <link href="/css/theme.css" rel="stylesheet" type="text/css" />
        <link href="/css/skins/skin-default.css" rel="stylesheet" type="text/css" />
        <link href="/css/plugins.css" rel="stylesheet" type="text/css" />

</head>
<style>

  /* Set height to 100% for body and html to enable the background image to cover the whole page: */
body, html {
  height: 100%
}

.bgimg {
  /* Background image */
  background-image: url('https://www.theluxurysale.com/uploads/G2CpgxwCbF8GewHZQ7MDp2oYDhr1WU08SppxPdxK.jpeg');
  /* Full-screen */
  height: 100%;
  /* Center the background image */
  background-position: center;
  /* Scale and zoom in the image */
  background-size: cover;
  /* Add position: relative to enable absolutely positioned elements inside the image (place text) */
  position: relative;
  /* Add a white text color to all elements inside the .bgimg container */
  color: white;
  /* Add a font */
  font-family: "Courier New", Courier, monospace;
  /* Set the font-size to 25 pixels */
  font-size: 25px;
}

/* Position text in the top-left corner */
.topleft {
  position: absolute;
  top: 0;
  left: 16px;
}

/* Position text in the bottom-left corner */
.bottomleft {
  position: absolute;
  bottom: 0;
  left: 16px;
}

/* Position text in the middle */
.middle {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  text-align: center;
}

/* Style the <hr> element */
hr {
  margin: auto;
  width: 40%;
} 

</style>


<body>


<div class="bgimg">
  <div class="topleft">
    <p></p>
  </div>
  <div class="middle">
    <h1></h1>
    <hr>
    <p></p>
  </div>
  <div class="bottomleft">
    <p></p>
  </div>
</div> 
  

</body>
</html>