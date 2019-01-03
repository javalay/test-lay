const express=require('express')
const app=express()
const mysql=require('mysql')
const conn=mysql.createConnection({
    host:'localhost',
    user:'root',
    password:'',
    database:'mysql_001'
})
//--------------新增----------------
// const user={uname:'小强',age:21,gender:'男'}
// const sqlStr1='insert into users set ?'
// conn.query(sqlStr1,user,(err,result)=>{}
//     if(err) return console.log('插入数据失败'+err.message)
//     console.log(result)
// })
//---------------查-----------------
const sqlStr='select *from users'
conn.query(sqlStr,(err,result)=>{
    if(err) return console.log('获取数据失败'+err.message)
    console.log(result)
})
//--------------修改----------------
const userr={id:0,uname:'小强',age:26}
//两个问好， 就是要传入两个参数
const sqlStr2='update users set ? where id=?'
conn.query(sqlStr2,[userr,userr.id],(err,result) =>{
    if(err) return console.log('修改数据失败'+err.message)
    console.log(result)
})
//-------------删除------------
// const sqlStr3='delete from users where id=?'
// conn.query(sqlStr3,0,(err,result)=>{
//     if(err) return console.log('删除失败'+err.message)
//     console.log(result)
// })
app.listen(3030,()=>{
    console.log()
})
