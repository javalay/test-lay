// 入口文件
console.log('OK')
// import Vue from '../node_modules/vue/dist/vue.js'
import Vue from 'vue'
import VueRouter from "vue-router"
Vue.use(VueRouter)
// import { Button } from 'mint-ui';
// Vue.component(Button.name, Button);
import MintUI from 'mint-ui'
import 'mint-ui/lib/style.css'
Vue.use(MintUI)
import App from "./App.vue"
//这是第二种方式去接收向外暴露成员的方式 title1 as t1 这种方式可以起别名
import test,{title,title1 as t1} from "./test.js"
console.log(test.name)
console.log(title,t1)
//  把抽离出去的router文件 引入进来
import router from "./router.js"
import "./lib/mui/css/mui.css"
var vm=new Vue({
    el:'#app',
    data:{
      msg:20
    },
    render: c=> c(App),
    router
  })