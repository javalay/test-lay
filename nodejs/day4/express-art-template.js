const express=require('express')
 const app= express()
 //定义模板引擎名称
 app.engine('html',require('express-art-template'))
 //定义模板引擎的方式
 app.set('view engine','html')
 //定义views指向的模板引擎目录
 app.set('views','./art')
 app.get('/',(req,res)=>{
     //使用render方法调用
     res.render('art.html',{
         name:'zd',
         age:22,
         books:['西游记','红楼梦','活着']
     })
 })
 app.listen(3030,()=>{
     console.log('http://127.0.0.1:3030')
 })