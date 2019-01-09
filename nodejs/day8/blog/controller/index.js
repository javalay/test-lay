const conn=require('../db/index.js')
//展示首页页面
const showIndexPage=(req,res)=>{
    // console.log(222222)  // 每页显示3条数据
    const pagesize = 3
    const nowpage = Number(req.query.page) || 1 
    console.log(nowpage)
    //两个查询语句， 有两个查询结果
    const sql=`SELECT blog_articles.id,blog_articles.title,blog_articles.ctime,blog_users.nickname 
    FROM blog_articles LEFT JOIN blog_users ON blog_articles.authorId=blog_users.id 
    ORDER BY blog_articles.id DESC
    limit ${(nowpage - 1) * pagesize}, ${pagesize};
    select count(*) as count from blog_articles`
    conn.query(sql,(err,result)=>{
        //如果查询错误，就返回下面的的数据
        console.log(result[1][0].count)
        if(err){
            res.render('index.ejs',{
                user:req.session.user,
                islogin:req.session.islogin,
                articles :[]
            })
        }
    // 总页数
    const totalPage = Math.ceil(result[1][0].count / pagesize)
    res.render('index.ejs',{
        user:req.session.user,
        islogin:req.session.islogin,
        articles : result[0],
        // 总页数
      totalPage: totalPage,
      // 当前展示的是第几页
      nowpage: nowpage
    })
})
}
module.exports={ 
    showIndexPage
}