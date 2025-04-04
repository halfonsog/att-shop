<?php
//...
//aqui todo lo q lleve el dashboard del customer 

//Esto es para el boton de logout ?>
<button onclick="handleLogout()">Logout</button>

<script>
  async function handleLogout() {
    try {
      const response = await fetch('<?= route("logout") ?>', {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': token, // Laravel CSRF protection
          'Accept': 'application/json',
        },
      });

      if (response.ok) {
        window.location.href = '/'; // Redirect to welcome page
      } else {
        console.error('Logout failed');
      }
    } catch (error) {
      console.error('Error:', error);
    }
  }
</script>