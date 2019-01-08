const express=require('express')

const router=express.Router()

const controller=require('../controller/index.js')

// 用户请求的 项目首页
router.get('/', controller.showIndexPage)


//把路由对象暴露出去
module.exports=router