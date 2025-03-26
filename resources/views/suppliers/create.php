<html>
<body>
    <h1>Add New Supplier</h1>
    
    <form action="/suppliers" method="POST">
        <label>Name:</label>
        <input type="text" name="name" required>
        
        <label>Email:</label>
        <input type="email" name="email" required>
        
        <label>Phone:</label>
        <input type="text" name="phone">
        
        <label>Address:</label>
        <textarea name="address"></textarea>
        
        <button type="submit">Save Supplier</button>
    </form>
</body>
</html>
