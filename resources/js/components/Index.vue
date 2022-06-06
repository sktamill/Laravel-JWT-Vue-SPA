<template>
  <div>
      <router-link @click.native="messCar" :to="{name: 'cars.index'}">Cars</router-link>
      <router-link v-if="!accessToken" :to="{name: 'user.login'}"> | Login | </router-link>
      <router-link v-if="!accessToken" :to="{name: 'user.registration'}">Registration</router-link>
      <router-link v-if="accessToken" :to="{name: 'user.personal'}"> | Personal</router-link>
      <a v-if="accessToken" @click.prevent="logout" href=""> | Logout</a>
      <router-view></router-view>
      <div v-if="mess" class="text-danger mb-3">{{this.mess}}</div>
  </div>
</template>

<script>
import api from "../api";

export default {
    name: "Index",

    data() {
        return {
            accessToken: null,
            mess: null
        }
    },

    mounted() {
        this.getAccessToken()
    },

    updated() {
        this.getAccessToken()
    },

    methods: {
        getAccessToken() {
            this.accessToken = localStorage.getItem('access_token')
        },

        logout() {
            api.post('/api/auth/logout')
                .then(res => {
                    localStorage.removeItem('access_token')
                    this.$router.push({name: 'user.login'})
                })
        },

        messCar() {
            if (!this.accessToken) {
                this.mess = 'Cars available after Login!'
            }
        }
    },

    watch: {
        $route(to, from) {
            this.mess = false;
        }
    }

}
</script>

<style scoped>
 div{text-align: center; font-size: 20px; padding: 20px;}
</style>
