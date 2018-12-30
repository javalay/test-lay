const http =require('http');
const fs=require('fs')
const path=require('path')
 http.createServer(function(req,res){
 	//设置报文响应头,告诉浏览器使用响应的数据
	// res.setHeader('Content-type','text/html;charset=utf-8');
	if(req.url===''|| req.url==="/index"){
        // res.end('Hello Index <h1>你22 哈皮</h1>')
        // readFile 读取文件
        console.log(__dirname);
        fs.readFile(path.join(__dirname,'htmls','index.html'),function(err,data){
            if(err){
                throw err
            }
            res.end(data)
        })
	}else if(req.url==="/login"){
        res.end('Hello login')
        fs.readFile(path.join(__dirname,'htmls','login.html'),function(err,data){
            if(err){
                throw err
            }
            res.end(data)
        })
	}else if(req.url==="/list"){
        res.end('Hello list')
        fs.readFile(path.join(__dirname,'htmls','list.html'),function(err,data){
            if(err){
                throw err
            }
            res.end(data)
        })
	}else if(req.url==="/register"){
        res.end('Hello register')
        fs.readFile(path.join(__dirname,'htmls','register.html'),function(err,data){
            if(err){
                throw err
            }
            res.end(data)
        })
        //表示用户要请求图片-- 这里要重新弄一个判断 改变 申请地址文件
    }else if(req.url==='/images/index.xxx'){
        fs.readFile(path.join(__dirname,'images','index.jpg'),function(err,data){
            if(err){
                throw err
            }
            res.setHeader('Content-type','image/jpeg')
            res.end(data)
        })
    }else if(req.url==='/css/index.css'){
        fs.readFile(path.join(__dirname,'css','index.css'),function(err,data){
            if(err){
                throw err
            }
            //请求头 要设置 类型
            res.setHeader('Content-type','text/css')
            res.end(data)
        })
    }
    else{
        // res.end('404 , not Fount . 客户端错误')
        fs.readFile(path.join(__dirname,'htmls','404.html'),function(err,data){
            if(err){
                throw err
            }

        })
	}
}).listen(9090,function(){ 
	console.log('服务器启动了，请访问 ： http://localhost:9090')
})
