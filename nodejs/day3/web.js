const http=require('http')
http.createServer(function(req,res){
    res.writeHeader(200,{
        'Content-Type':'text/plain;charset=utf-8'
    })
    res.end('世界你好')
}).listen(9090,function(){
    console.log('htt://lacahost:9090');
})