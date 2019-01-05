const express=require('express')
const app=express()
const bodyParser=require('body-parser')
const path =require('path')
//注册 body-parser  中间件，来解析Post提交过来的表单数据
app.use(bodyParser.urlencoded({extended:false}))

//get请求 http://127.0.0.1:3000/index/1/zs 进行数据的传输  '/index/:id/:name' 这get的请求中进行获取  req.params 这方式进行获取数据
app.get('/index/:id/:name',(req,res) =>{
    console.log(req.params)
    res.sendFile('./dom/index.html',{root:__dirname})
})
// http://127.0.0.1:3000/about?name=中国&age=10086   通过这种方式进行数据的传输   req.query 这种方式进行数据的接收
app.get('/about',(req,res) =>{
    console.log(req.query)
    res.sendFile('./dom/about.html',{root:__dirname})
})

//监听客户端 post 请求
app.post('/user',(req,res)=>{
    //服务器 ，可以通过req.query 属性获取客户端提交到服务器的数据 查询数据
    console.log(req.body)
    console.log(req.query)
    res.send('ok')
})
app.listen(3000,()=>{
    console.log('http://127.0.0.1:3000')
})