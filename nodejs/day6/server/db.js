//数据操作模块  -- 只负责数据库链接对象
const mysql=require('mysql')
const conn=mysql.createConnection({
    host:'127.0.0.1',
    user:  'root',
    password: '',
    database: 'mysql_001'
})
//把conn暴露出去
module.exports=conn