const express=require('express')
const router=express.Router()
const users=require('../controller/users.js')

//获取数据库的模块
const conn = require('../db/index.js')
//用户请求的注册页面 
router.get('/register',users.showregister )
//用户请求的是登录页面
router.get('/login', users.showlogin)
//要注册新用户了
router.post('/register', users.register)
// 监听 登录的请求
router.post('/login',users.login)
//监听 注销按钮
router.get('/logout',users.logout)
module.exports=router