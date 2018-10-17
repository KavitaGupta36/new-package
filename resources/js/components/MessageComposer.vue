<style type="text/css">
    .message-input{
        width:100%; 
        margin-top:20px;
        border: 1px solid #ddd;
        border-radius: 5px;
    }

    .message-input input{
        width: 80%;
        outline: none;
        border:none;
        padding: 0 10px;
        height: 38px;
    }
    
</style>

<template>
    <div class="composer">

    <div class="message-input">
        <input v-model="message" @keydown.enter="send" placeholder="Message..." />
    </div>
        
    </div>
</template>
<script>
    export default {
        data() {
            return {
                message: ''
            };
        },
        methods: {
            send(e) {
                e.preventDefault();
                
                if (this.message == '') {
                    return;
                }

                this.$emit('send', this.message);
                this.message = '';
            }
        }
    }
</script>

<style lang="scss" scoped>
.composer textarea {
    width: 96%;
    margin: 10px;
    resize: none;
    border-radius: 3px;
    border: 1px solid lightgray;
    padding: 6px;
}
</style>

