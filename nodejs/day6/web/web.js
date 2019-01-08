const express=require('express')
const app=express()
//托管views semantic node_modules文件夹
app.use(express.static('./views'))
app.use('/semantic',express.static('./semantic'))
app.use('/node_modules',express.static('./node_modules'))
app.listen(3001,()=>{
    console.log('http://127.0.0.1:3001')
})