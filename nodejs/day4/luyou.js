const express=require('express')
const app=express()
  // 导入自己的路由模块
const router=require('./router.js')
// app.get('/',(req,res)=>{
//     res.sendFile('./dom/index.html',{root:__dirname})
// })
//  // 使用 app.use() 来注册路由
app.use(router)
app.listen(3040,()=>{
    console.log('http://127.0.0.1:3040')
})