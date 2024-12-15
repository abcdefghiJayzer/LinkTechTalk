<script type="text/javascript" src="{{ asset(path: 'jquery.min.js') }}"></script>

<!-- Ajax script for search and categories -->
<script>
 $('#searchInput, #categoryFilter').on('input change', function() {
  const searchQuery = $('#searchInput').val();
  const categoryQuery = $('#categoryFilter').val();
  $.ajax({
   url: '{{ route("user.search") }}', // Update to use the named route for the user search
   type: 'GET',
   data: {
    search: searchQuery,
    category: categoryQuery,
   },
   success: function(response) {
    $('#postsContainer').html(response);
   }
  });
 });
</script>

<!-- Close Success/Error Message Script -->
<script>
 function closeFlashMessage() {
  const flashMessage = document.getElementById('flashMessage');
  if (flashMessage) {
   flashMessage.style.display = 'none';
  }
 }
</script>

<!-- copy to clipboard scripts -->
<script>
 function copyToClipboard() {
  // Get the current page URL
  const url = window.location.href;

  // Copy the URL to the clipboard
  navigator.clipboard.writeText(url).then(() => {
   alert("URL copied to clipboard!");
  }).catch(err => {
   alert("Failed to copy URL: ", err);
  });
 }
</script>