import { createApp } from 'vue'
import App from './App.vue'
import store from './store'
import router from './router'
import cors from 'cors';

createApp(App).use(cors).use(router).use(store).mount('#app')
