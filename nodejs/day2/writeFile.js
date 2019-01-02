const fs=require('fs')
fs.writeFile('./test.txt','你成功写入文件了', (err) => {
     if(err) { return console.log("写入失败"+err.message)} 
     console.log('写入成功')
    });
    fs.appendFile('./test.txt','\n你追加成功',(err) => {if(err){return console.log('你追加失败'+err.message)} console.log('你追加成功')})