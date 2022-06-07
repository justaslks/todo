<template>
    <Navbar/>
    <router-view /> 
  <div class="page">
  </div>
  <Footer class="mt-auto" />
</template>


<script>
import Navbar from './components/Navbar.vue';
import Footer from '@/components/Footer.vue';
import axios from 'axios';
export default {
    name: "App",
    components:  { 
      Navbar,
      Footer
    },
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
.page{
  padding-top: 20px;
}
</style>
