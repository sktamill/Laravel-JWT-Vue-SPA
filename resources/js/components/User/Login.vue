<template>
    <div>
        <div>
             <input v-model="email" type="email" class="form-control mb-3 mt-3" placeholder="Email">
            <input v-model="password" type="password" class="form-control mb-3" placeholder="Password">
            <input @click.prevent="login" type="submit" class="btn btn-primary" value="Login">
            <div v-if="error" class="text-danger mt-3">{{ this.error }}</div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Login",

    data(){
        return{
            email: null,
            password: null,
            error: null,
        }
    },

    methods:{
        login(){
            axios.post('/api/auth/login', {email: this.email, password: this.password})
                .then(res => {
                    localStorage.setItem('access_token', res.data.access_token);
                    this.$router.push({name: 'cars.index'})
                }).catch(error => {
                    this.error = error.response.data.error
                })
        }
    }

}
</script>

<style scoped>
    div{width: 50%; margin: 0 auto;}
</style>
