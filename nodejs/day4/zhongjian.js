const express=require('express')
const app = express()
const querystring=require('querystring')
//定义中间件
app.use((req,res,next)=>{
    let dataStr=''
    req.on('data',chunk=>{
        dataStr +=chunk
    })
    req.on('end',()=>{
        console.log(dataStr)
        const obj=querystring.parse(dataStr)
        console.log(obj)
        const bj=querystring.stringify(dataStr)
        console.log(bj)
        //把获取到的数据obj暴露到body
        req.body=obj
        next()
    })
})

//下面的这个两个方法是引用级别的方法
app.get('/',(req,res)=>{
    res.sendFile('./zhong.html',{root:__dirname})
})
//监听客户端的post的请求
app.post('/postdata',(req,res)=>{
    console.log(req.body)
    res.send(req.body)
})
app.listen(3000,()=>{
    console.log('http://127.0.0.1:3000')
})
