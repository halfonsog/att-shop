<html>
<body>
    <h1>Login</h1>
    
    <?php if (session('error')): ?>
        <div style="color:red"><?= session('error') ?></div>
    <?php endif; ?>
    
    <form action="/login" method="POST">
        <label>Email:</label>
        <input type="email" name="email" required>
        
        <label>Password:</label>
        <input type="password" name="password" required>
        
        <button type="submit">Login</button>
    </form>
    
    <p>Don't have an account? <a href="/register">Register</a></p>
</body>
</html>
