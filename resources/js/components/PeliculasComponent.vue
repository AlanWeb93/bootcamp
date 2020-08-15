<template>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-8">
                <div class="container">
                    <div id="output"></div>
                    <form @submit.prevent="buscarPelicula()" autocomplete="off">
                        <div class="input-group">
                            <input type="text" v-model="buscar" id="buscarPeli" class="form-control" placeholder="Buscar pelicula" >
                            <button type="submit" class="btn btn-primary">Buscar</button>
                        </div>
                    </form>
                    <div class="card text-center mt-3">
                        <div class="card-body">
                            <detalle-pelicula-component 
                            v-for="pelicula in peliculas"
                            :key="pelicula.id"
                            :pelicula="pelicula"
                            @addFavorito="addFavorito(pelicula)"/>
                        </div>
                    </div>
                    <websocket-component/>
                </div>
            </div>
            <div class="col-md-4">
                <div class="container">
                    <h3>Mis Peliculas Favoritas</h3>
                    <div class="card text-center mt-3">
                        <div class="card-body">
                            <detalle-pelicula-favorita-component 
                            v-for="favorito in favoritos"
                            :key="favorito.id"
                            :favorito="favorito"/>
                        </div>
                    </div>
                </div>
            </div>    
        </div>
    </div>
</template>


<style>
.card-body {
  max-height: calc(100vh - 200px);
  overflow-x: hidden;
  overflow-y: auto;
}
</style>

<script>
    export default {
        props: {
            tooken: String
        },
        data(){
            return{
                peliculas: [],
                favoritos: [],
                buscar: ""
            }
        },
        mounted() {
            this.getPeliculas();
            this.getFavoritos();
        },
        methods: {
            buscarPelicula(){
                const params = {
                    buscar : this.buscar
                };
                axios.post('/pelicula', params)
                .then((response) => {
                    this.peliculas = response.data;
                });
            },
            getPeliculas(){
            axios.post('/pelicula')
                .then((response) => {
                    this.peliculas = response.data;
                });
            },

            //Local storage
            addFavorito(pelicula){
                var newFav = {
                    id : pelicula.id,
                    titulo : pelicula.titulo,
                    sinopsis : pelicula.sinopsis,
                    actor : pelicula.nombre_actor
                };
                
                for(var i = 0; i < this.favoritos.length; i++){
                    if(this.favoritos[i].id == newFav.id){
                        return alert("Ya esta marcada como favorita");
                    }
                }
                
                this.favoritos.push(newFav);
                this.localStorageFav(this.favoritos);
                
            },
            getFavoritos(){
                var favoritosGuardados = localStorage.getItem('peliFavoritas');
                if(favoritosGuardados == null){
                    this.favoritos = [];
                }else{
                    this.favoritos = JSON.parse(favoritosGuardados);
                }
            },
            localStorageFav(peliFav){
                localStorage.setItem('peliFavoritas', JSON.stringify(peliFav));
            }

            // FIN DE LOCAL STARAGE

        },
        watch: {
            buscar(value){
                this.buscarPelicula();
            }
        }
    }
</script>