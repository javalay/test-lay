const http=require('http')
http.createServer(function(req,res){
    res.statusCode=200
    res.statusMessage='ok'
    // res.writeHead(404,"Not Found",{'Content-type':'text/html;charset=utf-8'});
    res.end('成功打开网页')
}).listen(9091,function(){
    console.log('http://localhost:9091')
})