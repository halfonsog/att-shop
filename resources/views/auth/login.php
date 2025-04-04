<html>
<body>
    <h1>Acceso seguro</h1>
    
    <?php if (session('error')): ?>
        <div style="color:red"><?= session('error') ?></div>
    <?php endif; ?>
    
    <form action="/login" method="POST">
        <?= csrf_field() ?>
       <label>Email:</label>
        <input type="email" name="usr" required>
        
        <label>Contraseña:</label>
        <input type="password" name="psw" required>
        
        <button type="submit">Login</button>
    </form>
    
    <p>Aún no tine una cuenta? <a href="/register">Registrarse</a></p>
    <p>Olvidó su contraseña? <a href="javascript:chkPswHint()">Ver recordatorio</a></p>
</body>
<script>
    function chkPswHint(){
        //check for usr
        //send ajax request to the sever to get user[psw_hint]
        alert('mostrar recordatorio');
    }
</script>
</html>
