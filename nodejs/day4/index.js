const express = require('express')
const path= require('path')
const app= express()
//这是只有一个参数的时候
// app.use(express.static('./dom'))
//两个参数的时候我们要给它指定一个虚拟路径
app.use('/page',express.static('./dom'))
// app.get('/',(req,res)=>{
//     // res.send("你干了什么")
//     // res.send({name:'zs',age:22})
//     // res.end("你干了什么")
//     // res.sendFile(path.join(__dirname,'/index.html'))
// })
app.listen(3000,()=>{
    console.log('http://localhost:3000')
}) 