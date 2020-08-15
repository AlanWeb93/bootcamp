<template>
  <div class="container mt-4">
    <div class="row">
      <div class="col-md-6">
        <div class="container">
          <h4>Agregar Actor/Actriz</h4>
          <br />
          <form @submit.prevent="agregarActor" autocomplete="off">
             <input
                  type="hidden"
                  v-model="id_actor"
                  value="id_actor"
                />
            <div class="form-group row">
              <label class="col-md-3 form-control-label" for="text-input">Nombre</label>
              <div class="col-md-9">
                <input
                  type="text"
                  v-model="nombre"
                  class="form-control"
                  placeholder="Nombre del actor"
                  required
                />
              </div>
            </div>
            <div class="form-group row">
              <label class="col-md-3 form-control-label" for="des">Fecha de nacimiento</label>
              <div class="col-md-9">
                <input
                  type="date"
                  v-model="fecha"
                  class="form-control"
                  required
                />
              </div>
            </div>
            <div class="form-group row">
              <label class="col-md-3 form-control-label" for="des">Contraseña</label>
              <div class="col-md-9">
                <input
                  type="password"
                  v-model="pass"
                  class="form-control"
                  required
                />
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
            <h4>Lista de Actores</h4>
            <br />
             <div class="card text-center">
                <div class="card-body">
                    <actor-component 
                    v-for="actor in actores"
                    :key="actor.id"
                    :actor="actor"
                    @obtenerActores="obtenerActores()"
                    @modificarActor="modificarActor(actor)"/>
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
          id_actor: null,
          nombre: "",
          fecha: "",
          pass: "",
          actores: []
            
        };
    },
    mounted(){
      this.obtenerActores();
    },
    methods: {
        agregarActor(){
            const params = {
                id_actor: this.id_actor,
                nombre: this.nombre,
                fecha_nacimiento: this.fecha,
                pass: this.pass
            };
            axios.post("/actor/store", params).then(response => {
                this.id_actor = null;
                this.nombre = "";
                this.fecha = "";
                this.pass = "";
                this.obtenerActores();
                //Deberia avisar al usuario que se inserto
            });
        },
        obtenerActores(){
          axios.get('/actor')
            .then((response) => {
                this.actores = response.data;
            });
        },
        modificarActor(actor){
          this.id_actor = actor.id,
          this.nombre = actor.nombre;
          this.fecha = actor.fecha_nacimiento;
        }
    }
};
</script>