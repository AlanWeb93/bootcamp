<template>
  <div class="container mb-2">
    <div class="card">
      <div class="card-body">
          <div class="row">
              <div class="col-md-7">
                  <div class="row">
                    <label for="nombre"><strong>Titulo: </strong></label>
                    <p class="ml-4">{{pelicula.titulo}}</p>
                    </div>
                    <div class="row">
                    <label for="actor"><strong>Actor/Actriz: </strong></label>
                    <p class="ml-3">{{pelicula.nombre_actor}}</p>
                    </div>
                    <div class="row">
                    <label for="fecha" style="te"><strong>Sinopsis: </strong></label>
                    <p class="ml-3">{{pelicula.sinopsis}}</p>
                    </div>
                    <div class="row">
                    <label for="fecha" style="te"><strong>Año: </strong></label>
                    <p class="ml-3">{{pelicula.año}}</p>
                    </div>
                    <div class="row">
                        <form @submit.prevent="favorito">
                            <button
                            type="submit"
                            class="btn btn-primary ml-2 btn-sm"
                            data-dismiss="modal"
                            >Marcar Favorito</button>
                        </form>
                    </div>
              </div>
              <div class="col-md-5">
                  <img src="" alt="Deberia tener las imagenes aqui">
              </div>
          </div>
      </div>
    </div>
  </div>
</template>


<script>
export default {
    props: {
        pelicula: Object
    },
  data() {
    return {

    };
  },
  mounted() {},
  methods: {
    favorito() {
     this.$emit("addFavorito", this.pelicula);
    }
  },
};
</script>