//路由模块
const express=require('express')
const router=express.Router()
//导入自己写的模块
const ctrl=require('./controller.js')
//对接口的检查操作
router.get('/',ctrl.gettest)
//获取英雄操作
router.get('/getahero',ctrl.getahero)
//添加英雄操作
router.post('/addhero',ctrl.addhero)
//根据id获取英雄信息---这是另一种传递参数的方式
router.get('/gethero/:id',ctrl.gethero)
//--------------根据id修改英雄----------------
router.post('/alter/:id',ctrl.alter)
//-------------根据id软删除------------
router.get('/del/:id',ctrl.del)
//-------------根据id软删除------------
router.get('/alte/:id',ctrl.alte)
// express.use(router)
//暴露数据
module.exports=router