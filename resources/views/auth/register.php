<html>
<body>
    <h1>Register</h1>
    
    <form action="/register" method="POST">
        <label>Name:</label>
        <input type="text" name="name" required>
        
        <label>Email:</label>
        <input type="email" name="email" required>
        
        <label>Password:</label>
        <input type="password" name="password" required minlength="6">
        
        <label>Account Type:</label>
        <select name="type" required>
            <option value="customer">Customer</option>
            <option value="supplier">Supplier</option>
        </select>
        
        <button type="submit">Register</button>
    </form>
</body>
</html>
