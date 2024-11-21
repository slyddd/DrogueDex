// Función para abrir el modal de agregar producto
function openAddModal() {
    // Limpia los campos del formulario
    document.getElementById("productForm").reset();
    // Cambia el título del modal
    document.getElementById("modalTitle").textContent = "Agregar Producto";
    // Muestra el modal
    document.getElementById("productModal").style.display = "block";
}

// Función para cerrar el modal
function closeModal() {
    document.getElementById("productModal").style.display = "none";
}

// Función para guardar el producto
async function saveProduct() {
    // Capturamos los datos del formulario
    const productName = document.getElementById("productName").value.trim();
    const productType = document.getElementById("productType").value.trim();
    const productStock = document.getElementById("productStock").value.trim();
    const idCategoria = 1;  // Este valor puede cambiar dependiendo de la categoría
    const idProveedor = 1;  // Este valor puede cambiar dependiendo del proveedor

    // Validación para asegurarse que los campos no estén vacíos
    if (!productName || !productType || !productStock) {
        alert("Por favor, complete todos los campos.");
        return;
    }

    // Datos a enviar a la API
    const productData = {
        nombre: productName,
        descripcion: productType,  // Usamos productType como descripción
        precio: 0,  // Asignamos un precio por defecto, ya que no hay campo para ello en el formulario
        stock: productStock,
        id_categoria: idCategoria,
        id_proveedor: idProveedor
    };

    try {
        // Enviamos los datos a la API usando fetch
        const response = await fetch("https://cienciadatos701.dcramirez.com/G2/api/product", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify(productData)
        });

        // Revisamos la respuesta de la API
        const result = await response.json();
        if (response.ok) {
            alert("Producto agregado exitosamente.");
            closeModal(); // Cierra el modal
            // Aquí puedes agregar lógica para actualizar la tabla si es necesario
        } else {
            alert(`Error al agregar producto: ${result.message}`);
        }
    } catch (error) {
        console.error("Error al conectar con la API", error);
        alert("Error de red. No se pudo agregar el producto.");
    }
}
