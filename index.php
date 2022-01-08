<?php

require 'pharse-master/pharse.php';
require 'mysql.php';

$link = R::findOne('config', 'id = 1')->link;
$html = Pharse::file_get_dom($link);

    foreach($html('head title') as $element) {
        $channel_title = $element->getPlainText();
    }

    foreach($html('meta[property="og:image"]') as $element) {
        $channel_image = $element->getAttribute('content');

      if (substr($channel_image, 0, 9) == "undefined") 
      $channel_image = "images/discord.jpg";
    }    
  ?>

  <!DOCTYPE html>
  <html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title><?php echo $channel_title ?></title>
      <link rel="stylesheet" href="css/main.css">
  </head>
  <body>
  <div class="channel--block">
            <img src="<?php echo $channel_image ?>" class="channel__image">
            <div class="channel__title">
                <?php echo $channel_title ?>
            </div>
            <div class="channel__join">
                <a onclick="redirect()" class="channel__join--button button">Присоединиться</a>
            </div>
      </div>
  </body>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script>
      function redirect() {
        $.ajax({
    url: "addclick.php",
    type: "POST",
    data: {
      blogger: "<?php echo $_GET['blogger'] ?>"
    },
    cache: false,
    success: function (data) {  
        document.location.href="<?php echo $link ?>";
    }
});
}
  </script>
  </html>

