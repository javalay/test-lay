const moment=require('moment')
const conn=require('../db/index.js')
const marked=require('marked')

//添加文章页面渲染
const showAdd=(req,res)=>{
    //如果用户没有登录，则不准许访问文章添加页 则会返回主页面   
    if(!req.session.islogin) return res.redirect('/')
    res.render('./article/add.ejs',{
                //这里要获取 session 中存储的数据  要不然模板获取不到会报错
                user:req.session.user,
                islogin:req.session.islogin
            })
}
//添加新文章
const showArticle=(req,res)=>{
    // console.log(req.body)
    const body=req.body
    body.ctime=moment().format('YY-MM-DD HH-mm-ss')  
    // console.log(body)
    const sql='insert into blog_articles set ?'
    conn.query(sql,body,(err,ressult)=>{
        // console.log(ressult)
        if(err) return res.send({msg:'发表文章失败',status:500})
        if(ressult.affectedRows !==1) return res.send({msg:'发表文章失败',status:501})
        res.send({msg:'发表文章成功',status:200,insertId:ressult.insertId})
    })
}
//文章详情页 
const showDetail=(req,res)=>{
     console.log(req.params)
    //获取地址栏上面传过来的id值
     const id=req.params.id
     //根据id查询文章的信息
     sql='select * from blog_articles where id=?'
     conn.query(sql,id,(err,result)=>{
         if(err)return res.send({msg:'获取文章详情失败！！',status:500})
        console.log(result)
        if(result.length!==1) return res.redirect('/')
        //在调用  res.render 方法之前 要先把markdown 文本 ，转未html 文本
       const html= marked(result[0].content) 
       console.log(html)
       result[0].content = html
        res.render('./article/info.ejs',{
            //这里要获取 session 中存储的数据  要不然模板获取不到会报错
            user:req.session.user,
            islogin:req.session.islogin, 
            article:result[0]})
     })
}
//展示编辑文章
const showEdit= (req,res)=>{
  // 如果用户没有登录，则不允许查看文章编辑页面
//   console.log(req.params.id)
//判断是否有没有登录
  if (!req.session.islogin) return res.redirect('/')
  const sql = 'select * from blog_articles where id=?'
    conn.query(sql,req.params.id,(err,result)=>{
        if(err) return res.send({msg:'修改文章失败',status:500})
        // console.log(result)
        if (result.length !== 1) return res.redirect('/')
        // 渲染详情页
        res.render('./article/edit.ejs', { user: req.session.user, islogin: req.session.islogin, article: result[0] })
    })
}
//编辑文章
const showEditAticle=(req,res)=>{
    const sql = 'update blog_articles set ? where id=?'
    conn.query(sql, [req.body, req.body.id], (err, result) => {
      if (err) return res.send({ msg: '修改文章失败！', status: 501 })
      if (result.affectedRows !== 1) return res.send({ msg: '修改文章失败！', status: 502 })
      res.send({ msg: 'ok', status: 200 })
    })
}
module.exports={
    showAdd,
    showArticle,
    showDetail,
    showEdit,
    showEditAticle
}