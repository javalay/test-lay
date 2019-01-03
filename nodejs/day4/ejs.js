const express=require('express')
const app=express()
app.set('view engine','ejs')
app.set('views','./ejs')
app.get('/',(req,res)=>{
    res.render('index.ejs',{name:'zs',age:22,hobby:['吃饭','阅读','睡觉']})
}) 
app.listen(3030,()=>{
    console.log('http://127.0.0.1:3030')
})