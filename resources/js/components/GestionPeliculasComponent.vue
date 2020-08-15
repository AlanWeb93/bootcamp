<template>
  <div class="container mt-4">
    <div class="row">
      <div class="col-md-6">
        <div class="container">
          <h4>Agregar Pelicula</h4>
          <br />
          <form @submit.prevent="agregarPelicula()" autocomplete="off" method="post" enctype="multipart/form-data">
              <input
                  type="hidden"
                  v-model="id_peli"
                  value="id_peli"
                />
            <div class="form-group row">
              <label class="col-md-3 form-control-label" for="text-input">Titulo</label>
              <div class="col-md-9">
                <input
                  type="text"
                  name="titulo"
                  v-model="titulo"
                  class="form-control"
                  placeholder="Titulo de la pelicula"
                  required
                />
               </div>
            </div>
            <div class="form-group row">
              <label class="col-md-3 form-control-label" for="des">Año</label>
              <div class="col-md-9">
                <input
                  type="number"
                  name="año"
                  v-model="año"
                  class="form-control"
                  placeholder="Año de estreno"
                  required
                />
              </div>
            </div>
            <div class="form-group row">
              <label class="col-md-3 form-control-label" for="des">Duracion</label>
              <div class="col-md-9">
                <input
                  type="text"
                  name="duracion"
                  v-model="duracion"
                  class="form-control"
                  placeholder="Duracion de la pelicula"
                  required
                />
              </div>
            </div>
            <div class="form-group row">
              <label class="col-md-3 form-control-label" for="des">Sinopsis</label>
              <div class="col-md-9">
                <textarea rows="4" cols="50"
                type="text"
                name="sinopsis"
                  v-model="sinopsis"
                  class="form-control"
                  placeholder="Descripcion de la pelicula"
                  required/>
              </div>
            </div>
            <div class="form-group row">
                <label class="col-md-3 form-control-label" for="actor">Actores</label>
                <div class="col-md-9">
                    <select class="form-control" required v-model="id_actor">
                      <option value="0" disabled >Seleccione</option>
                        <option name="id_actor" v-for="actor in actores"
                        :key="actor.id"
                        >{{actor.nombre}}
                        </option>
                    </select>
                </div>
            </div>
           <div class="form-group row">
                <label class="col-md-3 form-control-label" for="imagen">Imagen</label>
                <div class="col-md-9">
                    <input
                      type="file"
                      class="form-control"
                      name="imagen"
                      placeholder="Ingrese una Imagen"
                      @change="obtenerImagen"
                    />
                </div>
            </div>

            <div class="form-group row">
              <label class="col-md-3 form-control-label" for="des">Contraseña</label>
              <div class="col-md-9">
                <input
                  type="password"
                  name="pass"
                  v-model="pass"
                  class="form-control"
                  required/>
              </div>
            </div>
            
            <div class="modal-footer">
              <button type="reset" class="btn btn-danger" data-dismiss="modal">
                Clear
              </button>
              <button type="submit" class="btn btn-success">
                 Guardar
              </button>
            </div>
          </form>
        </div>
      </div>
      <div class="col-md-6">
          <div class="container">
            <h4>Lista de Peliculas</h4>
            <br />
             <div class="card text-center">
                <div class="card-body">
                    <pelicula-component
                    v-for="pelicula in peliculas"
                    :key="pelicula.id"
                    :pelicula="pelicula"
                    @obtenerPeliculas="obtenerPeliculas()"
                    @modificarPelicula="modificarPelicula(pelicula)"/>
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
        token: String
    },
    data(){
        return {

          id_peli: null,
          id_actor: null,
          titulo: "",
          año: "",
          duracion: "",
          sinopsis: "",
          imagen: "",
          pass: "",
          actores: [],
          peliculas: [],

        };
    },
    mounted(){
      this.obtenerActores();
      this.obtenerPeliculas();
    },
    methods: {
        obtenerImagen(e){
          let file = e.target.files[0];
          this.imagen = file;
          console.log(this.imagen);
        },
        agregarPelicula(){
            const user = this.actores.find((actor) => 
                actor.nombre === this.id_actor
            );
            
            const params = {
                _token: this.token,
                id_peli: this.id_peli,
                id_actor: user.id,
                titulo: this.titulo,
                año: this.año,
                duracion: this.duracion,
                sinopsis: this.sinopsis,
                imagen: this.imagen,
                pass: this.pass
            };
            axios.post("/pelicula/store", params).then(response => {
                
                this.id_peli = null;
                this.id_actor = null;
                this.titulo = "";
                this.año = "";
                this.duracion = "";
                this.sinopsis = "";
                this.imagen = "";
                this.pass = "";
                this.obtenerPeliculas();
                //Deberia avisar al usuario que se inserto
            });
        },
        obtenerActores(){
          axios.get('/actor')
            .then((response) => {
                this.actores = response.data;
            });
        },
        obtenerPeliculas(){
          axios.post('/pelicula')
            .then((response) => {
                this.peliculas = response.data;
            });
        },
        modificarPelicula(pelicula){
          this.id_peli = pelicula.id;
          this.titulo = pelicula.titulo;
          this.año = pelicula.año;
          this.duracion = pelicula.duracion;
          this.sinopsis = pelicula.sinopsis;
        }
    }
};
</script>