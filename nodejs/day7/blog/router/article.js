const express=require('express')
const router=express.Router()
router.get('/article/add',(req,res)=>{
    res.render('./article/add.ejs',{
        //这里要获取 session 中存储的数据  要不然模板获取不到会报错
        user:req.session.user,
        islogin:req.session.islogin
    })
})
//把router暴露出去
module.exports=router