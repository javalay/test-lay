const express = require('express')
const fs=require('fs')
const path =require('path')
const app = express()
//注册中间件，获取post请求时表单的数据
const body = require('body-parser')
app.use(body.urlencoded({ extended: false }))


//这里托管不用添加 虚拟路径
app.use(express.static('./views'))
//把node_modules 文件夹，托管为静态资源目录  这里  挂载 /node_modules  虚拟路径 。 我们在页面找路径的只能提示才可以很容易找到文件
app.use('/node_modules', express.static('./node_modules'))

//使用模板渲染数据
app.set('view engine', 'ejs')
app.set('views', './views')
// // 导入 router/index.js 模块
// const router1=require('./router/index.js')
// //请用router1这个模块
// app.use(router1)

// // 导入 router/uster.js 模块
// const router2=require('./router/users.js')
// //请用router2这个模块
// app.use(router2)

//使用 循环的方式，进行路由的自动注册
//在某个路径下读取文件名的
fs.readdir(path.join(__dirname,'./router'),(err,filenames)=>{
    if(err) return　console.log('读取 router 目录中的路由失败！')
    // 查看文件夹中有几个文件
    // console.log(filenames) 
    //循环router 目录下的每一个文件名
    filenames.forEach(fname=>{
        //文件的完整路径
        // console.log(path.join(__dirname,'./router',fname))
        //没循环一次，拼接出一个完整的路由模块地址，然后 使用require 导入这个路由模块
        const router=require(path.join(__dirname,'./router',fname))
        app.use(router)
    })
})
app.listen(90, () => {
    console.log('http://127.0.0.1:90')
})