<template>
    <div class="container mb-2">
       <div class="card">
            <div class="card-body">
                <div class="row">
                    <label for="nombre">Nombre: </label>
                    <p class="ml-3">{{actor.nombre}}</p>
                    <div class="ml-4">
                        <div class="row">
                        <form @submit.prevent="eliminarActor">
                             <button type="submit" class="btn btn-danger ml-2 btn-sm" data-dismiss="modal">
                                Eliminar
                            </button>
                        </form>
                        <form @submit.prevent="modificarActor">
                            <button type="submit" class="btn btn-primary ml-2 btn-sm" data-dismiss="modal">
                                Modificar
                            </button>
                        </form>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label for="fecha">Fecha de Nacimiento: </label>
                    <p class="ml-3">{{actor.fecha_nacimiento}}</p>
                    
                </div>
            </div>
       </div>
    </div>
</template>

<script>
    export default {
        props:{
            actor: Object
        },
        data(){
            return {
            };
        },
        mounted() {
        },
        methods: {
            eliminarActor(){
                const params = {
                id: this.actor.id,
                };
                axios.post("/actor/destroy", params)
                    .then(response => {
                this.$emit('obtenerActores');
                });
            },
            modificarActor(){
                this.$emit('modificarActor', this.actor);
            }
        }
    }
</script>