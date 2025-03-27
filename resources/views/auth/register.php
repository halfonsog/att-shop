<html>
<body>
    <h1>Register</h1>
    
    <form action="/register" method="POST">
        <label>Nombre completo:</label>
        <input type="text" name="name" required>
        
        <label>Usuario (email):</label>
        <input type="email" name="usr" required>
        
        <label>Contraseña:</label>
        <input type="password" name="psw" required minlength="6">
        
        <label>Repetir contraseña:</label>
        <input type="password" id="psw2" required minlength="6">

        <label>Recordatorio:</label>
        <input type="text" name="psw_hint" required>
        
        <label>Pais de residencia:</label>
        <select name="country">
        <?php
 use Illuminate\Support\Facades\DB; 
 $Items = DB::select("SELECT * FROM countries"); 
 foreach ($items as $item): ?>
            <option value="<?=$item->id?>"><?=$item->name?></option>
 <?php endforeach; ?>
            <input type="hidden" name="typ" value="customer">
        <button type="submit">Register</button>
    </form>
</body>
</html>
