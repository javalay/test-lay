const express=require('express')
const app=express()
const path =require('path')
app.get('/index',(req,res) =>{
    res.sendFile('./dom/index.html',{root:__dirname})
})
app.get('/about',(req,res) =>{
    res.sendFile('./dom/about.html',{root:__dirname})
})
app.listen(3000,()=>{
    console.log('http://127.0.0.1:3000')
})