<template>
  <div class="container mb-2">
    <div class="card">
      <div class="card-body">
          <div class="row">
            <label for="nombre"><strong>Titulo: </strong></label>
            <p class="ml-4">{{favorito.titulo}}</p>
            </div>
            <div class="row">
            <label for="actor"><strong>Actor/Actriz: </strong></label>
            <p class="ml-3">{{favorito.actor}}</p>
            </div>
            <div class="row">
            <label for="fecha"><strong>Sinopsis: </strong></label>
            <p class="ml-3">{{favorito.sinopsis}}</p>
            </div>
          </div>
      </div>
    </div>
</template>


<script>
export default {
    props: {
        favorito: Object
    },
  data() {
    return {};
  },
  methods: {
  },
};
</script>