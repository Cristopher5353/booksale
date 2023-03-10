document.addEventListener("change", (e) => {
    let idItemCar = e.target.getAttribute("id");
    let inputQuantity = document.getElementById("inputQuantity_" + idItemCar);
    inputQuantity.value = e.target.value;
})