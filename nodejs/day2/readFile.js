const fs=require('fs');
fs.readFile('../test.txt','utf-8', (err,data) => {if(err){ return console.log('读取文件失败'+err.message)}  console.log(data)})