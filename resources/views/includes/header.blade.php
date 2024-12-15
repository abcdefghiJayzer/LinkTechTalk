<head>
 <meta charset="UTF-8">
 <meta http-equiv="X-UA-Compatible" content="ie=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <!---CUSTOM CSS--->

 <!---ICONSCOUT CDN--->
 <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
 <!---GOOGLE FONTS (POPPINS)--->
 <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

 <script src="https://cdn.tiny.cloud/1/mqznv0kokmz15jmmy6sur693q64wc3lwspmwjktq8q6xotmh/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>

 <script>
  tinymce.init({
   selector: '#content, #updatecontent',
   plugins: 'code table lists',
   toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table',
   setup: function(editor) {
    editor.on('change', function() {
     editor.save();
    });
   }
  });
 </script>
</head>
