<script setup>
const Routes = {
  home: "/backoffice",
  clients: "/customers",
  empleats: "/employees",
  reserves: "/reservations",
  vehicles: "/vehicles",
  proveidors: "/providers",
  factures: "/invoices",
  comandes: "/orders",
};
defineProps({
  Routes: Object,
})
</script>

<template>
  <nav class="bg-primary-lm">
    <ul class="m-0 list-unstyled fs-5 d-flex flex-column text-sm-start text-center font-lm-text">
      <li class="pe-3 py-4 ps-sm-5 btn-normal-hover">
        <a :href="Routes.home" class="text-decoration-none text-white">
          <i class="bi bi-house"></i> Inicio
        </a>
      </li>
      <li class="pe-3 py-4 ps-sm-5 btn-normal-hover">
        <a :href="Routes.home" class="text-decoration-none text-white">
          <i class="bi bi-file-earmark"></i> Facturas
        </a>
      </li>
      <li class="pe-3 py-4 ps-sm-5 btn-normal-hover">
        <a :href="Routes.home" class="text-decoration-none text-white">
          <i class="bi bi-person"></i> Clientes
        </a>
      </li>
      <li class="pe-3 py-4 ps-sm-5 btn-normal-hover">
        <a :href="Routes.home" class="text-decoration-none text-white">
          <i class="bi bi-file-earmark-person"></i> Empleados
        </a>
      </li>
      <li class="pe-3 py-4 ps-sm-5 btn-normal-hover">
        <a :href="Routes.home" class="text-decoration-none text-white">
          <i class="bi bi-calendar"></i> Reservas
        </a>
      </li>
      <li class="pe-3 py-4 ps-sm-5 btn-normal-hover">
        <a :href="Routes.home" class="text-decoration-none text-white">
          <i class="bi bi-car-front-fill"></i> Vehículos
        </a>
      </li>
      <li class="pe-3 py-4 ps-sm-5 btn-normal-hover">
        <a :href="Routes.home" class="text-decoration-none text-white">
          <i class="bi bi-truck"></i> Proveedores
        </a>
      </li>
      <li class="pe-3 py-4 ps-sm-5 btn-normal-hover">
        <a :href="Routes.home" class="text-decoration-none text-white">
          <i class="bi bi-cart"></i> Pedidos
        </a>
      </li>
    </ul>
  </nav>
</template>