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





//============================================================================================================

// tinymce.init({
//   selector: 'textarea',
//   width: 980,
//   height: 400,
//   plugins: [
//     'advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker',
//     'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
//     'save table contextmenu directionality emoticons template paste textcolor'
//   ],
//   content_css: 'css/content.css',
//   toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons'
// });


// $(document).ready(function(){
//   $('#selectAllBoxes').click(function(event){
//     if(this.checked){
//       $('.checkboxes').each(function(){
//         this.checked = true;
//       });
//     } else {
//       $('.checkboxes').each(function(){
//         this.checked = false;
//       });

//     }
//   });
// });

// document.getElementById('button').addEventListener('click', loadTest);

// function loadTest(){
//   document.getElementById('text').innerHTML = "Yes! It's working.";
// }

