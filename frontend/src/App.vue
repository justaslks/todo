<template>
  <Navbar/>
  <router-view />
</template>


<script>
import Navbar from './components/Navbar.vue';
import axios from 'axios';
export default {
    name: "App",
    components:  { Navbar },
    created() {
      axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('app_token');
    }
}
</script>
<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}
</style>
