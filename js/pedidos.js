document.addEventListener("DOMContentLoaded", function () {
    cargarPedidos();
  });
  
  const pedidos = [
    {
      fecha: "2025-05-01",
      nroPedido: "1001",
      vencimiento: "2025-05-05",
      cliente: "Juan Pérez",
      ejecutivo: "Carlos Ruiz",
      total: "$120.00",
      aprobado: "Sí",
      pagado: "Sí",
      estatus: "Finalizado",
      entrega: "Envío a provincia"
    },
    {
      fecha: "2025-05-02",
      nroPedido: "1002",
      vencimiento: "2025-05-06",
      cliente: "Ana Gómez",
      ejecutivo: "Laura Castro",
      total: "$200.00",
      aprobado: "No",
      pagado: "No",
      estatus: "Pendiente",
      entrega: "Recojo en agencia"
    },
    {
      fecha: "2025-05-03",
      nroPedido: "1003",
      vencimiento: "2025-05-07",
      cliente: "Luis Martínez",
      ejecutivo: "Carlos Ruiz",
      total: "$150.00",
      aprobado: "Sí",
      pagado: "No",
      estatus: "Cancelado",
      entrega: "Envío a domicilio"
    },
    {
      fecha: "2025-05-04",
      nroPedido: "1004",
      vencimiento: "2025-05-09",
      cliente: "Roberto Mego",
      ejecutivo: "Carlos Ruiz",
      total: "$1350.00",
      aprobado: "Sí",
      pagado: "No",
      estatus: "Cancelado",
      entrega: "Envío a domicilio"
    },
  ];
  
  function cargarPedidos() {
    const tbody = document.getElementById("tablaPedidos");
    tbody.innerHTML = "";
    pedidos.forEach(pedido => {
      const row = `<tr>
        <td>${pedido.fecha}</td>
        <td>${pedido.nroPedido}</td>
        <td>${pedido.vencimiento}</td>
        <td>${pedido.cliente}</td>
        <td>${pedido.ejecutivo}</td>
        <td>${pedido.total}</td>
        <td>${pedido.aprobado}</td>
        <td>${pedido.pagado}</td>
        <td>${pedido.estatus}</td>
        <td>${pedido.entrega}</td>
      </tr>`;
      tbody.innerHTML += row;
    });
  }
  
  function filtrarPedidos() {
    const fechaInicio = document.getElementById("fechaInicio").value;
    const fechaFinal = document.getElementById("fechaFinal").value;
    const estatus = document.getElementById("estatus").value;
    const buscarSO = document.getElementById("buscarSO").value.trim();
  
    const tbody = document.getElementById("tablaPedidos");
    tbody.innerHTML = "";
  
    const pedidosFiltrados = pedidos.filter(pedido => {
      const cumpleFechaInicio = fechaInicio ? pedido.fecha >= fechaInicio : true;
      const cumpleFechaFinal = fechaFinal ? pedido.fecha <= fechaFinal : true;
      const cumpleEstatus = estatus !== "Todos" ? pedido.estatus === estatus : true;
      const cumpleBusqueda = buscarSO ? pedido.nroPedido.includes(buscarSO) : true;
  
      return cumpleFechaInicio && cumpleFechaFinal && cumpleEstatus && cumpleBusqueda;
    });
  
    pedidosFiltrados.forEach(pedido => {
      const row = `<tr>
        <td>${pedido.fecha}</td>
        <td>${pedido.nroPedido}</td>
        <td>${pedido.vencimiento}</td>
        <td>${pedido.cliente}</td>
        <td>${pedido.ejecutivo}</td>
        <td>${pedido.total}</td>
        <td>${pedido.aprobado}</td>
        <td>${pedido.pagado}</td>
        <td>${pedido.estatus}</td>
        <td>${pedido.entrega}</td>
      </tr>`;
      tbody.innerHTML += row;
    });
  }
