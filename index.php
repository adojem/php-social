<?php
   include('includes/header.php');
   include('includes/classes/User.php');
   include('includes/classes/Post.php');

   if (isset($_POST['post'])) {
       $post = new Post($con, $userLoggedIn);  
       $post->submitPost($_POST['post_text'], 'none');
   }

?>
      <div class="user_details column">
         <a href="<?php echo $userLoggedIn; ?>"><img src="<?php echo $user['profile_pic']; ?>"></a>

         <div class="user_details_left_right">
            <a href="<?php echo $userLoggedIn; ?>"><?php echo "{$user['first_name']} {$user['last_name']}"; ?></a>
            <br>
            <?php 
            echo "Posts: {$user['num_posts']}<br>";
            echo "Likes: {$user['num_likes']}";
            ?>
         </div>

      </div>

      <div class="main_column column">
            <form action="index.php" method="POST" class="post_form">
                  <textarea name="post_text" id="post_text" placeholder="Got something to say?"></textarea>
                  <input type="submit" name="post" id="post_button" value="Post">
                  <hr>
            </form>         

            <div class="posts_area">
                  
            </div>
            <img src="assets/images/icons/loading.gif" alt="spinner" id="loading">

      </div>

      <script>
         var userLoggedIn = '<?php echo $userLoggedIn; ?>';

         $(function () {
            $loading = $('#loading');
            $postsArea = $('.posts_area');

            $loading.show();

            // Original ajax request for loading first posts
            $.ajax({
               url: 'includes/handlers/ajax_load_posts.php',
               type: 'POST',
               data: {
                  page: 1,
                  userLoggedIn: userLoggedIn,
               },
               cache: false,
               success: function (data) {
                  $loading.hide();
                  $postsArea.html(data);
               }
            });

            $(window).scroll(function () {
               var height = $postsArea.height();
               var scroll_top = $(this).scrollTop();
               var page = $postsArea.find('.nextPage').val();
               var noMorePosts = $postsArea.find('.noMorePosts').val();
            
               if ((document.body.scrollHeight === Math.floor(document.documentElement.scrollTop)+window.innerHeight) && noMorePosts === 'false') {
                  $loading.show();

                  var ajaxReq = $.ajax({
                     url: 'includes/handlers/ajax_load_posts.php',
                     type: 'POST',
                     data: {
                        page: page,
                        userLoggedIn: userLoggedIn,
                     },
                     cache: false,
                     success: function (response) {
                        $postsArea.find('.nextPage').remove();
                        $postsArea.find('.noMorePosts').remove();

                        $loading.hide();
                        $postsArea.append(response);
                     }
                  });
               } // end if

               return false;
            });
         });
      </script>

   </div><!-- .wrapper  ?>
</body>
</html>