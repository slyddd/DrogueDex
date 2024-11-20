// Simulando una base de datos local para almacenar los productos
let productList = [];
let editProductIndex = null; // Indice del producto a editar

// Abre el modal para agregar un nuevo producto
function openAddModal() {
    document.getElementById('productModal').style.display = 'flex';
    document.getElementById('productForm').reset(); // Resetea el formulario
    document.getElementById('modalTitle').textContent = 'Agregar Producto'; // Cambiar título del modal
    document.querySelector('.save-btn').textContent = 'Guardar'; // Cambiar texto del botón a "Guardar"
    document.querySelector('.save-btn').setAttribute('onclick', 'saveProduct()'); // Asegurarse de que la función sea de guardar
    editProductIndex = null; // Asegura que no haya un producto editado
}

// Cierra el modal
function closeModal() {
    document.getElementById('productModal').style.display = 'none';
}

// Guarda un producto (agregar o actualizar)
function saveProduct() {
    const name = document.getElementById('productName').value;
    const type = document.getElementById('productType').value;
    const stock = document.getElementById('productStock').value;

    // Validación de campos
    if (!name || !type || !stock) {
        alert("Por favor, completa todos los campos.");
        return;
    }

    // Si estamos editando, actualizamos el producto
    if (editProductIndex !== null) {
        productList[editProductIndex] = {
            name: name,
            type: type,
            stock: parseInt(stock)
        };

        // Actualizamos la tabla
        updateProductTable();
        closeModal();
        return;
    }

    // Si estamos agregando, guardamos el nuevo producto
    const product = {
        name: name,
        type: type,
        stock: parseInt(stock)
    };

    productList.push(product);

    // Actualizamos la tabla con el nuevo producto
    updateProductTable();
    closeModal();
}

// Actualiza la tabla con los productos
function updateProductTable() {
    const tableBody = document.getElementById('productTable');
    tableBody.innerHTML = ''; // Limpiar la tabla

    productList.forEach((product, index) => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${product.name}</td>
            <td>${product.type}</td>
            <td>${product.stock}</td>
            <td>
                <button onclick="editProduct(${index})">Editar</button>
                <button onclick="deleteProduct(${index})">Eliminar</button>
            </td>
        `;
        tableBody.appendChild(row);
    });
}

// Editar producto
function editProduct(index) {
    // Cargar el producto en el formulario
    const product = productList[index];
    document.getElementById('productName').value = product.name;
    document.getElementById('productType').value = product.type;
    document.getElementById('productStock').value = product.stock;

    // Cambiar el título y el texto del botón
    document.getElementById('modalTitle').textContent = 'Editar Producto';
    document.querySelector('.save-btn').textContent = 'Actualizar';
    document.querySelector('.save-btn').setAttribute('onclick', `updateProduct(${index})`);

    // Mostrar el modal
    document.getElementById('productModal').style.display = 'flex';

    // Guardar el índice del producto que se va a editar
    editProductIndex = index;
}

// Actualizar producto
function updateProduct(index) {
    const name = document.getElementById('productName').value;
    const type = document.getElementById('productType').value;
    const stock = document.getElementById('productStock').value;

    // Validación de campos
    if (!name || !type || !stock) {
        alert("Por favor, completa todos los campos.");
        return;
    }

    // Actualizar el producto en el arreglo
    productList[index] = {
        name: name,
        type: type,
        stock: parseInt(stock)
    };

    // Actualizar la tabla con los datos modificados
    updateProductTable();

    // Cerrar el modal
    closeModal();
}

// Eliminar producto
function deleteProduct(index) {
    // Confirmar eliminación
    const confirmation = confirm("¿Estás seguro de que deseas eliminar este producto?");
    if (confirmation) {
        // Eliminar el producto
        productList.splice(index, 1);
        updateProductTable();
    }
}
