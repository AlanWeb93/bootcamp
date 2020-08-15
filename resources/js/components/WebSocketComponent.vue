<template>
    <div class="row mt-3">
        <input type="text" v-model="msg">
        <button v-on:click="sendMessage()">Enviar mensaje</button>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                connection: null,
                msg: ""
            }
        },
        methods: {
            sendMessage: function(){
                console.log(this.connection);

                this.connection.send(this.msg);
            }
        },
        created(){
            console.log("Abriendo coneccion")
            this.connection = new WebSocket('ws://echo.websocket.org')

            this.connection.onopen = function(event){
                console.log("Coneccion Abierta")
            }

            this.connection.onmessage = function(event){
                console.log(event.data);
            }
        }
    }
</script>