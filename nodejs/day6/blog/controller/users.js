const moment=require('moment')
const conn=require('../db/index.js')
//用户请求的注册页面 
const showregister=(req, res) => {
    //当在调用模板引擎res.render函数的时候， 。/   是相对路径，是相对于app.set('views') 指定的目录来进行查找的
    res.render('./user/register.ejs', {})
}
//用户请求的是登录页面
const showlogin=(req, res) => {
    //当在调用模板引擎res.render函数的时候， 。/   是相对路径，是相对于app.set('views') 指定的目录来进行查找的
    res.render('./user/login.ejs', {})
}
//要注册新用户了
const register=(req, res) => {
    //获取前端通过表单发过来的数据
    let body = req.body
    // console.log(body)
    if (body.username.trim().length <= 0 || body.password.trim().length <= 0 || body.nickname <= 0) {
        return res.send({ msg: '请填写完整的数据', static: 501 })
    }
    //查用户名有没有重复操作
    let sql1 = 'select count(*) as count from blog_users where username=?'
    conn.query(sql1, body.username, (err, result) => {
        // console.log(result);
        // console.log(err);
        if (err) return res.send({ msg: '查重操作失败', static: 502 })
        if (result[0].count !== 0) return res.send({ msg: 'sorry，用户名重复了', static: 503 })
        body.ctime = moment().format('YYYY-MM-DD HH:mm:ss')
        let sql2 = 'insert into blog_users set ?'
        conn.query(sql2, body, (err, result) => {
            // console.log(err.message)
            if (err) return res.send({ msg: '注册操作失败', static: 504 })
            if (result.affectedRows !== 1) return res.send({ msg: '注册功能失败!', static: 505 })
            res.send({ msg: 'ok', static: 200 })
        })
    })
}
// 监听 登录的请求
const login=(req,res)=>{
    let body = req.body
    // console.log(body);
    //执行sql语句查询用户是否存在
    const sql2='select *from blog_users where username=? and password=?'
    conn.query(sql2,[body.username,body.password],(err,result)=>{
        // 如果查询期间，执行sql语句失败，则任务登录失败
        if(err) return res.send({msg:'查询用户失败',static:501})
        // 如果查询结果，记录条数不为一 则证明查询失败
        //  console.log(result)
        if(result.length !==1) return res.send({msg:'用户登录失败',static:502})
        //查询成功
        res.send({msg:'ok',static:200})
    })
}
module.exports={
    showregister,
    showlogin,
    register,
    login
}