<?php
require 'mysql.php';

$bloggers = R::find('bloggers');
  ?>

  <!DOCTYPE html>
  <html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Панель админа</title>
      <link rel="stylesheet" href="css/main.css">
  </head>
  <body>
            <div class="channel__title">SLDVS</div>
                <br>
                <br>
                <div class="container">
                <div class="invites">
                    <?php
                    
                    foreach ($bloggers
                     as $blogger) {
                         echo '
                         <div class="invite--info" data-blogger="'. $blogger->id .'">
                         <span class="invite--info__link"><a href="http://'. $_SERVER['HTTP_HOST'] .'/'. $blogger->nickname .'">'. $_SERVER['HTTP_HOST'] .'/'. $blogger->nickname .'</a></span> 
                         <span class="invite--info__clicks">'. $blogger->clicks .' нажатий</span> 
                         <span class="invite--info__remove"><a onclick="removeBlogger('. $blogger->id .')" class="invite--info__button">Удалить</a></span> 
                     </div>
                         ';
                     }

                    ?>
                     
                </div>
            <div class="tools">
            <a onclick="return newBlogger()" class="tools__button button">Добавить блогера</a>
            <a onclick="return changeLinks()" class="tools__button button">Изменить ссылки</a>
            </div>
      </div>

  </body>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script>
      function newBlogger() {
       $('body').append(`
       <div class="modal">
  <div class="modal__container">
      <div class="modal__title">Создание новой ссылки</div>
      <div class="modal__content">
          <input type="text" class="modal__input" id="bloger" placeholder="Введите никнейм блогера">
          <a onclick="addBlogger()" class="modal__button button">Создать</a>
      </div>
  </div>
  </div> 
       `);
       document.querySelector('.modal').addEventListener('click', function(event) {
           if (event.target.classList.contains('modal')) {
                document.querySelector('.modal').remove();
           }
       });
      }

      function changeLinks() {
       $('body').append(`
       <div class="modal">
  <div class="modal__container">
      <div class="modal__title">Изменить ссылки</div>
      <div class="modal__content">
          <input type="text" class="modal__input" id="link" placeholder="https://discord.gg/xxxxxx">
          <a onclick="changeLink()" class="modal__button button">Изменить</a>
      </div>
  </div>
  </div> 
       `);
       document.querySelector('.modal').addEventListener('click', function(event) {
           if (event.target.classList.contains('modal')) {
                document.querySelector('.modal').remove();
           }
       });
      }

      function addBlogger() {
        $.ajax({
    url: "addblogger.php",
    type: "POST",
    data: {
      blogger: $('#bloger').val()
    },
    cache: false,
    success: function (id) {
 
        $('.invites').append(`
        <div class="invite--info" data-blogger="` +id+ `">
                            <span class="invite--info__link"><a href="http://<?php echo $_SERVER['HTTP_HOST'] ?>/`+ $('#bloger').val() +`"><?php echo $_SERVER['HTTP_HOST'] ?>/`+ $('#bloger').val() +`</a></span> 
                            <span class="invite--info__clicks">0 нажатий</span> 
                            <a onclick="removeBlogger(` + id + `)" class="invite--info__remove">Удалить</a> 
                        </div>
        `);
        document.querySelector('.modal').remove();
      }
    });
}

function removeBlogger(id) {
        $.ajax({
    url: "removeblogger.php",
    type: "POST",
    data: {
      blogger: id
    },
    cache: false,
    success: function () {    
        document.querySelector('[data-blogger="'+ id +'"]').remove();   
      }
    });
}

function changeLink() {
        $.ajax({
    url: "changelink.php",
    type: "POST",
    data: {
      link: $('#link').val()
    },
    cache: false,
    success: function () {    
    
    document.querySelector('.modal').remove();      

}
    });
}

  </script>
  </html>

