<template>
    <div class="container mb-2">
       <div class="card">
            <div class="card-body">
                <div class="row">
                    <label for="nombre">Titulo: </label>
                    <p class="ml-3">{{pelicula.titulo}}</p>
                    <div class="ml-4">
                        <div class="row">
                        <form @submit.prevent="eliminarPelicula">
                             <button type="submit" class="btn btn-danger ml-2 btn-sm" data-dismiss="modal">
                                Eliminar
                            </button>
                        </form>
                        <form @submit.prevent="modificarPelicula">
                            <button type="submit" class="btn btn-primary ml-2 btn-sm" data-dismiss="modal">
                                Modificar
                            </button>
                        </form>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label for="fecha">Sinopsis: </label>
                    <p class="ml-3">{{pelicula.sinopsis}}</p>
                </div>
                <div class="row">
                    <label for="actor">Actor/Actriz: </label>
                    <p class="ml-3">{{pelicula.nombre_actor}}</p>
                </div>
            </div>
       </div>
    </div>
</template>

<script>
    export default {
        props:{
            pelicula: Object
        },
        data(){
            return {
            };
        },
        mounted() {
        },
        methods: {
            eliminarPelicula(){
                const params = {
                id: this.pelicula.id,
                };
                axios.post("/pelicula/destroy", params)
                    .then(response => {
                this.$emit('obtenerPeliculas');
                });
            },
            modificarPelicula(){
                this.$emit('modificarPelicula', this.pelicula);
            }
        },
        computed: {
            image(){
                return `/imgPeliculas/${this.pelicula.imagen}`;
            }
            }
        }
</script>