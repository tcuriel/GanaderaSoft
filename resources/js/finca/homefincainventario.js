import Swal from 'sweetalert2';

// @ts-ignore
const fincaId = JSON.parse(window.dataFinca)[0].id_Finca;
// @ts-ignore
const fincaname = JSON.parse(window.dataFinca)[0].Nombre;
// @ts-ignore
const list_inventario = window.list_inventario;
// @ts-ignore
const url_actionGet = window.get_inventario;
// @ts-ignore
const inventario_selector = window.inventario_selector;
const selectInventario = document.getElementById("selectInventario");

findInventarioLists();

if (selectInventario) selectInventario.addEventListener("change", (event) => {
  // @ts-ignore
  const tipoListado = event.target.value;
  if(tipoListado != null) {
    findInventarioLists();
  }
  const existingCard = document.getElementById("inventory-details");
  if (existingCard) {
    existingCard.remove();
  }
});

function findInventarioLists() {
  if(fincaId != null && fincaId > 0 && list_inventario && inventario_selector) {
    const rutasParseadas = inventario_selector.split(",");
    let swal;
    // @ts-ignore
    const element = selectInventario.value;
    const url_actionGetList = list_inventario + element + "/" + fincaId;
    swal = Swal.fire({
        title: "Obteniendo datos de " + fincaname + " ...",
        timerProgressBar: true,
        didOpen: () => {
          Swal.showLoading();
        }
    });

    fetch(url_actionGetList, {
        method: "GET",
        headers: {
          "Content-Type": "application/json",
        }
      })
      .then(response => {
        if (response.status === 204) {
          swal.close();
          Swal.fire({
            icon: "info",
            text: "No se encontraron datos.",
            confirmButtonText: "Aceptar"
          });
          return; 
        }
        if (response.status === 500) {
          swal.close();
          Swal.fire({
              icon: "error",
              text: "Error al enviar el formulario.",
              confirmButtonText: "Aceptar"
          });
          // @ts-ignore
          actionButton.disabled = false;
          return; 
        }
        return response.json();
      })
      .then(data => {// Respuesta del servidor
        swal.close();
        if(data) {
          buildList(data,element);
        }
      });
  }
}

function buildList(data, type) {
  let idInv = 0;
  const listInventarioUl = document.getElementById("list-invetario"); // Suponiendo que tienes un elemento con la clase "my-list"
  if(listInventarioUl) {
    listInventarioUl.innerHTML = "";
    data.data.forEach(item => {
        const elemento = document.createElement("li");
        elemento.classList.add("list-group-item");
    
        const contenedor = document.createElement("div");
        contenedor.classList.add("row", "continer-item-list", "inventario-item");
    
        const columna = document.createElement("div");
        columna.classList.add("col-12", "iconinventariofarm", "text-left");
    
        const titulo = document.createElement("h4");
        titulo.classList.add("listItem");
        if(type == "general") {
          titulo.textContent = `ID: ${item.id_Inv.toString().padStart(3, "0")}`;
          titulo.id = "listItem" + item.id_Inv;
          idInv = item.id_Inv;
        }
        if(type == "vacuno") {
          titulo.textContent = `ID: ${item.id_Inv_V.toString().padStart(3, "0")}`;
          titulo.id = "listItem" + item.id_Inv_V;
          idInv = item.id_Inv_V;
        }
        if(type == "bufalo") {
          titulo.textContent = `ID: ${item.id_Inv_B.toString().padStart(3, "0")}`;
          titulo.id = "listItem" + item.id_Inv_B;
          idInv = item.id_Inv_B;
        }
        titulo.classList.add("mb-1");
    
        const fecha = document.createElement("p");
        fecha.textContent = `Fecha: ${item.Fecha_Inventario}`;
    
        columna.appendChild(titulo);
        columna.appendChild(fecha);
        contenedor.appendChild(columna);
        elemento.appendChild(contenedor);
    
        listInventarioUl.appendChild(elemento);
    });
  }
  const elementosInventario = document.querySelectorAll('.iconinventariofarm');
  
  elementosInventario.forEach((elemento) => {
      elemento.addEventListener('click', (event) => {
      elementosInventario.forEach((elemento) => {
        elemento.classList.remove('active');
      });
      // @ts-ignore
      event.currentTarget?.classList?.add('active');
      // @ts-ignore
      const clickedButton = event.target.closest(".listItem"); // "listItem" eventoo click botones
      if (clickedButton) {
        
        const idInventario = clickedButton.id.replace("listItem", "");
        getInventario(type,idInventario);

      }

    });
  });
}

function getInventario (type, idInv) {
  fetch(url_actionGet + type + "/" + idInv, {
    method: "GET",
    headers: {
    "Content-Type": "application/json",
  }
  })
  .then(response => {
    if (response.status === 204) {
        Swal.fire({
            icon: "info",
            text: "No se encontraron datos.",
            confirmButtonText: "Aceptar"
        });
        return; 
    }
    return response.json();
  })
  .then(data => {// Respuesta del servidor
    if(data) {
      buildCard(data.data,type);
    }
  })
  .catch(error => {// Error
    Swal.fire({
        icon: "error",
        text: "Error al obtener el datos.",
        confirmButtonText: "Aceptar"
    });
    console.error("Error al obtener inventario:", error);
  });
}

function buildCard(data, type) {
  const inventoryContent = document.getElementById("inventory-content");
  if (inventoryContent) {
    const card = document.createElement("div");
    card.classList.add("card");
    card.id = "inventory-details";

    let idInv = 0;
    if(type == "general") {
      idInv = data.id_Inv;
    }
    if(type == "vacuno") {
      idInv = data.id_Inv_V;
    }
    if(type == "bufalo") {
      idInv = data.id_Inv_B;
    }

    const cardHeader = document.createElement("div");
    cardHeader.classList.add("card-header");

    const cardHeaderText = document.createElement("h4");
    cardHeaderText.classList.add("text-center");
    cardHeaderText.textContent = `Detalle del Inventario (${idInv.toString().padStart(3, "0")})`;
    cardHeader.appendChild(cardHeaderText);

    const cardBody = document.createElement("div");
    cardBody.classList.add("card-body");

    const lista = document.createElement("ul");
    lista.classList.add("list-group", "list-group-flush", "list-group-inventario");

    const listaItem1 = document.createElement("li");
    listaItem1.classList.add("list-group-item", "d-flex", "flex-row", "justify-content-between");
    const span1 = document.createElement("span");
    span1.textContent = "ID";
    const span2 = document.createElement("span");
    span2.textContent = `${idInv.toString().padStart(3, "0")}`;
    listaItem1.appendChild(span1);
    listaItem1.appendChild(span2);
    lista.appendChild(listaItem1);

    if(type == "general") {
      const listaItem2 = document.createElement("li");
      listaItem2.classList.add("list-group-item", "d-flex", "flex-row", "justify-content-between");
      const span3 = document.createElement("span");
      span3.textContent = "Numero de Personal";
      const span4 = document.createElement("span");
      span4.textContent = `${data.Num_Personal}`;
      listaItem2.appendChild(span3);
      listaItem2.appendChild(span4);
      lista.appendChild(listaItem2);
    }
    if(type == "vacuno") {
      const listaItem4 = document.createElement("li");
      listaItem4.classList.add("list-group-item", "d-flex", "flex-row", "justify-content-between");
      const span7 = document.createElement("span");
      span7.textContent = "Numero de Becerra";
      const span8 = document.createElement("span");
      span8.textContent = `${data.Num_Becerra}`;
      listaItem4.appendChild(span7);
      listaItem4.appendChild(span8);
      lista.appendChild(listaItem4);

      const listaItem5 = document.createElement("li");
      listaItem5.classList.add("list-group-item", "d-flex", "flex-row", "justify-content-between");
      const span9 = document.createElement("span");
      span9.textContent = "Numero de Becerro";
      const span10 = document.createElement("span");
      span10.textContent = `${data.Num_Becerro}`;
      listaItem5.appendChild(span9);
      listaItem5.appendChild(span10);
      lista.appendChild(listaItem5);

      const listaItem6 = document.createElement("li");
      listaItem6.classList.add("list-group-item", "d-flex", "flex-row", "justify-content-between");
      const span11 = document.createElement("span");
      span11.textContent = "Numero de Mauta";
      const span12 = document.createElement("span");
      span12.textContent = `${data.Num_Mauta}`;
      listaItem6.appendChild(span11);
      listaItem6.appendChild(span12);
      lista.appendChild(listaItem6);

      const listaItem7 = document.createElement("li");
      listaItem7.classList.add("list-group-item", "d-flex", "flex-row", "justify-content-between");
      const span13 = document.createElement("span");
      span13.textContent = "Numero de Maute";
      const span14 = document.createElement("span");
      span14.textContent = `${data.Num_Maute}`;
      listaItem7.appendChild(span13);
      listaItem7.appendChild(span14);
      lista.appendChild(listaItem7);

      const listaItem8 = document.createElement("li");
      listaItem8.classList.add("list-group-item", "d-flex", "flex-row", "justify-content-between");
      const span15 = document.createElement("span");
      span15.textContent = "Numero de Novilla";
      const span16 = document.createElement("span");
      span16.textContent = `${data.Num_Novilla}`;
      listaItem8.appendChild(span15);
      listaItem8.appendChild(span16);
      lista.appendChild(listaItem8);


      const listaItem9 = document.createElement("li");
      listaItem9.classList.add("list-group-item", "d-flex", "flex-row", "justify-content-between");
      const span17 = document.createElement("span");
      span17.textContent = "Numero de Torete";
      const span18 = document.createElement("span");
      span18.textContent = `${data.Num_Torete}`;
      listaItem9.appendChild(span17);
      listaItem9.appendChild(span18);
      lista.appendChild(listaItem9);


      const listaItem10 = document.createElement("li");
      listaItem10.classList.add("list-group-item", "d-flex", "flex-row", "justify-content-between");
      const span19 = document.createElement("span");
      span19.textContent = "Numero de Toro";
      const span20 = document.createElement("span");
      span20.textContent = `${data.Num_Toro}`;
      listaItem10.appendChild(span19);
      listaItem10.appendChild(span20);
      lista.appendChild(listaItem10);

      const listaItem11 = document.createElement("li");
      listaItem11.classList.add("list-group-item", "d-flex", "flex-row", "justify-content-between");
      const span21 = document.createElement("span");
      span21.textContent = "Numero de Vaca";
      const span22 = document.createElement("span");
      span22.textContent = `${data.Num_Vaca}`;
      listaItem11.appendChild(span21);
      listaItem11.appendChild(span22);
      lista.appendChild(listaItem11);
    }
    if(type == "bufalo") {
      const listaItem12 = document.createElement("li");
      listaItem12.classList.add("list-group-item", "d-flex", "flex-row", "justify-content-between");
      const span23 = document.createElement("span");
      span23.textContent = "Numero de Anojo";
      const span24 = document.createElement("span");
      span24.textContent = `${data.Num_Anojo}`;
      listaItem12.appendChild(span23);
      listaItem12.appendChild(span24);
      lista.appendChild(listaItem12);

      const listaItem13 = document.createElement("li");
      listaItem13.classList.add("list-group-item", "d-flex", "flex-row", "justify-content-between");
      const span25 = document.createElement("span");
      span25.textContent = "Numero de Becerro";
      const span26 = document.createElement("span");
      span26.textContent = `${data.Num_Becerro}`;
      listaItem13.appendChild(span25);
      listaItem13.appendChild(span26);
      lista.appendChild(listaItem13);

      const listaItem14 = document.createElement("li");
      listaItem14.classList.add("list-group-item", "d-flex", "flex-row", "justify-content-between");
      const span27 = document.createElement("span");
      span27.textContent = "Numero de Bubilla";
      const span28 = document.createElement("span");
      span28.textContent = `${data.Num_Bubilla}`;
      listaItem14.appendChild(span27);
      listaItem14.appendChild(span28);
      lista.appendChild(listaItem14);

      const listaItem15 = document.createElement("li");
      listaItem15.classList.add("list-group-item", "d-flex", "flex-row", "justify-content-between");
      const span29 = document.createElement("span");
      span29.textContent = "Numero de Bufalo";
      const span30 = document.createElement("span");
      span30.textContent = `${data.Num_Bufalo}`;
      listaItem15.appendChild(span29);
      listaItem15.appendChild(span30);
      lista.appendChild(listaItem15);
    }

    const listaItem3 = document.createElement("li");
    listaItem3.classList.add("list-group-item", "d-flex", "flex-row", "justify-content-between");
    const span5 = document.createElement("span");
    span5.textContent = "Fecha del Inventario";
    const span6 = document.createElement("span");
    span6.textContent = `${data.Fecha_Inventario}`;
    listaItem3.appendChild(span5);
    listaItem3.appendChild(span6);
    lista.appendChild(listaItem3);

    cardBody.appendChild(lista);

    card.appendChild(cardHeader);
    card.appendChild(cardBody);

    const existingCard = document.getElementById("inventory-details");
    if (existingCard) {
      existingCard.remove();
    }

    inventoryContent.appendChild(card)
  }
}
