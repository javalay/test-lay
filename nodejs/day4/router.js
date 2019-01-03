//  // 1. 封装单独的 router.js 路由模块文件
const express=require('express')
  // 创建路由对象
const router=express.Router()
router.get('/index',(req,res)=>{
    res.sendFile('./dom/index.html',{root:__dirname})
})
router.get('/about',(req,res)=>{
    res.sendFile('./dom/about.html',{root:__dirname})
})
  // 导出路由对象
module.exports = router