const express =require('express')
//开启框架
const app=express()
//导入中间件
const body=require('body-parser')
//注册中间件
app.use(body.urlencoded({extended:false}))
//在API服务器端，启用CORS跨域支援共享
const cors =require('cors')
app.use(cors())
//导入自己定义的模块
const router=require('./router.js')
//注册路由
app.use(router)
app.listen(5000,()=>{
    console.log('http://127.0.0.1:5000')
})