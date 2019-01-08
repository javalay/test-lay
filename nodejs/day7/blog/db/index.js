const mysql=require('mysql')
const conn=mysql.createConnection({
    host:'127.0.0.1',
    database:'mysql_001',
    user: 'root',
    password : '',
    multipleStatements:true
})
//把当前模块中创建的 conn 数据库链接对象 ， 暴露出去
module.exports=conn