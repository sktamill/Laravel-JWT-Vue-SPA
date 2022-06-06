<template>
    <div>
        <div>
            <input v-model="name" type="text" class="form-control mb-3 mt-3" placeholder="Name">
            <input v-model="email" type="email" class="form-control mb-3" placeholder="Email">
            <input v-model="password" type="password" class="form-control mb-3" placeholder="Password">
            <input v-model="password_confirmation" type="password" class="form-control mb-3" placeholder="Confirm Password">
            <input @click.prevent="storeUsers" type="submit" class="btn btn-primary" value="Registration">
            <div v-if="error" class="text-danger mt-3">{{this.error}}</div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Registration",

    data(){
        return{
            name: null,
            email: null,
            password: null,
            password_confirmation: null,
            error: null
        }
    },

    methods:{
        storeUsers(){
            axios.post('/api/auth/users', {name: this.name, email: this.email, password: this.password, password_confirmation: this.password_confirmation})
                .then(res => {
                    localStorage.setItem('access_token', res.data.access_token)
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
