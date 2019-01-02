const http =require('http');
const fs=require('fs')
const path=require('path')
 http.createServer((req,res)=>{
     let url=req.url
     console.log(url);
     
 	//设置报文响应头,告诉浏览器使用响应的数据
	// res.setHeader('Content-type','text/html;charset=utf-8');
	if(req.url===''|| url==="/index.html"){
        // res.end('Hello Index <h1>你22 哈皮</h1>')
        // readFile 读取文件
        console.log(__dirname);
        fs.readFile(path.join(__dirname,url),(err,data)=>{
            if(err) throw err
            res.end(data)
        })                        
	}else if(url==="/login.html"){
        res.end('Hello login')
        fs.readFile(path.join(__dirname,url),(err,data)=>{
            if(err) throw err 
            res.end(data)
        })
	}else if(url==="/list.html"){
        res.end('Hello list')
        fs.readFile(path.join(__dirname,url),(err,data)=>{
            if(err) throw err 
            res.end(data)
        })
	}else if(url==="/register.html"){
        res.end('Hello register')
        fs.readFile(path.join(__dirname,url),(err,data)=>{
            if(err)  throw err 
            res.end(data)
        })
        //表示用户要请求图片-- 这里要重新弄一个判断 改变 申请地址文件
    }else if(url==='/index.jpg'){
        fs.readFile(path.join(__dirname,url),(err,data)=>{
            if(err) throw err 
            res.setHeader('Content-type','image/jpeg')
            res.end(data)
        })
    }else if(url==='/index.css'){
        fs.readFile(path.join(__dirname,'./index.css'),(err,data)=>{
            if(err) throw err 
            //请求头 要设置 类型
            res.setHeader('Content-type','text/css')
            res.end(data)
        })
    }
    else{
        // res.end('404 , not Fount . 客户端错误')
        fs.readFile(path.join(__dirname,'./404.html'),(err,data)=>{
            if(err) throw err 
        })
	}
}).listen(3000,()=>{ 
	console.log('服务器启动了，请访问 ： http://localhost:3000')
})
