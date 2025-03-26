<html>
<body>
    <h1>Add New Product</h1>
    
    <form action="/products" method="POST" enctype="multipart/form-data">
        <label>Product Name:</label>
        <input type="text" name="name" required>
        
        <label>Description:</label>
        <textarea name="description" required></textarea>
        
        <label>Price:</label>
        <input type="number" name="price" step="0.01" min="0" required>
        
        <label>Product Image:</label>
        <input type="file" name="image">
        
        <button type="submit">Save Product</button>
    </form>
</body>
</html>
