// import Vue from 'vue'
import VueRouter from 'vue-router'
// Vue.use(VueRouter)

// 3. 创建路由对象
//路由 的实现
import account from "./main/Account.vue"
import title1 from "./main/title.vue"
import login from "./sub/login.vue"
import str from "./sub/ster.vue"
var router=new VueRouter({
    routes:[
        {path:'/account',component:account,
          children:[
            {path:'/login',component:login,
            children:[
                {path:'str',component:str}
            ]}, 
            {path:'/title1',component:title1,
            children:[
                {path:'str',component:str}
            ]
            }
      ]
    },
        {path:'/title',component:title1}
    ]
}) 
// 把路由对象暴露出去
export default router