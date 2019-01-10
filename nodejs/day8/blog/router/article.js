const express=require('express')
const router=express.Router()
const ctrl=require('../controller/article.js')
//添加文章页面
router.get('/article/add',ctrl.showAdd)
router.post('/article/add',ctrl.showArticle)
router.get('/article/info/:id',ctrl.showDetail)
router.get('/article/edit/:id',ctrl.showEdit)
// 用户要编辑文章
router.post('/article/edit', ctrl.showEditAticle)
//把router暴露出去
module.exports=router 