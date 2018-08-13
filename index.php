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
            $postArea = $('.post_area');

            $loading.show();

            // Original ajax request for loading first posts
            $.ajax({
               url: 'icludes/handlers/ajax_load_posts_php',
               type: 'POST',
               data: 'page=1&userLoggedIn=' + userLoggedIn,
               cache: false,

               success: function () {
                  $loading.hide();
                  $postArea.html(data);
               }
            });

            $(window).scroll(function () {
               var height = $postArea.height();
               var scroll_top = $(this).scrollTop();
               var page = $postArea.find('.nextPage').val();
               var noMorePosts = $postArea.find('.noMorePosts').val();

               if ((document.body.scrollHeight === document.body.scrollTop + window.innerHeight) && noMorePosts == 'false') {
                  $loading.show();

                  $.ajax({
                     url: 'icludes/handlers/ajax_load_posts_php',
                     type: 'POST',
                     data: `page=${page}&userLoggedIn=${userLoggedIn}`,
                     cache: false,

                     success: function (res) {
                        $postArea.find('.nextPage').remove();
                        $postArea.find('.noMorePosts').remove();

                        $loading.hide();
                        $postArea.append(res);
                     }
                  });
               }
            });
         });
      </script>

   </div><!-- .wrapper  ?>
</body>
</html>