function saveProduct() {
    const productName = document.getElementById('productName').value;
    const productDescription = document.getElementById('productDescription').value;
    const productPrice = document.getElementById('productPrice').value;
    const productStock = document.getElementById('productStock').value;
    const productCategory = document.getElementById('productCategory').value;
    const productSupplier = document.getElementById('productSupplier').value;

    if (!productName || !productDescription || !productPrice || !productStock || !productCategory || !productSupplier) {
        alert('Por favor, complete todos los campos');
        return;
    }

    const product = {
        nombre: productName,
        descripcion: productDescription,
        precio: productPrice,
        stock: productStock,
        id_categoria: productCategory,
        id_proveedor: productSupplier
    };

    fetch('url_de_tu_api', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(product)
    })
    .then(response => response.json())
    .then(data => {
        alert('Producto guardado exitosamente');
        closeModal();
        // Aquí puedes agregar lógica para recargar los productos si es necesario
    })
    .catch(error => {
        console.error('Error al guardar el producto:', error);
        alert('Hubo un problema al guardar el producto.');
    });
}

function closeModal() {
    document.getElementById('productModal').style.display = 'none';
}

function openAddModal() {
    document.getElementById('productModal').style.display = 'block';
}
