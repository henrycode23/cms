
    </div>
    <!-- /#wrapper -->

    <script type="text/javascript" src="js/scripts.js"></script>

    <!-- jQuery -->
    <script type="text/javascript" src="js/jquery.js"></script>

    <!-- <script
  src="https://code.jquery.com/jquery-1.12.4.js"
  integrity="sha256-Qw82+bXyGq6MydymqBxNPYTaUXXq7c8v3CwiYwLLNXU="
  crossorigin="anonymous"></script> -->

  <!-- <script
  src="https://code.jquery.com/jquery-2.2.4.js"
  integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI="
  crossorigin="anonymous"></script> -->

    <!-- <script
  src="https://code.jquery.com/jquery-3.3.1.js"
  integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
  crossorigin="anonymous"></script> -->

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <script>
    // SELECT ALL CHECKBOXES
    $(document).ready(function(){
      $('#selectAllBoxes').click(function(event){
          if(this.checked){
              $('.checkboxes').each(function(){
                  this.checked = true;
              });
          } else{
              $('.checkboxes').each(function(){
                  this.checked = false;
              });
          }
      });
    });


    // LOADER ANIMATION
    var div_box = "<div id='load-screen'><div id='loading'></div></div>";
    $('body').prepend(div_box);
    $('#load-screen').delay(500).fadeOut(600, function(){
        $(this).remove();
    });


    // USERS ONLINE COUNT AJAX
    function loadUsersOnline(){
        $.get('functions.php?onlineusers=result', function(data){
            $('.usersonline').text(data);
        });
    }
    setInterval(function(){
        loadUsersOnline();
    },500);

    </script>
    
</body>

</html>