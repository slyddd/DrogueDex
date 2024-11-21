// Función para guardar el producto
async function saveProduct() {
    const productName = document.getElementById("productName").value;
    const productDescription = document.getElementById("productDescription").value;
    const productPrice = document.getElementById("productPrice").value;
    const productStock = document.getElementById("productStock").value;
    const productCategory = document.getElementById("productCategory").value;
    const productSupplier = document.getElementById("productSupplier").value;

    // Verificar que todos los campos estén llenos
    if (!productName || !productDescription || !productPrice || !productStock || !productCategory || !productSupplier) {
        alert("Por favor, complete todos los campos.");
        return;
    }

    // Crear objeto con los datos del producto
    const productData = {
        nombre: productName,
        descripcion: productDescription,
        precio: productPrice,
        stock: productStock,
        id_categoria: productCategory,
        id_proveedor: productSupplier
    };

    try {
        // Enviar los datos a la API usando fetch
        const response = await fetch("https://cienciadatos701.dcramirez.com/G2/api/product", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify(productData)
        });

        const data = await response.json();

        // Verificar si la respuesta es exitosa
        if (response.ok && data.status === 200) {
            alert("Producto guardado exitosamente.");
            closeModal(); // Cerrar el modal
            loadProducts(); // Volver a cargar la lista de productos (si tienes esta función)
        } else {
            alert("Error al guardar el producto.");
        }
    } catch (error) {
        console.error("Error al guardar el producto:", error);
        alert("Hubo un problema al guardar el producto.");
    }
}

// Función para abrir el modal
function openAddModal() {
    const modal = document.getElementById("productModal");
    modal.style.display = "block";  // Mostrar el modal
}

// Función para cerrar el modal
function closeModal() {
    const modal = document.getElementById("productModal");
    modal.style.display = "none";  // Ocultar el modal
}

// Función para cargar los productos en la tabla
async function loadProducts() {
    try {
        const response = await fetch("https://cienciadatos701.dcramirez.com/G2/api/products");
        const productsData = await response.json();

        const tableBody = document.getElementById("productTable");
        tableBody.innerHTML = "";  // Limpiar la tabla antes de agregar productos

        productsData.response.forEach(product => {
            const row = document.createElement("tr");

            const nameCell = document.createElement("td");
            nameCell.textContent = product.nombre;
            row.appendChild(nameCell);

            const categoryCell = document.createElement("td");
            categoryCell.textContent = product.categoria;
            row.appendChild(categoryCell);

            const stockCell = document.createElement("td");
            stockCell.textContent = product.stock;
            row.appendChild(stockCell);

            const actionCell = document.createElement("td");
            const editButton = document.createElement("button");
            editButton.textContent = "Editar";
            // Aquí puedes agregar la lógica para editar el producto
            actionCell.appendChild(editButton);
            row.appendChild(actionCell);

            tableBody.appendChild(row);
        });

    } catch (error) {
        console.error("Error al cargar los productos:", error);
        alert("Hubo un problema al cargar los productos.");
    }
}

// Cargar productos al cargar la página
window.onload = function() {
    loadProducts();
};
