import { createStore } from 'vuex'

import userModule from './modules/userModule'
import taskModule from './modules/taskModule'

const store = createStore({
    modules: {
        userModule,
        taskModule
    }
})

export default store