const d = document;
const $searcher = d.getElementById("searcher");
const $products = d.querySelectorAll(".name");

d.addEventListener("DOMContentLoaded", (e) => {
    console.log("adasdas");
    // Actualizar la cantidad de productos al cargar la página

    $searcher.addEventListener("input", (e) => {
        const searchText = e.target.value.toLowerCase(); // Convertir el texto ingresado a minúsculas

        $products.forEach((product) => {
            const productName = product.textContent.toLowerCase(); // Obtener el texto del elemento en minúsculas
            if (productName.includes(searchText)) {
                product.parentElement.style.display = "block"; // Mostrar el producto si coincide con la búsqueda
            } else {
                product.parentElement.style.display = "none"; // Ocultar el producto si no coincide con la búsqueda
            }
        });
    });
});
