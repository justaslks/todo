import { createStore } from 'vuex'

import userModule from './modules/userModule'
import taskModule from './modules/taskModule'
import adminModule from './modules/adminModule'

const store = createStore({
    modules: {
        userModule,
        taskModule,
        adminModule,
    }
})

export default store