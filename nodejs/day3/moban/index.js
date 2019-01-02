const path=require('path')
const template=require('art-template')
const http =require('http')
const server=http.createServer()
server.on('request',(req,res)=>{
    const url=req.url
    if(url==='/'){
        const html=template(path.join(__dirname,'./index.html'),{name:'xh',age:22,hobby:['湾','呵呵','喝','打代码']})
        res.end(html)
    }
}).listen('3030',()=>{
    console.log('http://localhost:3030');
})